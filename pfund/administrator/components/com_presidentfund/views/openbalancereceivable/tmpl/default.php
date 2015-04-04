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
    <input type="hidden" name="controller" value="openbalancerecievable" />
    <input type="hidden" name="id" value="<?php echo $this->openbalancerecievable_list->id; ?>" />

    <table class="adminlist" >
        
        <tr>
        <td >From Whom</td>
        <td><?php echo PFundHelper::createList('rec_from', (int)$this->openbalancerecievable_list->rec_from, $this->debtor_list); ?></td>
        </tr>
        <tr>
        <td >Amount</td>
        <td><input type="Text"  name="rec_amount" value="<?php echo $this->openbalancerecievable_list->rec_amount; ?>" /></td>
        </tr>
        <tr>
        <td >Date</td>
        <td><?php echo JHtml::calendar($this->openbalancerecievable_list->rec_date, 'rec_date', 'rec_date'); ?></td>
        </tr>
        <tr>
        <td valign="top">Remarks</td>
        <td><textarea name="rec_remark" cols="40" rows="5"><?php echo $this->openbalancerecievable_list->rec_remark; ?></textarea></td>
        </tr>
       
        
        
     </table>
     
</form>

