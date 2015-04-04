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
$expense_type = PFundHelper::getLedgerExpenseType();
JHTML::_('behavior.modal');
JHTML::_('behavior.mootools');
JHTML::_('behavior.tooltip');

//if(empty($this->receipt_uploaded_list->name)){$this->receipt_uploaded_list->name='';}
//if(empty($this->receipt_uploaded_list->document)){$this->receipt_uploaded_list->document='';}
?>
<form action="index.php" method="post" name="adminForm"  enctype="multipart/form-data">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="voucher" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="id" value="<?php echo $this->receipt_uploaded_list->id ; ?>" />
    <input type="hidden" name="number" value="<?php echo $this->receipt_uploaded_list->number ; ?>" />
    <input type="hidden" name="account_type" value="2" />
    
    <table>
        <tr>
            <td>Payment Payable To</td>
            <td><?php echo $this->receipt_uploaded_list->name ;?>
                <input type="hidden" name="contact_id" value="<?php echo $this->receipt_uploaded_list->contact_id;?>" /></td>
        </tr>
        <tr>
            <td>Amount</td>
            <td><?php echo $this->receipt_uploaded_list->amount ;?>
                <input type="hidden" name="cheque_amount" value="<?php echo $this->receipt_uploaded_list->amount;?>" /></td>
        </tr>
        <tr>
            <td>Reason</td>
            <td><?php echo $expense_type[$this->receipt_uploaded_list->ledger_activity] ;?></td>
        </tr>
        <tr>
            <td>Bank</td>
            <td>
                <?php echo PFundHelper::createList('bank_id',(int)$this->receipt_cheque_list->bank_id,$this->bank_array); ?>
            </td>
        </tr>
        <tr>
            <td>Account Number</td>
            <td id="account_list">
                 <?php  echo PFundHelper::createList('bankaccount_id',(int)$this->receipt_cheque_list->bankaccount_id, $this->account_nums); ?>
            </td>
        </tr>
        <tr>
            <td>Cheque Number</td>
            <td><input type="text" name="chequenumber" value="<?php echo $this->receipt_cheque_list->chequenumber;?>"  /></td>
        </tr>
        
        <tr>
        <td >Upload Request Letter</td>
        <td ><input type="file" name="documentletter"  value="" size="50" />
            <?php 
            if($this->receipt_uploaded_list->document != '')
            {

            ?>
           <a class="modal"  rel="{handler: 'iframe', size: {x: 800, y: 450}}" href=<?php echo JURI::root().'components/com_presidentfund/files/letters/voucher/'.$this->receipt_uploaded_list->document;  ?> ><?php echo $this->receipt_uploaded_list->document; ?></a>

            <?php
            }

            ?>
        </td>
        </tr>
        <tr>
            <td>Cheque Date</td>
            <td><?php echo JHtml::calendar($this->receipt_cheque_list->cheque_date, 'cheque_date', 'cheque_date'); ?></td>
        </tr>
    </table>
    
</form>
