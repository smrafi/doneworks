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

JHTML::_('behavior.modal');
JHTML::_('behavior.mootools');
JHTML::_('behavior.tooltip');

$numrows = count($this->voucher_list);
$numrows_rec = count($this->receipt_uploaded_list);
$numrows_released = count($this->voucher_released_list);


//keep session alive while editing
JHTML::_('behavior.keepalive');

$tabid = JRequest::getVar('tabid',0);
$tabs= &JPane::getInstance('Tabs', array('startOffset'=>$tabid));
?>
<h1>Voucher List</h1>
<div class="comp-button" >
    <div class="comp-button" style="float: left"><button type="button" name="medical_voucher_btn" class="medical_voucher_btn" >Medical voucher</button></div>
    <div class="comp-button"  style="float: left"><button type="button" name="release_btn" class="release_btn" >Release voucher</button></div>
    <div class="comp-button" style="float:right;"><button type="button" name="back_btn" class="back_btn" >Back</button></div>
    <button type="button" name="new_btn" class="new_btn">New</button>
</div>
 
<div class="comp-appcontent">
   
<form class="submit-form" action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" id="task"/>
    <input type="hidden" name="controller" value="voucher" />
    <input type="hidden" name="boxchecked" value="0" />
    
     <?php echo $tabs->startPane('content-pane'); ?>
     <?php echo $tabs->startPanel(JText::_('Voucher Requested List'),"voucher-requested"); ?>
    
    <table class="adminlist">
   	<thead>
                <tr>
			<th width="5%">
				<?php echo '#'; ?>
			</th>
                        <th width="5%">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo$numrows; ?>);" />
                        </th>
                        <th class="title" nowrap="nowrap">Number</th>
                        <th class="title" nowrap="nowrap">Amount</th>
                        <th class="title" nowrap="nowrap">Payable To</th>
                        <th class="title" nowrap="nowrap">Prepared By</th>
                        <th class="title" nowrap="nowrap">Date</th>
                          
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
                $row = $this->voucher_list[$x];
                $link = JRoute::_(COMPONENT_LINK.'&controller=voucher&task=edit&cid='.$row->id);
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
                            <?php echo JHtml::link($link, $row->number); ?>
			</td>
                        <td>
				<?php  echo  $row->amount; ?>
			</td>
                        <td>
				<?php  echo  $row->name; ?>
			</td>
                        <td>
				<?php  echo  $row->prepare; ?>
			</td>
                        <td>
				<?php  echo  $row->date; ?>
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
       
 <table class="adminlist">
   	<thead>
		<tr>
			<th width="5%">
				<?php echo '#'; ?>
			</th>
                        <th class="title" nowrap="nowrap">Voucher Number</th>
                        <th class="title" nowrap="nowrap">Amount</th>
                        <th class="title" nowrap="nowrap">Payable To</th>
                        <th class="title" nowrap="nowrap">Prepared By</th>
                        <th class="title" nowrap="nowrap">Date</th>
                        <th class="title" nowrap="nowrap"></th>
                        
                       
		</tr>
	</thead>
        <tfoot>
            <tr>
                <td colspan="12"><?php echo $this->pagination->getListFooter(); ?></td>
            </tr>
        </tfoot>
        <tbody>
  
        <?php
		 $k_released = 0;
            
            for($x = 0; $x < $numrows_released; $x++)
            {
                $row_released = $this->voucher_released_list[$x];
                $link_released = JRoute::_(COMPONENT_LINK.'&controller=voucher&task=edit&cid='.$row_released->id);
                $checked_released = JHtml::_('grid.id', $x, $row_released->id);
                
		?>
    	<tr class="<?php echo 'row'.$k_released; ?>">
			<td align="center">
				<?php echo $this->pagination->getRowOffset($x); ?>
			</td>
                       <td>
                            <?php echo JHtml::link($link_released, $row_released->number); ?>
			</td>
                        
                        <td>
				<?php  echo  $row_released->amount; ?>
			</td>
                        <td>
				<?php  echo  $row_released->name; ?>
			</td>
                        <td>
				<?php  echo  $row_released->prepare; ?>
			</td>
                        <td>
				<?php  echo  $row_released->date; ?>
			</td>
                        <td> 
                            <a   href=<?php echo COMPONENT_LINK.'&controller=voucher&task=uploadreceipt&cid='.$row_released->number;  ?> >
                       <button type="button" name="upload_btn"  >Upload Receipt</button></a>
                        </td>
                        
		</tr>
    <?php
	         $k_released = 1 - $k_released;
			}
	?>
                
                
                </tbody>
</table>   
     
       <?php echo $tabs->endPanel(); ?>
    <?php echo $tabs->startPanel(JText::_('Receipt Uploaded'),"uploaded-receipt"); ?>
 <table class="adminlist">
   	<thead>
		<tr>
			<th width="5%">
				<?php echo '#'; ?>
			</th>
                        <th class="title" nowrap="nowrap">Voucher Number</th>
                        <th class="title" nowrap="nowrap">Amount</th>
                        <th class="title" nowrap="nowrap">Payable To</th>
                        <th class="title" nowrap="nowrap">Prepared By</th>
                        <th class="title" nowrap="nowrap">Date</th>
                        <th class="title" nowrap="nowrap">Uploaded Receipt</th>
                       
		</tr>
	</thead>
        <tfoot>
            <tr>
                <td colspan="12"><?php echo $this->pagination->getListFooter(); ?></td>
            </tr>
        </tfoot>
        <tbody>
  
        <?php
		 $k_rec = 0;
            
            for($x = 0; $x < $numrows_rec; $x++)
            {
                $row_rec = $this->receipt_uploaded_list[$x];
                $link_rec = JRoute::_(COMPONENT_LINK.'&controller=voucher&task=edit&cid='.$row_rec->id);
                $checked_rec = JHtml::_('grid.id', $x, $row_rec->id);
                
		?>
    	<tr class="<?php echo 'row'.$k_rec; ?>">
			<td align="center">
				<?php echo $this->pagination->getRowOffset($x); ?>
			</td>
                        <td>
                            <?php echo JHtml::link($link_rec, $row_rec->number); ?>
			</td>
                        <td>
				<?php  echo  $row_rec->amount; ?>
			</td>
                        <td>
				<?php  echo  $row_rec->name; ?>
			</td>
                        <td>
				<?php  echo  $row_rec->prepare; ?>
			</td>
                        <td>
				<?php  echo  $row_rec->date; ?>
			</td>
                        <td> 
                            <a class="modal"  rel="{handler: 'iframe', size: {x: 800, y: 450}}" 
                                       href=<?php echo JURI::root().'components/com_presidentfund/files/letters/voucher/'.$row_rec->document;  ?> ><button type="button" name="upload_btn"  >View</button> </a>
			</td>
                       
		</tr>
    <?php
	         $k_rec = 1 - $k_rec;
			}
	?>
                
                
                </tbody>
</table>   
    <?php echo $tabs->endPanel(); ?>
     <?php echo $tabs->endPane(); ?>
</form>
</div>