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
$interest_type = PFundHelper::getInterestType('Select a Interest Type');
$interest_period_type = PFundHelper::getInterestPeriodType('Select a Interest Period Type');
JHTML::_('behavior.modal');
JHTML::_('behavior.mootools');
JHTML::_('behavior.tooltip');

if($this->loan_list->id == 0)
    echo '<h1>New Loan Details</h1>';
else
    echo '<h1>Edit Loan Details</h1>';

?>
<div class="comp-button">
    <button type="button" name="apply_btn" class="apply_btn">Apply</button>
    <button type="button" name="save_btn" class="save_btn">Save</button>
    <button type="button" name="cancel_btn" class="cancel_btn">Back</button>
</div>
<div class="comp-content">
<form class="submit-form" action="index.php" method="post" name="adminForm" >
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value=""id="task" />
    <input type="hidden" name="controller" value="openbalanceloan" />
    <input type="hidden" name="id" value="<?php echo $this->loan_list->id; ?>" />
     
    <table  >
        
        <tr>
        <td >From</td>
        <td><?php echo PFundHelper::createList('al_whom', (int)$this->loan_list->al_whom, $this->creditor_list); ?></td>
        </tr>
        <tr>
        <td >Interest Type</td>
        <td ><?php echo PFundHelper::createList('al_type', (int)$this->loan_list->al_type, $interest_type); ?></td>
        </tr>
        <tr>
        <td >Scheme Type</td>
        <td ><?php echo PFundHelper::createList('al_scheme', (int)$this->loan_list->al_scheme, $interest_period_type); ?></td>
        </tr>
        <tr>
        <td >Rate</td>
        <td ><input type="Text"   name="al_rate" value="<?php echo $this->loan_list->al_rate; ?>" /></td>
        </tr>
        <tr>
        <td >Balance Amount</td>
        <td><input type="Text"  name="al_balance" value="<?php echo $this->loan_list->al_balance; ?>" /></td>
        </tr>
        <tr>
        <tr>
        <td >Granted Amount</td>
        <td><input type="Text" maxlength="8"  name="al_amount" value="<?php echo $this->loan_list->al_amount; ?>" /></td>
        </tr>
        <td >Granted Date</td>
        <td><?php echo JHtml::calendar($this->loan_list->al_start, 'al_start', 'al_start'); ?></td>
        </tr>
        <tr>
        <td >Due Date</td>
        <td><?php echo JHtml::calendar($this->loan_list->al_due, 'al_due', 'al_due'); ?></td>
        </tr>
        <tr>
        <td valign="top">Remarks</td>
        <td><textarea name="al_remark" cols="40" rows="5"><?php echo $this->loan_list->al_remark; ?></textarea></td>
        </tr>
       
     </table>
     </form>
</div>