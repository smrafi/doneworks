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
    <input type="hidden" name="controller" value="receivable" />
    <input type="hidden" name="id" value="<?php echo $this->receivable_list->id; ?>" />

    <table class="adminlist" >
        
        <tr>
        <td >From Whom</td>
        <td><?php echo PFundHelper::createList('rec_from', (int)$this->receivable_list->rec_from, $this->debtor_list); ?></td>
        </tr>
        <tr>
        <td >Amount</td>
        <td><input type="Text"  name="rec_amount" value="<?php echo $this->receivable_list->rec_amount; ?>" /></td>
        </tr>
        <tr>
        <td >Given Date</td>
        <td><?php echo JHtml::calendar($this->receivable_list->rec_date, 'rec_date', 'rec_date'); ?></td>
        </tr>
        <tr>
        <td >Receivable %</td>
        <td ><input type="Text"   name="rec_per" value="<?php echo $this->receivable_list->rec_per; ?>" /></td>
        </tr>
        <tr>
        <td >Upload Request Letter</td>
        <td ><input type="file" name="rec_certificationletter"  value="" size="50" />
            <?php 
            if($this->receivable_list->rec_certification != '')
            {

            ?>
           <a class="modal"  rel="{handler: 'iframe', size: {x: 800, y: 450}}" href=<?php echo JURI::root().'components/com_presidentfund/files/letters/receivable/'.$this->receivable_list->rec_certification;  ?> ><?php echo $this->receivable_list->rec_certification; ?></a>

            <?php
            }

            ?>
        </td>
        </tr>
        <tr>
        <td >Due Date</td>
        <td><?php echo JHtml::calendar($this->receivable_list->rec_duedate, 'rec_duedate', 'rec_duedate'); ?></td>
        </tr>
        
        
     </table>
     
</form>

