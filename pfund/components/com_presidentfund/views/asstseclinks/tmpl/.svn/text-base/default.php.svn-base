<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   15 January 2012
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );
$user =& JFactory::getUser();

?>

<h1>SAS Actions</h1>
<div class="comp-button">
   <button type="button" name="spback_btn" class="spback_btn" onclick="routeback('<?php echo $this->link_data->controller; ?>', 'linkback');">Back</button>
</div>
<div class="comp-content">
    
    <form class="submit-form" action="index.php" method="post" name="adminForm">
        <input type="hidden" name="option" value="<?php echo OPTION_NAME ; ?>" />
        <input type="hidden" name="task" id="task" value="" />
        <input type="hidden" name="controller" value="asstsec" />
        
        
        <table class="link-list">
            <?php if(PFundPermissionHelper::checkAcces($user->id, 'asstsec', 'all')): ?>
            <tr> 
                <td width="5%"><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/account_administration.png' ?>" title="Account Administration" /></td>
                <td>
                    <b><?php echo JHtml::link(COMPONENT_LINK.'&controller='.$this->link_data->controller.'&task='.$this->link_data->apptask, 'Applications to Review'); ?></b>
                </td>
            </tr> 
            <tr> 
                <td width="5%"><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/account_administration.png' ?>" title="Account Administration" /></td>
                <td>
                    <b><?php echo JHtml::link(COMPONENT_LINK.'&controller='.$this->link_data->controller.'&task='.$this->link_data->lettertask, 'Letters to Review'); ?></b>
                </td>
            </tr> 
            <?php endif; ?>
        </table>
        
    </form>
</div>