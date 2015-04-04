<?php

/*************************************************************************************
 *  Developer       : Mohamed Rafi
 *  Developer Email : rafi@archmage.lk
 *  Copyright       : Archmage Software
 *  Product         : Raffles Facebook Application
 *  Date            : 23 March 2011
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
    //database information
    $host = 'localhost';
    $user = 'archdemo_fbapps';
    $password = 'appraf#123@fb';
    $db = 'archdemo_raffle_team';

    mysql_connect($host, $user, $password);
    mysql_select_db($db);

    $tname = $_POST['tname'];
    $tdescrip = $_POST['tdescrip'];
    $tfrn1 = $_POST['teamfrn1'];   //invited friend 1
    $tfrn2 = $_POST['teamfrn2'];   //invited friend 2
    $tfrn3 = $_POST['teamfrn3'];   //invited friend 3

    //get the image if available
    $tlogo_info = $_FILES['tlogo'];

       
    //secure this page
    //if a user coming without possible chance we are getting him to application page
    if($tname == '' or $tfrn1 == '' or $tfrn2 == '' or $tfrn3 == '' or !is_numeric($tfrn1) or !is_numeric($tfrn2) or !is_numeric($tfrn3))
    {
        $app_url = $config['appurl'];
        echo "<script type=\"text/javascript\">top.location.href = \"$app_url\";</script>";
    }

    //make team name, team description first letter to capitol
    $tname = ucfirst($tname);
    $tdescrip = ucfirst($str);

    

    $user_id = $fbme['id'];
    $user_name = $fbme['name'];

    //get the access token from facebook
    $access_token = $facebook->getAccessToken();

    //write the information into table
    $team_query = "Insert Into team_info (tname, tdescription, tleader, tfrn1, tfrn2, tfrn3)
                    Values('".$tname."', '".$tdescrip."', '".$user_id."', '".$tfrn1."', '".$tfrn2."', '".$tfrn3."')";

    if($tname !='' and $tfrn1 != '' and $tfrn2 != 0 and $tfrn3 != 0)
    {
        //write the informations on table
        mysql_query($team_query);
        $teamrow_num = mysql_insert_id();
    }

    if($teamrow_num == 0)
    {
        header ('Location: '.$config['appurl'].'error.php');
        return;
    }

    //check previous query is updated successfully and if logo has been uploaded
    if($teamrow_num != 0 and $tlogo_info != '')
    {
        //process the image
        //create image to 100px X 100px
        //define fixed image and create
        $path = dirname(__FILE__).'/logos';         //image saving path
        $image_width = 100;
        $image_height = 100;

        //take an unique id to use to the images
        $uniq_id = uniqid();

        $file_name = $tlogo_info['name'];
        $file_type = $tlogo_info['type'];

        $tmp_file = $tlogo_info['tmp_name'];
        $file_size = $tlogo_info['size'];
        $info = pathinfo($file_name);

        $filename = $uniq_id.'_'.basename($file_name);

        if($file_name != '')
        {
            if(strtolower($info['extension']) == 'jpg' or strtolower($info['extension']) == 'gif' or strtolower($info['extension']) == 'png')
            {
                if(strtolower($info['extension']) == 'jpg')
                {
                    $img = imagecreatefromjpeg($tmp_file);
                }

                if(strtolower($info['extension']) == 'gif')
                {
                    $img = imagecreatefromgif($tmp_file);
                }

                if(strtolower($info['extension']) == 'png')
                {
                    $img = imagecreatefrompng($tmp_file);
                }

                $width = imagesx($img);
                $height = imagesy($img);

                //calculate defined image size ratio
                $def_ratio = $image_width/$image_height;
                $true_ratio = $width/$height;

                //if true ratio is more than defined ratio then we get hieght according to it
                if($true_ratio > $def_ratio)
                {
                    $new_width = $image_width;
                    $new_height = ($image_width/$true_ratio);
                }
                //if true ration is lower than defined ration we are adjusting width according to it and have to fill both side
                elseif($true_ratio < $def_ratio)
                {
                    $new_width = $image_height * $true_ratio;
                    $new_height = $image_height;
                }
                //otherwise we assign given values
                else
                {
                    $new_width = $image_width;
                    $new_height = $image_height;
                }

                $new_width = round($new_width);
                $new_height = round($new_height);

                //create a temporary image
                $tmp_image = imagecreatetruecolor($image_width, $image_height);

                $mycolor = imagecolorallocate($tmp_image, 226, 226, 226);
                imagefill($tmp_image, 0, 0, $mycolor);

                $xdistination = (($image_width-$new_width)/2);
                $ydistination = (($image_height-$new_height)/2);

                //create the image
                imagecopyresampled($tmp_image, $img, $xdistination, $ydistination, 0, 0, $new_width, $new_height, $width, $height);

                //save the image into folder
                if(strtolower($info['extension']) == 'jpg')
                {
                    imagejpeg($tmp_image, "$path/$filename");
                }

                if(strtolower($info['extension']) == 'gif')
                {
                    imagegif($tmp_image, "$path/$filename");
                }

                if(strtolower($info['extension']) == 'png')
                {
                    imagepng($tmp_image, "$path/$filename");
                }

                //image created then we save the data into image info table
                $image_query = "Insert Into logo_info (image_source, image_name, team_id) Values('".basename($file_name)."', '".$filename."', ".$teamrow_num.")";
                mysql_query($image_query);
            }
        }
    }

    //write to remind table that user has already reminded
    $today = date('Y-m-d');
    

    $frns_list = array($tfrn1, $tfrn2, $tfrn3);
    //$sample_array = array('508918407','531960137','100002196048436');

    if($teamrow_num != 0)
    {
        foreach($frns_list as $friend_id)
        {
            $friend = $facebook->api('/'.$friend_id);

            //write to remind table that user has already reminded
            $remind_query = "Insert Into reminds_info (reminded_date, remind, team_id, user_id)
                            Values('".$today."', 1, ".$teamrow_num.", '".$friend_id."')";
            mysql_query($remind_query);

            $attachment = array(
                'message' => 'Hey '.$friend['name'].'! We are entering to "ARCHMAGE GET TEAMED UP" contest and I would like to invite you as a member of my team - '.$tname.'. When you accept the invitation our team will be eligible for the Raffle Draw ! Follow this link.',
                'name' => 'Facebook Raffle Team - Application from Archmage',
                'caption' => 'archmage.lk',
                'link' => 'http://apps.facebook.com/raffle_team',
                'description' => 'Raffle Team application is allowing users to create Raffle team with their friends and gives them a chance to fun on raffles.',
                'picture' => $config['baseurl'].'images/raffle_logo.jpg',
                'actions' => array(array('name' => 'Get Search', 'link' => 'http://www.google.com'))
              );

            $result = $facebook->api('/'.$friend['id'].'/feed/','post',$attachment);
        }

        header ('Location: '.$config['baseurl'].'myteams.php');
    }

}


?>
