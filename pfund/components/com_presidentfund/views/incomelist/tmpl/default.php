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
$numrows = count($this->income_list);
$num_deposit= count($this->deposited_list);
$num_uploaded= count($this->uploaded_list);

$ledger_type= PFundHelper::getLedgerType('Select a type');
$transaction_type = PFundHelper::getTransactionType();
JHTML::_('behavior.modal');
JHTML::_('behavior.mootools');
JHTML::_('behavior.tooltip');


//keep session alive while editing
JHTML::_('behavior.keepalive');

$tabid = JRequest::getVar('tabid',0);
$tabs= &JPane::getInstance('Tabs', array('startOffset'=>$tabid));
?>
<h1>Receipt List</h1>
<div class="comp-button">
    <div class="comp-button" style="float: left"><button type="button" name="deposit_btn" class="deposit_btn" >Deposit To Bank</button></div>
    <button type="button" name="new_btn" class="new_btn">New</button>
    <button type="button" name="delete_btn" class="delete_btn">Delete</button>
    <div class="comp-button" style="float: right"><button type="button" name="back_btn" class="back_btn" >Back</button></div>
</div>
<div class="comp-content">
<form class="submit-form" action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" id="task"/>
    <input type="hidden" name="controller" value="income" />
    <input type="hidden" name="boxchecked" value="0" />
    
     <?php echo $tabs->startPane('content-pane'); ?>
     <?php echo $tabs->startPanel(JText::_('Un Deposited List'),"undeposited-receipt"); ?>
    
    
    
    
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
				<?php echo JText::_( 'Person' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Receipt Method' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Receipt Amount' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Activity' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Receipt Date' ); ?>
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
                $row = $this->income_list[$x];
                $link = JRoute::_(COMPONENT_LINK.'&controller=income&task=edit&cid='.$row->id);
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
                     
                      <?php echo $transaction_type[$row->income_type]; ?>
		</td>
                <td>
                      <?php echo $row->amount ; ?>
		</td>
                <td>
                      <?php echo $ledger_type[$row->ledgertype] ; ?>
		</td>
                <td>
                      <?php echo $row->date ?>
		</td>
        </tr>

    <?php
	         $k = 1 - $k;
	    }
    ?>
    </tbody>
</table>
    
   <?php echo $tabs->endPanel(); ?>
   <?php echo $tabs->startPanel(JText::_('Deposited List'),"deposited-receipt"); ?>
   <table class="adminlist">
   	<thead>
		<tr>
			<th width="5%">
				<?php echo '#'; ?>
			</th>
			
			<th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Person' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Receipt Method' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Receipt Amount' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Activity' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Receipt Date' ); ?>
			</th>
                        <th class="title" nowrap="nowrap"></th>
                        
		</tr>
	</thead>
        <tfoot>
            <tr>
                <td colspan="9"><?php echo $this->pagination->getListFooter(); ?></td>
            </tr>
        </tfoot>
        <tbody>
    
        <?php
		 $k_deposit = 0;
            
            for($x_deposit = 0; $x_deposit < $num_deposit; $x_deposit++)
            {
                $row_deposit = $this->deposited_list[$x_deposit];
                $link_deposit = JRoute::_(COMPONENT_LINK.'&controller=income&task=edit&cid='.$row_deposit->id);
                $checked_deposit = JHtml::_('grid.id', $x_deposit, $row_deposit->id);
		?>
    	        <tr class="<?php echo 'row'.$k_deposit; ?>">
		<td align="center">
		      <?php echo $this->pagination->getRowOffset($x_deposit); ?>
		</td>
		
		<td>
                      <?php echo  $row_deposit->name; ?>
		</td>
                <td>
                     
                      <?php echo $transaction_type[$row_deposit->income_type]; ?>
		</td>
                <td>
                      <?php echo $row_deposit->amount ; ?>
		</td>
                <td>
                      <?php echo $ledger_type[$row_deposit->ledgertype] ; ?>
		</td>
                <td>
                      <?php echo $row_deposit->date ?>
		</td>
                <td>

                    <?php 
                     if($row_deposit->income_type==TRANSACTION_TYPE_CASH_DEPOSIT_BANK ||$row_deposit->income_type==TRANSACTION_TYPE_CHEQUE_DEPOSIT_BANK||$row_deposit->income_type==TRANSACTION_TYPE_ONLINE_BANK_DEPOSIT)
                        {
                         $sptask="uploadreceipt";
                         $btn_name="Upload Receipt";
                        }
                        else{
                            $sptask="uploadslip";
                            $btn_name="Upload Slip";
                            

                     }
                     
                       ?>
                    <a   href="<?php echo COMPONENT_LINK.'&controller=income&task='.$sptask.'&cid='.$row_deposit->id;?>" >
                       <button type="button" name="upload_btn"  ><?php echo $btn_name;?> </button></a>
                </td>
        </tr>

    <?php
	         $k_deposit = 1 - $k_deposit;
	    }
    ?>
    </tbody>
</table>
    <?php echo $tabs->endPanel(); ?>
    <?php echo $tabs->startPanel(JText::_('Slip Uploaded'),"Slip-Uploaded"); ?>
   <table class="adminlist">
   	<thead>
		<tr>
			<th width="5%">
				<?php echo '#'; ?>
			</th>
			
			<th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Person' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Receipt Method' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Receipt Amount' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Activity' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Receipt Date' ); ?>
			</th>
                        <th class="title" nowrap="nowrap"></th>
                        
		</tr>
	</thead>
        <tfoot>
            <tr>
                <td colspan="9"><?php echo $this->pagination->getListFooter(); ?></td>
            </tr>
        </tfoot>
        <tbody>
    
        <?php
		 $k_uploaded = 0;
            
            for($x_uploaded = 0; $x_uploaded < $num_uploaded; $x_uploaded++)
            {
                $row_uploaded = $this->uploaded_list[$x_uploaded];
                $link_uploaded = JRoute::_(COMPONENT_LINK.'&controller=income&task=edit&cid='.$row_uploaded->id);
                $checked_uploaded = JHtml::_('grid.id', $x_uploaded, $row_uploaded->id);
		?>
    	        <tr class="<?php echo 'row'.$k_uploaded; ?>">
		<td align="center">
		      <?php echo $this->pagination->getRowOffset($x_uploaded); ?>
		</td>
		
		<td>
                      <?php echo  $row_uploaded->name; ?>
		</td>
                <td>
                     
                      <?php echo $transaction_type[$row_uploaded->income_type]; ?>
		</td>
                <td>
                      <?php echo $row_uploaded->amount ; ?>
		</td>
                <td>
                      <?php echo $ledger_type[$row_uploaded->ledgertype] ; ?>
		</td>
                <td>
                      <?php echo $row_uploaded->date ?>
		</td>
                <td>
                    
                </td>
        </tr>

    <?php
	         $k_uploaded = 1 - $k_uploaded;
	    }
    ?>
    </tbody>
</table>
    <?php echo $tabs->endPanel(); ?>
    <?php echo $tabs->endPane(); ?>
    
</form>
</div>