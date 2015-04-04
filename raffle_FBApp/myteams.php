<?php

/*************************************************************************************
 *  Developer       : Mohamed Rafi
 *  Developer Email : rafi@archmage.lk
 *  Copyright       : Archmage Software
 *  Product         : Raffles Facebook Application
 *  Date            : 28 March 2011
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

    //user informations of current user from API
    $user_id = $fbme['id'];
    $user_name = $fbme['name'];
    $access_token = $facebook->getAccessToken();

    //1342504898 - Dev Rafi Facebook id

    //retrieve current user informations from database
    $allteam_query = "Select team.*, logo.image_name From team_info As team, logo_info As logo Where team.tleader = '".$user_id."' And logo.team_id = team.id";

    $result = mysql_query($allteam_query);
    while($row = mysql_fetch_object($result))
        $allteams[] = $row;

   

    ?>

<head>

<link href="styles/style.css" rel="stylesheet" type="text/css" />

<script src="scripts/jquery-1.4.1.min.js" type="text/javascript"></script>
<script src="scripts/popup.js" type="text/javascript"></script>
</head>
<body>
<div id="fb-root"></div>
 <script>
   window.fbAsyncInit = function() {
     FB.init({appId: '<?php echo $fbconfig['appid' ]; ?>', status: true, cookie: true,
              xfbml: true});
          FB.Canvas.setAutoResize();
   };
   (function() {
     var e = document.createElement('script'); e.async = true;
     e.src = document.location.protocol +
       '//connect.facebook.net/en_US/all.js';
     document.getElementById('fb-root').appendChild(e);
   }());
 </script>
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
<style>
.main_wrapper {
	background-color:#f1f1f1;
	width:760px;
	height:auto;
	padding-bottom:40px;
}
.header {
	height:160px;
	background-image:url(images/banner_page2.jpg);
	background-repeat:no-repeat;
	background-position:center;
}
.header_tabs {
	height:45px;
	width:auto;
	padding-top:115px;
}
.header_tabs a {
	font-size:14px;
	font-family:Arial, Helvetica, sans-serif;
	color:#FFF;
	text-decoration:none;
	line-height:42px;
}
.header_tabs table.left_tabs {
	float:left;
	width:50%;
}
.header_tabs table.right_tab {
	float:right;
	width:32%;
}
.header_tabs table.left_tabs div.tab1 {
	height:40px;
	width:150px;
	background-image:url(images/tab_bg.png);
	background-position:right;
	background-repeat:no-repeat;
	margin-left:25px;
	text-align:center;
}
.header_tabs table.left_tabs div.tab2 {
	height:40px;
	width:90px;
	background-image:url(images/tab_bg.png);
	background-position:right;
	background-repeat:no-repeat;
	text-align:center;
}
.header_tabs table.left_tabs div.tab3 {
	height:40px;
	width:90px;
	background-image:url(images/tab_bg.png);
	background-position:right;
	background-repeat:no-repeat;
	text-align:center;
}
.header_tabs table.right_tab div.tab4 {
	height:40px;
	width:90px;
	background-image:url(images/tab_bg.png);
	background-position:right;
	background-repeat:no-repeat;
	text-align:center;
	margin-left:120px;
}
.header_tabs table.left_tabs div.tab1:hover, .header_tabs table.left_tabs div.tab2:hover, .header_tabs table.left_tabs div.tab3:hover, .header_tabs table.right_tab div.tab4:hover {
	background-image:url(images/tab_bg_hover.png);
	background-position:right;
	background-repeat:no-repeat;
}

div.tab2_current
{
    height:40px;
    width:90px;
    background-image:url(images/tab_bg_hover.png);
    background-position:right;
    background-repeat:no-repeat;
    text-align:center;
}

.team_wrapper {
	padding-left:20px;
	padding-right:20px;
}
.header_title {
	width:auto;
	height:auto;
	background-image:url(images/footer_line.jpg);
	background-position:right bottom;
	background-repeat:no-repeat;
}
.header_title h2 {
	font-family:Arial, Helvetica, sans-serif;
	font-size:18px;
}
.team_main_wrapper, .member_main_wrapper {
	background-color:#FFF;
	padding:10px;
	border:2px solid #e2e2e2;
}
.team_description {
	border-bottom:1px solid #e2e2e2;
        padding-bottom: 10px;
}
.team_description span.team_name {
	font-size:18px;
	font-family:Arial, Helvetica, sans-serif;
}
/*.team_description img{
	height:100px;
	width:125px;
	}*/
.team_description td.tdescription {
	font-size:11px;
	font-family:Arial, Helvetica, sans-serif;
	text-align:justify;
	vertical-align:top;
}
.team_description tr td img.team_image {
	padding:3px;
	border:2px solid #cccccc;
}
.team_members {
	margin-top:15px;
}
.team_members td.user_name {
	font-size:12px;
	font-family:Arial, Helvetica, sans-serif;
	padding-right:10px;
}
.team_members span.accepted, .team_members span.leader {
	font-size:11px;
	font-family:Arial, Helvetica, sans-serif;
	font-weight:100;
}
.team_members a img {
	border:none;
	vertical-align:middle;
}
.team_members tr td img {
	padding-right:10px;
}

/*Dev Rafi - created to cover no team text and link*/
.noteam
{
    color: #BDBDBD;
}

.create_team a
{
    color: #000000;
    padding-left: 80px;
    text-decoration: none;
}

.create_team a:hover
{
    text-decoration: underline;
}

</style>

<script type="text/javascript">

    function remindfrn(spanid,teamid,userid)
    {
        //first check weather he can remind today or not
        //redirecting to check remind page
        //onsuccess if respone is true we are giving permission to remind friend
        //otherwise we are displaying error message

        $.post('checkremind.php',{
            'teamid':teamid,
            'userid':userid
        },function (result){
            if(result != 0){
                var reminded_html = '<a href="#"><img src="images/remind_gone.jpg" /></a>';
                $('#remindfrn'+spanid).html(reminded_html);
                return;
            }
            else{
                centerPopup_error();
                loadPopup_error();
                $('#errmsg').html('You cannot remind anymore today!');
                var reminded_html = '<a href="#"><img src="images/remind_gone.jpg" /></a>';
                $('#remindfrn'+spanid).html(reminded_html);
                return;
            }
        })

    }

    function leaveteam(counter,type,tnum)
    {
        //pass above information to another page and we record this in database about current use has left from his team
        $.post('leaveteam.php', {
            'type':type,
            'tnum':tnum
        },function(result){
            $('#member'+counter).fadeOut(600);
        })
        
    }

</script>

<!--this is going to display error message for validation-->
<div id="popupContact_error"> <a id="popupContactClose_error" onClick="disablePopup_error();" ><img src="images/close.jpg"></a>
<table>
  <tr>
    <td id="errimg"><img src="http://fb-applications.net/images/icon.jpg" alt="error image" /></td>
    <td id="errmsg"></td>
  </tr>
</table>
</div>
<div id="backgroundPopup_error"></div>
<div class="main_wrapper">
  <div class="header">
    <div class="header_tabs clearfix">
      <table class="left_tabs" cols="3">
        <tr>
          <td><div class="tab1"><a href="newteam.php"><span> Create a New Team </span></a></div></td>
          <td><div class="tab2_current"><a href="myteams.php">My Teams</a></div></td>
          <td><div class="tab3"><a href="invitations.php">Invitations</a></div></td>
        </tr>
      </table>
      <table class="right_tab">
        <tr>
          <td><div class="tab4"><a href="stats.php">Stats</a></div></td>
        </tr>
      </table>
    </div>
  </div>
  <div class="team_wrapper">
  <div class="header_title">
    <h2>My Teams</h2>
  </div>
  <?php
  if($allteams != '')
  {
      ?>

      <table>
        <?php
            for($x=0; $x<count($allteams); $x++)
            {
                $team = $allteams[$x];
                if($x % 2 == 0)
                    echo '<tr>';
                ?>

          <td style="width:50%;"><div class="team_main_wrapper">
            <div class="team_description">
              <table>
                <tr>
                  <td colspan="2"><span class="team_name"><?php echo $team->tname; ?></span>
                      <?php
                            if($team->team_accepted == 1)
                                    $eligible = '<img src="images/eligible.jpg">';
                            else
                                $eligible = '';
                            ?>
                    &nbsp;&nbsp;<span><?php echo $eligible; ?></span>
                  
                </tr>
                <tr>
                  <td><img class="team_image" src="<?php echo 'logos/'.$team->image_name;?>" /></td>
                  <td class="tdescription"><p><?php echo $team->tdescription; ?></p></td>
                </tr>
              </table>
            </div>
            <div class="team_members">
              <table>
                <tr>
                  <td><img src="<?php echo 'https://graph.facebook.com/'.$user_id.'/picture?access_token='.$access_token; ?>" /></td>
                  <td class="user_name"><span><?php echo $user_name; ?></span></td>
                  <td><span class="leader">Team Leader</span></td>
                  <td></td>
                </tr>
                <?php
                        //get the name of all invited friends
                        $tfriend1 = $facebook->api('/'.$team->tfrn1);
                        $tfriend2 = $facebook->api('/'.$team->tfrn2);
                        $tfriend3 = $facebook->api('/'.$team->tfrn3);

                        ?>
                <tr>
                  <td><img src="<?php echo 'https://graph.facebook.com/'.$team->tfrn1.'/picture?access_token='.$access_token; ?>" /></td>
                  <td class="user_name"><span><?php echo $tfriend1['name']; ?></span></td>
                  <td><?php
                                if($team->tfrn1_accepted and !$team->tfrn1_rejected and !$team->tfrn1_left)
                                {
                                ?>
                    <span class="accepted">Request Accepted</span>
                    <?php
                                }
                                elseif($team->tfrn1_rejected)
                                {
                                    ?>
                    <span class="accepted">Request Rejected</span>
                    <?php
                                }
                                elseif($team->tfrn1_left)
                                {
                                    ?>
                    <span class="accepted">Not Available (Left)</span>
                    <?php
                                }
                                else
                                {
                                ?>
                    <span class="accepted">Pending</span>&nbsp;&nbsp;<span id="remindfrn1<?php echo $x; ?>"><a href="#" onclick="remindfrn(1<?php echo $x; ?>,<?php echo $team->id; ?>,'<?php echo $team->tfrn1; ?>');"><img src="images/remind.jpg" /></a></span>
                    <?php
                                }
                                ?></td>
                  <td><a href="#"><img src="images/close_button.jpg" /></a></td>
                </tr>
                <tr>
                  <td><img src="<?php echo 'https://graph.facebook.com/'.$team->tfrn2.'/picture?access_token='.$access_token; ?>" /></td>
                  <td class="user_name"><span><?php echo $tfriend2['name']; ?></span></td>
                  <td><?php
                                if($team->tfrn2_accepted and !$team->tfrn2_rejected and !$team->tfrn2_left)
                                {
                                ?>
                    <span class="accepted">Request Accepted</span>
                    <?php
                                }
                                elseif($team->tfrn2_rejected)
                                {
                                    ?>
                    <span class="accepted">Request Rejected</span>
                    <?php
                                }
                                elseif($team->tfrn2_left)
                                {
                                    ?>
                    <span class="accepted">Not Available (Left)</span>
                    <?php
                                }
                                else
                                {
                                ?>
                    <span class="accepted">Pending</span>&nbsp;&nbsp;<span id="remindfrn2<?php echo $x; ?>"><a href="#" onclick="remindfrn(2<?php echo $x; ?>,<?php echo $team->id; ?>,'<?php echo $team->tfrn2; ?>');"><img src="images/remind.jpg" /></a></span>
                    <?php
                                }
                                ?></td>
                  <td><a href="#"><img src="images/close_button.jpg" /></a></td>
                </tr>
                <tr>
                  <td><img src="<?php echo 'https://graph.facebook.com/'.$team->tfrn3.'/picture?access_token='.$access_token; ?>" /></td>
                  <td class="user_name"><span><?php echo $tfriend3['name']; ?></span></td>
                  <td><?php
                                if($team->tfrn3_accepted and !$team->tfrn3_rejected and !$team->tfrn3_left)
                                {
                                ?>
                    <span class="accepted">Request Accepted</span>
                    <?php
                                }
                                elseif($team->tfrn3_rejected)
                                {
                                    ?>
                    <span class="accepted">Request Rejected</span>
                    <?php
                                }
                                elseif($team->tfrn3_left)
                                {
                                    ?>
                    <span class="accepted">Not Available (Left)</span>
                    <?php
                                }
                                else
                                {
                                ?>
                    <span class="accepted">Pending</span>&nbsp;&nbsp;<span id="remindfrn3<?php echo $x; ?>"><a href="#" onclick="remindfrn(3<?php echo $x; ?>,<?php echo $team->id; ?>,'<?php echo $team->tfrn3; ?>');"><img src="images/remind.jpg" /></a></span>
                    <?php
                                }
                                ?></td>
                  <td><a href="#"><img src="images/close_button.jpg" /></a></td>
                </tr>
              </table>
            </div></td>
          </div>

        <?php
                if($x % 2 == 1)
                    echo '</tr>';
            }
            ?>
      </table>

      <?php
  }
  else
  {
      ?>
      <table>
          <tr>
              <td>
                  <span class="noteam">No team has been created yet.</span>
              </td>
<!--              <td class="create_team">
                  <a href="newteam.php">Create a team</a>
              </td>-->
          </tr>
      </table>
      <?php
  }
  ?>
</div>
<?php
$frn1_query = "Select team.*, logo.image_name From team_info As team, logo_info As logo Where team.tfrn1 = '".$user_id."' And team.tfrn1_accepted = 1 And team.tfrn1_rejected = 0 And team.tfrn1_left = 0 And logo.team_id = team.id";
$frn2_query = "Select team.*, logo.image_name From team_info As team, logo_info As logo Where team.tfrn2 = '".$user_id."' And team.tfrn2_accepted = 1 And team.tfrn2_rejected = 0 And team.tfrn2_left = 0 And logo.team_id = team.id";
$frn3_query = "Select team.*, logo.image_name From team_info As team, logo_info As logo Where team.tfrn3 = '".$user_id."' And team.tfrn3_accepted = 1 And team.tfrn3_rejected = 0 And team.tfrn3_left = 0 And logo.team_id = team.id";

//get all the teams that user available in as frn
$frn1_result = mysql_query($frn1_query);
$frn2_result = mysql_query($frn2_query);
$frn3_result = mysql_query($frn3_query);

while($row = mysql_fetch_object($frn1_result))
    $member1_teams[] = $row;

while($row = mysql_fetch_object($frn2_result))
    $member2_teams[] = $row;

while($row = mysql_fetch_object($frn3_result))
    $member3_teams[] = $row;

$counter = 0;

if($member1_teams != '' or $member2_teams != '' or $member3_teams != '')
{
?>
<div class="team_wrapper">
  <div class="header_title">
    <h2>Member of</h2>
  </div>
  <table>
    <?php
        if($member1_teams != '')
        {
            foreach ($member1_teams as $team)
            {
                if($counter % 2 == 0)
                    echo '<tr>';
                ?>
    
      <td width="350px" id="member<?php echo $counter; ?>"><!--column one-->
        
        <div class="member_main_wrapper">
          <div class="team_description">
            <table>
              <tr>
                
                <?php
                        if($team->team_accepted == 1)
                                $eligible = '<img src="images/eligible.jpg">';
                        else
                            $eligible = '';
                        ?>
                <td colspan="2"><span class="team_name"><?php echo $team->tname; ?></span>&nbsp;&nbsp;<span><?php echo $eligible; ?></span></td>
              </tr>
              <tr>
                <td><img class="team_image" src="<?php echo $config['baseurl'].'logos/'.$team->image_name;?>" /></td>
                <td class="tdescription"><p><?php echo $team->tdescription; ?></p></td>
              </tr>
            </table>
          </div>
          <div class="team_members">
            <table>
              <?php
                    //user is the friend 1 at here
                    $leader = $facebook->api('/'.$team->tleader);
                    $frn2 = $facebook->api('/'.$team->tfrn2);
                    $frn3 = $facebook->api('/'.$team->tfrn3);
                    ?>
              <tr>
                <td><img src="<?php echo 'https://graph.facebook.com/'.$team->tleader.'/picture?access_token='.$access_token; ?>" /></td>
                <td  class="user_name"><span><?php echo $leader['name']; ?></span><br>
                  <span class="leader">Team Leader</span></td>
                <td></td>
              </tr>
              <tr>
                <td><img src="<?php echo 'https://graph.facebook.com/'.$user_id.'/picture?access_token='.$access_token; ?>" /></td>
                <td class="user_name"><span><?php echo $user_name; ?></span><br></td>
                <td><a href="#" onclick="leaveteam(<?php echo $counter; ?>,1,<?php echo $team->id; ?>);"><img src="images/leave_team.jpg" /></a></td>
              </tr>
              <tr>
                <td><img src="<?php echo 'https://graph.facebook.com/'.$team->tfrn2.'/picture?access_token='.$access_token; ?>" /></td>
                <td class="user_name"><span><?php echo $frn2['name']; ?></span></td>
                <td></td>
              </tr>
              <tr>
                <td><img src="<?php echo 'https://graph.facebook.com/'.$team->tfrn3.'/picture?access_token='.$access_token; ?>" /></td>
                <td class="user_name"><span><?php echo $frn3['name']; ?></span></td>
                <td></td>
              </tr>
            </table>
          </div>
        </div></td>
      <?php
                if($counter % 2 == 1)
                    echo '</tr>';
                $counter++;
            }
        }

        if($member2_teams != '')
        {
            foreach ($member2_teams as $team)
            {
                if($counter % 2 == 0)
                    echo '<tr>';
                ?>
      <td width="350px" id="member<?php echo $counter; ?>"><!--column two-->
        
        <div class="member_main_wrapper">
          <div class="team_description">
            <table>
              <tr>
                <?php
                        if($team->team_accepted == 1)
                                $eligible = '<img src="images/eligible.jpg">';
                        else
                            $eligible = '';
                        ?>
                <td colspan="2"><span class="team_name"><?php echo $team->tname; ?></span>&nbsp;&nbsp;<span><?php echo $eligible; ?></span></td>
                </tr>
                <td><img class="team_image" src="<?php echo $config['baseurl'].'logos/'.$team->image_name;?>" /></td>
              
                <td class="tdescription"><p><?php echo $team->tdescription; ?></p></td>
              </tr>
            </table>
          </div>
          <div class="team_members">
            <table>
              <?php
                    //user is the friend 2 at here
                    $leader = $facebook->api('/'.$team->tleader);
                    $frn1 = $facebook->api('/'.$team->tfrn1);
                    $frn3 = $facebook->api('/'.$team->tfrn3);
                    ?>
              <tr>
                <td><img src="<?php echo 'https://graph.facebook.com/'.$team->tleader.'/picture?access_token='.$access_token; ?>" /></td>
                <td class="user_name"><span><?php echo $leader['name']; ?></span><br>
                  <span class="leader">Team Leader</span></td>
                <td></td>
              </tr>
              <tr>
                <td><img src="<?php echo 'https://graph.facebook.com/'.$team->tfrn1.'/picture?access_token='.$access_token; ?>" /></td>
                <td class="user_name"><span><?php echo $frn1['name']; ?></span></td>
                <td></td>
              </tr>
              <tr>
                <td><img src="<?php echo 'https://graph.facebook.com/'.$user_id.'/picture?access_token='.$access_token; ?>" /></td>
                <td class="user_name"><span><?php echo $user_name; ?></span><br></td>
                <td><a href="#" onclick="leaveteam(<?php echo $counter; ?>,2,<?php echo $team->id; ?>);"><img src="images/leave_team.jpg" /></a></td>
              </tr>
              <tr>
                <td><img src="<?php echo 'https://graph.facebook.com/'.$team->tfrn3.'/picture?access_token='.$access_token; ?>" /></td>
                <td class="user_name"><span><?php echo $frn3['name']; ?></span></td>
                <td></td>
              </tr>
            </table>
          </div>
        </div></td>
      <?php
                if($counter % 2 == 1)
                    echo '</tr>';
                $counter++;
            }
        }

        if($member3_teams != '')
        {
            foreach ($member3_teams as $team)
            {
                if($counter % 2 == 0)
                    echo '<tr>';
                ?>
      <td width="350px" id="member<?php echo $counter; ?>"><!--column three-->
        
        <div class="member_main_wrapper">
          <div class="team_description">
            <table>
              <tr>
                <?php
                        if($team->team_accepted == 1)
                                $eligible = '<img src="images/eligible.jpg">';
                        else
                            $eligible = '';
                        ?>
                  <td colspan="2"><span class="team_name"><?php echo $team->tname; ?></span>&nbsp;&nbsp;<span><?php echo $eligible; ?></span></td>
				</tr>
                <tr>
                <td><img class="team_image" src="<?php echo $config['baseurl'].'logos/'.$team->image_name;?>" /></td>
                <td class="tdescription"><p><?php echo $team->tdescription; ?></p></td>
              </tr>
            </table>
          </div>
          <div class="team_members">
            <table>
              <?php
                    //user is the friend 3 at here
                    $leader = $facebook->api('/'.$team->tleader);
                    $frn1 = $facebook->api('/'.$team->tfrn1);
                    $frn2 = $facebook->api('/'.$team->tfrn2);
                    ?>
              <tr>
                <td><img src="<?php echo 'https://graph.facebook.com/'.$team->tleader.'/picture?access_token='.$access_token; ?>" /></td>
                <td class="user_name"><span><?php echo $leader['name']; ?></span><br>
                  <span class="leader">Team Leader</span></td>
                <td></td>
              </tr>
              <tr>
                <td><img src="<?php echo 'https://graph.facebook.com/'.$team->tfrn1.'/picture?access_token='.$access_token; ?>" /></td>
                <td class="user_name"><span><?php echo $frn1['name']; ?></span></td>
                <td></td>
              </tr>
              <tr>
                <td><img src="<?php echo 'https://graph.facebook.com/'.$team->tfrn2.'/picture?access_token='.$access_token; ?>" /></td>
                <td class="user_name"><span><?php echo $frn2['name']; ?></span></td>
                <td></td>
              </tr>
              <tr>
                <td><img src="<?php echo 'https://graph.facebook.com/'.$user_id.'/picture?access_token='.$access_token; ?>" /></td>
                <td class="user_name"><span><?php echo $user_name; ?></span><br></td>
                <td><a href="#" onclick="leaveteam(<?php echo $counter; ?>,3,<?php echo $team->id; ?>);"><img src="images/leave_team.jpg" /></a></td>
              </tr>
            </table>
          </div>
        </div></td>
      <?php
                if($counter % 2 == 1)
                    echo '</tr>';
                $counter++;
            }
        }
        ?>
  </table>
    <input type="hidden" name="memberboxes" id="memberboxes" value="<?php echo $counter-1; ?>" />
</div>
</body>
<?php
}

//we redirect to application page if non above is available
//if all details above are empty we redirect to application page
if($allteams == '' and $member1_teams == '' and $member2_teams == '' and $member3_teams == '')
{
    $app_url = $config['baseurl'].'newteam.php';
    echo "<script type=\"text/javascript\">top.location.href = \"$app_url\";</script>";
}


}

?>
