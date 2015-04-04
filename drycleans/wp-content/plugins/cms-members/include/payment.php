<?php
if ('payment.php' == basename($_SERVER['SCRIPT_FILENAME']))
     die ('<h2>Direct File Access Prohibited</h2>');

/*  PHP Paypal IPN Integration Class Demonstration File
 *  6.25.2008 - Eric Wang, http://www.ericbess.com/ericblog/?p=172
*/

require_once('paypal.class.php');
global $wpdb;
$pageid=get_the_id();
if (get_option('permalink_structure')) {
	$this_script =clean_url(get_permalink($pageid));
	$sucpage=$this_script.'?action=success';
	$canpage=$this_script.'?action=cancel';
	$ipnpage=$this_script.'?action=ipn';
}else{
	$this_script = get_option('home').'/?page_id='.$pageid;
	$sucpage=$this_script.'&action=success';
	$canpage=$this_script.'&action=cancel';
	$ipnpage=$this_script.'&action=ipn';
}

$admin_paypal_mail=get_option('wwm_paypal_mail_address');
$admin_email=get_option('admin_email');
$paypal_mode=get_option('wwm_paypal_mode');

//require_once('wp-blog-header.php');
//require_once(ABSPATH.'/wp-includes/pluggable.php');

// Setup class


if($paypal_mode=='live'){
	$p = new wwm_paypal_class(false); // initiate an instance of the class. true:sandbox / false:live use
}else{
	$p = new wwm_paypal_class(true);  //sandbox
}     

// if there is not action variable, set the default action of 'process'
if (empty($_GET['action'])) $_GET['action'] = 'process';
  
$rec = get_option('wwm_paypal_recurring');

if ($rec['0'] && (($plantype=='membership')||($main_fields[0][show])) ) {
	$p->add_field('src', '1');
	$p->add_field('sra', '1');
	$p->add_field('cmd', '_xclick-subscriptions');
	
	$p->add_field('a3', $planprice);
	
	
	$y=$planduration%365;
	$m=$planduration%30;
	
	
	if (!$y) { //if it is not zeo proccess days else convert duration to months
		$p->add_field('t3', 'Y');
		$p->add_field('p3', ($planduration/365));
	}elseif (!$m) {
		$p->add_field('t3', 'M');
		$p->add_field('p3', ($planduration/30));
	}else{
		$p->add_field('t3', 'D');
		$p->add_field('p3', $planduration);
	}
	
	if ($rec['p1'] ) { //set trial
		if ( $rec['a1'])
			$p->add_field('a1', $rec['a1']);
		else
			$p->add_field('a1', '0');
			
		$p->add_field('p1', $rec['p1']);
		$p->add_field('t1', 'D');
	}
	
	
	
}else{
	$p->add_field('amount', $planprice);
}

$p->add_field('currency_code',get_option('wwm_paypal_currency_code')); //['USD,GBP,JPY,CAD,EUR']
$p->add_field('item_name', $plantitle);
$p->add_field('notify_url', $ipnpage);
$p->add_field('cancel_return', $canpage);
$p->add_field('return', $sucpage);
$p->add_field('business', $admin_paypal_mail);
$paypalcustom= urlencode(serialize(array('c' => $checkid, 'd' =>	$blog_domain,'t' =>	$blog_title )));

$p->add_field('custom', $paypalcustom); 
$p->add_field('no_shipping', '1');
$p->add_field('no_note', '1');

foreach($_POST as $i => $v) {
	$postdata .= $i.'='.urlencode($v).'&';
}
$postdata .= 'cmd=_notify-validate';

switch ($_GET['action']) {
    
   case 'process':      // Process and order...

      // There should be no output at this point.  To process the POST data,
      // the submit_paypal_post() function will output all the HTML tags which
 
      $p->submit_paypal_post(); // submit the fields to paypal
   // $p->dump_fields();      // for debugging, output a table of all the fields
      break;
      
   case 'success':      // Order was successful...
   
      // This is where you would probably want to thank the user for their order
      // or what have you.  The order information at this point is in POST 
      // variables.  However, you don't want to "process" the order until you
      // get validation from the IPN.  That's where you would have the code to
      // email an admin, update the database with payment status, activate a
      // membership, etc.  
 
      echo "<div class=\"wwm-thanksmessage\">".__('Thank you for your payment.','wwm')."</div>";
    //  foreach ($_POST as $key => $value) { echo "$key: $value<br>"; }
      
      // You could also simply re-direct them to another page, or your own 
      // order status page which presents the user with the status of their
      // order based on a database (which can be modified with the IPN code 
      // below).
      
      break;
      
   case 'cancel':       // Order was canceled...
      echo "<div class=\"wwm-errormessage\">".__('The payment was canceled.','wwm')."</div>";
	  
		 /*if (isset($_POST['custom'])) { //Not sure paypal post this variable
				$check_id= $wpdb->escape($_POST['custom']);
				$sql="UPDATE ".WWM_ORDERS_TABLE." SET
				status=%s, payment_status=%s WHERE checkid=%s LIMIT 1;";
			
				$wpdb->query($wpdb->prepare($sql,'Cancelled','Cancelled', $check_id));
		 }*/
			
	  
      break;
      
   case 'ipn':         
         // Payment has been recieved and IPN is verified.  This is where you
         // update your database to activate or process the order, or setup
         // the database with the user's order details, email an administrator,
         // etc.  You can access a slew of information via the ipn_data() array.
     
     if ($p->validate_ipn()) {
	 
     	$error=false;
	 	
		$txn_id = $wpdb->escape($p->ipn_data['txn_id']);
		$memo = $wpdb->escape($p->ipn_data['memo']);
		$payer_fname = $wpdb->escape($p->ipn_data['first_name']);
		$payer_lname = $wpdb->escape($p->ipn_data['last_name']);
		$payer_country = $wpdb->escape($p->ipn_data['residence_country']);
		$payer_email = $wpdb->escape($p->ipn_data['payer_email']);
		$verify_sign = $wpdb->escape($p->ipn_data['verify_sign']);
		$item_name =$wpdb->escape($p->ipn_data['item_name']);
		$gross = $p->ipn_data['mc_gross'];
		$payment_date_time = date('Y-m-d H:i:s');
		$payment_status = $wpdb->escape($p->ipn_data['payment_status']);
		$custom_ipn = unserialize(urldecode($_POST['custom']));
		
		$check_id = $wpdb->escape($custom_ipn['c']);

		$info=$wpdb->get_row("SELECT * FROM ".WWM_ORDERS_TABLE."  WHERE checkid='".$check_id."' LIMIT 1;");	

		$planinfo=get_plan_info($info->planid);
		$planprice=$planinfo->price;
		$planduration=$planinfo->duration;
		$plantitle=$planinfo->title;
		$plantype=$planinfo->plantype;
			
		if ($planduration)
			$expiredate = date("Y-m-d H:i:s",strtotime('+'.$planduration.'day'));
		else
			$expiredate=0;
			
			
		if (!$info) {
			$p->ipn_status .= "<br>Invalid Check ID. Received Check ID: ".$check_id;
			$p->log_ipn_results(false);
			return;
		}
			
		if ($p->ipn_data["pending_reason"]) {
		
			$p->ipn_status = "No Completed Payment: ".$p->ipn_data["payment_status"].' Reason: '.$p->ipn_data["pending_reason"];
			$details .= "<br>The transaction was not completed successfully at Paypal. The pending reason for this is".' '.$p->ipn_data['pending_reason'];
			
			//$sql="UPDATE ".WWM_ORDERS_TABLE." SET failed_details=%s WHERE checkid=%s";
			//$wpdb->query($wpdb->prepare($sql,$details,$check_id));
	
			$p->log_ipn_results(false);
			$error=true;
            $status='Pending at PayPal';

		}
		
		if ($p->ipn_data["mc_gross"]< 0) {
			$refund_userid = $wpdb->get_var("SELECT userid FROM ".WWM_ORDERS_TABLE." WHERE checkid='".$check_id. "' LIMIT 1;");
			
			if ($refund_userid) {
				$sql="UPDATE ".WWM_ORDERS_TABLE." SET payment_status=%s WHERE checkid=%s  LIMIT 1;";
				$wpdb->query($wpdb->prepare($sql, $p->ipn_data["payment_status"],$check_id));
			}
			
			$details .= "<br>The Payment amount is negative. The payment status for this is".' '.$p->ipn_data['payment_status'];
			
			//update_usermeta($refund_userid,'expire', date("Y-m-d H:i:s");
			update_usermeta($refund_userid,'status', 'suspended');
			$p->log_ipn_results(false);
			$error=true;
            $status='Negative Payment. User Suspended)';

		}
		
		if ('subscr_cancel'==$p->ipn_data["txn_type"]) {
			$canc_userid = $wpdb->get_var("SELECT userid FROM ".WWM_ORDERS_TABLE." WHERE checkid='".$check_id. "' LIMIT 1;");
			
			$details .= "<br>The Subscribe profile was cancelled at PayPal. ".date("Y-m-d H:i:s");
			
			//update_usermeta($canc_userid,'expire', date("Y-m-d H:i:s");
			update_usermeta($canc_userid,'status','cancelled');
			$p->log_ipn_results(false);
			$error=true;
            $status='Cancelled Subscr';
			//$payment_status='Cancelled Subscr';
		}
		
			

		$valid=false;
		if ((strtolower($p->ipn_data["payment_status"]) == 'completed') && (!$error) ){
			
			$valid=true;
			if ('subscr_payment'==$p->ipn_data["txn_type"])
				$sub=true;
					
			//check txn_id is unique
			$checktrans=$wpdb->get_results("SELECT txnid FROM ".WWM_ORDERS_TABLE.";");
			foreach($checktrans as $trans){
				if(strpos($trans->txnid, $p->ipn_data['txn_id'])===true){
					$p->ipn_status .= "<br>Duplicated Transaction ID. Transaction ID: ".$p->ipn_data['txn_id'];
					//$error=true;
					$p->log_ipn_results(false);
					$valid=false;
				}
			}
			
			if($p->ipn_data['receiver_email']!= $admin_paypal_mail){
				$details .= "<br>Receiver email is different from your paypal mail. Receiver mail: {$p->ipn_data['receiver_email']}";
				$valid=false;
                $status='Failed (Different Receiver)';
			}
			
			if($info->gross!= $p->ipn_data["mc_gross"]){
				$details .= "<br>Paid amount is different from plan price (with promocodes). Received  money: ".$p->ipn_data["mc_gross"];
				$valid=false;
                $status='Failed (Different Amount)';
			}
			
			if (!$p->ipn_data['txn_id'])
				$valid=false;
				
			if(strtolower($info->payment_status)== 'completed'){
				$details .= "<br>It was completed before.";
				$valid=false;
			}
			
			$p->ipn_status .= "Payment Completed" .$details;
			$p->log_ipn_results(true);
		}

        //$p->ipn_status .= $details ;	
	
		$id='';
		if ($valid) {
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
				$id = wp_insert_user($userdata);
								
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
				
				if (($expiredate) && (!$sub)) //paypal subscribe payment will never expires until cancel
					update_usermeta($id,'expire',$expiredate);
				
				if ($sub)
					update_usermeta($id,'PayPal_Subscr_ID',$p->ipn_data['subscr_id']);
				
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

		    $status='Completed Payment';

			$sql="UPDATE ".WWM_ORDERS_TABLE." SET
			userid=%s , status=%s, txnid=%s, memo=%s, payment_status=%s ,payment_date=%s ,payer_mail=%s ,payer_fname=%s ,payer_lname=%s ,payer_country=%s ,verify_sign=%s ,gross=%s WHERE checkid=%s LIMIT 1;";
			
			$wpdb->query($wpdb->prepare($sql,$id,$status,$txn_id,$memo,$payment_status, $payment_date_time,$payer_email, $payer_fname, $payer_lname, $payer_country, $verify_sign, $gross, $check_id));
			
			$order_id=$wpdb->get_var("SELECT id FROM ". WWM_ORDERS_TABLE." WHERE checkid='".$check_id."' LIMIT 1;");
			
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
				$body.='<p><small>Powered by <a href="http://wpwave.com/plugins/cms-members/"> CMS Members</a><small>';
				 	
				wwm_mail_actions('html'); //set actions

				if ( !wp_mail($to, $subject, $body, $header) ) 
						$msg= __('The e-mail could not be sent.') . "<br />\n" . __('Possible reason: your host may have disabled the mail() function...') ;
				
			 } //end welcome mail

		}else{//if  we found an error and it's not valid
		
			 if ($status) {
				if ($p->ipn_data['payment_status']) {
					$sql="UPDATE ".WWM_ORDERS_TABLE." SET payment_status=%s, status=%s, failed_details=%s WHERE checkid=%s LIMIT 1;";
					$wpdb->query($wpdb->prepare($sql,$p->ipn_data['payment_status'], $status, $details, $check_id));
				}else{
					$sql="UPDATE ".WWM_ORDERS_TABLE." SET status=%s, failed_details=%s WHERE checkid=%s LIMIT 1;";
					$wpdb->query($wpdb->prepare($sql, $status, $details, $check_id));
				}
				
			 }
		}//end if error	 
	 }//end if valid
			 
  	break;
 }     
?>