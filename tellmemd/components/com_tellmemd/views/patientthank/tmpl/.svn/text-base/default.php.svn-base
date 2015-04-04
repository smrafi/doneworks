<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   12 August 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$user =& JFactory::getUser();

$document =& JFactory::getDocument();
$document->setTitle('Thank You');

?>

<form name="socialform" id="caseform" action="<?php echo COMPONENT_FRONT_LINK; ?>" method="post">
    <input type="hidden" name="controller" value="medical" />
<!--    <input type="hidden" name="task" value="newcase" />-->
<div id="patient-thank">
    <div id="thank-wrapper">
        <div id="thank-inner-wrapper">
            <div id="thank-heading">
                <h1>
                    <span>Thank you for registering with <span class="tellme">Tellme</span>MD</span>
                </h1>
            </div>
            <div id="thank-content">
                <p>
                    Congratulations! You have just registered with TellmeMD using the username <span><?php echo $user->username; ?></span>, and your account has been activated now. You can now ask questions and get solutions for you.
                </p>
                <br />
                <p>
                    If you were on middle of posting a question, you can still go with that. To proceed with your previous question click following button.
                </p>
                <br />
            </div>
            <div id="thank-proceed">
            <div id="button-box">
                <div id="button-box-inner">
                <table><tr>
                <td>
                    <div id="proceed-button">
                        <button type="submit" name="save_back">Proceed</button>
                    </div>
                    </td>
                    </tr>
                </table>
                </div>
            </div>
                
            </div>
        </div>
    </div>
</div>
</form>