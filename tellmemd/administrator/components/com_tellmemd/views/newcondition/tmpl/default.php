<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   21 September 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?>

<form action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTIOIN_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="conditions" />
    <input type="hidden" name="id" value="<?php echo $this->condition_data->id; ?>" />
    
    <table width="100%">
        <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_PUBLISH'); ?>
            </td>
            <td>
                <?php echo TellMeMDHelper::createCheckBox('published', $this->condition_data->published, 1); ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('COM_TELLMEMD_CATEGORY'); ?>
            </td>
            <td>
                <?php echo TellMeMDHelper::createList('cat_id', (int)$this->condition_data->cat_id, $this->catlist_array, '', 'adminlist'); ?>
            </td>
        </tr>
        <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_CONDITION_NAME'); ?>
            </td>
            <td>
                <input type="text" name="condition_name" value="<?php echo $this->condition_data->condition_name; ?>" size="50" />
            </td>
        </tr>
    </table>
    
</form>