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



$numrows = count($this->medical_payment_list);
$numreleased = count($this->voucher_released_list);
$numreceipt = count($this->receipt_uploaded_list);



$district_name= PFundHelper::getAllDistrict('Select a type');
$transaction_type = PFundHelper::getTransactionType();
$search_by = array(0 => 'Select', 
                     SEARCH_BY_HOSPITAL => 'Hospital',
                     SEARCH_BY_PHARMACEUTICAL => 'Pharmaceuticals'
                   );
$search_num = JRequest::getInt('search_by');
$search_word = JRequest::getVar('search_word');



JHTML::_('behavior.modal');
JHTML::_('behavior.mootools');
JHTML::_('behavior.tooltip');


//keep session alive while editing
JHTML::_('behavior.keepalive');

$tabid = JRequest::getVar('tabid',0);
$tabs= &JPane::getInstance('Tabs', array('startOffset'=>$tabid));
?>
<h1>Other Medical Payment List</h1>
<div class="comp-button">
    <div class="comp-button" style="float: left"><button type="button" name="medical_voucher_btn" class="medical_voucher_btn" >Release voucher</button></div>
    <div class="comp-button" ><button type="button" name="back_btn" class="back_btn" >Back</button></div>

</div>

<div class="comp-content">
<form action="index.php" method="post" name="adminForm" class="submit-form"  enctype="multipart/form-data">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" id="task"  value="" />
    <input type="hidden" name="controller" value="medicalpayment" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="type" value="<?php echo APPLICATION_TYPE_NORMAL ;?>" />
    
    <?php echo $tabs->startPane('content-pane'); ?>
     <?php echo $tabs->startPanel(JText::_('Payment Accepted Patients'),"payment_accepted"); ?>
    
    
    
            <div class="search-input">
             <span>List by: </span>
            <?php echo PFundHelper::createList('search_by', $search_num, $search_by); ?>
            <input type="text" name="search_word" id="search_word" value="<?php echo $search_word; ?>" />
            <button type="submit" name="search_btn" id="serach_btn">Search</button>
            </div>
    
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
				<?php echo JText::_( 'Full Name' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'NIC' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'District' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Disease' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Hospital' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Estimate' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Grant Amount' ); ?>
			</th>
                        
		</tr>
	</thead>
        <tfoot>
            <tr>
                <td colspan="11"><?php echo $this->pagination->getListFooter(); ?></td>
            </tr>
        </tfoot>
        <tbody>
    
        <?php
		 $k = 0;
            
            for($x = 0; $x < $numrows; $x++)
            {
                $row = $this->medical_payment_list[$x];
                $link = JRoute::_(COMPONENT_LINK.'&controller=medicalpayment&task=edit&cid[]='.$row->application_id);
                $checked = JHtml::_('grid.id', $x, $row->application_id);
		?>
    	<tr class="<?php echo 'row'.$k; ?>">
		<td align="center">
		      <?php echo $this->pagination->getRowOffset($x); ?>
		</td>
		<td align="center">
		      <?php echo $checked; ?>
		</td>
		<td>
                      <?php echo $row->patient_fullname; ?>
		</td>
                
                <td>
                     
                      <?php echo $row->patient_nic; ?>
		</td>
                <td>
                     
                      <?php echo $district_name[$row->patient_district]; ?>
		</td>
                 <td>
                      <?php echo $row->disease_name; ?>
		</td>
                <td>
                      <?php echo $row->hos_name ; ?>
		</td>
                <td>
                      <?php echo $row->estimated_amount; ?>
		</td>
                <td>
                      <?php echo $row->grant_amount; ?>
		</td>
               
        </tr>

    <?php
	         $k = 1 - $k;
	    }
    ?>
    </tbody>
     </table>
    
    
   <?php echo $tabs->endPanel(); ?>
   <?php echo $tabs->startPanel(JText::_('Voucher Released List'),"released-voucher"); ?>
    
            <div class="search-input">
            <span>Search: </span>
            <input type="text" name="search_word" id="search_word" value="<?php echo $search_word; ?>" />
            <button type="submit" name="search_btn" id="serach_btn">Search</button>
            </div>
    
            <table class="adminlist">
   	    <thead>
		<tr>
			<th width="5%">
				<?php echo '#'; ?>
			</th>
			<th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Full Name' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'NIC' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'District' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Disease' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Hospital' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				
			</th>
                        
		</tr>
	</thead>
        <tfoot>
            <tr>
                <td colspan="11"><?php echo $this->pagination->getListFooter(); ?></td>
            </tr>
        </tfoot>
        <tbody>
    
        <?php
		 $k_released = 0;
            
            for($x_released = 0; $x_released < $numreleased; $x_released++)
            {
                $row_released = $this->voucher_released_list[$x_released];
                $link_released = JRoute::_(COMPONENT_LINK.'&controller=medicalpayment&task=edit&cid[]='.$row_released->application_id);
                $checked_released = JHtml::_('grid.id', $x_released, $row_released->application_id);
		?>
    	<tr class="<?php echo 'row'.$k_released; ?>">
		<td align="center">
		      <?php echo $this->pagination->getRowOffset($x_released); ?>
		</td>
		<td>
                      <?php echo $row_released->patient_fullname; ?>
		</td>
                
                <td>
                     
                      <?php echo $row_released->patient_nic; ?>
		</td>
                <td>
                     
                      <?php echo $district_name[$row_released->patient_district]; ?>
		</td>
                 <td>
                      <?php echo $row_released->disease_name; ?>
		</td>
                <td>
                      <?php echo $row_released->hos_name ; ?>
		</td>
                 <td>
                     <a href=<?php echo COMPONENT_LINK.'&controller=medicalpayment&task=uploadreceipt&cid='.$row_released->application_id.'&type='.APPLICATION_TYPE_NORMAL; ?>><button type="button" name="upload_btn"  >Upload Receipt</button></a>
		</td>
               
        </tr>

    <?php
	         $k_released= 1 - $k_released;
	    }
    ?>
    </tbody>
    </table>


<?php echo $tabs->endPanel(); ?>
<?php echo $tabs->startPanel(JText::_('Receipt Uploaded List'),"Receipt-Uploaded"); ?>
    
            
            <table class="adminlist">
   	    <thead>
		<tr>
			<th width="5%">
				<?php echo '#'; ?>
			</th>
			<th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Full Name' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'NIC' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'District' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Disease' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Hospital' ); ?>
			</th>
                       
                        
		</tr>
	</thead>
        <tfoot>
            <tr>
                <td colspan="11"><?php echo $this->pagination->getListFooter(); ?></td>
            </tr>
        </tfoot>
        <tbody>
    
        <?php
		 $k_receipt = 0;
            
            for($x_receipt = 0; $x_receipt < $numreceipt; $x_receipt++)
            {
                $row_receipt = $this->receipt_uploaded_list[$x_receipt];
                $link_receipt = JRoute::_(COMPONENT_LINK.'&controller=medicalpayment&task=edit&cid[]='.$row_receipt->application_id);
                $checked_receipt = JHtml::_('grid.id', $x_receipt, $row_receipt>application_id);
		?>
    	<tr class="<?php echo 'row'.$k_receipt; ?>">
		<td align="center">
		      <?php echo $this->pagination->getRowOffset($x_receipt); ?>
		</td>
		<td>
                      <?php echo $row_receipt->patient_fullname; ?>
		</td>
                
                <td>
                     
                      <?php echo $row_receipt->patient_nic; ?>
		</td>
                <td>
                     
                      <?php echo $district_name[$row_receipt->patient_district]; ?>
		</td>
                 <td>
                      <?php echo $row_receipt->disease_name; ?>
		</td>
                <td>
                      <?php echo $row_receipt->hos_name ; ?>
		</td>
                 
               
        </tr>

    <?php
	         $k_receipt= 1 - $k_receipt;
	    }
    ?>
    </tbody>
    </table>


<?php echo $tabs->endPanel(); ?>
 <?php echo $tabs->endPane(); ?>
</form>
</div>
