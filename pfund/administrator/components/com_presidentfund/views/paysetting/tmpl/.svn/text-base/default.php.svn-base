<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Asfaran
 * Developer Email  :   asfaransl@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   13/12/2011
 * ***************************************************************************** */
defined( '_JEXEC' ) or die( 'Restricted access' );

?>

<form  action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="paysetting" />
    <input type="hidden" name="id" value="<?php echo $this->paysetting_list->id ; ?>" />
     
    <table  class="adminlist"  >
        
        <tr>
        <td width="20%">Income Source</td>
        <td><?php echo PFundHelper::createList('income', (int)$this->paysetting_list->income, $this->ledger_debit_array); ?></td>
        </tr>
        <tr>
        <td >Payable Item</td>
        <td><?php echo PFundHelper::createList('pay_item', (int)$this->paysetting_list->pay_item, $this->ledger_credit_array); ?></td>
        </tr>
        <tr>
        <td >Payable % From Income Source</td>
        <td><input type="Text"  name="pay_per" value="<?php echo $this->paysetting_list->pay_per ; ?>" size="50"/></td>
        </tr>
        <tr>
        
     </table>
     
</form>

