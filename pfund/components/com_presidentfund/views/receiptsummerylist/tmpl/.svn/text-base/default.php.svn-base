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
$numrows = count($this->receipt_summery);
$ledger_type = PFundHelper::getLedgerType('Select a type');
$income_type = PFundHelper::getTransactionType('Select a type');
$banks =$this->bank_array;
?>
<h1>Receipt Summery</h1>
<div class="comp-button">
    <button type="button" name="cancel_btn" class="cancel_btn">Back</button>
</div>
<div class="comp-content">
<form action="index.php" method="post" name="adminForm" class="submit-form">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="recpts" id="task"  />
    <input type="hidden" name="controller" value="accountview" />
    <table  class="acctable">
        <tr>
            <td width="45%" >Date From:<?php echo JHtml::calendar('', 'date_from', 'date_from',$format = '%Y-%m-%d'); ?></td>
            <td width="45%" >To :<?php echo JHtml::calendar('', 'date_to', 'date_to',$format = '%Y-%m-%d'); ?></td>
            <td width="10%"><button type="submit" name="search_btn" id="serach_btn">Search</button></td>
       </tr>
       <tr>
            <td colspan="4"></td>
        </tr>
        <tr>
            <td colspan="4"></td>
        </tr>
    </table>
    <table class="adminlist">
   	<thead>
		<tr>
                        <th width="5%">
				<?php echo JText::_( 'Reciept No' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Date' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Name' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Type' ); ?>
			</th>
			 <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Method' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Bank' ); ?>
			</th>
                        
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Cheque' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Balance' ); ?>
			</th>
		</tr>
	</thead>
        <tfoot>
            <tr>
                <td colspan="8"><?php echo $this->pagination->getListFooter(); ?></td>
            </tr>
        </tfoot>
        <tbody>
             <?php
		 $k = 0;
            for($x = 0; $x < $numrows; $x++)
            {
                $row = $this->receipt_summery[$x];
		?>
    	<tr class="<?php echo 'row'.$k; ?>">
		 <td>
                     <?php echo $row->id; ?>
		</td>
                 <td>
                      <?php echo $row->date; ?>
		</td>
                <td>
                      <?php echo $row->name; ?>	
		</td>
                <td>
                      <?php echo $ledger_type[$row->ledgertype]; ?>
		</td>
                 <td>
                      <?php echo $income_type[$row->income_type];?>
		</td>
               
		
                <td>
                      <?php echo $row->chequeno; ?>
		</td>
                <td>
                      <?php echo $banks[$row->bank_id];  ?>
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
        </tbody>
    </table>
    
</form>
</div>