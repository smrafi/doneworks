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
$numrows = count($this->openbalancepayable_list);
JHTML::_('behavior.modal');
JHTML::_('behavior.mootools');
JHTML::_('behavior.tooltip');
?>

<form action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="openbalancepayable" />
    <input type="hidden" name="boxchecked" value="0" />
    
    <table class="adminlist">
   	<thead>
		<tr>
			<th width="40">
				<?php echo '#'; ?>
			</th>
			<th width="40">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo$numrows; ?>);" />
                        </th>
                        <th class="title" nowrap="nowrap">Debtor</th>
			<th class="title" nowrap="nowrap">Payable On</th>
                        <th class="title" nowrap="nowrap">Amount</th>
                        <th class="title" nowrap="nowrap">Payable Type</th>
                        <th class="title" nowrap="nowrap">Remarks</th>
                </tr>
	</thead>
        <tfoot>
            <tr>
                <td colspan="12"><?php echo $this->pagination->getListFooter(); ?></td>
            </tr>
        </tfoot>
        <tbody>
  
        <?php
		 $k = 0;
            
            for($x = 0; $x < $numrows; $x++)
            {
                $row = $this->openbalancepayable_list[$x];
                $link = JRoute::_(COMPONENT_LINK.'&controller=openbalancepayable&task=edit&cid[]='.$row->id);
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
                            <?php echo JHtml::link($link, $row->contact_name); ?>
			</td>
                        <td>
				<?php  echo  $row->pl_date; ?>
			</td>
                        <td>
				<?php  echo  $row->pl_amount; ?>
			</td>
                        <td>
				<?php  echo  $row->ledger_item; ?>
			</td>
                        <td>
				<?php  echo  $row->pl_remark; ?>
			</td>
        </tr>
    <?php
	         $k = 1 - $k;
			}
	?>
                </tbody>
</table>   

</form>