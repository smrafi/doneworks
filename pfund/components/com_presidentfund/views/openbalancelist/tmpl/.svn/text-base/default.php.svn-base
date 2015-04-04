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

?>
<h1>Open Balance Detail View</h1>
<div class="comp-button">
    <button type="button" name="save_btn" class="save_btn">Save</button>
    <button type="button" name="back_btn" class="back_btn" >Back</button>
</div>
<div class="comp-content">
<form class="submit-form" action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" id="task" />
    <input type="hidden" name="controller" value="openbalance" />
    <input type="hidden" name="id" value="<?php echo $this->openbalance_list->id ; ?>" />
      <table  >
        
        <tr>
            <td>Date</td>
            <td><?php echo JHtml::calendar($this->openbalance_list->ob_date, 'ob_date', 'ob_date'); ?></td>
        </tr>   
        <tr>
            <td >Banks</td>
            <td ><input type="text" name="ob_bank"   value="<?php echo $this->result->bankbalance ; ?>" /></td>
            <td ><a href="<?php echo COMPONENT_LINK.'&controller=bankbalance' ?>">Detail View</a></td>
        </tr>
        <tr>
            <td >Receivable</td>
            <td ><input type="text" name="ob_receivable"   value="<?php echo $this->result->receivablebalance ; ?>" /></td>
            <td width="20%"><a href="<?php echo COMPONENT_LINK.'&controller=openbalancereceivable' ?>">Detail View</a></td>
        </tr>
        <tr>
        <td >Payable</td>
        <td ><input type="text" name="ob_payable"  value="<?php echo $this->result->payablebalance ; ?>" /></td>
        <td><a href="<?php echo COMPONENT_LINK.'&controller=openbalancepayable' ?>">Detail View</a></td>
        </tr>
        <tr>
        <td >Loan</td>
        <td ><input type="text" name="ob_loan"  value="<?php echo $this->result->loanbalance ; ?>" /></td>
        <td><a href="<?php echo COMPONENT_LINK.'&controller=openbalanceloan' ?>">Detail View</a></td>
        </tr>
        <tr>
        <td >Fixed Deposits</td>
        <td ><input type="text" name="ob_fd"  value="<?php echo $this->result->fdbalance ; ?>" /></td>
        <td><a href="<?php echo COMPONENT_LINK.'&controller=openbalancefd' ?>">Detail View</a></td>
        </tr>
        <tr>
        <td >Accumulated Fund</td>
        <td colspan="2"><input type="text" name="ob_accumulate"  value="<?php echo $this->openbalance_list->ob_accumulate ; ?>" /></td>
        
        </tr>
      </table>
</form>
</div>