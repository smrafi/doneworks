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
$namefield = $fields['jform_name'];
$unamefield = $fields['jform_username'];
$pwd1field = $fields['jform_password1'];
$pwd2field = $fields['jform_password2'];
$emailfield = $fields['jform_email1'];
$emailfield2 = $fields['jform_email2'];

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

//we define numbers to be used to verify the registration
$rand_num1 = rand(1, 9);
$rand_num2 = rand(1, 9);
$rand_total = $rand_num1+$rand_num2;

//load the css for register 
$document = JFactory::getDocument();
$document->addStyleSheet(JURI::root().'templates/tellmemd_template/css/register.css');
$document->addScript(JURI::root().'templates/tellmemd_template/scripts/jquery-1.6.2.min.js');
$document->addScript(JURI::root().'templates/tellmemd_template/scripts/register.js');

$query = "Select * From #__usergroups Where ((title = 'Doctors') OR (title = 'Patients'))";

$db =& JFactory::getDbo();
$db->setQuery($query);

$user_groups = $db->loadObjectList();

?>
<script type="text/javascript">
    jQuery(document).ready(function($){
        $('#captchavalue').change(function(){
            if($(this).val() != <?php echo $rand_total; ?>){
                alert('enter the correct value');
                return false;
            }
        });
        $('#account-register').click(function(){
            if($('#captchavalue').val() != <?php echo $rand_total; ?>){
                $('#captchavalue').addClass('invalid');
                return false;
            }
        });
    });
</script>
<div class="log_redirect">
<p>Click <a class="link" href="index.php?option=com_users&view=login">here</a> if you are an existing User</p>
</div>
<div class="blue_line_register clearfix">
<div class="registration<?php echo $this->pageclass_sfx?>">
    <div id="registration-inner">
        <form id="member-registration" action="<?php echo JRoute::_('index.php?option=com_users&task=registration.register'); ?>" method="post" class="form-validate">
            <div id="user-type-div">
                <div id="user-types">
                    <?php
                    foreach($user_groups as $group)
                    {
                        if($group->title == 'Doctors')
                        {
                            $group_name = 'Doctor';
                        }
                        else
                        {
                            $group_name = 'Patient';
                            echo '<input type="hidden" name="jform[default_gid]" value="'.$group->id.'" />';
                        }
                        ?>
                        
                    <span id="<?php echo strtolower($group->title).'-div' ?>" class="group-type">
                        <input type="radio" name="jform[groupid]" value="<?php echo $group->id; ?>" id="<?php echo strtolower($group->title).'-input' ?>" class="required" />Sign me up as a <span><?php echo $group_name; ?></span>
                    </span>
                    
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div id="user-input-div" class="clearfix">
                <div class="left-inputbox clearfix">
                    <div class="left-label">
                        <label id="jform_profile_first_name-lbl" for="jform_profile_first_name" class="hasTip required" title="First Name::First Name of the user">First Name<span class="star">&#160;*</span></label>
                    </div>
                    <div class="right-input">
                        <input type="text" name="jform[profile][first_name]" id="jform_profile_first_name" class="required" value="" size="30"/>
                    </div>
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
                        <label id="jform_profile_last_name-lbl" for="jform_profile_last_name" class="hasTip required" title="Last Name::Last Name of the user">Last Name<span class="star">&#160;*</span></label>
                    </div>
                    <div class="right-input">
                        <input type="text" name="jform[profile][last_name]" id="jform_profile_last_name" class="required" value="" size="30"/>
                    </div>
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
            
            <div id="user-captcha-div">
                <div id="captcha-div-inner" class="clearfix">
                    <div id="captcha-field">
                        <span><?php echo $rand_num1.' + '.$rand_num2.' = '; ?></span>
                        <input class="required" type="text" name="captchavalue" id="captchavalue" value="" />
                    </div>
                </div>
                                    <div id="register-button">
                        <button id="account-register" type="submit">Create Account</button>
                    </div>
            </div>
            <div id="user-terms-div">
                <div id="terms-innner">
                    <input type="checkbox" class="required" name="termscond" id="termscond" /> &nbsp;&nbsp; <span>By selecting this check box you indicate that you are 18 years or older and agree to this site's <a class="link" href="index.php?option=com_content&view=article&id=6">Terms & conditions.</a></span>
                </div>
            </div>
            
            
            <input type="hidden" name="option" value="com_users" />
            <input type="hidden" name="task" value="registration.register" />
            <input type="hidden" name="jform[email2]" id="jform_email2" value="" />
            <input type="hidden" name="jform[name]" id="jform_name" value="" />
            <?php echo JHtml::_('form.token');?>
            
        </form>
    </div>
</div>
</div>
