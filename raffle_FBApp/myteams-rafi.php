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

$config['baseurl']  = "http://www.archdemo.info/raffle_team/";
$config['appurl'] = 'http://apps.facebook.com/raffle_team/';

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
    $allteam_query = "Select team.*, logo.image_name From team_info As team, logo_info As logo Where team.tleader = '".'1342504898'."' And logo.team_id = team.id";

    $result = mysql_query($allteam_query);
    while($row = mysql_fetch_object($result))
        $allteams[] = $row;

    if($allteams == '')
        header ('Location: '.$config['appurl']);

    ?>

<script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"></script>
<script type="text/javascript">
    FB_RequireFeatures(["CanvasUtil"], function(){ FB.XdComm.Server.init("xd_receiver.htm");
    FB.CanvasClient.startTimerToSizeToContent(); });
</script>

<div>
    My Teams ----------------------------------------------------------
    <table>
        <?php
        for($x=0; $x<count($allteams); $x++)
        {
            $team = $allteams[$x];
            if($x % 2 == 0)
                echo '<tr>';
            ?>
            <td>
                <table>
                    <tr>
                        <td>
                            <span><?php echo $team->tname; ?></span>
                        </td>
                        <?php
                        if($team->team_accepted == 1)
                                $eligible = 'Eligible!';
                        else
                            $eligible = '';
                        ?>
                        <td>
                            <span><?php echo $eligible; ?></span>
                        </td>
                        <td>
                            <img src="<?php echo $config['baseurl'].'logos/'.$team->image_name;?>" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <p><?php echo $team->tdescription; ?></p>
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td>
                            <img src="<?php echo 'https://graph.facebook.com/'.$user_id.'/picture?access_token='.$access_token; ?>" />
                        </td>
                        <td>
                            <span><?php echo $user_name; ?></span>
                        </td>
                        <td>
                            <span>Team Leader</span>
                        </td>
                        <td></td>
                    </tr>
                    <?php
                    //get the name of all invited friends
                    $tfriend1 = $facebook->api('/'.$team->tfrn1);
                    $tfriend2 = $facebook->api('/'.$team->tfrn2);
                    $tfriend3 = $facebook->api('/'.$team->tfrn3);

                    ?>
                    <tr>
                        <td>
                            <img src="<?php echo 'https://graph.facebook.com/'.$team->tfrn1.'/picture?access_token='.$access_token; ?>" />
                        </td>
                        <td>
                            <span><?php echo $tfriend1['name']; ?></span>
                        </td>
                        <td>
                            <?php
                            if($team->tfrn1_accepted)
                            {
                            ?>
                                <span>Request Accepted</span>
                            <?php
                            }
                            else
                            {
                            ?>
                                <span>Pending</span>&nbsp;&nbsp;<a href="#">Remind</a>
                            <?php 
                            }
                            ?>
                        </td>
                        <td><a href="#">x</a></td>
                    </tr>
                    <tr>
                        <td>
                            <img src="<?php echo 'https://graph.facebook.com/'.$team->tfrn2.'/picture?access_token='.$access_token; ?>" />
                        </td>
                        <td>
                            <span><?php echo $tfriend2['name']; ?></span>
                        </td>
                        <td>
                            <?php
                            if($team->tfrn2_accepted)
                            {
                            ?>
                                <span>Request Accepted</span>
                            <?php
                            }
                            else
                            {
                            ?>
                                <span>Pending</span>&nbsp;&nbsp;<a href="#">Remind</a>
                            <?php
                            }
                            ?>
                        </td>
                        <td><a href="#">x</a></td>
                    </tr>
                    <tr>
                        <td>
                            <img src="<?php echo 'https://graph.facebook.com/'.$team->tfrn3.'/picture?access_token='.$access_token; ?>" />
                        </td>
                        <td>
                            <span><?php echo $tfriend3['name']; ?></span>
                        </td>
                        <td>
                            <?php
                            if($team->tfrn3_accepted)
                            {
                            ?>
                                <span>Request Accepted</span>
                            <?php
                            }
                            else
                            {
                            ?>
                                <span>Pending</span>&nbsp;&nbsp;<a href="#">Remind</a>
                            <?php
                            }
                            ?>
                        </td>
                        <td><a href="#">x</a></td>
                    </tr>
                </table>
            </td>
        
            <?php
            if($x % 2 == 1)
                echo '</tr>';
        }
        ?>
    </table>
</div>

<?php
$frn1_query = "Select team.*, logo.image_name From team_info As team, logo_info As logo Where team.tfrn1 = '".'1342504898'."' And logo.team_id = team.id";
$frn2_query = "Select team.*, logo.image_name From team_info As team, logo_info As logo Where team.tfrn2 = '".'1342504898'."' And logo.team_id = team.id";
$frn3_query = "Select team.*, logo.image_name From team_info As team, logo_info As logo Where team.tfrn3 = '".'1342504898'."' And logo.team_id = team.id";

//get all the teams that user available in as frn1
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

<div>
    Member Of-------------------------------------------------------------------------
    <table>
        <?php
        if($member1_teams != '')
        {
            foreach ($member1_teams as $team)
            {
                if($counter % 2 == 0)
                    echo '<tr>';
                ?>
            <td>
                <table>
                    <tr>
                        <td>
                            <span><?php echo $team->tname; ?></span>
                        </td>
                        <?php
                        if($team->team_accepted == 1)
                                $eligible = 'Eligible!';
                        else
                            $eligible = '';
                        ?>
                        <td>
                            <span><?php echo $eligible; ?></span>
                        </td>
                        <td>
                            <img src="<?php echo $config['baseurl'].'logos/'.$team->image_name;?>" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <p><?php echo $team->tdescription; ?></p>
                        </td>
                    </tr>
                </table>
                <table>
                    <?php
                    //user is the friend 1 at here
                    $leader = $facebook->api('/'.$team->tleader);
                    $frn2 = $facebook->api('/'.$team->tfrn2);
                    $frn3 = $facebook->api('/'.$team->tfrn3);
                    ?>
                    <tr>
                        <td>
                            <img src="<?php echo 'https://graph.facebook.com/'.$team->tleader.'/picture?access_token='.$access_token; ?>" />
                        </td>
                        <td>
                            <span><?php echo $leader['name']; ?></span><br>
                            <span>Team Leader</span>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <img src="<?php echo 'https://graph.facebook.com/'.$user_id.'/picture?access_token='.$access_token; ?>" />
                        </td>
                        <td>
                            <span><?php echo $user_name; ?></span><br>
                        </td>
                        <td>
                            <a href="#">Leave Team</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="<?php echo 'https://graph.facebook.com/'.$team->tfrn2.'/picture?access_token='.$access_token; ?>" />
                        </td>
                        <td>
                            <span><?php echo $frn2['name']; ?></span>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <img src="<?php echo 'https://graph.facebook.com/'.$team->tfrn3.'/picture?access_token='.$access_token; ?>" />
                        </td>
                        <td>
                            <span><?php echo $frn3['name']; ?></span>
                        </td>
                        <td></td>
                    </tr>
                </table>
            </td>
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
            <td>
                <table>
                    <tr>
                        <td>
                            <span><?php echo $team->tname; ?></span>
                        </td>
                        <?php
                        if($team->team_accepted == 1)
                                $eligible = 'Eligible!';
                        else
                            $eligible = '';
                        ?>
                        <td>
                            <span><?php echo $eligible; ?></span>
                        </td>
                        <td>
                            <img src="<?php echo $config['baseurl'].'logos/'.$team->image_name;?>" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <p><?php echo $team->tdescription; ?></p>
                        </td>
                    </tr>
                </table>
                <table>
                    <?php
                    //user is the friend 2 at here
                    $leader = $facebook->api('/'.$team->tleader);
                    $frn1 = $facebook->api('/'.$team->tfrn1);
                    $frn3 = $facebook->api('/'.$team->tfrn3);
                    ?>
                    <tr>
                        <td>
                            <img src="<?php echo 'https://graph.facebook.com/'.$team->tleader.'/picture?access_token='.$access_token; ?>" />
                        </td>
                        <td>
                            <span><?php echo $leader['name']; ?></span><br>
                            <span>Team Leader</span>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <img src="<?php echo 'https://graph.facebook.com/'.$team->tfrn1.'/picture?access_token='.$access_token; ?>" />
                        </td>
                        <td>
                            <span><?php echo $frn1['name']; ?></span>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <img src="<?php echo 'https://graph.facebook.com/'.$user_id.'/picture?access_token='.$access_token; ?>" />
                        </td>
                        <td>
                            <span><?php echo $user_name; ?></span><br>
                        </td>
                        <td>
                            <a href="#">Leave Team</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="<?php echo 'https://graph.facebook.com/'.$team->tfrn3.'/picture?access_token='.$access_token; ?>" />
                        </td>
                        <td>
                            <span><?php echo $frn3['name']; ?></span>
                        </td>
                        <td></td>
                    </tr>
                </table>
            </td>
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
            <td>
                <table>
                    <tr>
                        <td>
                            <span><?php echo $team->tname; ?></span>
                        </td>
                        <?php
                        if($team->team_accepted == 1)
                                $eligible = 'Eligible!';
                        else
                            $eligible = '';
                        ?>
                        <td>
                            <span><?php echo $eligible; ?></span>
                        </td>
                        <td>
                            <img src="<?php echo $config['baseurl'].'logos/'.$team->image_name;?>" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <p><?php echo $team->tdescription; ?></p>
                        </td>
                    </tr>
                </table>
                <table>
                    <?php
                    //user is the friend 3 at here
                    $leader = $facebook->api('/'.$team->tleader);
                    $frn1 = $facebook->api('/'.$team->tfrn1);
                    $frn2 = $facebook->api('/'.$team->tfrn2);
                    ?>
                    <tr>
                        <td>
                            <img src="<?php echo 'https://graph.facebook.com/'.$team->tleader.'/picture?access_token='.$access_token; ?>" />
                        </td>
                        <td>
                            <span><?php echo $leader['name']; ?></span><br>
                            <span>Team Leader</span>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <img src="<?php echo 'https://graph.facebook.com/'.$team->tfrn1.'/picture?access_token='.$access_token; ?>" />
                        </td>
                        <td>
                            <span><?php echo $frn1['name']; ?></span>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <img src="<?php echo 'https://graph.facebook.com/'.$team->tfrn2.'/picture?access_token='.$access_token; ?>" />
                        </td>
                        <td>
                            <span><?php echo $frn2['name']; ?></span>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <img src="<?php echo 'https://graph.facebook.com/'.$user_id.'/picture?access_token='.$access_token; ?>" />
                        </td>
                        <td>
                            <span><?php echo $user_name; ?></span><br>
                        </td>
                        <td>
                            <a href="#">Leave Team</a>
                        </td>
                    </tr>
                </table>
            </td>
            <?php
                if($counter % 2 == 1)
                    echo '</tr>';
                $counter++;
            }
        }
        ?>
    </table>
</div>

<?php
}
}

?>
