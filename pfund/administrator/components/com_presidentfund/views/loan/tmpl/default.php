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

?>

<form  action="index.php" method="post" name="adminForm" enctype="multipart/form-data">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="loan" />
    <input type="hidden" name="id" value="<?php echo $this->loan_list->id; ?>" />
     
    <table class="adminlist" >
        
        <tr>
        <td >To Whom</td>
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
        <td >Balance Amount</td>
        <td><input type="Text"  name="al_balance" value="<?php echo $this->loan_list->al_balance; ?>" /></td>
        </tr>
        <tr>
        <tr>
        <td >Loan Amount</td>
        <td><input type="Text"  name="al_amount" value="<?php echo $this->loan_list->al_amount; ?>" /></td>
        </tr>
        <td >Entered Date</td>
        <td><?php echo JHtml::calendar($this->loan_list->al_start, 'al_start', 'al_start'); ?></td>
        </tr>
        <tr>
        <td >Due Date</td>
        <td><?php echo JHtml::calendar($this->loan_list->al_due, 'al_due', 'al_due'); ?></td>
        </tr>
        
        <tr>
        <td >Interest Rate</td>
        <td ><input type="Text"   name="al_rate" value="<?php echo $this->loan_list->al_rate; ?>" /></td>
        </tr>
        <tr>
        <td >Upload Request Letter</td>
        <td ><input type="file" name="al_requestletter"  value="" size="50" />
            <?php 
            if($this->loan_list->al_request != '')
            {

            ?>
           <a class="modal"  rel="{handler: 'iframe', size: {x: 800, y: 450}}" href=<?php echo JURI::root().'components/com_presidentfund/files/letters/loan/request/'.$this->loan_list->al_request;  ?> ><?php echo $this->loan_list->al_request; ?></a>

            <?php
            }

            ?>
        </td>
        </tr>
        <tr>
        <td >Upload Offer Letter</td>
        <td ><input type="file" name="al_offerletter"  value="" size="50" />
         <?php 
            if($this->loan_list->al_request != '')
            {

            ?>
           <a class="modal"  rel="{handler: 'iframe', size: {x: 800, y: 450}}" href=<?php echo JURI::root().'components/com_presidentfund/files/letters/loan/offer/'.$this->loan_list->al_offer;  ?> ><?php echo $this->loan_list->al_offer; ?></a>

            <?php
            }

            ?>
        </td>
        </tr>
     </table>
     
</form>
