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

$document =& JFactory::getDocument();
$document->addStyleSheet(JURI::root().'components/com_presidentfund/assets/styles/print.css', '', 'print');


$transaction_type = PFundHelper::getTransactionType();
$persons=$this->person_list;
$ledgers=$this->ledger_array;
?>
<div class="comp-button">
    <button type="button" name="print_btn" class="print_btn">Print</button>
    <button type="button" name="bk_btn" class="bk_btn" onclick="routeback('income','display');">Back</button>
</div>
<div class="comp-print"> 
    <form  action="index.php" method="post" name="adminForm" class="submit-form"  >
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" id="task"/>
    <input type="hidden" name="controller" value="income" />
        
 
<table  class="printvoucher_table">
  <tr>
    <td width="19%">Reciept No:</td>
    <td width="9%"><?php echo $this->income_list->id; ?></td>
    <td colspan="3" rowspan="3"><img src="images/banners/pf-logo.png" /></td>
    <td width="4%">date:</td>
    <td width="14%"><?php echo $this->income_list->date; ?></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td colspan="2" ></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td colspan="2" ></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">Received With thanks From</td>
    <td colspan="4"><?php echo ": ".$persons[$this->income_list->contact_id]; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>of </td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>by<?php echo $transaction_type[$this->income_list->income_type]; ?></td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>of</td>
    <td><?php echo $this->income_list->chequedate; ?></td>
    <td>&nbsp;</td>
    <td>dated</td>
    <td colspan="2"><?php //echo $ledgers[$this->income_list->income_type]; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">purpose of payment</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7">&nbsp;</td>
  </tr>
  <tr>
    <td rowspan="2">Rs:<?php echo $this->income_list->amount; ?></td>
    <td colspan="5" rowspan="2">&nbsp;</td>
    <td>.........................</td>
  </tr>
  <tr>
    <td>Secretary/Accountant</td>
  </tr>
  <tr>
    <td colspan="7" align="center">THIS RECEIPT WILL ENTITLE YOU FOR INCOME TAX EXEMPTION IN TEARMS OF INLAND REVENUE(AMENDMENT) <br/>ACT NO.27 OF 1986</td>
  </tr>
</table>
</div>
