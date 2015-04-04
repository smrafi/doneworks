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
        var anchhtml = '<a href="#" onclick="userselect('+num+')"><img src="images/select_friend.jpg"></a>';

        $('#frn'+num).html(anchhtml);
        $("#teamfrn"+num).val('');
    }

    function validate(form)
    {
        var msg = '';
        if($("#tname").val() == '')
            msg = 'You have to enter a team name.';
        else if($("#teamfrn1").val() == '' || $("#teamfrn2").val() == '' || $("#teamfrn3").val() == '')
            msg = 'You have to select 3 friends for your team.';
        else
            return true;

        centerPopup_error();
        loadPopup_error();
        $('#errmsg').html(msg);
        return false;
    }
</script>
<style type="text/css">
.main_wrapper{
	background-color:#f1f1f1;
	width:760px;
	height:auto;
	padding-bottom:40px;
	}
.header{
	height:160px;
	background-image:url(images/banner_page2.jpg);
	background-repeat:no-repeat;
	background-position:center;
	}
.inner_wrapper{
	width:640px;
	margin-left:auto;
	margin-right:auto;
	background-color:#FFF;
	margin-top:40px;
	border:3px solid #e2e2e2;
	padding:20px;
	}
.top_text p{
	font-size:18px;
	font-family:Arial, Helvetica, sans-serif;
	margin-top:0px;
	margin-bottom:20px;
	}
.reg_form{
	margin-left:90px;
	}
.reg_form table td span{
	font-size:14px;
	font-family:Arial, Helvetica, sans-serif;
	}
.reg_form table td span.sub_text{
	font-size:11px;
	font-family:Arial, Helvetica, sans-serif;
	color:#9b9b9b;
	}
.reg_form table td input.text_box{
	height:25px;
	width:300px;
	background-color:#f1f1f1;
	border:1px solid #e2e2e2;
	}
.reg_form table td span a img{
	border:none;
	} 
.reg_form table tr.upload{
	line-height:35px;
	}
.reg_form table td input.browse{
	}
.reg_form span#frn1 a, .reg_form span#frn2 a , .reg_form span#frn3 a{
	text-decoration:none;
	font-size:11px;
	color:#666;
	}
.reg_form span#frn1 a:hover, .reg_form span#frn2 a:hover , .reg_form span#frn3 a:hover{
	text-decoration:underline;
	}
.reg_form span#frn1 span, .reg_form span#frn2 span , .reg_form span#frn3 span{
	color:#505050;
	}
.reg_form table tr.frnd_select{
	line-height:45px;
	}
.reg_form table tr.frnd_select td{
	line-height:15px;
	}
.header_tabs{
	height:45px;
	width:auto;
	padding-top:115px;
	}
.header_tabs a{
	font-size:14px;
	font-family:Arial, Helvetica, sans-serif;
	color:#FFF;
	text-decoration:none;
	line-height:42px;
	}
.header_tabs table.left_tabs{
	float:left;
	width:50%;
	}
.header_tabs table.right_tab{
	float:right;
	width:32%;
	}
.header_tabs table.left_tabs div.tab1{
	height:40px;
	width:150px;
	background-image:url(images/tab_bg.png);
	background-position:right;
	background-repeat:no-repeat;
	margin-left:25px;
	text-align:center;
	}
	.header_tabs table.left_tabs div.tab2{
	height:40px;
	width:90px;
		background-image:url(images/tab_bg.png);
	background-position:right;
	background-repeat:no-repeat;
		text-align:center;
	}
	.header_tabs table.left_tabs div.tab3{
	height:40px;
	width:90px;
		background-image:url(images/tab_bg.png);
	background-position:right;
	background-repeat:no-repeat;
		text-align:center;
	}
.header_tabs table.left_tabs div.tab1:hover, .header_tabs table.left_tabs div.tab2:hover, .header_tabs table.left_tabs div.tab3:hover {
			background-image:url(images/tab_bg_hover.png);
	background-position:right;
	background-repeat:no-repeat;}
</style>
<!--application html starts at here-->

<form action="<?php echo $config['baseurl'].'process_tform.php'?>" method="post" enctype="multipart/form-data" name="team_form" onSubmit="return validate(this);">
    
    <div id="popupContact">
        <a id="popupContactClose" onClick="closeit();" >x</a>
        <div  id="ajaxMessage"></div>
    </div>
    <div id="backgroundPopup"></div>

    <!--this is going to display error message for validation-->
    <div id="popupContact_error">
        <a id="popupContactClose_error" onClick="disablePopup_error();" >x</a>
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

    <div class="main_wrapper">
    <div class="header">
    <div class="header_tabs clearfix">
    <table class="left_tabs" cols="3">
    <tr><td><div class="tab1"><a href="#"><span> Create a New Team </span></a></div></td><td><div class="tab2"><a href="#">My Teams</a></div></td><td><div class="tab3"><a href="#">Invitations</a></div></td></tr>
    </table>
	<table class="right_tab">
    <tr><td>Stats</td></tr>
    </table>
    </div>
    
    </div>
        <div class="inner_wrapper">
        <div class="top_text">
            <p>Want to take part?<br>Invite your pals to your team now.</p>
        </div>
        <div class="create_team"><img src="images/create_team.jpg">
        </div>
        <div class="reg_form">
            <table>
                <tr>
                    <td>
                        <span>Team Name :</span>
                    </td>
                    <td>
                        <input class="text_box" type="text" name="tname" id="tname" value="" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>Team Description :</span><br>
                        <span class="sub_text">
                            This shows up in the team directory
                        </span>
                    </td>
                    <td>
                        <input class="text_box" type="text" name="tdescrip" id="tdescrip" value="" /><br>
                    </td>
                </tr>
                <tr><td></td><td></td></tr>
                <tr class="frnd_select">
                    <td>
                        <span>Members :</span><br>
                        <span class="sub_text">Maximum 3 members</span>
                    </td>
                    <td>
                        <span id="frn1"><a href="#" onClick="userselect(1);"><img src="images/select_friend.jpg"></a></span><br>
                        <span id="frn2"><a href="#" onClick="userselect(2);"><img src="images/select_friend.jpg"></a></span><br>
                        <span id="frn3"><a href="#" onClick="userselect(3);"><img src="images/select_friend.jpg"></a></span>
                        <input type="hidden" id="teamfrn1" name="teamfrn1" value="" />
                        <input type="hidden" id="teamfrn2" name="teamfrn2" value="" />
                        <input type="hidden" id="teamfrn3" name="teamfrn3" value="" />
                    </td>
                </tr>
                <tr  class="upload">
                    <td>
                        <span>Upload a Picture :</span>
                    </td>
                    <td>
                        <input class="Choose File" type="file" name="tlogo" id="tlogo" size="15" />
                        <span class="sub_text">No file chosen</span>
                    </td>
                    <tr>
                    <td></td>
                    <td><span class="sub_text">This is very important! It will make your team more popular!</span></td>
                    </tr>
                </tr>
                <tr><td></td><td><br><input type="image" src="<?php echo $config['baseurl'].'images/create_now.jpg'; ?>" name="tsubmit" id="tsubmit" /></td></tr>
            </table>
        </div>
    </div>
</form>
</div>
</body>

<?php
}


?>
