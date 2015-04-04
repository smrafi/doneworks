<?php

/*************************************************************************************
 *  Developer       : Mohamed Rafi
 *  Developer Email : rafi@archmage.lk
 *  Copyright       : Archmage Software
 *  Product         : Raffles Facebook Application
 *  Date            : 29 March 2011
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
    //508918407 - Nirosha's facebook id
    //531960137 - Manjula's facebook id

    $total_team_query = "Select Count(*) as total From team_info Where team_accepted = 1";
    $result = mysql_query($total_team_query);

    $total_teams = mysql_fetch_object($result);
    $total_teams = $total_teams->total;                 //total accepted teams availabe

    $total_members = $total_teams * 4;

    $member_query = "Select (
                        (Select Count(*) From team_info Where tfrn1 = '$user_id' And tfrn1_accepted = 1 And tfrn1_rejected = 0 And tfrn1_left = 0) +
                        (Select Count(*) From team_info Where tfrn2 = '$user_id' And tfrn2_accepted = 1 And tfrn2_rejected = 0 And tfrn2_left = 0) +
                        (Select Count(*) From team_info Where tfrn3 = '$user_id' And tfrn3_accepted = 1 And tfrn3_rejected = 0 And tfrn3_left = 0)) As member_total";

    $result = mysql_query($member_query);
    $member_of = mysql_fetch_object($result);
    $member_of_total = $member_of->member_total;

    $owned_query = "Select Count(*) As total From team_info Where tleader = '$user_id'";
    $result = mysql_query($owned_query);
    $owned = mysql_fetch_object($result);
    $owned_total = $owned->total;

    $invites_recieved_query = "Select (
                        (Select Count(*) From team_info Where tfrn1 = '$user_id') +
                        (Select Count(*) From team_info Where tfrn2 = '$user_id') +
                        (Select Count(*) From team_info Where tfrn3 = '$user_id')) As member_total";

    $result = mysql_query($invites_recieved_query);
    $invites_recieved = mysql_fetch_object($result);
    $total_invites_recieved = $invites_recieved->member_total;

    $invites_left_query = "Select (
                        (Select Count(*) From team_info Where tfrn1 = '$user_id' And tfrn1_accepted = 0 And tfrn1_rejected = 0 And tfrn1_left = 0) +
                        (Select Count(*) From team_info Where tfrn2 = '$user_id' And tfrn2_accepted = 0 And tfrn2_rejected = 0 And tfrn2_left = 0) +
                        (Select Count(*) From team_info Where tfrn3 = '$user_id' And tfrn3_accepted = 0 And tfrn3_rejected = 0 And tfrn3_left = 0)) As member_total";

    $result = mysql_query($invites_left_query);
    $invites_left = mysql_fetch_object($result);
    $total_invites_left = $invites_left->member_total;

    ?>
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
	padding-top:116px;
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

div.tab4_current
{
    height:40px;
    width:90px;
    background-image:url(images/tab_bg_hover.png);
    background-position:right;
    background-repeat:no-repeat;
    text-align:center;
    margin-left:120px;
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
	font-size:22px;
}
.stats_inside {
	height:auto;
	width:auto;
	padding-left:20px;
	padding-right:20px;
}
h2.total {
	font-family:Arial, Helvetica, sans-serif;
	font-size:40px;
	font-weight:100;
	margin-bottom:10px;
}
span.total {
	font-family:Arial, Helvetica, sans-serif;
	font-size:16px;
}
.stats_table {
	height:auto;
	width:420px;
	background-image:url(images/stats_bg.jpg);
	background-position:left bottom;
	background-repeat:repeat-x;
	margin-left:10px;
	padding-bottom:20px;
}
span.time_left {
	font-family:Arial, Helvetica, sans-serif;
	font-size:16px;
	line-height:35px;
}
.stats_table h3.count {
	font-size:30px;
	font-family:Arial, Helvetica, sans-serif;
	margin-bottom:5px;
	font-weight:200;
}
.stats_table table tr.time_counts td {
	text-align: center;
	width: 19%;
}
.stats_inside table.my_stats tr td {
	text-align: center;
	width: 24%;
}
</style>
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

<div class="main_wrapper">
  <div class="header">
    <div class="header_tabs clearfix">
      <table class="left_tabs" cols="3">
        <tr>
          <td><div class="tab1"><a href="newteam.php"><span> Create a New Team </span></a></div></td>
          <td><div class="tab2"><a href="myteams.php">My Teams</a></div></td>
          <td><div class="tab3"><a href="invitations.php">Invitations</a></div></td>
        </tr>
      </table>
      <table class="right_tab">
        <tr>
          <td><div class="tab4_current"><a href="stats.php">Stats</a></div></td>
        </tr>
      </table>
    </div>
  </div>
  <div class="stats_inside">
    <div class="header_title">
      <h2>The Stats</h2>
    </div>
    <table width="700px">
      <tr>
        <td style="text-align:center; width:25%;"><h2 class="total"><?php echo $total_teams; ?></h2>
          <span class="total">Total Teams</span></td>
        <td style="text-align:center; width:25%;"><h2 class="total"><?php echo $total_members; ?></h2>
          <span class="total">Total Members</span></td>
        <td><div class="stats_table">
            <table style="margin-left:15px;">
              <tr>
                <td colspan="5"><span class="time_left">Time Left</span></td>
              </tr>
              <tr>
                <td colspan="5"><img src="images/stats_line.jpg" /></td>
              </tr>
              <tr class="time_counts">
                <td><h3 class="count">1</h3>
                  <span class="time_left">Week</span></td>
                <td><h3 class="count">1</h3>
                  <span class="time_left">Day</span></td>
                <td><h3 class="count">3</h3>
                  <span class="time_left">Hours</span></td>
                <td><h3 class="count">0</h3>
                  <span class="time_left">Minutes</span></td>
                <td><h3 class="count">43</h3>
                  <span class="time_left">Seconds</span></td>
              </tr>
            </table>
          </div></td>
      </tr>
    </table>
  </div>
  <div class="stats_inside">
    <div class="header_title">
      <h2>My Stats</h2>
    </div>
    <table width="700px" class="my_stats">
      <tr>
        <td><h2 class="total" ><?php echo $owned_total; ?></h2>
          <br>
          <span class="time_left">Teams Own</span></td>
        <td><h2 class="total"><?php echo $member_of_total; ?></h2>
          <br>
          <span class="time_left">A Member Of</span></td>
        <td><h2 class="total"><?php echo $total_invites_recieved; ?></h2>
          <br>
          <span class="time_left">Invites Received</span></td>
        <td><h2 class="total"><?php echo $total_invites_left; ?></h2>
          <br>
          <span class="time_left">Invites Left</span></td>
      </tr>
    </table>
  </div>
</div>
</body>
<?php

}

?>
