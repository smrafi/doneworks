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

?>
<h1>Payable</h1>
<div class="comp-button">
    <button type="button" name="cancel_btn" class="cancel_btn">Back</button>
</div>
<div class="comp-content">
<form action="index.php" method="post" name="adminForm" class="submit-form">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" id="task" />
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
			<th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Date' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Discription' ); ?>
			</th>
                        
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Amount' ); ?>
			</th>
                        
		</tr>
	</thead>
        <tfoot>
            
        </tfoot>
        <tbody>
            
        </tbody>
    </table>
    
</form>
</div>