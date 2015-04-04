<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   19 Dec 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
$numrows = count($this->dsoffice_data);
$district = PFundHelper::getAllDistrict('Districts');
?>
<h1>DS Office List</h1>
<div class="comp-button">
    <button type="button" name="new_btn" class="new_btn">New</button>
    <button type="button" name="delete_btn" class="delete_btn">Delete</button>
    <button type="button" name="new_btn" onclick="routeback('dsoffice', 'linkback');">Back</button>
</div>
<div class="comp-content">
<form class="submit-form" action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" id="task"/>
    <input type="hidden" name="controller" value="dsoffice" />
    <input type="hidden" name="boxchecked" value="0" />
 <table class="adminlist">
   	<thead>
		<tr>
			<th width="5%">
				<?php echo '#'; ?>
			</th>
			<th width="5%">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo$numrows; ?>);" />
                        </th>
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
                $link = JRoute::_(COMPONENT_LINK.'&controller=dsoffice&task=edit&cid='.$row->id);
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
</div>
