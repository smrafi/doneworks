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
$numrows = count($this->deposit_voucher_list);
$ledger_type= PFundHelper::getLedgerType('Select a type');
$transaction_type = PFundHelper::getTransactionType();
$persons=$this->person_list;
?>
<h1>Detail View Of Receipts</h1>
<div class="comp-button">
    <button type="button" name="save_deposit_btn" class="save_deposit_btn">Save</button>
    <button type="button" name="cancel_btn" class="cancel_btn">Back</button>
    
</div>
<div class="comp-content">
<form class="submit-form" action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task"  id="task" value="" />
    <input type="hidden" name="controller" value="income" />
    <input type="hidden" name="boxchecked" value="0" />
<table >
        <tr>
            <td>Bank</td>
            <td colspan="8">
                <?php echo PFundHelper::createList('bank_id','',$this->bank_array); ?>
            </td>
        </tr>
        <tr>
            <td>Account Number</td>
            <td id="account_list" colspan="8">
                 <?php  echo PFundHelper::createList('bankaccount_id','', $this->account_nums); ?>
            </td>
        </tr>
        <tr>
             <td>Date</td>
             <td colspan="8"><?php echo JHtml::calendar('', 'date', 'date'); ?></td>
        </tr>
        <tr><td colspan="9"></td></tr>
        <tr><td colspan="9"></td></tr>
        <tr>
			
			
			<th class="title" nowrap="nowrap">
                                 <u><?php echo JText::_( 'Person' ); ?></u>
			</th>
                        <th class="title" nowrap="nowrap">
				<u><?php echo JText::_( 'Receipt Method' ); ?></u>
			</th>
                        <th class="title" nowrap="nowrap">
				<u><?php echo JText::_( 'Receipt Amount' ); ?></u>
			</th>
                        <th class="title" nowrap="nowrap">
				<u><?php echo JText::_( 'Activity' ); ?></u>
			</th>
                        <th class="title" nowrap="nowrap">
				<u><?php echo JText::_( 'Receipt Date' ); ?></u>
			</th>
                        
		</tr>
	
        <tfoot>
            <tr>
                <td colspan="9"><?php echo $this->pagination->getListFooter(); ?></td>
            </tr>
        </tfoot>
        <tbody>
    
        <?php
		 $k = 0;
            
            for($x = 0; $x < $numrows; $x++)
            {
                $row = $this->deposit_voucher_list[$x];
                $link = JRoute::_(COMPONENT_LINK.'&controller=income&task=edit&cid[]='.$row->id);
                $checked = JHtml::_('grid.id', $x, $row->id);
		?>
    	<tr class="<?php echo 'row'.$k; ?>">
		
		
		<td>
                      <input type="hidden" name="cid[]" value="<?php echo $row->id ;?>"  />
                      <?php echo $persons[$row->contact_id]; ?>
		</td>
                <td>
                     
                      <?php echo $transaction_type[$row->income_type]; ?>
		</td>
                <td>
                      <?php echo $row->amount ; ?>
		</td>
                <td>
                      <?php echo $ledger_type[$row->ledger_activity] ; ?>
		</td>
                <td>
                      <?php echo $row->date ?>
		</td>
        </tr>

    <?php
	         $k = 1 - $k;
	    }
    ?>
    </tbody>
</table>
</form>

</div>