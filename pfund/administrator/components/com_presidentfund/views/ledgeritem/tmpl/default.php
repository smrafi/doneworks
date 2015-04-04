<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
$type= PFundHelper::getAccountType('Select a type');
$income_type= PFundHelper::getLedgerIncomeType('Select a type');
$expense_type= PFundHelper::getLedgerExpenseType('Select a type'); 

$income_display = 'display: none';
$expense_display = 'display: none';
$income_diabled = $expense_disabled = 'disabled = "disabled"';

if($this->ledgeritem_data->account_type == ACCOUNT_TYPE_DEBIT)
{
    $expense_display = '';
    $expense_disabled = '';
}
if($this->ledgeritem_data->account_type == ACCOUNT_TYPE_CREDIT)
{
    $income_display = '';
    $income_diabled = '';
}

?>

<form  action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="ledgeritem" />
    <input type="hidden" name="id" value="<?php echo $this->ledgeritem_data->id; ?>" />
   
     
    <table id="ledgertable">
         
        <tr>
            <td>Account Type</td>
            <td>
               <?php echo PFundHelper::createList('account_type',(int)$this->ledgeritem_data->account_type,$type); ?>
            
            </td>
        </tr>

        <tr>
            <td>Type</td>
            <td class="type-list" id="list-type-<?php echo ACCOUNT_TYPE_CREDIT; ?>" style="<?php echo $income_display; ?>">
               <?php echo PFundHelper::createList('ledger_type',(int)$this->ledgeritem_data->ledger_type,$income_type,0, '', $income_diabled); ?>
            </td>
            <td class="type-list" id="list-type-<?php echo ACCOUNT_TYPE_DEBIT; ?>" style="<?php echo $expense_display; ?>">
               <?php echo PFundHelper::createList('ledger_type',(int)$this->ledgeritem_data->ledger_type,$expense_type, 0, '', $expense_disabled); ?>
            </td>
        </tr>
        <tr>
            <td width="30%">Ledger Item Name</td>
            <td><input type="text" name="ledger_item" value="<?php echo $this->ledgeritem_data->ledger_item ; ?>" size="50"/></td>
        </tr>
        <tr>
            <td>Bank</td>
            <td>
                <?php echo PFundHelper::createList('bank_id',(int)$this->ledgeritem_data->bank_id,$this->bank_array); ?>
            </td>
        </tr>
        <tr>
            <td>Account Number</td>
            <td id="account_list">
                 <?php  echo PFundHelper::createList('bankaccount_id', (int)$this->ledgeritem_data->bankaccount_id, $this->account_nums); ?>
            </td>
        </tr>
    </table>

</form>