<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   24 jan 2012
 * ***************************************************************************** */
defined('_JEXEC') or die('Restricted access');
$numrows = count($this->receivable_data);
$numrows_loan = count($this->loan_data);
?>
<h1>Receivable</h1>
<div class="comp-button">
    <button type="button" name="cancel_btn" class="cancel_btn">Back</button>
</div>
<div class="comp-content">
<form action="index.php" method="post" name="adminForm" class="submit-form">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="receivable" id="task" />
    <input type="hidden" name="controller" value="accountview" />
    <input type="hidden" name="boxchecked" value="0" />
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
			
                        <th class="title" nowrap="nowrap" width="80%">
				<?php echo JText::_( 'Discription' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Date of Maturity' ); ?> <!--  duedate--> 

			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Amount' ); ?>
			</th>
                        
		</tr>
	</thead>
        <tfoot>
            
        </tfoot>
        <tbody>
            <?php
		 
            
            for($x = 0; $x < $numrows; $x++)
            {
                $row = $this->receivable_data[$x];
		?>
                <tr class="row1">
			
                        <td>
                                <?php echo $row->bank_name.'-'.$row->account_name; ?>
			</td>
                        <td colspan="2">
				<?php //echo $row->period_end;  ?>
			</td>
		</tr>
                <tr class="row0">
                    <td><?php  
                            $diff = abs(strtotime($row->period_end) - strtotime($row->period_start));
                            $years = floor($diff / (365*60*60*24));
                            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                            
                            /*printf("%d years, %d months, %d days\n", $years, $months, $days);*/
                            echo $row->account_no.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $years.'&nbspYears'.'&nbsp;&nbsp'.$months.'&nbspMonths'.'&nbsp;&nbsp'.$days.'&nbspDays';
                            ?>
                    </td>
                    <td>
                        <?php echo $row->period_end;  ?>
                    </td>
                    <td>
				<?php echo $row->int_amount;  ?>
			</td>
                </tr>
    <?php
			}
	?>
                <?php
		 
            
            for($x = 0; $x < $numrows_loan; $x++)
            {
                $row_loan = $this->loan_data[$x];
		?>
                <tr class="row0">
			
                        <td>
                                <?php echo $row_loan->persone; ?>
			</td>
                        <td>
				<?php echo $row_loan->loan_amount;  ?>
			</td>
		</tr>
                <tr>
                    <td><?php  
                            $diff = abs(strtotime($row->al_due) - strtotime($row->al_start));
                            $years = floor($diff / (365*60*60*24));
                            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                            
                            /*printf("%d years, %d months, %d days\n", $years, $months, $days);*/
                            echo $row->account_no.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $years.'&nbspYears'.'&nbsp;&nbsp'.$months.'&nbspMonths'.'&nbsp;&nbsp'.$days.'&nbspDays';
                            ?>
                    </td>
                    <td colspan="2"></td>
                </tr>
                
    <?php
	         
			}
	?>
            
        </tbody>
    </table>
    
</form>
</div>