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
    <input type="hidden" name="controller" value="surgery" />
    <input type="hidden" name="id" value="<?php echo $this->surgery_data->id; ?>" />
    
    <table width="100%">
        <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_PUBLISH'); ?>
            </td>
            <td>
                <?php echo TellMeMDHelper::createCheckBox('published', $this->surgery_data->published, 1); ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('COM_TELLMEMD_CATEGORY'); ?>
            </td>
            <td>
                <?php echo TellMeMDHelper::createList('cat_id', (int)$this->surgery_data->cat_id, $this->catlist_array, '', 'adminlist'); ?>
            </td>
        </tr>
        <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_SURGERY_NAME'); ?>
            </td>
            <td>
                <input type="text" name="surgery_name" value="<?php echo $this->surgery_data->surgery_name; ?>" size="50" />
            </td>
        </tr>
    </table>
    
</form>