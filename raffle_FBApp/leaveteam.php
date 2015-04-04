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
    //recieve posted variables
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

    //determine which type of friend should be removed
    if($friend_type == FRIEND_TYPE_ONE)
    {
        $left_string = 'tfrn1_left';
        $frn_string = 'tfrn1';
    }
    if($friend_type == FRIEND_TYPE_TWO)
    {
        $left_string = 'tfrn2_left';
        $frn_string = 'tfrn2';
    }
    if($friend_type == FRIEND_TYPE_THREE)
    {
        $left_string = 'tfrn3_left';
        $frn_string = 'tfrn3';
    }

    //update query
    $query = "Update team_info Set $left_string = 1, team_accepted = 0 Where id = ".$team_id." And ".$frn_string." = ".$user_id;

    mysql_query($query);
    $row = mysql_affected_rows();


}
