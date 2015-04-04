<?php

/*************************************************************************************
 *  Developer       : Mohamed Rafi
 *  Developer Email : rafi@archmage.lk
 *  Copyright       : Archmage Software
 *  Product         : Raffles Facebook Application
 *  Date            : 01 April 2011
 *  Licence         : GNU / GPL
 **************************************************************************************/
include_once "fbmain.php";

//define all friend type
define('FRIEND_TYPE_ONE', 1);
define('FRIEND_TYPE_TWO', 2);
define('FRIEND_TYPE_THREE', 3);

$config['baseurl']  = "https://demo.reebotech.com/raffleapp/";
$config['appurl'] = 'https://apps.facebook.com/raffle_team/';

$redirect_url = $redirect_url = "http://www.facebook.com/dialog/oauth/?scope=email,user_birthday,status_update,publish_stream,user_photos,user_hometown&client_id=".$fbconfig['appid' ]."&redirect_uri=".$config['appurl']."&response_type=token";

if(!$fbme)
{
    echo "<script type=\"text/javascript\">top.location.href = \"$redirect_url\";</script>";
}
else
{
    //get posted variables
    $friend_type = $_POST['type'];
    $team_id = $_POST['tnum'];

    if($friend_type == '' or $team_id == '' or !is_numeric($friend_type) or !is_numeric($team_id))
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

    //user informations of current user from API
    $user_id = $fbme['id'];

    //check weather team is eligible to apply qualify
    $team_check_query = "Select eligible_count From team_info Where id = $team_id";

    $result = mysql_query($team_check_query);
    $count_info = mysql_fetch_object($result);
    $eligible_count = $count_info->eligible_count;

    //increase eligible count by one
    $eligible_count++;

    //if 3rd friend now accepting the request then we make team to eligible
    if($eligible_count == 3)
        $eligible_patch = ", team_accepted = 1";
    else
        $eligible_patch = '';

    //determine which type of friend should be removed
    if($friend_type == FRIEND_TYPE_ONE)
    {
        $join_string = 'tfrn1_accepted';
        $date_string = 'tfrn1_accept_time';
        $frn_string = 'tfrn1';
    }
    if($friend_type == FRIEND_TYPE_TWO)
    {
        $join_string = 'tfrn2_accepted';
        $date_string = 'tfrn2_accept_time';
        $frn_string = 'tfrn2';
    }
    if($friend_type == FRIEND_TYPE_THREE)
    {
        $join_string = 'tfrn3_accepted';
        $date_string = 'tfrn3_accept_time';
        $frn_string = 'tfrn3';
    }

    $date_time = date('Y-m-d h:i:s');

    $query = "Update team_info Set $join_string = 1, $date_string = '$date_time', eligible_count = $eligible_count $eligible_patch Where $frn_string = '$user_id' And id = $team_id";

    mysql_query($query);
    $rows = mysql_affected_rows();
}

?>
