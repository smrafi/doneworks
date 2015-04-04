<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Asfaran
 * Developer Email  :   asfaransl@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */
//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
$numrows = count($this->journalentry_data);
JHTML::_('behavior.modal');
JHTML::_('behavior.mootools');
JHTML::_('behavior.tooltip');
?>
<h1>Journal Entry</h1>
<div class="comp-button">
    <button type="button" name="back_btn" class="back_btn">Back</button>
     <button type="button" name="save_btn" class="save_btn">Save</button>
</div>
<div class="comp-content">
<form action="index.php" method="post" name="adminForm" class="submit-form">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" id="task" />
    <input type="hidden" name="controller" value="journalentry" />    

    
    <table>
            <tr>
                <td>Date</td>
               <td colspan="4"><?php echo JHtml::calendar('', 'je_date', 'date'); ?></td>
            </tr>
            <tr>
                 <td>Description</td>
                 <td colspan="4"><input type="text" name="je_description" value=""/></td>
            </tr>
             <tr>
                <th width="5%"  class="title" nowrap="nowrap">
                                    <?php echo JText::_( 'Journal No' ); ?>
                </th>
                <th  width="45%"  class="title" nowrap="nowrap">
                                    <?php echo JText::_( 'Ledger' ); ?>
                </th>
                <th  width="20%"  class="title" nowrap="nowrap">
                                    <?php echo JText::_( 'Remarks' ); ?>
                </th>
                <th width="15%"  class="title" nowrap="nowrap">
                                    <?php echo JText::_( 'Credit Amount' ); ?>
                </th>
                <th width="15%"  class="title" nowrap="nowrap">
                                    <?php echo JText::_( 'Debit Amount' ); ?>
                </th>


            </tr>
       </table>
     <div >
       <table  id="journal-table" class="journaltable">
       
        <tr >
            
             <td width="5%"><input type="text" name="" value="" /></td>
             <td width="45%"><?php  echo PFundHelper::createList('journal_data[ledger_typeid][]','', $this->ledgeritemtype_list ); ?></td>
              <td width="20%"><input type="text" name="journal_data[je_remarks][]" value=""  /></td>
             <td width="15%"><input type="text" maxlength="7"  name="journal_data[je_c_amount][]" class="journal_c_data"  value=""  /></td>
             <td width="15%"><input type="text" maxlength="7"   name="journal_data[je_d_amount][]" class="journal_d_data"  value=""  /></td>
            
        </tr>
    </table>
          <table>
            
             <tr>
                <td width="50%"  colspan="2" >
                               <b><?php echo JText::_( 'Total Amount' ); ?> </b>    
               
                                    
                </td>
                <td  width="20%"  >
                                    
                </td>
                <td width="15%" id="credit_sum"  align="center">
                                    
                </td>
                <td width="15%" id="debit_sum" align="center">
                                    
                </td>


            </tr>
       </table>
    </div>
    
      
    
    </form>
    <div id="journal-result"> </div>
    <div class="appendlink journal-append">
        <a href="javascript:void(0);">+ Add Another Record</a>
     </div>
    </div>
    
    
    