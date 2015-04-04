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

$document =& JFactory::getDocument();
$document->setTitle('Thank You');

?>

<div id="doctor-thank">
    <div id="thank-wrapper">
        <div id="thank-inner-wrapper">
            <div id="thank-heading">
                <h1>
                    <span>Thank you for registering with <span class="tellme">Tellme</span>MD</span>
                </h1>
            </div>
            <div id="thank-content">
                <p><br />
                    Your account is now on pending approval on verification of the provided details.<br /> Please give upto a week for this to be fully processed.
                </p>
                <p><br />
                    We have sent you this same to the email address you have registered with us.
                </p>
                <p><br />
                Looking forward to your service,<br />
                Team <span class="tellme">Tellme</span><span class="bold">MD</span>
                </p>
            </div>
            <div id="thank-proceed">
                <form name="thank_form" id="thank-form" action="<?php echo COMPONENT_FRONT_LINK; ?>" method="post">
                    <input type="hidden" name="controller" value="doctor" />
                    <input type="hidden" name="token" value="<?php echo $this->token_info->token; ?>" />
                    <input type="hidden" name="uid" value="<?php echo $this->token_info->id; ?>" />
                </form>
            </div>
        </div>
    </div>
</div>