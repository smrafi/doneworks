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
$ledger_type = PFundHelper::getLedgerType();
JHTML::_('behavior.modal');
JHTML::_('behavior.mootools');
JHTML::_('behavior.tooltip');

?>
<h1>Upload Receipt</h1>
<div class="comp-button">
    <button type="button" name="bk_btn" class="_btn" onclick="routeback('income','saveslip');">Save</button>
    <button type="button" name="cancel_btn" class="cancel_btn">back</button>
</div>
<div class="comp-content">
<form action="index.php" method="post" name="adminForm" class="submit-form"  enctype="multipart/form-data">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" id="task" value="" />
    <input type="hidden" name="controller" value="income" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="id" value="<?php echo $this->slip_uploaded_list->id ; ?>" />
    <input type="hidden" name="account_type" value="2" />
    
    <table>
        
        <tr>
            <td>From</td>
            <td><?php echo $this->slip_uploaded_list->name ;?>
                <input type="hidden" name="contact_id" value="<?php echo $this->slip_uploaded_list->contact_id;?>" /></td>
        </tr>
        <tr>
            <td>Amount</td>
            <td><?php echo $this->slip_uploaded_list->amount ;?>
                <input type="hidden" name="cheque_amount" value="<?php echo $this->slip_uploaded_list->amount;?>" /></td>
        </tr>
        <tr>
            <td>Reason</td>
            <td><?php echo $ledger_type[$this->slip_uploaded_list->ledgertype]; ?></td>
        </tr>
        
        <tr>
        <td >Upload Request Letter</td>
        <td ><input type="file" name="documentletter"  value="" size="50" /></td>
        </tr>
        
    </table>
    
</form>
</div>
