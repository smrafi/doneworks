<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */


//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
$type= PFundHelper::getAccountType('Select a type');
$ledgertype= PFundHelper::getLedgerType('Select a type');
$numrows = count($this->ledger_list);
?>

<form action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="ledgeritem" />
    <input type="hidden" name="boxchecked" value="0" />
    
    
<table class="adminlist">
   	<thead>
		<tr>
			<th width="40">
				<?php echo '#'; ?>
			</th>
                        <th width="40">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo $numrows; ?>);" />
                        </th>
			
                        <th class="title" nowrap="nowrap"><?php echo JText::_('JPUBLISHED'); ?></th>
                        
			<th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Ledger Item' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Main Type' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Account Type' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Bank Name' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Account Number' ); ?>
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
                $row = $this->ledger_list[$x];
                $link = JRoute::_(COMPONENT_LINK.'&controller=ledgeritem&task=edit&cid[]='.$row->id);
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
                      <?php  echo JHtml::link($link, $row->ledger_item); ?>
		</td>
                <td>
                     <?php echo $ledgertype[$row->ledger_type]; ?>
		</td>
                <td>
                     <?php echo $type[$row->account_type]; ?>
		</td>
                <td>
                      <?php echo $row->bank_name; ?>
		</td>
                <td>
                      <?php echo $row->acc_number; ?>
		</td>
               
        </tr>
    <?php
	         $k = 1 - $k;
	    }
    ?>
    </tbody>
</table>
</form>
