<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   16 August 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$genders = array('Select a gender', 'Male', 'Female');
$martial_states = array('Select a status', 'Single', 'Married');
$country_array = TellMeMDGeneralHelper::getCountryArray();

$gender_list = TellMeMDHelper::createList('gender', 0, $genders, 0, 'inputlist');
$martial_state_list = TellMeMDHelper::createList('martial_status', 0, $martial_states, 0, 'inputlist');
$country_list = TellMeMDHelper::createList('country', 0, $country_array, 0, 'inputlist');

$document =& JFactory::getDocument();
$document->setTitle('Doctor Personal Details');

?>
<form name="thank_form" id="thank-from" action="<?php echo COMPONENT_FRONT_LINK; ?>" method="post">
<div class="brown_wrapper clearfix">
<div class="blue_line clearfix">
            <div id="extra-input-div" class="clearfix">
            <p class="descrip_top">Enter below personal details, save and proceed to enter employment and qualification details.</p>
                <div class="left_right_wrapper clearfix">
                <div class="left-inputbox clearfix">
                    <div class="left-label">
                        <label><?php echo 'First Name';?></label>
                    </div>
                    <div class="right-input">
                        <input type="text" name="first_name" id="first_name" value="<?php echo $this->user_info->first_name; ?>" />
                    </div>
                    <div class="left-label">
                        <label><?php echo 'Other Name';?></label>
                    </div>
                    <div class="right-input">
                        <input type="text" name="other_name" id="other_name" value="" />
                    </div>
                    <div class="left-label">
                        <label><?php echo 'Nationality';?></label>
                    </div>
                    <div class="right-input">
                        <input type="text" name="nationality" id="nationality" value="" />
                    </div>
                    <div class="left-label">
                        <label><?php echo 'Martial Status';?></label>
                    </div>
                    <div class="right-input">
                        <?php echo $martial_state_list;?>
                    </div>
                    <div class="left-label">
                        <label><?php echo 'Address of Residence';?></label>
                    </div>
                    <div class="right-input">
                        <input type="text" name="address1" id="address1" value="" /><br>
                        <input type="text" name="address2" id="address2" value="" /><br>
                        <input type="text" name="city" id="city" value="" /><br>
                        <input type="text" name="region" id="region" value="" /><br>
                        <?php echo $country_list;?>
                    </div>
                    <div class="left-label">
                        <label><?php echo 'Paypal Email';?></label>
                    </div>
                    <div class="right-input">
                        <input type="text" name="paypal_email" id="paypal_email" value="" />
                    </div>
                    <div class="left-label"></div>
                    <div class="right-input"></div>
                </div>
                <div class="right-inputbox clearfix">
                    <div class="left-label">
                        <label><?php echo 'Last Name';?></label>
                    </div>
                    <div class="right-input">
                        <input type="text" name="last_name" id="last_name" value="<?php echo $this->user_info->last_name; ?>" />
                    </div>
                    <div class="left-label">
                        <label><?php echo 'Gender';?></label>
                    </div>
                    <div class="right-input">
                        <?php echo $gender_list;?>
                    </div>
                    <div class="left-label">
                        <label><?php echo 'Date of Birth';?></label>
                    </div>
                    <div class="right-input">
                        <?php echo JHtml::calendar(date('d-m-Y'), 'date_birth', 'date_birth', '%d-%m-%Y');?>
                    </div>
                    <div class="left-label">
                        <label><?php echo 'Personal Phone';?></label>
                    </div>
                    <div class="right-input">
                        <input type="text" name="mobile_phone" id="mobile_phone" value="" />
                    </div>
                    <div class="left-label">
                        <label><?php echo 'Work Phone';?></label>
                    </div>
                    <div class="right-input">
                        <input type="text" name="work_phone" id="work_phone" value="" />
                    </div>
                    <div class="left-label">
                        <label><?php echo 'Skype ID';?></label>
                    </div>
                    <div class="right-input">
                        <input type="text" name="skype_id" id="skype_id" value="" />
                    </div>
                </div>
                </div>
                <div id="post-button">
        <div id="post-button-inner">
            <input type="submit" name="post_button" id="post_button" value="Save and Proceed" />
        </div>
    </div>
            </div>
             
        </div>
    </div>
   
    <input type="hidden" name="controller" value="doctor" />
    <input type="hidden" name="task" value="saveform" />
    <input type="hidden" name="user_id" value="<?php echo $this->user_info->user_id; ?>" />
</form>