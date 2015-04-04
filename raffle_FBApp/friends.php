<?php

/*************************************************************************************
 *  Developer       : Mohamed Rafi
 *  Developer Email : rafi@archmage.lk
 *  Copyright       : Archmage Software
 *  Product         : US Speedskating Facebook Application
 *  Date            : 25 April 2011
 *  Licence         : GNU / GPL
 **************************************************************************************/

include_once "fbmain.php";

$redirect_url = $redirect_url = "http://www.facebook.com/dialog/oauth/?scope=email,user_birthday,status_update,publish_stream,user_photos,user_hometown&client_id=".$fbconfig['appid' ]."&redirect_uri=".$config['appurl']."&response_type=token";

if(!$fbme)
{
    echo "<script type=\"text/javascript\">top.location.href = \"$redirect_url\";</script>";
}
else
{
    
    //get the access token from facebook
    $access_token = $facebook->getAccessToken();

    //get list of friends
    //$friends = $facebook->api('/me/friends');
    $user_id = $facebook->getUser();

    //$excludeFriends = $facebook->friends_get();

    $friends = $facebook->api(array(
            'method' => 'fql.query',
            'query' => 'Select uid, name, pic_square From user Where uid In (Select uid2 From friend WHERE uid1 = '.$user_id.') Order By name'
            ));

    //print_r($a_friend);

    //create a search division
    $html_frns .= '<div><input name="searchname" id="searchname" type="text" value="" />';
    $html_frns .= '<button type="button" onclick="searchx()">Search</button>';
    $html_frns .= '</div>';

    //create list of frn html
    $html_frns .= '<div id="frnlist">';
    $html_frns .= '<ul>';

    for($x=0; $x<count($friends); $x++)
    {
        $friend = $friends[$x];
        $frn_img = $friend['pic_square'];
        $html_frns .= '<li userid="'.$friend['uid'].'"><a href="#" onclick="selectpic(\''.$friend['uid'].'\',\''.$friend['name'].'\')"><img src="'.$frn_img.'" /><span id="friendname">'.$friend['name'].'</span></a></li>';
    }

    $html_frns .= '</ul>';
    $html_frns .= '</div>';

    echo $html_frns;
}

?>
