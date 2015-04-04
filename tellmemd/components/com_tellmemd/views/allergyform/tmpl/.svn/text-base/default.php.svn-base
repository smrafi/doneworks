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
$document->setTitle('Allergy History');

?>

<form name="medicationform" id="medicationform" action="<?php echo COMPONENT_FRONT_LINK; ?>" method="post">
    
<input type="hidden" name="controller" value="medical" />
<input type="hidden" name="task" id="task" value="pastmedical" />

<div class="brown_wrapper clearfix">
    <div class="blue_line clearfix">
        <div id="data-form-box">
            <div id="data-form-inner">
                <div id="info-div">
                    <p class="descrip_top">Enter into text field a allergy and add to list.</p>
                </div>
                <div id="preinput-box">
                    <div id="allergy-input">
                        <span>Enter Allergy</span>&nbsp;&nbsp;&nbsp;
                        <input type="text" name="allergy_name" id="allergy_name" value="" />
                    </div>
                </div>
                <div id="allergy-button">
                    <button type="button" name="allergy_button" id="allergy_button" disabled="disabled" class="disabled-button">Add Allergy</button>
                </div>
                <div id="total-databox">
<!--                    <textarea cols="30" rows="5" name="total_data" id="total_data"></textarea>-->
                    <table>
                        <thead>
                            <tr>
                                <th>Allergy Name</th>
                            </tr>
                        </thead>
                        <?php
                        foreach($this->summary_data as $data)
                        {
                            ?>
                        <tr>
                            <td><?php echo $data->allergy_name; ?></td>
                        </tr>
                        <input type="hidden" name="allergy_ids[]" value="<?php echo $data->id; ?>" />
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
                        <button type="submit" id="save_proceed" name="save_proceed">Save & Proceed</button>
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