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
$transaction_type = PFundHelper::getTransactionType();
$ledger_type= PFundHelper::getLedgerType('Select a type');
JHTML::_('behavior.modal');
JHTML::_('behavior.mootools');
JHTML::_('behavior.tooltip');
$type_bank_display = 'display: none';
if($this->income_list->income_type == TRANSACTION_TYPE_CHEQUE)
{
    $type_bank_display = '';
}

if($this->income_list->id == 0)
    echo '<h1>New Receipt</h1>';
else
    echo '<h1>Edit Receipt</h1>';

?>
<div class="comp-button">
    <button type="button" name="bk_btn" class="_btn" onclick="routeback('income','mahapola');">Mahapola</button>
    <button type="button" name="save_btn" class="save_btn">Save</button>
    <button type="button" name="cancel_btn" class="cancel_btn">Back</button>
</div>
<div class="comp-content">
<form  action="index.php" method="post" name="adminForm" class="submit-form"  enctype="multipart/form-data">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" id="task"/>
    <input type="hidden" name="controller" value="income" />
    <input type="hidden" name="id" value="<?php echo $this->income_list->id; ?>" />

  <table  >
        
      <tr>
        <td  width="10%">Type</td>
        <td><?php echo PFundHelper::createList('income_type', (int)$this->income_list->income_type, $transaction_type); ?></td>
        </tr>  
        <tr   >
            <td>Ledger</td>
            <td ><?php echo PFundHelper::createList('ledger_typeid', (int)$this->income_list->ledger_typeid, $this->ledger_array); ?></td>
        </tr> 
        <tr  class="list-type-bank" style="<?php echo $type_bank_display; ?>">
            <td>Bank</td>
            <td><?php echo PFundHelper::createList('bank_id', (int)$this->income_list->bank_id, $this->bank_array); ?></td>
        </tr> 
        <tr  class="list-type-bank" style="<?php echo $type_bank_display; ?>">
            <td>Cheque Number</td>
            <td><input type="Text"  name="chequeno" value="<?php echo $this->income_list->chequeno; ?>" /></td>
        </tr> 
        <tr  class="list-type-bank" style="<?php echo $type_bank_display; ?>">
            <td>Cheque Date</td>
            <td><?php echo JHtml::calendar($this->income_list->chequedate, 'chequedate', 'chequedate'); ?></td>
        </tr> 
        
        <tr  class="reciept_item_lottery" style="display: none">
            <td>Un Claimed  Amount</td>
            <td><input type="Text"  name="lotteryunclaim_amount" value="<?php echo $this->income_list->lotteryunclaim_amount; ?>" /></td>
        </tr >
        <tr  class="reciept_item_reciept_item_lottery" style="display: none">   
            <td>Upload Related Document</td>
            <td><input type="file" name="in_documentletter"  value="" size="50" />
            <?php 
            if($this->income_list->in_document != '')
            {

            ?>
           <a class="modal"  rel="{handler: 'iframe', size: {x: 800, y: 450}}" href=<?php echo JURI::root().'components/com_presidentfund/files/letters/income/'.$this->income_list->in_document;  ?> ><?php echo $this->income_list->in_document; ?></a>

            <?php
            }

            ?>
            </td>
        </tr>
        <tr>
        <td >Amount</td>
        <td ><input type="Text"  name="amount" value="<?php echo $this->income_list->amount; ?>" /></td>
        </tr>
        <tr>
            <td >Date</td>
            <td ><?php echo JHtml::calendar($this->income_list->date, 'date', 'date'); ?></td>
        </tr>
        <tr>
            <td >From</td>
            <td> <input name="qu_cusname" type="text" id="qu_cusname" size="35" value=""  onkeyup="ajax_showOptions(this,'getColourByLetters21',event)"><?php echo PFundHelper::createList('contact_id', (int)$this->income_list->contact_id, $this->person_list); ?> 
        
        <a class="modal"  rel="{handler: 'iframe', size: {x: 800, y: 450}}" href="index.php?option=com_presidentfund&controller=newpopupContact&task=addnew&tmpl=component&action=view" >Add New</a>
        
       </td>
          </tr>

        
      
       
        
     </table>
     
</form>
</div>
