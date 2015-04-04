<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   23 Dec 2011
 * ***************************************************************************** */


//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
$numrows = count($this->bankbalance_list);
?>
<h1>Bank Balance List</h1>
<div class="comp-button">
    <button type="button" name="new_btn" class="new_btn">New</button>
    <button type="button" name="delete_btn" class="delete_btn">Delete</button>
    <button class="back_btn" name="back_btn" type="button">Back</button>
</div>
<div class="comp-content">
<form class="submit-form" action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" id="task"/>
    <input type="hidden" name="controller" value="bankbalance" />
    <input type="hidden" name="boxchecked" value="0" />
    
    
<table class="adminlist">
   	<thead>
		<tr>
			<th width="5%">
				<?php echo '#'; ?>
			</th>
                        <th width="5%">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo $numrows; ?>);" />
                        </th>
			<th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Bank Name' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Account Name' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Account Number' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Balance Amount' ); ?>
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
                $row = $this->bankbalance_list[$x];
                $link = JRoute::_(COMPONENT_LINK.'&controller=bankbalance&task=edit&cid='.$row->id);
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
                      <?php echo JHtml::link($link, $row->bank_name); ?>
		</td>
                <td>
                      <?php echo $row->acc_name; ?>
		</td>
                <td>
                      <?php echo $row->acc_number; ?>
		</td>
                <td>
                      <?php echo $row->bal_amount; ?>
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