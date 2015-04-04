<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   19 August 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$document =& JFactory::getDocument();
$document->setTitle('Medication History');
?>

<form name="medicationform" id="medicationform" action="<?php echo COMPONENT_FRONT_LINK; ?>" method="post">
    
<input type="hidden" name="controller" value="medical" />
<input type="hidden" name="task" id="task" value="allergyform" />
    
<div class="brown_wrapper clearfix">
    <div class="blue_line clearfix">
        <div id="data-form-box">
            <div id="data-form-inner">
                <div id="info-div">
                    <p class="descrip_top">Enter into text field a medication used by you and its date of use and add to list.</p>
                </div>
                <div id="preinput-box clearfix">
                <table align="left"><tr>
                <td>
                    <div id="medication-input">
                        <span>Enter Medication</span>&nbsp;&nbsp;&nbsp;
                        <input type="text" name="medication_name" id="medication_name" value="<?php echo $this->medi_data->medication_name; ?>" />
                    </div>
                 </td><td>
                    <div id="dose-input">
                        <span>Dose</span>&nbsp;&nbsp;&nbsp;
                        <input type="text" name="dose" id="dose" value="<?php echo $this->medi_data->dose; ?>" />
                    </div>
                    </td><td>
                    <div id="frequency-input">
                        <span>Frequency</span>&nbsp;&nbsp;&nbsp;
                        <input type="text" name="frequency" id="frequency" value="<?php echo $this->medi_data->frequency; ?>" />
                    </div>
                    </td>
                    </tr>
                </table>
                </div>
                <div id="medication-button">
                    <button type="button" name="medi_button" id="medi_button" disabled="disabled" class="disabled-button" >Add Medication</button>
                </div>
                <div id="total-databox">
<textarea cols="30" rows="5" name="total_data" id="total_data"></textarea>
                    <table>
                        <thead>
                            <tr>
                                <th>Medication Name</th>
                                <th>Dose</th>
                                <th>Frequency</th>
                            </tr>
                        </thead>
                        <?php
                        foreach($this->summary_data as $data)
                        {
                            ?>
                        <tr>
                            <td><?php echo $data->medication_name; ?></td>
                            <td><?php echo $data->dose; ?></td>
                            <td><?php echo $data->frequency; ?></td>
                        </tr>
                        <input type="hidden" name="medication_ids[]" value="<?php echo $data->id; ?>" />
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
            <div id="button-box">
                <div id="button-box-inner">
                <table><tr><td>
                    <div id="skip-button">
                        <button type="button" name="skip">Skip</button>
                    </div>
                    </td><td>
                    <div id="back-button">
                        <button type="submit" name="save_back">Save & Go Back</button>
                    </div>
                    </td><td>
                    <div id="proceed-button">
                        <button type="submit" name="save_proceed">Save & Proceed</button>
                    </div>
                    </td>
                    </tr>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
</form>