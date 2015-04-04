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
$numrows = count($this->paysetting_list);

?>

<form  action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="paysetting" />
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
                        <th class="title" nowrap="nowrap">InCome Source</th>
                        <th class="title" nowrap="nowrap">Payable Item</th>
			<th class="title" nowrap="nowrap">Payable Percentage</th>
                        
                        
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
                $row = $this->paysetting_list[$x];
                $link = JRoute::_(COMPONENT_LINK.'&controller=paysetting&task=edit&cid[]='.$row->id);
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
                            <?php echo JHtml::link($link, $row->income_source); ?>
			</td>
                        <td>
                            <?php echo $row->payable_item; ?>
			</td>
                        <td>
                            <?php echo $row->pay_per; ?>%
			</td>
                        
		</tr>
    <?php
	         $k = 1 - $k;
			}
	?>
                <tr><td colspan="7"></td></tr>
               
         </tbody>
</table>
    
</form>
