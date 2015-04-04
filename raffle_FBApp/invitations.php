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

//define all friend types
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

    $invite1_query = "Select team.*, logo.image_name From team_info As team, logo_info As logo Where team.tfrn1 = '".$user_id."' And team.tfrn1_accepted = 0 And team.tfrn1_rejected = 0 And team.tfrn1_left = 0 And logo.team_id = team.id";
    $invite2_query = "Select team.*, logo.image_name From team_info As team, logo_info As logo Where team.tfrn2 = '".$user_id."' And team.tfrn2_accepted = 0 And team.tfrn2_rejected = 0 And team.tfrn2_left = 0 And logo.team_id = team.id";
    $invite3_query = "Select team.*, logo.image_name From team_info As team, logo_info As logo Where team.tfrn3 = '".$user_id."' And team.tfrn3_accepted = 0 And team.tfrn3_rejected = 0 And team.tfrn3_left = 0 And logo.team_id = team.id";

    $result1 = mysql_query($invite1_query);
    $result2 = mysql_query($invite2_query);
    $result3 = mysql_query($invite3_query);


    $counter = 0;
    
    while ($row = mysql_fetch_object($result1))
    {
        $invites[$counter] = $row;
        $counter++;
    }

    while ($row = mysql_fetch_object($result2))
    {
        $invites[$counter] = $row;
        $counter++;
    }

    while ($row = mysql_fetch_object($result3))
    {
        $invites[$counter] = $row;
        $counter++;
    }
    
    ?>

<script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"></script>
<script type="text/javascript">
    FB_RequireFeatures(["CanvasUtil"], function(){ FB.XdComm.Server.init("xd_receiver.htm");
    FB.CanvasClient.startTimerToSizeToContent(); });
</script>
<script src="scripts/jquery-1.4.1.min.js" type="text/javascript"></script>
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

div.tab3_current
{
    height:40px;
    width:90px;
    background-image:url(images/tab_bg_hover.png);
    background-position:right;
    background-repeat:no-repeat;
    text-align:center;
}

.header_title{
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
.header_title_long {
	width:auto;
	height:auto;
	background-image:url(images/footer_line_short.jpg);
	background-position:right bottom;
	background-repeat:no-repeat;
}
.header_title_long h2 {
	font-family:Arial, Helvetica, sans-serif;
	font-size:18px;
}
.inside_wrapper{
	height:auto;
	width:auto;
	padding-left:20px;
	padding-right:20px;
	}
.inside_wrapper td img.team_image{
	padding-right:15px;
	margin-bottom:15px;
	}
.inside_wrapper span.team_name {
	font-size:12px;
        font-weight: bold;
	font-family:Arial, Helvetica, sans-serif;
}
.tdescription{
	    font-family: Arial,Helvetica,sans-serif;
    font-size: 12px;
    text-align: justify;
    vertical-align: top;
	font-weight:bold;
	width:90%;
	}
.inside_wrapper span.invitor{
	font-size:11px;
	font-family:Arial, Helvetica, sans-serif;
	color:#00bdff;
	}
.inside_wrapper span.invites_you{
		font-size:11px;
	font-family:Arial, Helvetica, sans-serif;
	color:#777777;
	}
.inside_wrapper td a img{
	border:none;
	}
</style>
<script type="text/javascript">

    function acceptinvite(rownum,type,tnum){
        //post these to page accept invitation
        $.post('acceptinvite.php',{
            'type':type,
            'tnum':tnum
        },function(result){
            $('#inviterow'+rownum).fadeOut(600);
        })
    }

    function rejectinvite(rownum,type,tnum){
        //post these to page accept invitation
        $.post('rejectinvite.php',{
            'type':type,
            'tnum':tnum
        },function(result){
            $('#inviterow'+rownum).fadeOut(600);
        })
    }

</script>
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
          <td><div class="tab3_current"><a href="invitations.php">Invitations</a></div></td>
        </tr>
      </table>
      <table class="right_tab">
        <tr>
          <td><div class="tab4"><a href="stats.php">Stats</a></div></td>
        </tr>
      </table>
    </div>
  </div>
<?php
if($invites != '')
{
    ?>
<div class="inside_wrapper">
    <div class="header_title">
    <h2>Invites</h2>
  </div>
    <table width="700px">
        <?php
        $mark = 0;
        foreach($invites as $invite)
        {
            $leader = $facebook->api('/'.$invite->tleader);
            if($invite->tfrn1 == $user_id)
                    $type = FRIEND_TYPE_ONE;
            elseif($invite->tfrn2 == $user_id)
                    $type = FRIEND_TYPE_TWO;
            elseif($invite->tfrn3 == $user_id)
                    $type = FRIEND_TYPE_THREE;
            ?>
    <tr id="inviterow<?php echo $mark; ?>">
        <td>
            <img class="team_image" src="logos/<?php echo $invite->image_name; ?>" />
        </td>
        <td style="vertical-align:top;">
            <div>
                <span class="team_name"><?php echo $invite->tname; ?></span>
            </div>
            <div class="tdescription">
                <p><?php echo $invite->tdescription; ?></p>
            </div>
            <div>
                <span class="invitor"><?php echo $leader['name']; ?></span><span class="invites_you"> invited you</span>
            </div>
        </td>
        <td>
            <a href="#" onclick="acceptinvite(<?php echo $mark.','.$type.','.$invite->id; ?>);"><img src="images/accept_button.png" /></a>
        </td>
        <td>
            <a href="#" onclick="rejectinvite(<?php echo $mark.','.$type.','.$invite->id; ?>);"><img src="images/ignore_button.png" /></a>
        </td>
    </tr>
    <?php
            $mark++;
        }
        ?>
    </table>
</div>

<?php
}

//get the current time
$date_time = date('Y-m-d h:i:s');

//get accepted
$accepted1_query = "Select team.*, logo.image_name, (UNIX_TIMESTAMP('$date_time') - UNIX_TIMESTAMP(team.tfrn1_accept_time)) as time_difference
                    From team_info As team, logo_info As logo Where team.tfrn1 = '".$user_id."' And team.tfrn1_accepted = 1 And team.tfrn1_rejected = 0 And team.tfrn1_left = 0 And logo.team_id = team.id";
$accepted2_query = "Select team.*, logo.image_name, (UNIX_TIMESTAMP('$date_time') - UNIX_TIMESTAMP(team.tfrn2_accept_time)) as time_difference
                    From team_info As team, logo_info As logo Where team.tfrn2 = '".$user_id."' And team.tfrn2_accepted = 1 And team.tfrn2_rejected = 0 And team.tfrn2_left = 0 And logo.team_id = team.id";
$accepted3_query = "Select team.*, logo.image_name, (UNIX_TIMESTAMP('$date_time') - UNIX_TIMESTAMP(team.tfrn3_accept_time)) as time_difference
                    From team_info As team, logo_info As logo Where team.tfrn3 = '".$user_id."' And team.tfrn3_accepted = 1 And team.tfrn3_rejected = 0 And team.tfrn3_left = 0 And logo.team_id = team.id";


$result1 = mysql_query($accepted1_query);
$result2 = mysql_query($accepted2_query);
$result3 = mysql_query($accepted3_query);

$counter = 0;

while($row = mysql_fetch_object($result1))
{
    $accepted_list[$counter] = $row;
    $counter++;
}

while($row = mysql_fetch_object($result2))
{
    $accepted_list[$counter] = $row;
    $counter++;
}

while($row = mysql_fetch_object($result3))
{
    $accepted_list[$counter] = $row;
    $counter++;
}


if($accepted_list != '')
{

?>

<div class="inside_wrapper">
    <div class="header_title_long">
    <h2>Recently Accepted</h2>
  </div>
    <table width="700px">
    <?php
    for($x=0; $x<count($accepted_list); $x++)
    {

        $accepted = $accepted_list[$x];

        $time = $accepted->time_difference;

        //check weather it is lesser than a min
        if($time > 60)
        {
            $time = ($time/60);             //converted to min
            $stamp = 'minutes';
            //check weather it is lesser than an hour
            if($time > 60)
            {
                $time = ($time/60);         //converted to hours
                $stamp = 'hours';
                //check weather for more than 1 day
                if($time > 24)
                {
                    $time = ($time/24);     //converted to days
                    $stamp = 'days';
                }
            }
        }
        else
        {
            $time = $time;
            $stamp = 'secondes';
        }

        $time = round($time);

        if($x % 3 == 0)
            echo '<tr>';
        ?>
        <td>
            <table>
                <tr>
                    <td>
                        <img class="team_image" src="logos/<?php echo $accepted->image_name; ?>" />
                    </td>
                    <td style="vertical-align:top;">
                        <div>
                            <span class="team_name"><?php echo $accepted->tname; ?></span>
                        </div>
                        <div>
                            <span class="invites_you"> <?php echo $time.' '.$stamp.' ago'; ?> </span>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    <?php
    }
    if($x % 3 == 2)
        echo '</tr>';
    ?>
    </table>

</td>
</div>
</div>
</body>
<?php
}

//if no invitations available and no accpted teams available, then we redirect in to create a team.
if($invites == '' and $accepted_list == '')
{
    $app_url = $config['appurl'].'newteam.php';
    echo "<script type=\"text/javascript\">top.location.href = \"$app_url\";</script>";
}

}


?>