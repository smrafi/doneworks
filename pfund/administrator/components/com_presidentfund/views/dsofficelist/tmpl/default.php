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
$numrows = count($this->dsoffice_data);
$district = PFundHelper::getAllDistrict('Districts');
?>

<form action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="dsoffice" />
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
                        <th class="title" nowrap="nowrap"><?php echo JText::_('JPUBLISHED'); ?></th>
			<th class="title" nowrap="nowrap">
				<?php echo "Divisional Secretariat Office Name"; ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo "District"; ?>
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
                $row = $this->dsoffice_data[$x];
                $link = JRoute::_(COMPONENT_LINK.'&controller=dsoffice&task=edit&cid[]='.$row->id);
                $checked = JHtml::_('grid.id', $x, $row->id);
                $published = JHtml::_('grid.published', $row, $x);
		?>
    	<tr class="<?php echo 'row'.$k; ?>">
			<td align="center">
				<?php echo $this->pagination->getRowOffset($x); ?>
			</td>
			<td align="center">
				<?php echo $checked; ?>
			</td>
                <td align="center">
                    <?php echo $published; ?>
                </td>
			<td>
                            <?php echo JHtml::link($link, $row->ds_office); ?>
			</td>
                        <td>
				<?php  echo  $district[$row->district]; ?>
			</td>
		</tr>
    <?php
	         $k = 1 - $k;
			}
	?>
                </tbody>
</table>   
    

</form>

