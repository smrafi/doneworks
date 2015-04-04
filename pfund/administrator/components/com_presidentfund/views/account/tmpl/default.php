<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<form  action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="account" />
    
    <table class="adminlist">
        <tr>
            <td width="5%"></td>
            <td>
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=accountsetting&task=banks', 'Bank Settings'); ?></b>
            </td>
        </tr>
        <tr>
            <td width="5%"></td>
            <td>
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=bankaccount', 'Bank Account'); ?></b>
            </td>
        </tr>
        <tr>
            <td width="5%"></td>
            <td>
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=ledgeritem&task=ledger', 'Ledger Settings'); ?></b>
            </td>
        </tr>
        <tr>
            <td ></td>
            <td>
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=paysetting', 'Payable Setting'); ?></b>
            </td>
        </tr>
        <tr>
            <td ></td>
            <td>
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=openbalance', 'Opening Balance'); ?></b>
            </td>
        </tr>
        
        
        
        
    </table>
    
</form>