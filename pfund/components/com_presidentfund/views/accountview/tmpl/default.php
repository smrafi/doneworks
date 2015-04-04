<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

?>
<h1>Account Views</h1>
<div class="comp-button">
    <button type="button" name="spback_btn" class="spback_btn" onclick="routeback('configure', 'accountlinks');">Back</button>
</div>
<div class="comp-content">
<form action="index.php" method="post" name="adminForm" class="submit-form">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" id="task" />
    <input type="hidden" name="controller" value="accountview" id="controller" />
    
    <table class="link-list">
        <tr>
            <td width="5%"><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/accounts_receivable.png' ?>" title="Receivable" /></td>
            <td>
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=accountview&task=receivable', 'Receivable'); ?></b>
            </td>
        </tr>
        <tr>
            <td><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/accounts_payable.png' ?>" title="Payable" /></td>
            <td>
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=accountview&task=payable', 'Payable'); ?></b>
            </td>
        </tr>
        <tr>
            <td><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/ledger_book.png' ?>" title="Ledger Book" /></td>
            <td>
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=ledger', 'Ledger Book'); ?></b>
            </td>
        </tr>
        <tr>
            <td><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/receipt_summary.png' ?>" title="Receipt Summary" /></td>
            <td>
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=accountview&task=recpts', 'Receipt Summary'); ?></b>
            </td>
        </tr>
        <tr>
            <td><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/payment_vouchers.png' ?>" title="Voucher Summary" /></td>
            <td>
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=accountview&task=voucher', 'Voucher Summary'); ?></b>
            </td>
        </tr>
    </table>
</form>
</div>
