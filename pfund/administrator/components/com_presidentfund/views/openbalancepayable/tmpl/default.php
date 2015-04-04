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

?>

<form  action="index.php" method="post" name="adminForm" enctype="multipart/form-data">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="openbalancepayable" />
    <input type="hidden" name="id" value="<?php echo $this->openbalancepayable_list->id; ?>" />
     
    <table class="adminlist" >
        
        <tr>
        <td >Payable on</td>
        <td><?php echo JHtml::calendar($this->openbalancepayable_list->pl_date, 'pl_date', 'pl_date'); ?></td>
        </tr>
        <tr>
        <td >Amount</td>
        <td ><input type="Text"  name="pl_amount" value="<?php echo $this->openbalancepayable_list->pl_amount; ?>" /></td>
        </tr>
        <tr>
        <td >Payable Type</td>
        <td ><?php echo PFundHelper::createList('pl_type', (int)$this->openbalancepayable_list->pl_type, $this->ledger_list); ?></td>
        </tr>
        <tr>
        <td >To Whom</td>
        <td><?php echo PFundHelper::createList('pl_whom', (int)$this->openbalancepayable_list->pl_whom, $this->creditor_list); ?></td>
        </tr>
        <tr>
        <td valign="top">Remarks</td>
        <td><textarea name="pl_remark" cols="40" rows="5"><?php echo $this->openbalancepayable_list->pl_remark; ?></textarea></td>
        </tr>                
     </table>
     
</form>
