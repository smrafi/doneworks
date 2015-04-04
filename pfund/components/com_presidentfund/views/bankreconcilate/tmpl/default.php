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

JHTML::_('behavior.modal');
JHTML::_('behavior.mootools');
JHTML::_('behavior.tooltip');
$numrow_credit = count($this->credit_data);
$numrow_debit = count($this->debit_data);

?>


<h1>Bank Reconciliation</h1>
<div class="comp-button">
    <button type="button" name="can_btn" onclick="routeback('bankreconcilate','linkback')">Back</button>
</div>
<div class="comp-content">
<form  action="index.php" method="post" name="adminForm" class="submit-form">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" id="task" />
    <input type="hidden" name="controller" value="bankreconcilate" />
    <input type="hidden" name="boxchecked" value="0" />
    <div align="right"></div>
    
    <table  class="acctable">
        <tr>
            <td width="10%">Date From:</td>
            <td ><?php echo JHtml::calendar('', 'date_from', 'date_from',$format = '%Y-%m'); ?></td>
            <td width="10%">To :</td>
            <td><?php echo JHtml::calendar('', 'date_to', 'date_to',$format = '%Y-%m'); ?></td>
       </tr>
       <tr>
            <td colspan="4"></td>
        </tr>
        <tr>
            <td colspan="4"></td>
        </tr>
    </table>
        <table  class="printvoucher_table">
            
       <tr>
        <th class="title" nowrap="nowrap">Checks & Payments</th>
        <th class="title" nowrap="nowrap">Deposits And Other Credits</th>
      </tr>
      <tr>
          <td width="50%">
              <table  >
                   <thead>
                      <tr>
                        <th width="5%">
                            <?php echo JText::_( '#' ); ?></th>
                        <th class="title" nowrap="nowrap">
                                <?php echo JText::_( 'Date' ); ?>
                        </th>
                        <th class="title" nowrap="nowrap">
                                <?php echo JText::_( 'Cheque' ); ?>
                        </th>
                        <th class="title" nowrap="nowrap">
                                <?php echo JText::_( 'Person' ); ?>
                        </th>
                        <th class="title" nowrap="nowrap">
                                <?php echo JText::_( 'Amount' ); ?>
                        </th>
                      </tr>
                   </thead>
      <tbody>
          <?php
		 $k_debit = 0;
             
            for($x_debit = 0; $x_debit < $numrow_debit; $x_debit++)
            {
                $row_debit = $this->debit_data[$x_debit];
                if($row_debit->status==COMMON_STATUS_RECOMMEND){
		?>
    	<tr  bgcolor="#3399FF"  class="<?php echo 'row'.$k_debit; ?>">
			<td ></td>
			<td>
				<?php echo $row_debit->date; ?>
			</td>
			<td>
                                <?php echo $row_debit->date; ?>
			</td>
                        <td>
				<?php  echo  $row_debit->number; ?>
			</td>
                        <td>
				<?php  echo $row_debit->amount; ?>
			</td>
		</tr>
    <?php
    }
     else{
            
                
		?>
    	<tr class="<?php echo 'row'.$k_debit; ?>">
			<td >
				 <a href="<?php echo COMPONENT_LINK.'&controller=bankreconcilate&task=statusupdate&cid='.$row_debit->id; ?>">
                        <img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/tick_button.png' ?>" />
                    </a>
			</td>
			<td>
				<?php echo $row_debit->date; ?>
			</td>
			<td>
                                <?php echo $row_debit->date; ?>
			</td>
                        <td>
				<?php  echo  $row_debit->number; ?>
			</td>
                        <td>
				<?php  echo $row_debit->amount; ?>
			</td>
		</tr>
    <?php
    }
	         $k_debit = 1 - $k_debit;
			}
	?>
      </tbody>
            </table></td>
    <td width="50%"><table  >
      <thead>
      <tr>
        <th width="5%">
            <?php echo JText::_( '#' ); ?></th>
        <th class="title" nowrap="nowrap">
                <?php echo JText::_( 'Date' ); ?>
        </th>
        <th class="title" nowrap="nowrap">
                <?php echo JText::_( 'Cheque' ); ?>
        </th>
        <th class="title" nowrap="nowrap">
                <?php echo JText::_( 'Person' ); ?>
        </th>
        <th class="title" nowrap="nowrap">
                <?php echo JText::_( 'Type' ); ?>
        </th>
        <th class="title" nowrap="nowrap">
                <?php echo JText::_( 'Amount' ); ?>
        </th>
      </tr>
      </thead>
      <tbody>
          <?php
		 $k = 0;
            for($x = 0; $x < $numrow_credit; $x++)
                    {
                        $row = $this->credit_data[$x];
                        
                        if($row->status==COMMON_STATUS_RECOMMEND){
                        ?>
                <tr  bgcolor="#3399FF" class="<?php echo 'row'.$k; ?>">
                                <td ></td>

                                <td>
                                        <?php echo $row->date; ?>
                                </td>
                                <td>
                                        <?php echo $row->chq_no; ?>
                                </td>
                                <td>
                                        <?php  echo  $row->name; ?>
                                </td>
                                <td>
                                        <?php  //echo  $row->name; ?>
                                </td>
                                <td>
                                        <?php  echo $row->amount; ?>
                                </td>

                        </tr>
    <?php
                        }
      else{
                        ?>
                <tr   class="<?php echo 'row'.$k; ?>">
                                <td >
                                    <a href="<?php echo COMPONENT_LINK.'&controller=bankreconcilate&task=statusupdate&cid='.$row_debit->id; ?>">
                        <img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/tick_button.png' ?>" />
                    </a>
                                    
                                </td>

                                <td>
                                        <?php echo $row->date; ?>
                                </td>
                                <td>
                                        <?php echo $row->chq_no; ?>
                                </td>
                                <td>
                                        <?php  echo  $row->name; ?>
                                </td>
                                <td>
                                        <?php  //echo  $row->name; ?>
                                </td>
                                <td>
                                        <?php  echo $row->amount; ?>
                                </td>

                        </tr>
    <?php
                        }
                    
	         $k = 1 - $k;
			}
	?>
      </tbody>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</div>

	