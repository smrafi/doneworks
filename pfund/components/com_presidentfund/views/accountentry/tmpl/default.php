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

?>
<h1>Account Entry Settings</h1>
<div class="comp-button">
    <button type="button" name="spback_btn" class="spback_btn" onclick="routeback('configure', 'accountlinks');">Back</button>
</div>
<div class="comp-content">
<form class="submit-form"  action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" id="task" value="" />
    <input type="hidden" name="controller" id="controller" value="accountentry" />
    
    <table class="link-list">
        <tr>
            <td width="5%"><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/receipt_summary.png' ?>" title="Reciept" /></td>
            <td>
                <b><?php echo JHtml::link('index.php/reciepts', 'Receipt'); ?></b>
            </td>
        </tr>
        <tr>
            <td><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/vouchers.png' ?>" title="Vouchers" /></td>
            <td>
                <b><?php echo JHtml::link('index.php/payment-vouchers', 'Vouchers'); ?></b>
            </td>
        </tr>
        
        <tr>
            <td ><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/loans.png' ?>" title="Loan" /></td>
            <td>
                <b><?php echo JHtml::link('index.php/loans', 'Loan'); ?></b>
            </td>
        </tr>
        <tr>
            <td ><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/fixed_deposits.png' ?>" title="Fixed Deposite" /></td>
            <td>
                <b><?php echo JHtml::link('index.php/fixed-deposit', 'Fixed Deposite'); ?></b>
            </td>
        </tr>
        <tr>
            <td ><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/journal_entry.png' ?>" title="Journal Entry" /></td>
            <td>
                <b><?php echo JHtml::link('index.php/journel-entry', 'Journal Entry'); ?></b>
            </td>
        </tr>
        <tr>
            <td ><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/bank_reconciliation.png' ?>" title="Bank Reconcilation" /></td>
            <td>
                <b><?php echo JHtml::link('index.php/bank-reconcilation', 'Bank Reconcilation'); ?></b>
            </td>
        </tr>
    </table>
</form>
</div>