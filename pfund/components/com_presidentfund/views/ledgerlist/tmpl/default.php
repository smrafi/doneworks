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
$numrows = count($this->ledgerlist);

$search_by = PFundHelper::getEveryLedgerType('All');


?>
<h1>Ledger</h1>
<div class="comp-button">
    <button type="button" name="subldgr_btn" onclick="routeback('ledger','subledger')">Sub Ledger</button>
    <button type="button" name="cancel_btn" class="cancel_btn">Back</button>
</div>
<div class="comp-content">
<form action="index.php" method="post" name="adminForm" class="submit-form">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" id="task" />
    <input type="hidden" name="controller" value="ledger" />
    <div class="search-input">
             <span>List by: </span>
            <?php echo PFundHelper::createList('search_by', 0, $search_by); ?>
            <button type="submit" name="search_btn" id="serach_btn">Search</button>
            </div>
    <table class="adminlist">
   	<thead>
		<tr>
                        <th width="5%">
				<?php echo '#'; ?>
			</th>
			<th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Ledger' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Type' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Balance' ); ?>
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
                $row = $this->ledgerlist[$x];
                
                
                if($row->type==$row->main_ledger)
                        $type=$row->type;
                if($row->type!=$row->main_ledger){
                    if($row->type !=0)
                     $type=$row->type;
                    else
                        $type=$row->main_ledger;
                }
                
		?>
    	<tr class="<?php echo 'row'.$k; ?>">
		<td align="center">
		      <?php echo $this->pagination->getRowOffset($x); ?>
		</td>
                <td>
                      <?php echo  $row->ledger_name ; ?>
		</td>
                <td>
                      <?php echo $search_by[$type] ; ?>
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