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
$payable_type = PFundHelper::getBankAccountType('Select a Expensess Type');

JHTML::_('behavior.modal');
JHTML::_('behavior.mootools');
JHTML::_('behavior.tooltip');

?>

<form  action="index.php" method="post" name="adminForm" enctype="multipart/form-data">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="payable" />
    <input type="hidden" name="id" value="<?php echo $this->payable_list->id; ?>" />
     
    <table class="adminlist" >
        
        <tr>
        <td >Payable on</td>
        <td><?php echo JHtml::calendar('2011/10/11', 'al_start', 'pl_date'); ?></td>
        </tr>
        <tr>
        <td >Amount</td>
        <td ><input type="Text"  name="pl_amount" value="<?php echo $this->payable_list->pl_amount; ?>" /></td>
        </tr>
        <tr>
        <td >Payable Type</td>
        <td ><?php echo PFundHelper::createList('pl_type', (int)$this->payable_list->pl_type, $payable_type); ?></td>
        </tr>
        <tr>
        <td >To Whom</td>
        <td><?php echo PFundHelper::createList('pl_whom', (int)$this->payable_list->pl_whom, $this->creditor_list); ?></td>
        </tr>
        
        <tr>
        <td >Upload Related Document</td>
        <td ><input type="file" name="pl_documentletter"  value="" size="50" />
            <?php 
            if($this->payable_list->pl_document != '')
            {

            ?>
           <a class="modal"  rel="{handler: 'iframe', size: {x: 800, y: 450}}" href=<?php echo JURI::root().'components/com_presidentfund/files/letters/payable/'.$this->payable_list->pl_document;  ?> ><?php echo $this->payable_list->pl_document; ?></a>

            <?php
            }

            ?>
        </td>
        </tr>
        
        <tr>
        <td >Description</td>
        <td><input type="Text"  name="pl_desc" value="<?php echo $this->payable_list->pl_desc; ?>" /></td>
        </tr>
        
     </table>
     
</form>
