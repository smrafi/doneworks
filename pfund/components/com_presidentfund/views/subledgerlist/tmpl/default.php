<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */
defined('_JEXEC') or die('Restricted access');
$numrows = count($this->subledger_list);
$ledger_type= PFundHelper::getLedgerType('Select a type');
?>
<h1>Sub Ledger</h1>
<div class="comp-button">
    <button type="button" name="cancel_btn" onclick="routeback('ledger','backop')">Back</button>
</div>
<div class="comp-content">
<form action="index.php" method="post" name="adminForm" class="submit-form">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="subledger" id="task" />
    <input type="hidden" name="controller" value="ledger" />
    <input type="hidden" name="boxchecked" value="0" />
    
    <table class="adminlist">
   	<thead>
		<tr>
                         <th width="15%" >
				<?php echo JText::_( 'Reference No' ); ?>
			</th>
			<th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Date' ); ?>
			</th>
                        
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Description' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Cheque No' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Amount' ); ?>
			</th>
                        
		</tr>
	</thead>
        <tfoot>
            <tr>
                <td colspan="7"><?php echo $this->pagination->getListFooter(); ?></td>
            </tr>
            
        </tfoot>
        <tbody>
             <?php
		 $k = 0;
            
            for($x = 0; $x < $numrows; $x++)
            {
                $row = $this->subledger_list[$x];
		?>
    	<tr class="<?php echo 'row'.$k; ?>">
		<td align="center">
		     <?php  if($row->voucher_id !=0){echo $row->voucher_id;}else{echo $row->reciept_id;} ?>
		</td>
                <td>
                      <?php echo $row->date; ?>
		</td>
		
               <td>
                      <?php echo  $row->ledger_name ; ?>
		</td>
                <td>
                      <?php echo $row->chequenumber; ?>
		</td>
                <td>
                      <?php echo $row->amount; ?>
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