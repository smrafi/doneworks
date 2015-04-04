<?php

/*************************************************************************************
 *  Developer       : Mohamed Rafi
 *  Developer Email : rafi@archmage.lk
 *  Copyright       : Archmage Software
 *  Product         : Raffles Facebook Application
 *  Date            : 30 March 2011
 *  Licence         : GNU / GPL
 **************************************************************************************/

include_once "fbmain.php";

$config['baseurl']  = "https://demo.reebotech.com/raffleapp/";
$config['appurl'] = 'https://apps.facebook.com/raffle_team/';

$redirect_url = $redirect_url = "http://www.facebook.com/dialog/oauth/?scope=email,user_birthday,status_update,publish_stream,user_photos,user_hometown&client_id=".$fbconfig['appid' ]."&redirect_uri=".$config['appurl']."&response_type=token";

if(!$fbme)
{
    echo "<script type=\"text/javascript\">top.location.href = \"$redirect_url\";</script>";
}
else
{
    $teamid = $_POST['teamid'];
    $userid = $_POST['userid'];

    if($teamid == '' or $userid == '' or !is_numeric($teamid) or !is_numeric($userid))
    {
        header ('Location: '.$config['baseurl']);
        return;
    }

    //database information
    $host = 'localhost';
    $user = 'archdemo_fbapps';
    $password = 'appraf#123@fb';
    $db = 'archdemo_raffle_team';

    mysql_connect($host, $user, $password);
    mysql_select_db($db);

    $query = "Select reminded_date, remind From reminds_info Where team_id = ".$teamid." And user_id = '".$userid."'";

    $result = mysql_query($query);
    $remind_info = mysql_fetch_object($result);

    
    $today = date('Y-m-d');

    if($remind_info == '')
        $remind_query = "Insert Into reminds_info (reminded_date, remind, team_id, user_id) 
                            Values('".$today."', 1, ".$teamid.", '".$userid."')";
    elseif($remind_info->remind == 0)
        $remind_query = "Update reminds_info Set reminded_date = '".$today."', remind = 1 Where team_id = ".$teamid." And user_id = '".$userid."'";
    elseif($remind_info->reminded_date != $today)
        $remind_query = "Update reminds_info Set reminded_date = '".$today."', remind = 1 Where team_id = ".$teamid." And user_id = '".$userid."'";

    if($remind_query != '')
    {

        $friend = $facebook->api('/'.$userid);

        $attachment = array(
            'message' => 'Hey '.$friend['name'].'! I\'m waiting till you accept my invitation and to get eligible to the raffle draw. Please follow this link.',
            'name' => 'Raffle Team invitation Reminder',
            'caption' => 'archmage.lk',
            'link' => 'http://apps.facebook.com/raffle_team',
            'description' => 'Raffle Team application is allowing users to create Raffle team with their friends and gives them a chance to fun on raffles.',
            'picture' => $config['baseurl'].'images/raffle_logo.jpg',
            'actions' => array(array('name' => 'Get Search', 'link' => 'http://www.google.com'))
          );

        $result = $facebook->api('/'.$friend['id'].'/feed/','post',$attachment);

        mysql_query($remind_query);
        $rows = mysql_affected_rows();
        echo $rows;
    }
    else
        echo 0;

}

?>
