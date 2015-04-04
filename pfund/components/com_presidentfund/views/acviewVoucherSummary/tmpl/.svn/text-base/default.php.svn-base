<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   24 jan 2012
 * ***************************************************************************** */
defined('_JEXEC') or die('Restricted access');
$numrows = count($this->voucher_summary);
$ledger_activity = PFundHelper::getLedgerType();


?>
<h1>Voucher Summary</h1>
<div class="comp-button">
    <button type="button" name="cancel_btn" class="cancel_btn">Back</button>
</div>
<div class="comp-content">
<form action="index.php" method="post" name="adminForm" class="submit-form">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="voucher" id="task" />
    <input type="hidden" name="controller" value="accountview" />
    <input type="hidden" name="boxchecked" value="0" />
    
    <table  class="acctable">
        <tr>
            <td width="45%" >Date From:<?php echo JHtml::calendar('', 'date_from', 'date_from',$format = '%Y-%m-%d'); ?></td>
            <td width="45%" >To :<?php echo JHtml::calendar('', 'date_to', 'date_to',$format = '%Y-%m-%d'); ?></td>
            <td width="10%"><button type="submit" name="search_btn" id="serach_btn">Search</button></td>
       </tr>
       <tr>
            <td colspan="4"></td>
        </tr>
        <tr>
            <td colspan="4"></td>
        </tr>
    </table>
    <table class="adminlist">
   	<thead>
                
		<tr>    
                       <th width="12%">
				<?php echo JText::_( 'Voucher No' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Date' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Person' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Type' ); ?>
			</th>
                        
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Sub Ledger' ); ?>
			</th>
                        
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Balance' ); ?>
			</th>
		</tr>
	</thead>
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
                $row = $this->voucher_summary[$x];
                $acc_type = $row->ledger_activity;
                $link = JRoute::_(COMPONENT_LINK.'&controller=dsoffice&task=edit&cid='.$row->id);
                $checked = JHtml::_('grid.id', $x, $row->id);
		?>
    	<tr class="<?php echo 'row'.$k; ?>">
			<td>
				<?php  echo  $row->number; ?>
			</td>
                        <td>
                                <?php echo $row->date; ?>
			</td>
                        <td>
				<?php  echo  $row->name; ?>
			</td>
			<td>
				<?php  if($row->ledger_activity !=0){ echo $ledger_activity[$row->ledger_activity];} ?>
			</td>
			
                        <td>
				<?php echo $row->subledger;  ?>
			</td>
                        
                        <td>
				<?php echo $row->amount;  ?>
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