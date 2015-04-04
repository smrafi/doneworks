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
$document->setTitle('Enter Medical Now ?');

?>

<form name="medicalform" id="medicalform" action="<?php echo COMPONENT_FRONT_LINK; ?>" method="post">
  <input type="hidden" name="controller" value="medical" />
  <input type="hidden" name="task" value="entermedical" />
  <div class="brown_wrapper clearfix">
    <div class="blue_line clearfix">
      <div id="medi-data-box">
        <div id="medi-data-inner">
          <div id="info-text">
            <p> You can enter your medical details now or skip this step and enter them later. Select the approprite choice and click Proceed. </p>
          </div>
          <div id="select-box">
            <div id="select-box-inner">
              <input type="radio" name="report_select" id="report_select_later" value="<?php echo PATIENT_MEDICAL_INFO_LATER; ?>" />
              Enter Medical History <span>Later</span><br>
              <input type="radio" name="report_select" id="report_select_now" value="<?php echo PATIENT_MEDICAL_INFO_NOW; ?>" />
              Enter Medical History <span>Now</span> </div>
          </div>
          <div id="button-box">
            <div id="button-wrapper">
              <input type="submit" name="proceed_button" id="proceed_button" value="Proceed" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
