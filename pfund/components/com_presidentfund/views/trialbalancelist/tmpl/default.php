<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   02 feb 2012
 * ***************************************************************************** */
defined('_JEXEC') or die('Restricted access');
$date_from = JRequest::getVar('date_from');
$date_to = JRequest::getVar('date_to');
$numrows = count($this->trial_data);
$ledger_type = PFundHelper::getEveryLedgerType();
?>
<h1>Trial Balance 
<?php if($date_from !=''||$date_to !=''){ echo "For Date ".$date_from." To ".$date_to; } ?>
</h1>
<div class="comp-button">
    <button type="button" name="cancel_btn" class="cancel_btn">Back</button>
</div>
<div class="comp-content">
<form action="index.php" method="post" name="adminForm" class="submit-form">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" id="task" />
    <input type="hidden" name="controller" value="accountreport" />
    <input type="hidden" name="boxchecked" value="0" />
    <table  class="acctable">
        <tr>
            <td width="45%" >Date From:<?php echo JHtml::calendar('', 'date_from', 'date_from',$format = '%Y-%m'); ?></td>
            <td width="45%" >To :<?php echo JHtml::calendar('', 'date_to', 'date_to',$format = '%Y-%m'); ?></td>
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
                        
                        <th class="title" nowrap="nowrap" width="70%">
				<?php echo JText::_( 'Discription' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Debit' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Credit' ); ?>
			</th>
		</tr>
	</thead>
        <tfoot>
            
        </tfoot>
        <tbody>
             <?php
           
            for($x = 0; $x < $numrows; $x++)
            {
                $row = $this->trial_data[$x];
                $acc_type = $row->account_type;
	?>
    	<tr class="row0">
            	
            <td>
                    <?php   if($row->main_ledger !=0){ echo $ledger_type[$row->main_ledger]."-";}  echo $row->ledger_item; ?>
            </td>
            <td>
                    <?php 
                    if($acc_type == ACCOUNT_TYPE_DEBIT)
                                        echo $row->amount;
                    ?>
            </td>
            <td>
                    <?php if($acc_type == ACCOUNT_TYPE_CREDIT)
                                        echo $row->amount;
                    ?>
            </td>
            
	</tr>
        <?php
	}
	?>
        </tbody>
    </table>
    
</form>
</div>