<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   08 September 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

?>

<form action="index.php" method="post" name="adminForm" enctype="multipart/form-data">
    <input type="hidden" name="option" value="<?php echo OPTIOIN_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="doctorset" />
    <input type="hidden" name="hidemainmenu" value="0" />
    <input type="hidden" name="id" value="<?php echo $this->setting_data->id; ?>" />
    
    <div class="table1">
        <table class="adminlist">
            <thead>
                <tr>
                    <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_SCENARIO'); ?></th>
                    <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_NUMLOCKS'); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr class="row0">
                    <td><?php echo JText::_('COM_TELLMEMD_CASE_ACTION_WITH_DOCTOR'); ?></td>
                    <td>
                        <input type="text" name="lockwt_doc" value="<?php echo $this->setting_data->lockwt_doc; ?>" />
                    </td>
                </tr>
                <tr class="row1">
                    <td><?php echo JText::_('COM_TELLMEMD_CASE_ACTION_NOT_WITH_DOCTOR'); ?></td>
                    <td>
                        <input type="text" name="lockntwt_doc" value="<?php echo $this->setting_data->lockntwt_doc; ?>" />
                    </td>
                </tr>
                <tr class="row0">
                    <td><?php echo JText::_('COM_TELLMEMD_CASE_ASSIGNED_TO_DOCTOR'); ?></td>
                    <td>
                        <input type="text" name="lockassign_doc" value="<?php echo $this->setting_data->lockassign_doc; ?>" />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <br/><br/><br/>
    <div class="table2">
        <table class="adminlist">
            <thead>
                <tr>
                    <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_URGENCY_LEVEL'); ?></th>
                    <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_TIME_LIMIT').' (minutes)'; ?></th>
                    <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_NUMRELOCKS'); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr class="row0">
                    <td><?php echo JText::_('COM_TELLMEMD_LOW'); ?></td>
                    <td>
                        <input type="text" name="low_timelimit" value="<?php echo $this->setting_data->low_timelimit; ?>" />
                    </td>
                    <td>
                        <input type="text" name="low_relock" value="<?php echo $this->setting_data->low_relock; ?>" />
                    </td>
                </tr>
                <tr class="row1">
                    <td><?php echo JText::_('COM_TELLMEMD_MEDIUM'); ?></td>
                    <td>
                        <input type="text" name="medium_timelimit" value="<?php echo $this->setting_data->medium_timelimit; ?>" />
                    </td>
                    <td>
                        <input type="text" name="medium_relock" value="<?php echo $this->setting_data->medium_relock; ?>" />
                    </td>
                </tr>
                <tr class="row0">
                    <td><?php echo JText::_('COM_TELLMEMD_HIGH'); ?></td>
                    <td>
                        <input type="text" name="high_timelimit" value="<?php echo $this->setting_data->high_timelimit; ?>" />
                    </td>
                    <td>
                        <input type="text" name="high_relock" value="<?php echo $this->setting_data->high_relock; ?>" />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
</form>