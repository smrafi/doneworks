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

$config['baseurl']  = "http://www.archmage.lk/raffle_team/";
$config['appurl'] = 'http://apps.facebook.com/raffle_team/';

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
    $friends = $facebook->api('/me/friends');

    //create list of frn html
    $html_frns = '<ul>';

    for($x=0; $x<count($friends['data']); $x++)
    {
        $friend = $friends['data'][$x];
        $frn_img = 'https://graph.facebook.com/'.$friend['id'].'/picture?access_token='.$access_token;
        $html_frns .= '<li><a href="#" onclick="selectpic(\''.$friend['id'].'\',\''.$friend['name'].'\')"><img src="'.$frn_img.'" /><span>'.$friend['name'].'</span></a></li>';
    }

    $html_frns .= '</ul>';

    ?>
<body>
<link href="styles/style.css" rel="stylesheet" type="text/css" />
<script src="scripts/jquery-1.4.1.min.js" type="text/javascript"></script>
<script src="scripts/popup.js" type="text/javascript"></script>
<script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"></script>
<script type="text/javascript">
    FB_RequireFeatures(["CanvasUtil"], function(){ FB.XdComm.Server.init("xd_receiver.htm");
    FB.CanvasClient.startTimerToSizeToContent(); });
</script>

<div id="fb-root"></div>
<script type="text/javascript">

    document.onkeydown = function(e){
        if (e == null) { // ie
          keycode = event.keyCode;
        } else { // mozilla
          keycode = e.which;
        }
        if(keycode == 27){ // close
          disablePopup();
        }
    }

</script>
<script type="text/javascript">
    function userselect(num)
    {
        centerPopup();
        loadPopup();

        var hiddenhtml = '<input type="hidden" id="divnum" value="'+num+'" />';

        $("#ajaxMessage").html('Loading....');

        $.ajax({ url: "http://www.archmage.lk/raffle_team/friends.php", success: function (result) { $("#ajaxMessage").html(result+hiddenhtml); }
    });
    }

    function selectpic(proid, proname)
    {
        disablePopup();
        var divnum = document.getElementById('divnum').value;

        //check weather friend is already selected
        if($("#teamfrn1").val() == proid || $("#teamfrn2").val() == proid || $("#teamfrn3").val() == proid)
            {
                //popup error
                var msg = proname+' has been already selected';
                centerPopup_error();
                loadPopup_error();
                $('#errmsg').html(msg);
                return;

            }

        $("#ajaxMessage").html('');

        var selecthtml = '<span>'+proname+'</span>&nbsp;&nbsp;&nbsp;<a href="#" onclick="removefrn('+divnum+')">Remove</a>';

        $('#teamfrn'+divnum).val(proid);
        $('#frn'+divnum).html(selecthtml);
    }

    function removefrn(num)
    {
        var anchhtml = '<a href="#" onclick="userselect('+num+')">+ Select Guest to Invite</a>';

        $('#frn'+num).html(anchhtml);
    }

    function validate(form)
    {
//        var msg = '';
//        if($("#tname").val() == '')
//            msg = 'You have to enter a team name.';
//        else if($("#teamfrn1").val() == '' || $("#teamfrn2").val() == '' || $("#teamfrn3").val() == '')
//            msg = 'You have to select 3 friends for your team.';
//        else
//            return true;
//
//        centerPopup_error();
//        loadPopup_error();
//        $('#errmsg').html(msg);
//        return false;
    }
</script>
<!--application html starts at here-->

<form action="<?php echo $config['baseurl'].'process_tform.php'?>" method="post" enctype="multipart/form-data" name="team_form" onsubmit="return validate(this);">
    
    <div id="popupContact">
        <a id="popupContactClose" onclick="closeit();" >x</a>
        <div  id="ajaxMessage"></div>
    </div>
    <div id="backgroundPopup"></div>

    <!--this is going to display error message for validation-->
    <div id="popupContact_error">
        <a id="popupContactClose_error" onclick="disablePopup_error();" >x</a>
        <table>
            <tr>
                <td id="errimg">
                    <img src="http://fb-applications.net/images/icon.jpg" alt="error image" />
                </td>
                <td id="errmsg"></td>
            </tr>
        </table>
    </div>
    <div id="backgroundPopup_error"></div>

    <div>
        <div>
            <ul>
                <li>
                    <span>
                        Want to take part?
                    </span>
                </li>
                <li>
                    <span>
                        Invite your pals to your team now.
                    </span>
                </li>
            </ul>
        </div>
        <div>
            <h2>
                Create your team here!
            </h2>
        </div>
        <div>
            <table>
                <tr>
                    <td>
                        <span>Team Name</span>
                    </td>
                    <td>
                        <input type="text" name="tname" id="tname" value="" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>Team Description</span><br>
                        <span>
                            This shows up in the team directory
                        </span>
                    </td>
                    <td>
                        <input type="text" name="tdescrip" id="tdescrip" value="" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>Members</span><br>
                        <span>Maximum 3 members</span>
                    </td>
                    <td>
                        <span id="frn1"><a href="#" onclick="userselect(1);">+ Select Guest to Invite</a></span><br>
                        <span id="frn2"><a href="#" onclick="userselect(2);">+ Select Guest to Invite</a></span><br>
                        <span id="frn3"><a href="#" onclick="userselect(3);">+ Select Guest to Invite</a></span>
                        <input type="hidden" id="teamfrn1" name="teamfrn1" value="" />
                        <input type="hidden" id="teamfrn2" name="teamfrn2" value="" />
                        <input type="hidden" id="teamfrn3" name="teamfrn3" value="" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>Upload a Picture</span>
                    </td>
                    <td>
                        <input type="file" name="tlogo" id="tlogo" size="15" />
                        <span>No file chosen</span><br><br>
                        <span>This is very important! It will make your team more popular!</span>
                    </td>
                </tr>
            </table>
        </div>
        <div>
            <input type="image" src="<?php echo $config['baseurl'].'images/upload_button_bg.jpg'; ?>" name="tsubmit" id="tsubmit" />
        </div>
    </div>
</form>
</body>

<?php
}


?>
