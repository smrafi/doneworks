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
$numrows = count($this->loan_list);
$interesttype = PFundHelper::getInterestType('Select A Interest Type');
$interestperiod = PFundHelper::getInterestPeriodType('Select A Period Type');
JHTML::_('behavior.modal');
JHTML::_('behavior.mootools');
JHTML::_('behavior.tooltip');
?>
<h1>Loan List</h1>
<div class="comp-button">
    
    <button type="button" name="new_btn" class="new_btn">New</button>
    <button type="button" name="delete_btn" class="delete_btn">Delete</button>
    <button type="button" name="back_btn" class="back_btn" >Back</button>
</div>
<div class="comp-content">
<form class="submit-form" action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" id="task"/>
    <input type="hidden" name="controller" value="openbalanceloan" />
    <input type="hidden" name="boxchecked" value="0" />
 <table class="adminlist">
   	<thead>
		<tr>
<!--			<th width="5%">
				<?php //echo '#'; ?>
			</th>-->
			<th width="5%">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php //echo$numrows; ?>);" />
                        </th>
                        <th class="title" nowrap="nowrap">Debtor</th>
			<th class="title" nowrap="nowrap">Interest Type</th>
                        <th class="title" nowrap="nowrap">Scheme</th>
                        <th class="title" nowrap="nowrap">Rate</th>
                        <th class="title" nowrap="nowrap">Balance Amount</th>
                        <th class="title" nowrap="nowrap">Due Date</th>
                        
                        
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
                $row = $this->loan_list[$x];
                $link = JRoute::_(COMPONENT_LINK.'&controller=openbalanceloan&task=edit&cid='.$row->id);
                $checked = JHtml::_('grid.id', $x, $row->id);
                
		?>
    	<tr class="<?php echo 'row'.$k; ?>">
<!--			<td align="center">
				<?php //echo $this->pagination->getRowOffset($x); ?>
			</td>-->
			<td align="center">
				<?php echo $checked; ?>
			</td>
                        <td>
                            <?php echo JHtml::link($link, $row->name); ?>
			</td>
                        <td>
				<?php  echo  $interesttype[$row->al_type]; ?>
			</td>
                        <td>
				<?php  echo  $interestperiod[$row->al_scheme]; ?>
			</td>
                        <td>
				<?php  echo  $row->al_rate; ?>
			</td>
                        <td>
				<?php  echo  $row->al_balance; ?>
			</td>
                        <td>
				<?php  echo  $row->al_due; ?>
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
