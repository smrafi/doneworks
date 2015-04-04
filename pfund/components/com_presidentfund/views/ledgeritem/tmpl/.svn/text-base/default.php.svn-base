<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   19 Dec 2011
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );
$type= PFundHelper::getAccountType('Select a type');
$ledger_type= PFundHelper::getLedgerType('Select a type');

$check_account_type_1 ="";
$check_account_type_2 ="";


if($this->ledgeritem_data->account_type == ACCOUNT_TYPE_DEBIT)
{
    $check_account_type_1="checked='checked'";
}
if($this->ledgeritem_data->account_type == ACCOUNT_TYPE_CREDIT)
{
     $check_account_type_2="checked='checked'";
}


if($this->ledgeritem_data->id == 0)
    echo '<h1>New Ledger Accounts</h1>';
else
    echo '<h1>Edit Ledger Accounts</h1>';
?>
<div class="comp-button">
    <div class="comp-button" style="float: left"><button type="button" name="acc_ob_btn" class="acc_ob_btn" >Opening Balance</button></div>
    <button type="button" name="apply_btn" class="apply_btn">Apply</button>
    <button type="button" name="save_btn" class="save_btn">Save</button>
    <button type="button" name="cancel_btn" class="cancel_btn">Back</button>
</div>
<div class="comp-content">
<form  action="index.php" method="post" name="adminForm" class="submit-form">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" id="task" value="" />
    <input type="hidden" name="controller" value="ledgeritem" />
    <input type="hidden" name="id" value="<?php echo $this->ledgeritem_data->id; ?>" />
   
     
    <table id="ledgertable">
        
        <tr>
            <td>Account Type</td>
            <td><label>Credit<input type="radio" name="account_type" value="<?php echo ACCOUNT_TYPE_CREDIT ;?>" id="account_type_1" <?php echo $check_account_type_1 ; ?> /></label></br>
                
                <label>Debit<input type="radio" name="account_type" value="<?php echo ACCOUNT_TYPE_DEBIT ;?>" id="account_type_2"    <?php echo $check_account_type_2 ; ?>/></label>

            </td>
        </tr>

        <tr>
            <td>Main Ledger</td>
            <td >
               <?php echo PFundHelper::createList('ledger_type',(int)$this->ledgeritem_data->ledger_type,$ledger_type); ?>
            </td>
            
        </tr>
        <tr>
            <td width="30%">Sub Ledger</td>
            <td><input type="text" name="ledger_item" value="<?php echo $this->ledgeritem_data->ledger_item ; ?>" size="50"/></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            
        </tr>
   
<!--        <tr>
            <td>Related Bank</td>
            <td>
                <?php //echo PFundHelper::createList('bank_id',(int)$this->ledgeritem_data->bank_id,$this->bank_array); ?>
            </td>
        </tr>-->
<!--        <tr>
            <td>Account Number</td>
            <td id="account_list">
                 <?php  //echo PFundHelper::createList('bankaccount_id', (int)$this->ledgeritem_data->bankaccount_id, $this->account_nums); ?>
            </td>
        </tr>-->
    </table>
   
</form>
</div>