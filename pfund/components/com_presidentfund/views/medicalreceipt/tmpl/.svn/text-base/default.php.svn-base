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

if($this->medical_type==APPLICATION_TYPE_NORMAL){
    $backroute="normal_medical";
}
if($this->medical_type == APPLICATION_TYPE_REIMBURSMENT){
    $backroute="reimbursment_medical";
    
}
?>
<h1>Update Medical Payment Status</h1>
<div class="comp-button">
    <button type="button" name="save_btn" class="save_btn">Save</button>
    <button type="button" name="bk_btn" class="_btn" onclick="routeback('medicalpayment','.$backroute.');">Back</button>
</div>
 
<div class="comp-content">
   
<form class="submit-form" action="index.php" method="post" name="adminForm" enctype="multipart/form-data">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" id="task"/>
    <input type="hidden" name="controller" value="medicalpayment" />
    <input type="hidden" name="application_type" value="<?php echo $this->medical_type ;?>" />
   
    
    
    
    <table>
        <tr>
            <td>Payment Payable To</td>
            <td><?php echo $this->application_data->patient_fullname ;?>
                <input type="hidden" name="application_id" value="<?php echo $this->application_data->application_id ;?>" /></td>
        </tr>
        <tr>
            <td>Amount</td>
            <td><?php echo $this->application_data->grant_amount ;?>
                <input type="hidden" name="grant_amount" value="<?php echo $this->application_data->grant_amount ;?>" /></td>
        </tr>
        <tr>
            <td>Illness</td>
            <td><?php echo $this->application_data->illness_nature;?></td>
        </tr>
        
         <tr >
            <td>Receipt Document</td>
            <td ><input type="file" name="receipt_document"  value="" size="50" /></td>
        </tr>
</table>   

</form>
</div>
