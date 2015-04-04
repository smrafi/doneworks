<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   13 September 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?>

<form action="index.php" method="post" name="adminForm" enctype="multipart/form-data">
    <input type="hidden" name="option" value="<?php echo OPTIOIN_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="patientset" />
    <input type="hidden" name="hidemainmenu" value="0" />
    <input type="hidden" name="id" value="<?php echo $this->setting_data->id; ?>" />
    
    <div class="table1">
        <table class="adminlist">
            <tr>
                <td width="20%"><?php echo JText::_('COM_TELLMEMD_SPECIFIC_DOCTOR_SELECTION'); ?></td>
                <td>
                    <?php echo TellMeMDHelper::createCheckBox('specific_doctor', $this->setting_data->specific_doctor, 1) ?>
                </td>
            </tr>
        </table>
    </div>
    <br/>
    <div class="table2">
        <table class="adminlist">
            <thead>
                <tr>
                    <th class="title" width="20%" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_URGENCY_LEVEL'); ?></th>
                    <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_CASE_TIME_LIMIT').' (minuites)'; ?></th>
                </tr>
            </thead>
            <tbody>
                <tr class="row0">
                    <td width="20%"><?php echo JText::_('COM_TELLMEMD_LOW'); ?></td>
                    <td>
                        <input type="text" name="urgencycasetime_low" value="<?php echo $this->setting_data->urgencycasetime_low; ?>" size="50" />
                    </td>
                </tr>
                <tr class="row1">
                    <td><?php echo JText::_('COM_TELLMEMD_MEDIUM'); ?></td>
                    <td>
                        <input type="text" name="urgencycasetime_medium" value="<?php echo $this->setting_data->urgencycasetime_medium; ?>" size="50" />
                    </td>
                </tr>
                <tr class="row0">
                    <td><?php echo JText::_('COM_TELLMEMD_HIGH'); ?></td>
                    <td>
                        <input type="text" name="urgencycasetime_high" value="<?php echo $this->setting_data->urgencycasetime_high; ?>" size="50" />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <br/>
    <div class="table2">
        <table class="adminlist">
            <thead>
                <tr>
                    <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_URGENCY_LEVEL'); ?></th>
                    <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_NEW_DOC_TIME_LIMIT').' (minuites)'; ?></th>
                </tr>
            </thead>
            <tbody>
                <tr class="row0">
                    <td width="20%"><?php echo JText::_('COM_TELLMEMD_LOW'); ?></td>
                    <td>
                        <input type="text" name="newdoctime_urglow" value="<?php echo $this->setting_data->newdoctime_urglow; ?>" size="50" />
                    </td>
                </tr>
                <tr class="row1">
                    <td><?php echo JText::_('COM_TELLMEMD_MEDIUM'); ?></td>
                    <td>
                        <input type="text" name="newdoctime_urgmedium" value="<?php echo $this->setting_data->newdoctime_urgmedium; ?>" size="50" />
                    </td>
                </tr>
                <tr class="row0">
                    <td><?php echo JText::_('COM_TELLMEMD_HIGH'); ?></td>
                    <td>
                        <input type="text" name="newdoctime_urghigh" value="<?php echo $this->setting_data->newdoctime_urghigh; ?>" size="50" />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <br/>
    <div class="table2">
        <table class="adminlist">
            <thead>
                <tr>
                    <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_URGENCY_LEVEL'); ?></th>
                    <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_PRICE_INC_PERCENTAGE').' (minuites)'; ?></th>
                </tr>
            </thead>
            <tbody>
                <tr class="row0">
                    <td width="20%"><?php echo JText::_('COM_TELLMEMD_LOW'); ?></td>
                    <td>
                        <input type="text" name="priceinc_urglow" value="<?php echo $this->setting_data->priceinc_urglow; ?>" size="50" />
                    </td>
                </tr>
                <tr class="row1">
                    <td><?php echo JText::_('COM_TELLMEMD_MEDIUM'); ?></td>
                    <td>
                        <input type="text" name="priceinc_urgmedium" value="<?php echo $this->setting_data->priceinc_urgmedium; ?>" size="50" />
                    </td>
                </tr>
                <tr class="row0">
                    <td><?php echo JText::_('COM_TELLMEMD_HIGH'); ?></td>
                    <td>
                        <input type="text" name="priceinc_urghigh" value="<?php echo $this->setting_data->priceinc_urghigh; ?>" size="50" />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <br/>
    <div class="table2">
        <table class="adminlist">
            <thead>
                <tr>
                    <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_LEVEL_DETAIL'); ?></th>
                    <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_PRICE_INC_PERCENTAGE').' (minuites)'; ?></th>
                </tr>
            </thead>
            <tbody>
                <tr class="row0">
                    <td width="20%"><?php echo JText::_('COM_TELLMEMD_LOW'); ?></td>
                    <td>
                        <input type="text" name="priceinc_level_low" value="<?php echo $this->setting_data->priceinc_level_low; ?>" size="50" />
                    </td>
                </tr>
                <tr class="row1">
                    <td><?php echo JText::_('COM_TELLMEMD_MEDIUM'); ?></td>
                    <td>
                        <input type="text" name="priceinc_level_medium" value="<?php echo $this->setting_data->priceinc_level_medium; ?>" size="50" />
                    </td>
                </tr>
                <tr class="row0">
                    <td><?php echo JText::_('COM_TELLMEMD_HIGH'); ?></td>
                    <td>
                        <input type="text" name="priceinc_level_high" value="<?php echo $this->setting_data->priceinc_level_high; ?>" size="50" />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <br/>
    <div class="table2">
        <table class="adminlist">
            <thead>
                <tr>
                    <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_MEDIUM_ANSWER'); ?></th>
                    <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_PRICE_INC_PERCENTAGE').' (minuites)'; ?></th>
                </tr>
            </thead>
            <tbody>
                <tr class="row0">
                    <td width="20%"><?php echo JText::_('COM_TELLMEMD_MEDIUM_FORM_SUBMIT'); ?></td>
                    <td>
                        <input type="text" name="priceinc_medium_submit" value="<?php echo $this->setting_data->priceinc_medium_submit; ?>" size="50" />
                    </td>
                </tr>
                <tr class="row1">
                    <td><?php echo JText::_('COM_TELLMEMD_MEDIUM_CHAT'); ?></td>
                    <td>
                        <input type="text" name="priceinc_medium_chat" value="<?php echo $this->setting_data->priceinc_medium_chat; ?>" size="50" />
                    </td>
                </tr>
                <tr class="row0">
                    <td><?php echo JText::_('COM_TELLMEMD_MEDIUM_SKYPE'); ?></td>
                    <td>
                        <input type="text" name="priceinc_medium_skype" value="<?php echo $this->setting_data->priceinc_medium_skype; ?>" size="50" />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <br/>
    <div class="table1">
        <table class="adminlist">
            <tr>
                <td width="20%"><?php echo JText::_('COM_TELLMEMD_WORDS_DIVIDE_FACOTR'); ?></td>
                <td>
                    <input type="text" name="words_divide" value="<?php echo $this->setting_data->words_divide; ?>" size="50" />
                </td>
            </tr>
        </table>
    </div>
    <br/>
    <div class="table2">
        <table class="adminlist">
            <thead>
                <tr>
                    <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_LAB_TEST_COMPLEXITY'); ?></th>
                    <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_PRICE').' ($)'; ?></th>
                </tr>
            </thead>
            <tbody>
                <tr class="row0">
                    <td width="20%"><?php echo JText::_('COM_TELLMEMD_COMPLEX_SIMPLE'); ?></td>
                    <td>
                        <input type="text" name="simple_labtest_price" value="<?php echo $this->setting_data->simple_labtest_price; ?>" size="50" />
                    </td>
                </tr>
                <tr class="row1">
                    <td><?php echo JText::_('COM_TELLMEMD_COMPLEX_MODERATE'); ?></td>
                    <td>
                        <input type="text" name="mod_labtest_price" value="<?php echo $this->setting_data->mod_labtest_price; ?>" size="50" />
                    </td>
                </tr>
                <tr class="row0">
                    <td><?php echo JText::_('COM_TELLMEMD_COMPLEX_COMPLEX'); ?></td>
                    <td>
                        <input type="text" name="complex_labtest_price" value="<?php echo $this->setting_data->complex_labtest_price; ?>" size="50" />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <br/>
    <div class="table1">
        <table class="adminlist">
            <tr>
                <td width="20%"><?php echo JText::_('COM_TELLMEMD_MAX_PRICE_PERCENTAGE').' (%)'; ?></td>
                <td>
                    <input type="text" name="maxprice_percentage" value="<?php echo $this->setting_data->maxprice_percentage; ?>" size="50" />
                </td>
            </tr>
        </table>
    </div>
    <br/>
    <div class="table1">
        <table class="adminlist">
            <tr>
                <td width="20%"><?php echo JText::_('COM_TELLMEMD_MIN_PRICE_PERCENTAGE').' (%)'; ?></td>
                <td>
                    <input type="text" name="minprice_percentage" value="<?php echo $this->setting_data->minprice_percentage; ?>" size="50" />
                </td>
            </tr>
        </table>
    </div>
    
</form>
