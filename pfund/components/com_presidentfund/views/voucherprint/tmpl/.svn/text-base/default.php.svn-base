<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Asfaran
 * Developer Email  :   asfaransl@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');
$numrows = count($this->selected_list);
$district_name= PFundHelper::getAllDistrict('Select a type');

$document =& JFactory::getDocument();
$document->addStyleSheet(JURI::root().'components/com_presidentfund/assets/styles/print.css', '', 'print');


?>
<div class="comp-button">
    <button type="button" name="print_btn" class="print_btn">Print</button>
    <button type="button" name="bk_btn" class="bk_btn" onclick="routeback('voucher','display');">Back</button>
    
</div>
<div class="comp-print"> 
    <form  action="index.php" method="post" name="adminForm" class="submit-form"  >
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" id="task"/>
    <input type="hidden" name="controller" value="voucher" />
        
 <div><h1>PRESIDENT'S FUND</h1></div>
                <table >
                <tr>
                    <td width="20%"><b>Station</b></td>
                    <td><b>:</b></td>
                    <td>Colombo</td>
                    <td><b>Voucher No :</b></td>
                    <td><b></b></td>
                </tr>
                <tr>
                    <td><b>Account No</b> </td>
                    <td><b>:</b></td>
                    <td><b>PRESIDENT'S FUND-A/C NO     <?php echo $this->post_data->bankaccount_id ; ?></b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><b>Code</b> </td>
                    <td><b>:</b></td>
                    <td><b><?php echo $this->post_data->chequenumber ; ?></b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><b>Sub Code</b> </td>
                    <td><b>:</b></td>
                    <td><b>*******</b></td>
                    <td></td>
                    <td></td>
                </tr>
            </table >
        
                <table class="application-list">
                  <tr>
                    <th  colspan="5">Payable to : **********************</th>
                  </tr>
                  <tr>
                    <th  rowspan="2">Date</th>
                    <th colspan="2" rowspan="2">Description</th>
                    <th  >Amount</th>
                  </tr>
                  <tr>
                    <th >Rs.</th>
                    
                  </tr>
                  <?php
		 $k = 0;
               $total_amount=0;
            for($x = 0; $x < $numrows; $x++)
            {
                $row = $this->selected_list[$x];
                $total_amount=$total_amount+$row->amount;
		?>
    	<tr >
		
		<td>
                      <?php echo $row->date ; ?>
		</td>
		<td colspan="2">
                    Reference No:<?php echo $row->id; ?></br>
                      Name :<?php echo $row->contact_id; ?></br>
                      ledger:<?php echo $row->ledger_activity; ?></br>
                      Sub Ledger<?php echo $row->ledger_typeid; ?>
		</td>
                <td >
                      <?php echo $row->amount; ?>
		</td>
                
                
                
                 
        </tr>

    <?php
	         $k = 1 - $k;
	    }
    ?>
                  <tr>
                    <td  align="center"><em>Prepared by</em></td>
                    <td ></td>
                    <td  rowspan="2" align="center"><b>TOTAL</b></td>
                    <td rowspan="2"><?php echo $total_amount;?></td>
                  </tr>
                  <tr>
                    <td align="center"><em>Checked by</em></td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
            </br>
        <div><p>I certify from personal knowledge /from the certificates in the relevant files/ *Overleaf* that
            the above supplies/*services* work were duly authorized and performed and that the payment of Rupees 
                    <?php echo $total_amount;?>
            is in accordance with regulations /contract fare and reasonable. </p>
        
         
        </div>
 <hr></hr>
        <div>
            <table class="printvoucher_table" >
              <tr>
                <th colspan="4" align="center">RECEIPT</th>
              </tr>
              <tr>
                <td colspan="4">Received this******* day of  in payment of the above account, the sum of Rupees ***********</td>
              </tr>
              <tr>
                  <td ><b>Amount</b> </td>
                <td >:</td>
                <td >******</td>
                <td  rowspan="3">&nbsp;</td>
              </tr>
              <tr>
                  <td><b>Account No</b></td>
                <td>:</td>
                <td>******</td>
              </tr>
              <tr>
                  <td><b>Bank</b></td>
                <td>:</td>
                <td>******</td>
              </tr>
              <tr>
                  <td><b>Branch</b> </td>
                <td>:</td>
                <td>*****</td>
                <td><b>Signature of Recipient</b></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>NIC No :********</td>
              </tr>
            </table>
        </div>
    </form>     
</div>