<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   14 September 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?>

<form action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTIOIN_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="category" />
    <input type="hidden" name="id" value="<?php echo $this->cat_data->id; ?>" />
    
    <table width="100%">
        <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_PUBLISH'); ?>
            </td>
            <td>
                <?php echo TellMeMDHelper::createCheckBox('published', $this->cat_data->published, 1); ?>
            </td>
        </tr>
        <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_CATNAME'); ?>
            </td>
            <td>
                <input type="text" name="cat_name" value="<?php echo $this->cat_data->cat_name; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('COM_TELLMEMD_CATDESC'); ?>
            </td>
            <td>
                <textarea name="cat_description" rows="4" cols="31"><?php echo $this->cat_data->cat_description; ?></textarea>
            </td>
        </tr>
    </table>
    
</form>