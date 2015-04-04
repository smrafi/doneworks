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

if($this->openbalancereceivable_list->id == 0)
    echo '<h1>New Receivable Details</h1>';
else
    echo '<h1>Edit Receivable Details</h1>';

?>
<div class="comp-button">
    
    <button type="button" name="apply_btn" class="apply_btn">Apply</button>
    <button type="button" name="save_btn" class="save_btn">Save</button>
    <button type="button" name="cancel_btn" class="cancel_btn">Back</button>
</div>
<div class="comp-content">
<form  action="index.php" method="post" name="adminForm" class="submit-form" enctype="multipart/form-data">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" id="task" />
    <input type="hidden" name="controller" value="openbalancereceivable" />
    <input type="hidden" name="id" value="<?php echo $this->openbalancereceivable_list->id; ?>" />

    <table  >
        
        <tr>
        <td >From Whom</td>
        <td><input type="Text"  name="rec_from" value="<?php echo $this->openbalancereceivable_list->rec_from; ?>" /></td>
        </tr>
        <tr>
        <td >Amount</td>
        <td><input type="Text"  name="rec_amount" value="<?php echo $this->openbalancereceivable_list->rec_amount; ?>" /></td>
        </tr>
        <tr>
        <td >Date</td>
        <td><?php echo JHtml::calendar($this->openbalancereceivable_list->rec_date, 'rec_date', 'rec_date'); ?></td>
        </tr>
        <tr>
        <td valign="top">Remarks</td>
        <td><textarea name="rec_remark" cols="40" rows="5"><?php echo $this->openbalancereceivable_list->rec_remark; ?></textarea></td>
        </tr>
     </table>
     
</form>
</div>
