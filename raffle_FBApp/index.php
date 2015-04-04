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
    //this page is only for redirecting
    //if a user come to this page it will check which page it should be redirected according to the purpose he is in
    //if a user enters first time to the application it checks weather user has any invitaion
    //if user has invitations we are redirecting him to invitation page
    //if user don have any invitations and if user has team then we are redirecting to myteams page
    //otherwise we are redirecting to newteam page

    //instruct database connection details
    //database information
    $host = 'localhost';
    $user = 'archdemo_fbapps';
    $password = 'appraf#123@fb';
    $db = 'archdemo_raffle_team';

    mysql_connect($host, $user, $password);
    mysql_select_db($db);

    //user informations of current user from API
    $user_id = $fbme['id'];
    $user_name = $fbme['name'];
    $access_token = $facebook->getAccessToken();

    //1342504898 - Dev Rafi Facebook id
    //508918407 - Nirosha's facebook id
    //531960137 - Manjula's facebook id
    //676885266 - Harsha's facebook id

    //check weather if there any unaccepted invitations available
    $invitations_query = "Select (
                        (Select Count(*) From team_info Where tfrn1 = '".$user_id."' And tfrn1_accepted = 0) +
                        (Select Count(*) From team_info Where tfrn2 = '".$user_id."' And tfrn2_accepted = 0) +
                        (Select Count(*) From team_info Where tfrn3 = '".$user_id."' And tfrn3_accepted = 0)) As member_total";

    $result = mysql_query($invitations_query);
    $invite_count = mysql_fetch_object($result);
    $invite_count = $invite_count->member_total;

    if($invite_count != 0)
    {
        header ('Location: '.$config['baseurl'].'invitations.php');
        return;
    }

    //otherwise check weather user has any team yet
    $team_query = "Select Count(*) As total From team_info Where tleader = '".$user_id."' And team_accepted = 1";

    $result = mysql_query($team_query);
    $teams_count = mysql_fetch_object($result);
    $teams_count = $teams_count->total;

    if($teams_count != 0)
    {
        header ('Location: '.$config['baseurl'].'myteams.php');
        return;
    }

    //if above two redirects ddn work, then we are redirecting to create new team page
    if($invite_count == 0 and $teams_count == 0)
    {
        header ('Location: '.$config['baseurl'].'newteam.php');
        return;
    }

    
}


?>
