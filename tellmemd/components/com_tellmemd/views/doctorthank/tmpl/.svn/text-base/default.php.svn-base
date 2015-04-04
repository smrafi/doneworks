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
$document->setTitle('Congratulations');

?>

<div id="doctor-thank">
    <div id="thank-wrapper">
        <div id="thank-inner-wrapper">
            <div id="thank-heading">
                <h1>
                    <span>You are almost done ... </span>
                </h1>
            </div>
            <div id="thank-content">
                <p>
                    Congratulations! You have just registered with TellmeMD as a doctor.
                </p>
                <p>
                    To complete the registration you have to add following details to your profile:
                </p>
                <ul>
                    <li>Personal Details</li>
                    <li>Your CV</li>
                    <li>Medical school diploma details</li>
                    <li>Proof of internship</li>
                    <li>Malpractice information</li>
                </ul>
                <p>
                    To proceed to add these details click following button.
                </p>
            </div>
            <div id="thank-proceed">
                <form name="thank_form" id="thank-from" action="<?php echo COMPONENT_FRONT_LINK; ?>" method="post">
                    <input type="hidden" name="controller" value="doctor" />
                    <input type="hidden" name="token" value="<?php echo $this->token_info->token; ?>" />
                    <input type="hidden" name="uid" value="<?php echo $this->token_info->id; ?>" />
                    <input type="submit" name="thank_submit" id="thank_submit" value="Proceed" />
                </form>
            </div>
        </div>
    </div>
</div>