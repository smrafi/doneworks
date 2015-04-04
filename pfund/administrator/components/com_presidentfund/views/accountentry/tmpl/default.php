<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<form  action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="accountentry" />
    
    <table class="adminlist">
        <tr>
            <td width="5%"></td>
            <td>
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=income', 'Reciept'); ?></b>
            </td>
        </tr>
        <tr>
            <td ></td>
            <td>
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=voucher', 'Payment Voucher'); ?></b>
            </td>
        </tr>
        <tr>
            <td ></td>
            <td>
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=medicalpayment', 'Medical Payment'); ?></b>
            </td>
        </tr>
        <tr>
            <td ></td>
            <td>
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=loan', 'Loan'); ?></b>
            </td>
        </tr>
        <tr>
            <td ></td>
            <td>
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=fd', 'Fixed Deposite'); ?></b>
            </td>
        </tr>
        <tr>
            <td ></td>
            <td>
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=journalentry', 'Journal Entry'); ?></b>
            </td>
        </tr>
        <tr>
            <td ></td>
            <td>
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=bankreconcilate', 'Bank Reconcilation'); ?></b>
            </td>
        </tr>
     
     
        
        
    </table>
    
</form>