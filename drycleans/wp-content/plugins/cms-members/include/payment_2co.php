<?php
if ('payment_2co.php' == basename($_SERVER['SCRIPT_FILENAME']))
     die ('<h2>Direct File Access Prohibited</h2>');


require_once('TwoCo.php');

global $wpdb;
$pageid=get_the_id();
if (get_option('permalink_structure')) {
	$this_script =clean_url(get_permalink($pageid));
	$ipnpage=$this_script.'?action=ipn&amp;method=twoco';
}else{
	$this_script = get_option('home').'?page_id='.$pageid;
	$ipnpage=$this_script.'&amp;action=ipn&amp;method=twoco';
}


$admin_email=get_option('admin_email');

$my2CO = new TwoCo();
$my2CO->ipnLog = TRUE;
// if there is not action variable, set the default action of 'process'
if (empty($_GET['action'])) $_GET['action'] = 'process';  

$my2CO->addField('sid', get_option('wwm_2co_sid'));
$my2CO->addField('cart_order_id', $plantitle);
$my2CO->addField('total', $planprice);
$my2CO->addField('x_Receipt_Link_URL', $ipnpage);
$my2CO->addField('id_type', '1');

if (get_option('wwm_2co_mode')=='test')
	$my2CO->enableTestMode();
				
//custom parameteers
$my2CO->addField('custom',$checkid);  
$my2CO->addField('blog_domain',$blog_domain);
$my2CO->addField('blog_title',$blog_title);

switch ($_GET['action']) {
    
   case 'process':      // Process and order...
 
      $my2CO->submitPayment();
      break;
 
   case 'ipn':         
         // Payment has been recieved and IPN is verified.  This is where you
         // update your database to activate or process the order, or setup
         // the database with the user's order details, email an administrator,
         // etc.  You can access a slew of information via the ipn_data() array.

		$my2CO->setSecret(get_option('wwm_2co_secret'));
				
		if (get_option('wwm_2co_mode')=='test') 
			$my2CO->enableTestMode();
     
		if ($my2CO->validateIpn()) {
				
			$error=false;
			
			$txn_id = $wpdb->escape($my2CO->ipnData['cart_order_id']);
			$memo = $wpdb->escape('2Checkout Key: '.$my2CO->ipnData['md5_hash']);
			$payer_fname = $wpdb->escape($my2CO->ipnData['customer_first_name']);
			$payer_lname = $wpdb->escape($my2CO->ipnData['customer_last_name']);
			$payer_country = $wpdb->escape($my2CO->ipnData['residence_country']);
			$payer_email = $wpdb->escape($my2CO->ipnData['customer_email']);
			$item_name =$wpdb->escape($my2CO->ipnData['cart_order_id']);
			$gross = $my2CO->ipnData['invoice_list_amount'];
			$payment_date_time = date('Y-m-d H:i:s');
			$payment_status = $wpdb->escape($my2CO->ipnData['invoice_status']);
		
			
			$check_id = $wpdb->escape($my2CO->ipnData['custom']);
	
			
			$info=$wpdb->get_row("SELECT id,planid, status ,user_login,user_email,user_pass , user_nicename ,user_url ,display_name,first_name,last_name,description,yim, aim, jabber,company,country  ,state  , city  ,address,address2, zip ,phone,birthday ,gender,ip, avatar,promocode, customfields FROM ".WWM_ORDERS_TABLE."  WHERE checkid='".$check_id."' LIMIT 1;");
					
			
			
			$planinfo=get_plan_info($info->planid);
			
			$planprice=$planinfo->price;
			$planduration=$planinfo->duration;
			$plantitle=$planinfo->title;
			$plantype=$planinfo->plantype;
			
			
			//check txn_id is unique
			$checktrans=$wpdb->get_results("SELECT txnid FROM ".WWM_ORDERS_TABLE.";");
			foreach($checktrans as $trans){
				if(strpos($trans->txnid,  $txn_id)===true){
					$details .= "<br>Duplicated Transaction ID. Transaction ID: {$txn_id} ";
					$error=true;
				}
			}
			
						
			if ($planduration)
				$expiredate = date("Y-m-d H:i:s",strtotime('+'.$planduration.'day'));else $expiredate=0;
			
			
			$id='';
			if ( !$error ) {
				echo "<div class=\"wwm-thanksmessage\">".__('Thank you for your payment.','wwm')."</div>";
				if ( ($plantype=='membership')||($main_fields[0][show])) { //register user after completed payment if type=membership or usernamefield was displayed
				
				require_once(ABSPATH.'/wp-includes/registration.php');
							
					$user_login = $info->user_login;
					$user_email = $info->user_email;
					$user_pass = $info->user_pass;
					$user_nicename=$info->user_nicename;
					$user_url=$info->user_url;
					$display_name=$info->display_name;
					$first_name=$info->first_name;
					$last_name=$info->last_name;
					$description=$info->description;
					$yim=$info->yim;
					$aim=$info->aim;
					$jabber=$info->jabber;
						
					$userdata = compact('user_login', 'user_email', 'user_pass','user_nicename','user_url','display_name','first_name','last_name','description','yim','aim','jabber');
					$id=wp_insert_user($userdata);
									
					update_usermeta($id,'plan_id',$info->planid);
					update_usermeta($id,'company',$info->company);
					update_usermeta($id,'country',$info->country);
					update_usermeta($id,'state',$info->state);
					update_usermeta($id,'city',$info->city);
					update_usermeta($id,'address',$info->address);
					update_usermeta($id,'address2',$info->address2);
					update_usermeta($id,'zip',$info->zip);
					update_usermeta($id,'phone',$info->phone);
					update_usermeta($id,'birthday',$info->bithday);
					update_usermeta($id,'gender',$info->gender);
					update_usermeta($id,'last_ip',$info->ip);
					update_usermeta($id,'status','');
					
					if ($expiredate) update_usermeta($id,'expire',$expiredate);
					
					update_usermeta($id,'avatar',$info->avatar);
					update_usermeta($id,'promocode',$info->promocode);
		
					do_action('wwm_paid_member_registered',$id);
					
					$custom=unserialize($info->customfields);
						
					$last_id= wwm_get_fields_last_id(); //last field
						
					
					for ($i=1;$i<=$last_id;$i++) {
						if  ( ($custom[$i][label]) && ($custom[$i][value]) )
						update_usermeta($id,'customfield_'.$i,$custom[$i][value]);
					}
				}//end if plan was membership
			
				$sql="UPDATE ".WWM_ORDERS_TABLE." SET
				userid=%s , status=%s, txnid=%s, memo=%s, payment_status=%s ,payment_date=%s ,payer_mail=%s ,payer_fname=%s ,payer_lname=%s ,payer_country=%s ,verify_sign=%s ,gross=%s WHERE checkid=%s LIMIT 1;";
				
				$wpdb->query($wpdb->prepare($sql,$id,$status,$txn_id,$memo,$payment_status, $payment_date,$payer_email, $payer_fname, $payer_lname, $payer_country, $verify_sign, $gross, $check_id));
				
				$order_id=$wpdb->get_var("SELECT id FROM ". WWM_ORDERS_TABLE." WHERE checkid='{$check_id}' LIMIT 1;");
				
				do_action('wwm_paid_order_registered',$order_id);
							
			  if (get_option('notify_paid_members_signup')) { //paid members and paid orders
				 $blogname=get_option('blogname');
				 $subject = '['.$blogname.'] IPN - Recieved Payment';
				 $to = $admin_email;    
				 $body =  "An instant payment notification was successfully recieved.\n\n";
				 $body .= "From: ".$p->ipn_data['payer_email']." \nOn ".date('m/d/Y') ." at " . date('g:i A');
				 $body .="\nPlan name: ".$plantitle."\nPlan Price:".$planprice."\n\nPlan Expire on: ".$expiredate."\nTransaction ID: ". $txn_id."\nGross: ".$gross."\nPayment Status: ".$payment_status."\n";
				 $body .="First Name:".$info->first_name."\nLast Name:". $info->last_name."\nRegisterd Email: ".$info->user_email."\nURL: ".$info->user_url."\nMemo: ".$memo."\nDescription: ".$info->description."\n\n";
				  
				 $body .= "For more details:\n".get_option('siteurl')."/wp-admin/admin.php?page=wwm-orders.php&view_order_id={$order_id} \n\nRegards,\nCMS Members";
				 
				 /*
				 $body .="<b>Login name: </b>".$user_login.'\n';
				 */ 
				

				if ( !wp_mail($to, $subject, $body, $header) ) 
						$msg= __('The e-mail could not be sent.') . "<br />\n" . __('Possible reason: your host may have disabled the mail() function...') ;
				
			  }//end notify admin
				
				if(get_option('paid_members_welcome_mail')) {
					$blogname=get_option('blogname');
					$subject = '['. $blogname.'] Thanks for Buying';
					$to = $user_email;    //  user email
					
					$body = get_option('paid_members_welcome_mail_body');
					$tags=array('{plantitle}','{expiredate}','{firstname}','{lastname}','{username}','{password}','{planid}');
					$replace=array($plantitle,$expiredate,$info->first_name,$info->last_name,$info->user_login,$info->user_pass,$info->planid);
					$body=str_replace($tags,$replace,$body);
					$body.='<p><small>Powered by <a href="http://wpwave.com/plugins/"> CMS Members</a><small>';
					 
					
					wwm_mail_actions('html'); //set actions
	
					if ( !wp_mail($to, $subject, $body, $header) ) 
							$msg= __('The e-mail could not be sent.') . "<br />\n" . __('Possible reason: your host may have disabled the mail() function...') ;
					
				 } //end welcome mail
	
			}else{//if we found an error
			
			 $status='Failed';
			 $sql="UPDATE ".WWM_ORDERS_TABLE." SET status=%s, failed_details=%s WHERE checkid=%s";
			 $wpdb->query($wpdb->prepare($sql,$status,$details,$check_id));
			}//end if error	 
			
		}else{//end if validate
			$status='Invalid';
			$sql="UPDATE ".WWM_ORDERS_TABLE." SET status=%s, failed_details=%s WHERE checkid=%s";
			$wpdb->query($wpdb->prepare($sql,$status,$details,$check_id));
		 
		}
			 
  	break;
 
 }     
?>