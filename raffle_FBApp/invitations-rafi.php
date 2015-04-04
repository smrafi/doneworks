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
    //508918407 - Nirosha's facebook id
    //531960137 - Manjula's facebook id

    $invite1_query = "Select team.*, logo.image_name From team_info As team, logo_info As logo Where team.tfrn1 = '".'508918407'."' And team.tfrn1_accepted = 0 And logo.team_id = team.id";
    $invite2_query = "Select team.*, logo.image_name From team_info As team, logo_info As logo Where team.tfrn2 = '".$user_id."' And team.tfrn2_accepted = 0 And logo.team_id = team.id";
    $invite3_query = "Select team.*, logo.image_name From team_info As team, logo_info As logo Where team.tfrn3 = '".$user_id."' And team.tfrn3_accepted = 0 And logo.team_id = team.id";

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
<?php
if($invites != '')
{
    ?>

<div>
    Invites ----------------------------------------------------------------------------
    <table>
        <?php
        foreach($invites as $invite)
        {
            $leader = $facebook->api('/'.$invite->tleader);
            ?>
    <tr>
        <td>
            <img src="logos/<?php echo $invite->image_name; ?>"
        </td>
        <td>
            <div>
                <span><?php echo $invite->tname; ?></span>
            </div>
            <div>
                <p><?php echo $invite->tdescription; ?></p>
            </div>
            <div>
                <?php echo $leader['name']; ?> invited you
            </div>
        </td>
        <td>
            <a href="#">Accept</a>
        </td>
        <td>
            <a href="#">Ignore</a>
        </td>
    </tr>
    <?php
        }
        ?>
    </table>
</div>

<?php
}

//get accepted
$accepted1_query = "Select team.*, logo.image_name From team_info As team, logo_info As logo Where team.tfrn1 = '".'508918407'."' And team.tfrn1_accepted = 1 And logo.team_id = team.id";
$accepted2_query = "Select team.*, logo.image_name From team_info As team, logo_info As logo Where team.tfrn2 = '".'531960137'."' And team.tfrn2_accepted = 1 And logo.team_id = team.id";
$accepted3_query = "Select team.*, logo.image_name From team_info As team, logo_info As logo Where team.tfrn3 = '".'508918407'."' And team.tfrn3_accepted = 1 And logo.team_id = team.id";


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

<div>
    Recently Accepted-------------------------------------------------
    <table>
    <?php
    for($x=0; $x<count($accepted_list); $x++)
    {

        $accepted = $accepted_list[$x];

        if($x % 3 == 0)
            echo '<tr>';
        ?>
        <td>
            <table>
                <tr>
                    <td>
                        <img src="logos/<?php echo $accepted->image_name; ?>" />
                    </td>
                    <td>
                        <div>
                            <span><?php echo $accepted->tname; ?></span>
                        </div>
                        <div>
                            <span>26 minutes ago </span>
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
</div>

<?php
}
}


?>
