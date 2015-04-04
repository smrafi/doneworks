<?php
/**
 * @version		$Id: default.php 21543 2011-06-15 22:48:00Z chdemko $
 * @package		Joomla.Site
 * @subpackage	com_users
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @since		1.6
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

//profile data
$filedsets = $this->form->getFieldsets();
$profile_fieldset = $filedsets['profile'];
$default_fieldset = $filedsets['default'];

//default registration fileds
$fields = $this->form->getFieldset($default_fieldset->name);

//get the default fields
$unamefield = $fields['jform_username'];
$pwd1field = $fields['jform_password1'];
$pwd2field = $fields['jform_password2'];
$emailfield = $fields['jform_email1'];

//set of fields for profile
$fields = $this->form->getFieldset($profile_fieldset->name);

//get all the fields
$titlefield = $fields['jform_profile_title'];
$fnamefield = $fields['jform_profile_first_name'];
$lnamefield = $fields['jform_profile_last_name'];
$onamefield = $fields['jform_profile_other_name'];
$genderfield = $fields['jform_profile_gender'];
$nationalityfield = $fields['jform_profile_nationality'];
$dobfield = $fields['jform_profile_date_birth'];
$mstatusfield = $fields['jform_profile_martial_status'];
$address1field = $fields['jform_profile_address1'];
$address2field = $fields['jform_profile_address2'];
$cityfield = $fields['jform_profile_city'];
$regionfield = $fields['jform_profile_region'];
$countryfield = $fields['jform_profile_country'];
$postcodefield = $fields['jform_profile_postal_code'];
$mphonefield = $fields['jform_profile_mobile_phone'];
$wphonefield = $fields['jform_profile_work_phone'];
$designfield = $fields['jform_profile_designation'];
$emplofield = $fields['jform_profile_employment'];
$pemailfield = $fields['jform_profile_paypal_email'];
$skypeidfield = $fields['jform_profile_skype_id'];
?>
<div class="registration<?php echo $this->pageclass_sfx?>">
    <div id="registration-inner">
        <form id="member-registration" action="<?php echo JRoute::_('index.php?option=com_users&task=registration.register'); ?>" method="post" class="form-validate">
            <div id="user-type-div"></div>
            <div id="user-input-div" class="clearfix">
                <div class="left-inputbox clearfix">
                    <div class="left-label">
                        <?php echo $unamefield->label; ?>
                    </div>
                    <div class="right-input">
                        <?php echo $unamefield->input; ?>
                    </div>
                    <div class="left-label">
                        <?php echo $pwd1field->label; ?>
                    </div>
                    <div class="right-input">
                        <?php echo $pwd1field->input; ?>
                    </div>
                    <div class="left-label"></div>
                    <div class="right-input"></div>
                </div>
                <div class="right-inputbox clearfix">
                    <div class="left-label">
                        <?php echo $emailfield->label; ?>
                    </div>
                    <div class="right-input">
                        <?php echo $emailfield->input; ?>
                    </div>
                    <div class="left-label">
                        <?php echo $pwd2field->label; ?>
                    </div>
                    <div class="right-input">
                        <?php echo $pwd2field->input; ?>
                    </div>
                    <div class="left-label"></div>
                    <div class="right-input"></div>
                </div>
            </div>
            <div id="extra-input-div" class="clearfix">
                <div class="left-inputbox clearfix">
                    <div class="left-label">
                        <?php echo $titlefield->label; ?>
                    </div>
                    <div class="right-input">
                        <?php echo $titlefield->input;?>
                    </div>
                    <div class="left-label">
                        <label id="jform_profile_first_name-lbl" for="jform_profile_first_name" class="hasTip required" title="First Name::First Name of the user">First Name<span class="star">&#160;*</span></label>
                    </div>
                    <div class="right-input">
                        <input type="text" name="jform[profile][first_name]" id="jform_profile_first_name" class="required" value="" size="30"/>
                    </div>
                    <div class="left-label">
                        <label id="jform_profile_last_name-lbl" for="jform_profile_last_name" class="hasTip required" title="Last Name::Last Name of the user">Last Name<span class="star">&#160;*</span></label>
                    </div>
                    <div class="right-input">
                        <input type="text" name="jform[profile][last_name]" id="jform_profile_last_name" class="required" value="" size="30"/>
                    </div>
                    <div class="left-label">
                        <?php echo $onamefield->label; ?>
                    </div>
                    <div class="right-input">
                        <?php echo $onamefield->input;?>
                    </div>
                    <div class="left-label">
                        <?php echo $genderfield->label; ?>
                    </div>
                    <div class="right-input">
                        <?php echo $genderfield->input;?>
                    </div>
                    <div class="left-label">
                        <?php echo $nationalityfield->label; ?>
                    </div>
                    <div class="right-input">
                        <?php echo $nationalityfield->input;?>
                    </div>
                    <div class="left-label">
                        <?php echo $mstatusfield->label; ?>
                    </div>
                    <div class="right-input">
                        <?php echo $mstatusfield->input;?>
                    </div>
                    <div class="left-label">
                        <?php echo $dobfield->label; ?>
                    </div>
                    <div class="right-input">
                        <?php echo $dobfield->input;?>
                    </div>
                    <div class="left-label">
                        <?php echo $address1field->label; ?>
                    </div>
                    <div class="right-input">
                        <?php echo $address1field->input;?>
                    </div>
                    <div class="left-label">
                        <?php echo $address2field->label; ?>
                    </div>
                    <div class="right-input">
                        <?php echo $address2field->input;?>
                    </div>
                    <div class="left-label">
                        <?php echo $cityfield->label; ?>
                    </div>
                    <div class="right-input">
                        <?php echo $cityfield->input;?>
                    </div>
                    <div class="left-label">
                        <?php echo $regionfield->label; ?>
                    </div>
                    <div class="right-input">
                        <?php echo $regionfield->input;?>
                    </div>
                    <div class="left-label">
                        <?php echo $countryfield->label; ?>
                    </div>
                    <div class="right-input">
                        <?php echo $countryfield->input;?>
                    </div>
                    <div class="left-label">
                        <?php echo $postcodefield->label; ?>
                    </div>
                    <div class="right-input">
                        <?php echo $postcodefield->input;?>
                    </div>
                    <div class="left-label">
                        <?php echo $mphonefield->label; ?>
                    </div>
                    <div class="right-input">
                        <?php echo $mphonefield->input;?>
                    </div>
                    <div class="left-label">
                        <?php echo $wphonefield->label; ?>
                    </div>
                    <div class="right-input">
                        <?php echo $wphonefield->input;?>
                    </div>
                    <div class="left-label">
                        <?php echo $designfield->label; ?>
                    </div>
                    <div class="right-input">
                        <?php echo $designfield->input;?>
                    </div>
                    <div class="left-label">
                        <?php echo $emplofield->label; ?>
                    </div>
                    <div class="right-input">
                        <?php echo $emplofield->input;?>
                    </div>
                    <div class="left-label">
                        <?php echo $pemailfield->label; ?>
                    </div>
                    <div class="right-input">
                        <?php echo $pemailfield->input;?>
                    </div>
                    <div class="left-label">
                        <?php echo $skypeidfield->label; ?>
                    </div>
                    <div class="right-input">
                        <?php echo $skypeidfield->input;?>
                    </div>
                </div>
                <div class="right-inputbox clearfix"></div>
            </div>
            <div id="user-terms-div"></div>
            <div id="user-captcha-div"></div>
            
            
            <input type="hidden" name="option" value="com_users" />
            <input type="hidden" name="task" value="registration.register" />
            <?php echo JHtml::_('form.token');?>
            
        </form>
    </div>
</div>
