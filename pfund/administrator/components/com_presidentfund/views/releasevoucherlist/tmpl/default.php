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
$numrows = count($this->releasevoucher_list);
$approval_status= PFundHelper::getApprovalStatusType();
?>

<form action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="voucher" />
    <input type="hidden" name="boxchecked" value="0" />

 <table class="adminlist">
   	<thead>
		<tr>
			<th width="40">
				<?php echo '#'; ?>
			</th>
			<th width="40">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php //echo$numrows; ?>);" />
                        </th>
                       <th class="title" nowrap="nowrap">Voucher Number</th>
			<th class="title" nowrap="nowrap">Ledger Activity</th>
                        <th class="title" nowrap="nowrap">Ledger Item Type</th>
                        <th class="title" nowrap="nowrap">Amount</th>
                        <th class="title" nowrap="nowrap">Payable To</th>
                        <th class="title" nowrap="nowrap">reference No</th>
                        <th class="title" nowrap="nowrap">Prepared By</th>
                        <th class="title" nowrap="nowrap">Date</th>
                        <th class="title" nowrap="nowrap">Status</th>
                       
		</tr>
	</thead>
        <tfoot>
            <tr>
                <td colspan="11"><?php echo $this->pagination->getListFooter(); ?></td>
            </tr>
        </tfoot>
        <tbody>
  
        <?php
		 $k = 0;
            
            for($x = 0; $x < $numrows; $x++)
            {
                $row = $this->releasevoucher_list[$x];
               
                $checked = JHtml::_('grid.id', $x, $row->id);
                
		?>
    	<tr class="<?php echo 'row'.$k; ?>">
			<td align="center">
				<?php echo $this->pagination->getRowOffset($x); ?>
			</td>
			<td align="center">
				<?php echo $checked; ?>
			</td>
                        <td>
                            <?php echo  $row->number; ?>
			</td>
                        <td>
				<?php  echo  $row->ledger_activity; ?>
			</td>
                        <td>
				<?php  echo  $row->ledger_typeid; ?>
			</td>
                        <td>
				<?php  echo  $row->amount; ?>
			</td>
                        <td>
				<?php  echo  $row->name; ?>
			</td>
                        <td>
				<?php  echo  $row->refno; ?>
			</td>
                        <td>
				<?php  echo  $row->prepare; ?>
			</td>
                        <td>
				<?php  echo  $row->date; ?>
			</td>
                       <td> 
				<?php  echo  $approval_status[$row->status]; ?>
			</td>
                       
		</tr>
    <?php
	         $k = 1 - $k;
			}
	?>
                
                
                </tbody>
</table>   
    

</form>

