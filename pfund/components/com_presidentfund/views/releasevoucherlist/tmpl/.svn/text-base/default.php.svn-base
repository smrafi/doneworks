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
$numrows = count($this->releasevoucher_list);
$approval_status= PFundHelper::getApprovalStatusType();
?>
<h1>Release Voucher</h1>
<div class="comp-button" style="height: 37px;">
    <div class="comp-button" style="float: left"><button type="button" name="acc_ob_btn" class="acc_ob_btn" >Release Voucher</button></div>
    <button type="button" name="cancel_btn" class="cancel_btn" >Back</button>
</div>
<div class="comp-content">
<form action="index.php" method="post" name="adminForm" class="submit-form">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" id="task"/>
    <input type="hidden" name="controller" value="voucher" />
    <input type="hidden" name="boxchecked" value="0" />
    <table>
        <tr>
            <td  rowspan="2"><h5>Select A Type</h5></td>
             <td align="left" >Generate Slip<input type="radio" name="print_type"  value="0" id="print_type_slip" /></td>
         </tr>
         <tr>
             <td align="left">Print Cheque<input type="radio" name="print_type"   value="1" id="print_type_cheque" /></td>
         </tr>
         <tr  class="print_type_cheque" style="display:none;">
            <td>Bank</td>
            <td>
                <?php echo PFundHelper::createList('bank_id','',$this->bank_array); ?>
            </td>
        </tr>
        <tr class="print_type_cheque" style="display:none;">
            <td>Account Number</td>
            <td id="account_list">
                 <?php  echo PFundHelper::createList('bankaccount_id','', $this->account_nums); ?>
            </td>
            <td id="bankaccount_detail_dev" ></td>
        </tr>
        <tr class="print_type_cheque"  style="display:none;">
            <td>Cheque Number</td>
            <td><input type="text" name="chequenumber" value=""  /></td>
        </tr>
            
     </table>   
 <table class="adminlist">
   	<thead>
		<tr>
			<th width="5%">
				<?php echo '#'; ?>
			</th>
			
                        <th class="title" nowrap="nowrap">Number</th>
		        <th class="title" nowrap="nowrap">Ledger</th>
                        <th class="title" nowrap="nowrap">Amount</th>
                        <th class="title" nowrap="nowrap">Payable To</th>
                        <th class="title" nowrap="nowrap">Reference No</th>
                        <th class="title" nowrap="nowrap">Prepared By</th>
                       
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
                $row = $this->releasevoucher_list[$x];
               
                $checked = JHtml::_('grid.id', $x, $row->id);
                
		?>
    	<tr class="<?php echo 'row'.$k; ?>">
			<td align="center">
				<?php echo $this->pagination->getRowOffset($x); ?>
                        </td>
                        <td>
                            <?php echo  $row->number; ?>
                            <input type="hidden" value="<?php  echo  $row->number; ?>" name="cid[]"/>
			</td>
                        <td>
				<?php  echo  $row->ledger_typeid; ?>
			</td>
                        <td>
				<?php  echo  $row->amount; ?>
			</td>
                        <td>
				<?php  echo  $row->name; ?>
			</td>
                        <td>
				<?php  echo  $row->refno; ?>
			</td>
                        <td>
				<?php  echo  $row->prepare; ?>
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
