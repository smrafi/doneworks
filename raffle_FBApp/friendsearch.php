<?php

/*************************************************************************************
 *  Developer       : Mohamed Rafi
 *  Developer Email : rafi@archmage.lk
 *  Copyright       : Archmage Software
 *  Product         : MCD Facebook app
 *  Date            : 19 March 2011
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
    $user_id = $facebook->getUser();

    $search_word = $_POST['name'];

    $friends = $facebook->api(array(
            'method' => 'fql.query',
            'query' => 'Select uid, name, pic_square From user Where uid In (Select uid2 From friend WHERE uid1 = '.$user_id.') Order By name'
            ));

    $html_frns .= '<ul>';

    for($x=0; $x<count($friends); $x++)
    {
        $friend = $friends[$x];
        $friend_name = $friend['name'];
        $frn_img = $friend['pic_square'];
        $search_final = str_replace($search_word, '<span class="matched">'.$search_word.'</span>', $friend_name);
        $html_frns .= '<li userid="'.$friend['uid'].'"><a href="#"  onclick="selectpic(\''.$friend['uid'].'\',\''.$friend['name'].'\')"><img src="'.$frn_img.'" />'.$search_final.'</a></li>';
    }

    $html_frns .= '</ul>';

    echo $html_frns;
}

?>
