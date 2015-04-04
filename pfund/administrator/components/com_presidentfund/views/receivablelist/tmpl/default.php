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
$numrows = count($this->receivable_list);
JHTML::_('behavior.modal');
JHTML::_('behavior.mootools');
JHTML::_('behavior.tooltip');
?>

<form action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="receivable" />
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
                        <th class="title" nowrap="nowrap">From Whom</th>
			<th class="title" nowrap="nowrap">Amount</th>
                        <th class="title" nowrap="nowrap">Date</th>
                        <th class="title" nowrap="nowrap">Certification</th>
                        <th class="title" nowrap="nowrap">Receivable %</th>
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
                $row = $this->receivable_list[$x];
                $link = JRoute::_(COMPONENT_LINK.'&controller=receivable&task=edit&cid[]='.$row->id);
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
				<?php  echo  $row->rec_amount; ?>
			</td>
                        <td>
				<?php  echo  $row->rec_date; ?>
			</td>
                        <td> 
				<a class="modal"  rel="{handler: 'iframe', size: {x: 800, y: 450}}" href=<?php echo JURI::root().'components/com_presidentfund/files/letters/receivable/'.$row->rec_certification;  ?> ><?php echo $row->rec_certification; ?></a>
			</td>
                        <td>
				<?php  echo  $row->rec_per; ?>
			</td>
                        <td>
				<?php  echo  $row->rec_duedate; ?>
			</td>
                        
		</tr>
    <?php
	         $k = 1 - $k;
			}
	?>
                </tbody>
</table>   
    

</form>

