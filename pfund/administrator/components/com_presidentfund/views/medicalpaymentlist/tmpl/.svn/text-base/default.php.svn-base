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
$district_name= PFundHelper::getAllDistrict('Select a type');
$transaction_type = PFundHelper::getTransactionType();

?>

<form action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="medicalpayment" />
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
			<th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Patient Full Name' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Patient NIC' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Patient Address' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Patient District' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Illness Nature' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Hospital' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Estimated Amount' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Disease' ); ?>
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
                $link = JRoute::_(COMPONENT_LINK.'&controller=medicalpayment&task=edit&cid[]='.$row->id);
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
                      <?php echo JHtml::link($link, $row->applicant_fullname); ?>
		</td>
                
                <td>
                     
                      <?php echo $row->applicant_nic; ?>
		</td>
                <td>
                     
                      <?php echo $row->applicant_address; ?>
		</td>
                <td>
                     
                      <?php echo $district_name[$row->patient_district]; ?>
		</td>
                <td>
                      <?php echo $row->illness_nature ; ?>
		</td>
                <td>
                      <?php echo $row->hospital_id ; ?>
		</td>
                <td>
                      <?php echo $row->estimated_amount; ?>
		</td>
                 <td>
                      <?php echo $row->disease_id; ?>
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

