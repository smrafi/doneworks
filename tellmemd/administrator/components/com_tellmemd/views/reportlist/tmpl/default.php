<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   26 July 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?>

<form action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTIOIN_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="controller" value="website" />
    
    <table class="adminlist">
        <tr>
            <td></td>
            <td><b><?php echo JHTML::link(JRoute::_(COMPONENT_LINK.'&controller=report&task=pending'), JText::_('COM_TELLMEMD_PENDING_REPORT')); ?></b></td>
        </tr>
        <tr>
            <td></td>
            <td><b><?php echo JHTML::link(JRoute::_(COMPONENT_LINK.'&controller=report&task=expense'), JText::_('COM_TELLMEMD_EXPENSE_REPORT')); ?></b></td>
        </tr>
        
    </table>
    
</form>
