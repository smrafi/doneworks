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
$numrows = count($this->releasevoucher_list);


$district_name= PFundHelper::getAllDistrict('Select a type');
$transaction_type = PFundHelper::getTransactionType();

$transaction_type = PFundHelper::getTransactionType();
$search_by = array(0 => 'Select', 
                     SEARCH_BY_HOSPITAL => 'Hospital',
                     SEARCH_BY_PHARMACEUTICAL => 'Pharmaceuticals',
                     SEARCH_BY_APPLICATION_TYPE => 'Application Type',
                     SEARCH_BY_ILLNESS => 'Illness');
$search_num = JRequest::getInt('search_by');
$search_word = JRequest::getVar('search_word');
?>

    <div class="comp-button" >
        <div class="comp-button" style="float: left"><button  name="sv_btn" class="sv_btn" onclick="routeback('medicalpayment','savereimburs');">Save</button></div>
        <button type="button" name="bk_btn" class="_btn" onclick="routeback('medicalpayment','reimbursment_medical');">Back</button>
    </div>
   

<div class="comp-content">
<form action="index.php" method="post" name="adminForm" class="submit-form"  enctype="multipart/form-data">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" id="task" value="" />
    <input type="hidden" name="controller" value="medicalpayment" />
    <input type="hidden" name="boxchecked" value="0" />
    
    <input type="hidden" name="application_type" value="<?php echo $this->type;?>" />
    
    <table  >
        <tr>
            <td  rowspan="2"><h5>Select A Type</h5></td>
             <td align="left" >Generate Slip<input type="radio" name="print_type"  value="0" id="print_type_slip" /></td>
         </tr>
         <tr>
             <td align="left" >Print Cheque<input type="radio" name="print_type"   value="1" id="print_type_cheque" /></td>
         </tr>
         <tr class="print_type_cheque" style="display:none;" >
            <td >Bank</td>
            <td>
                <?php echo PFundHelper::createList('bank_id','',$this->bank_array); ?>
            </td>
        </tr>
        <tr class="print_type_cheque" style="display:none;" >
            <td>Account Number</td>
            <td id="account_list">
                 <?php  echo PFundHelper::createList('bankaccount_id','', $this->account_nums); ?>
            </td>
        </tr>
        <tr class="print_type_cheque" style="display:none;">
            <td>Cheque Number</td>
            <td><input type="text" name="chequenumber" value=""  /></td>
        </tr>
            
     </table>   
    
<table class="adminlist">
    
   	<thead>
		<tr>
			<th width="5%" >
				<?php echo '#'; ?>
			</th>
			<th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Full Name' ); ?>
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
                $row = $this->releasevoucher_list[$x];
               
                
		?>
    	<tr class="<?php echo 'row'.$k; ?>">
		<td align="center">
                    <input type="hidden" value="<?php  echo  $row->application_id; ?>" name="cid[]" />
		      <?php echo $this->pagination->getRowOffset($x); ?>
		</td>
		
		<td>
                      <?php echo $row->applicant_fullname; ?>
		</td>
                <td>
                     
                      <?php echo $district_name[$row->patient_district]; ?>
		</td>
                 <td>
                      <?php echo $row->disease_id; ?>
		</td>
                <td>
                      <?php echo $row->hospital_id ; ?>
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
</form>
</div>
