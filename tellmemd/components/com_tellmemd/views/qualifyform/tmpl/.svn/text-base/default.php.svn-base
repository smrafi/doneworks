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

$document =& JFactory::getDocument();
$document->setTitle('Doctor Employment and Qualification Details');

?>

<form name="thank_form" id="thank-from" action="<?php echo COMPONENT_FRONT_LINK; ?>" method="post" enctype="multipart/form-data">
  <input type="hidden" name="controller" value="doctor" />
  <input type="hidden" name="task" value="savequalification" />
  <input type="hidden" name="user_id" value="<?php echo $this->user_id; ?>" />
  <div class="brown_wrapper clearfix">
    <div class="blue_line clearfix">
      <div id="registration-inner-qualification">
            <p class="descrip_top">Enter below employment and qualification details, save 
        and proceed to complete your doctor registration.</p>
        <table class="qualification" width="80%" align="center">
          <tr class="group">
          
            <td><div class="left-label">
                <label>Attach A CV file:</label>
              </div></td>
            <td><div class="right-input">
                <input type="file" name="cvfile" id="cvfile" value="" size="35" />
              </div></td>
              
          </tr>
          <tr class="group">
            <td><div class="left-label">
                <label>Attach medical school diploma:</label>
              </div></td>
            <td><div class="right-input">
                <input type="file" name="diplomafile" id="diplomafile" value="" size="35" />
              </div></td>
          </tr>
          <tr>
            <td><div class="left-label">
                <label>Category:</label>
              </div></td>
            <td><div class="right-input">
                <?php echo TellMeMDHelper::createList('cat_id', 0, $this->cat_list, 0, 'inputlist'); ?>
              </div></td>
          </tr>
          <tr>
            <td><div class="left-label">
                <label>Proof of Internship:</label>
              </div></td>
            <td><div class="right-input">
                <input type="file" name="internfile" id="internfile" value="" size="35" />
              </div></td>
          </tr>
          <tr>
            <td><div class="left-label">
                <label>Internship Place:</label>
              </div></td>
            <td><div class="right-input">
                <input type="text" name="internplace" id="internplace" value="" />
              </div></td>
          </tr>
          <tr>
            <td><div class="left-label">
                <label>Internship Start Date:</label>
              </div></td>
            <td><div class="right-input"> <?php echo JHtml::calendar(date('d-m-Y'), 'intern_start', 'intern_start', '%d-%m-%Y');?> </div></td>
          </tr>
          <tr class="group">
            <td><div class="left-label">
                <label>Internship End Date:</label>
              </div></td>
            <td><div class="right-input"> <?php echo JHtml::calendar(date('d-m-Y'), 'intern_end', 'intern_end', '%d-%m-%Y');?> </div></td>
          </tr>
          <tr>
            <td><div class="left-label">
                <label>State License:</label>
              </div></td>
            <td><div class="right-input">
                <input type="text" name="state_license" id="state_license" value="" />
              </div></td>
          </tr>
          <tr class="group">
            <td><div class="left-label">
                <label>DEA License:</label>
              </div></td>
            <td><div class="right-input">
                <input type="text" name="dealicense" id="dealicense" value="" />
              </div></td>
          </tr>
          <tr>
            <td><div class="left-label">
                <label>Malpractice Information:</label>
              </div></td>
            <td><div class="right-input">
                <textarea rows="3" cols="20" name="malpractice" id="malpractice"></textarea>
              </div></td>
          </tr>
          <tr>
            <td><div class="left-label">
                <label>Specialty:</label>
              </div></td>
            <td><div class="right-input">
                <textarea rows="3" cols="20" name="speciality" id="speciality"></textarea>
              </div></td>
          </tr>
          <tr class="group">
            <td><div class="left-label">
                <label>Year of Practice:</label>
              </div></td>
            <td><div class="right-input">
                <input type="text" name="yearpractice" id="yearpractice" value="" />
              </div></td>
          </tr>
          <tr>
            <td><div class="left-label">
                <label>Medical Background:</label>
              </div></td>
            <td><div class="right-input">
                <textarea rows="3" cols="20" name="medicalbg" id="medicalbg" value=""></textarea>
              </div></td>
          </tr>
          <tr>
            <td><div class="left-label">
                <label>Personal Background:</label>
              </div></td>
            <td><div class="right-input">
                <textarea rows="3" cols="20" name="personalbg" id="personalbg" value=""></textarea>
              </div></td>
          </tr>
        </table>
        <div id="post-button">
        <div id="post-button-inner">
          <input type="submit" name="post_button" id="post_button" value="Save and Proceed" />
        </div>
      </div>
      </div>
      
    </div>
  </div>
</form>
