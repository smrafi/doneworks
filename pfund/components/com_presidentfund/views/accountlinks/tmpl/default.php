<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   10 December 2012
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );

//$groups = JHTML::_('access.usergroup', $field.'[]', $valuearray, 'multiple="multiple" size="6"');

?>
<h1>Account Settings</h1>
<div class="comp-content">
<form  action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="account" />
    
     
    <table class="link-list">
        
        <tr> 
            <td width="5%"><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/account_administration.png' ?>" title="Account Administration" /></td>
            <td>
                <b><?php echo JHtml::link('index.php/account-administration', 'Account Administration'); ?></b>
            </td>
        </tr> 
        <tr>
            <td><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/bank_reconciliation.png' ?>" title="Account Entry" /></td>
            <td> 
                <b><?php echo JHtml::link('index.php/account-entry', 'Account Entry'); ?></b></td>
        </tr>
        <tr>
            <td><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/account_summary.png' ?>" title="Account Views" /></td>
            <td> 
                <b><?php echo JHtml::link('index.php/account-views', 'Account Views'); ?></b></td>
        </tr>
    </table>
</form>
</div>