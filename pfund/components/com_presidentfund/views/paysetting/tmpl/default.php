<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   19 Dec 2011
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );

if($this->paysetting_list->id == 0)
    echo '<h1>Add New</h1>';
else
    echo '<h1>Edit MHESTF </h1>';

?>
<div class="comp-button">
   <button type="button" name="apply_btn" class="apply_btn">Apply</button>
    <button type="button" name="save_btn" class="save_btn">Save</button>
    <button type="button" name="cancel_btn" class="cancel_btn">Back</button>
</div>
<div class="comp-content">
<form  action="index.php" method="post" name="adminForm" class="submit-form">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" id="task"/>
    <input type="hidden" name="controller" value="paysetting" />
    <input type="hidden" name="id" value="<?php echo $this->paysetting_list->id ; ?>" />
     
    <table   >
        <tr>
        <td width="20%">Received From</td>
        <td><?php echo PFundHelper::createList('income', (int)$this->paysetting_list->income, $this->ledger_debit_array); ?></td>
        </tr>
        <tr>
        <td >Payable To</td>
        <td><?php echo PFundHelper::createList('pay_item', (int)$this->paysetting_list->pay_item, $this->ledger_credit_array); ?></td>
        </tr>
        <tr>
        <td >Payable %</td>
        <td><input type="Text"  name="pay_per" value="<?php echo $this->paysetting_list->pay_per ; ?>" size="50"/></td>
        </tr>
        <tr>
        
     </table>
</form>
</div>
