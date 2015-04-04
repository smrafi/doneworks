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
?>

<form action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="bankreconcilate" />
    <input type="hidden" name="boxchecked" value="0" />
    <div align="right">Statement Date<?php echo JHtml::calendar('', 'date', 'date'); ?></div>
    <table class="adminlist">
   	<thead>
		<tr>    <th class="title" nowrap="nowrap">Status</th>
                    <th class="title" nowrap="nowrap">Source</th>
                        <th class="title" nowrap="nowrap">Reference</th>
                        <th class="title" nowrap="nowrap">Deposit/Bank Credit</th>
			<th class="title" nowrap="nowrap">checq/Bank Debit</th>
                        <th class="title" nowrap="nowrap">Date</th>
                        <th class="title" nowrap="nowrap">Description</th>
                </tr>
	</thead>
        <tbody>
            <tr>
                <td><input type="checkbox" name="toggle" value="" /></td>
                <td>testing</td>
                <td>009786</td>
                <td>4500000</td>
                <td></td>
                <td>2011-11-10</td>
                <td>Deposit Ticket</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="toggle" value="" /></td>
                <td>testing</td>
                <td>006744</td>
                <td>4500540</td>
                <td></td>
                <td>2011-11-10</td>
                <td>Deposit Ticket</td>
              
            </tr>
            <tr>
                <td><input type="checkbox" name="toggle" value="" /></td>
                <td>testing</td>
                <td>003432</td>
                <td>105575</td>
                <td></td>
                <td>2011-11-10</td>
                <td>Deposit Ticket</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="toggle" value="" /></td>
                <td>testing</td>
                <td>008676</td>
                <td>56078</td>
                <td></td>
                <td>2011-11-10</td>
                <td>Deposit Ticket</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="toggle" value="" /></td>
                <td>testing</td>
                <td>00645</td>
                <td>34000</td>
                <td></td>
                <td>2011-11-10</td>
                <td>Deposit Ticket</td>
            </tr>
           
        </tbody>
</table>
    <div align="left">
        <table>
            <tr>
                <td>
                    <table>
            <tr>
                <td>Interest Income :</td>
                <td><input type="text" value="" size="20" /></td>
            </tr>
            <tr>
                <td>Date :</td>
                <td><?php echo JHtml::calendar('', 'date', 'date'); ?></td>
            </tr>
            <tr>
                <td>Account :</td>
                <td><input type="text" value="" size="20" /><input type="button" value=">" size="5" /></td>
            </tr>
        </table>  
                </td>
                <td>
        <table>
            <tr>
                <td>Service charges :</td>
                <td><input type="text" value="" size="20" /></td>
            </tr>
            <tr>
                <td>Date :</td>
                <td><?php echo JHtml::calendar('', 'date', 'date'); ?></td>
            </tr>
            <tr>
                <td>Account :</td>
                <td><input type="text" value="" size="20" /><input type="button" value=">" size="5" /></td>
            </tr>
        </table> 
                </td>
            
                <td>
        <table>
            <tr>
                <td>Others :</td>
                <td><input type="text" value="" size="20" /></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="text" value="" size="20" /><input type="button" value=">" size="5" /></td>
            </tr>
        </table> 
                </td>
                
            </tr>
        </table>  
    </div>