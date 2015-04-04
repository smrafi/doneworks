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

<form action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="loan" />
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
                        <th class="title" nowrap="nowrap">Creditor</th>
			<th class="title" nowrap="nowrap">Interest Type</th>
                        <th class="title" nowrap="nowrap">Interest Period Scheme</th>
                        <th class="title" nowrap="nowrap">Balance Amount</th>
                        <th class="title" nowrap="nowrap">Loan Amount</th>
                        <th class="title" nowrap="nowrap">Due Date</th>
                        <th class="title" nowrap="nowrap">Start Date</th>
                        <th class="title" nowrap="nowrap">Rate(%)</th>
                        <th class="title" nowrap="nowrap">Request Letter</th>
                        <th class="title" nowrap="nowrap">Offer Latter</th>
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
                $link = JRoute::_(COMPONENT_LINK.'&controller=loan&task=edit&cid[]='.$row->id);
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
                            <?php echo JHtml::link($link, $row->name); ?>
			</td>
                        <td>
				<?php  echo  $interesttype[$row->al_type]; ?>
			</td>
                        <td>
				<?php  echo  $interestperiod[$row->al_scheme]; ?>
			</td>
                        <td>
				<?php  echo  $row->al_balance; ?>
			</td>
                        <td>
				<?php  echo  $row->al_amount; ?>
			</td>
                        <td>
				<?php  echo  $row->al_start; ?>
			</td>
                        <td>
				<?php  echo  $row->al_due; ?>
			</td>
                        <td>
				<?php  echo  $row->al_rate; ?>
			</td>
                        <td> 
				<a class="modal"  rel="{handler: 'iframe', size: {x: 800, y: 450}}" href=<?php echo JURI::root().'components/com_presidentfund/files/letters/loan/request/'.$row->al_request;  ?> ><?php echo $row->al_request; ?></a>
			</td>
                        <td>
				<a class="modal"  rel="{handler: 'iframe', size: {x: 800, y: 450}}" href=<?php echo JURI::root().'components/com_presidentfund/files/letters/loan/offer/'.$row->al_offer;  ?> ><?php echo $row->al_offer; ?></a>
			</td>
		</tr>
    <?php
	         $k = 1 - $k;
			}
	?>
                </tbody>
</table>   
    

</form>

