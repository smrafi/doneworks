<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Asfaran
 * Developer Email  :   asfaransl@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */
defined( '_JEXEC' ) or die( 'Restricted access' );

JHTML::_('behavior.modal');
JHTML::_('behavior.mootools');
JHTML::_('behavior.tooltip');

$approval_status= PFundHelper::getApprovalStatusType('no');
$ledger_type= PFundHelper::getLedgerType('no');

?>
<h1>Update Medical Payment Status</h1>
<div class="comp-button">
    <button type="button" name="new_btn" class="new_btn">Save</button>
    <button type="button" name="bk_btn" class="_btn" onclick="routeback('medicalpayment','reimbursment_medical');">Back</button>
</div>
 
<div class="comp-content">
   
<form class="submit-form" action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" id="task"/>
    <input type="hidden" name="controller" value="medicalpayment" />
   
    
    
    
    <table>
        <tr>
            <td>Payment Payable To</td>
            <td><?php echo $this->application_data->applicant_fullname."/".$this->application_data->patient_fullname ;?>
                <input type="hidden" name="contact_id" value="<?php echo $this->application_data->grant_amount ;?>" /></td>
        </tr>
        <tr>
            <td>Amount</td>
            <td><?php echo $this->application_data->grant_amount ;?>
                <input type="hidden" name="cheque_amount" value="<?php echo $this->application_data->grant_amount ;?>" /></td>
        </tr>
        <tr>
            <td>Illness</td>
            <td><?php echo $this->application_data->illness_nature;?></td>
        </tr>
        <tr>
            <td>Bank</td>
            <td>
                <?php echo PFundHelper::createList('bank_id','',$this->bank_array); ?>
            </td>
        </tr>
        <tr>
            <td>Account Number</td>
            <td id="account_list">
                 <?php  echo PFundHelper::createList('bankaccount_id', '', $this->account_nums); ?>
            </td>
             <td id="bankaccount_detail_dev" ></td>
        </tr>
         <tr>
            <td>Receipt Document</td>
            <td ><input type="file" name="receipt_Document_letter"  value="" size="50" /></td>
        </tr>
</table>   

</form>
</div>
