<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   26 August 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

JHTML::_('behavior.tooltip');
// echo 'Doctor -> Edit Profile';
?>

<div class="blue_wrapper clearfix">
  <div class="gray_line clearfix">
    <table width="100%" class="edit_info">
      <tr>
        <td class="col_1"><div class="profile_image"> <img src="<?php echo JURI::root(); ?>templates/tellmemd_template/images/pro_img_sample.jpg" />
            <input type="button" name="change_pofile_image" value="Change Profile Image" class="change_image"/>
          </div>
          <div class="quote_wrapper">
            <label>Enter Quote:</label>
            <br />
            <input type="text" class="text_box"/>
            <br />
            <label>Who Can View This Page:</label>
            <br />
            <select name="view_select" class="text_box" >
            </select>
            <br />
            <br />
            <input name="feature_me" type="checkbox" value="" checked>
            <label> Feature Me On This Website</label>
            </input>
            <br />
            <input type="button" name="save_preview" value="Save & Preview" class="change_image"/>
          </div></td>
        <td class="col_2"><table class="information_form">
            <tr>
              <td><label>First Name:</label></td>
              <td><input type="text" class="text_box"/></td>
            </tr>
            <tr>
              <td><label>Last Name:</label></td>
              <td><input type="text" class="text_box"/></td>
            </tr>
            <tr>
              <td><label>Speciality:</label></td>
              <td><select name="speciality" class="text_box" ></select></td>
            </tr>
            <tr>
              <td><label>Employer Name:</label></td>
              <td><input type="text" class="text_box"/></td>
            </tr>
            <tr>
              <td><label>Employer Address:</label></td>
              <td><textarea></textarea></td>
            </tr>
            <tr>
              <td><label>Areas of Interest:</label></td>
              <td><textarea></textarea></td>
            </tr>
          </table></td>
        <td class="col_3"><div class="key_area">
            <table width="300px" border="0" class="feedback_key" cellspacing="0">
              <tr>
                <td class="title">Successful Case Count</td>
                <td class="value">3</td>
              </tr>
              <tr>
                <td class="title">Quality of Response</td>
                <td class="value"><img src="<?php echo JURI::root(); ?>templates/tellmemd_template/images/stars.png" /></td>
              </tr>
              <tr>
                <td class="title">Speed of Response</td>
                <td class="value"><img src="<?php echo JURI::root(); ?>templates/tellmemd_template/images/stars.png" /></td>
              </tr>
              <tr>
                <td class="title">Friendliness of Response</td>
                <td class="value"><img src="<?php echo JURI::root(); ?>templates/tellmemd_template/images/stars.png" /></td>
              </tr>
              <tr>
                <td class="title">Overall Rating</td>
                <td class="value"><img src="<?php echo JURI::root(); ?>templates/tellmemd_template/images/stars.png" /></td>
              </tr>
            </table>
            <br />
            <table width="300px" border="0" class="feedback_key" cellspacing="0">
              <tr>
                <td class="title">Skype Rating</td>
                <td class="value"><img src="<?php echo JURI::root(); ?>templates/tellmemd_template/images/stars.png" /></td>
              </tr>
            </table>
          </div>
          <!--<div class="ask_question_btn clearfix">
            <div class="btn_left">
              <input type="button" name="ask_question" value="Ask me a Question" class=""/>
            </div>
            <div class="radio_right">
              <input name="status" type="radio" value="Enable" checked >
              <label>Button Enabled</label>
              </input>
              <br />
              <input name="status" type="radio" value="Enable">
              <label>Button Disabled</label>
              </input>
            </div>
          </div>-->
</td>
      </tr>
    </table>
    <table class="additional_info" width="100%">
    <tr>
    <td><label>Expertise:</label></td>
    <td><label>Medical Background:</label></td>
    <td><label>Personal Background:</label></td>
    </tr>
    <tr>
    <td><textarea></textarea></td>
    <td><textarea></textarea></td>
    <td><textarea></textarea></td>
    </tr>
    </table>
              <div class="cancel_save_btn">
            <input type="button" name="cancel" value="Cancel" class=""/>
            <input type="button" name="save" value="Save Changes" class=""/>
          </div>
  </div>
</div>
