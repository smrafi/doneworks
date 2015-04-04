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

?>

<form  action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="openbalance" />
    <input type="hidden" name="id" value="<?php echo $this->openbalance_list->id ; ?>" />
		
                        
                        
<table    >
       <tr><td>Date</td>
            <td><?php echo JHtml::calendar($this->openbalance_list->ob_date, 'ob_date', 'ob_date'); ?></td>
        <tr>
        <td >Total Bank Opening Balance</td>
        <td ><input type="text" name="ob_bank"   value="<?php echo $this->openbalance_list->ob_bank ; ?>" /></td>
        <td ><a href="<?php echo COMPONENT_LINK.'&controller=bankbalance' ?>">Detail View</a></td>
        </tr>
        <tr>
            <td >Total Receivable Opening Balance</td>
            <td ><input type="text" name="ob_receivable"   value="<?php echo $this->openbalance_list->ob_receivable ; ?>" /></td>
            <td width="20%"><a href="<?php echo COMPONENT_LINK.'&controller=receivable' ?>">Detail View</a></td>
        </tr>
        <tr>
        <td >Total Payable Opening Balance</td>
        <td ><input type="text" name="ob_payable"  value="<?php echo $this->openbalance_list->ob_payable ; ?>" /></td>
        <td><a href="<?php echo COMPONENT_LINK.'&controller=openbalancepayable' ?>">Detail View</a></td>
        </tr>
        <tr>
        <td >Total Loan Opening Balance</td>
        <td ><input type="text" name="ob_loan"  value="<?php echo $this->openbalance_list->ob_loan ; ?>" /></td>
        <td><a href="<?php echo COMPONENT_LINK.'&controller=openbalanceloan' ?>">Detail View</a></td>
        </tr>
        <tr>
        <td >Total Fixed Deposits Opening Balance</td>
        <td ><input type="text" name="ob_fd"  value="<?php echo $this->openbalance_list->ob_fd ; ?>" /></td>
        <td><a href="<?php echo COMPONENT_LINK.'&controller=openbalancefd' ?>">Detail View</a></td>
        </tr>
        <tr>
        <td >Accumulated Fund</td>
        <td colspan="2"><input type="text" name="ob_accumulate"  value="<?php echo $this->openbalance_list->ob_accumulate ; ?>" /></td>
        
        </tr>
        
        
     </table>
</form>
