<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

?>
<h1>Account Settings</h1>
<div class="comp-content">
<form  action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="account" />
    
     
    <table class="link-list">
        
        <tr> 
            <td width="5%"></td>
            <td>
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=accountsetting&task=openbalance', 'Opening Balance'); ?></b>
            </td>
        </tr> 
        <tr>
            <td></td>
            <td> <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=accountsetting&task=banks', 'Banks'); ?></b></td>
        </tr>
        <tr>
            <td></td>
            <td> <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=ledgeritem&task=ledgeritem', 'Ledger Items'); ?></b></td>
        </tr>
    </table>
</form>
</div>