<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Jazeer
 * Developer Email  :   jazeermim@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   08 December 2011
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );
if($this->openbalance_data->id == 0)
    echo '<h1>New Open Balance Detail</h1>';
else
    echo '<h1>Edit Open Balance Detail</h1>';
?>
<div class="comp-button">
    <button type="button" name="apply_btn" class="apply_btn">Apply</button>
    <button type="button" name="save_btn" class="save_btn">Save</button>
    <button type="button" name="cancel_btn" class="cancel_btn">Bank</button>
</div>
<div class="comp-content">
<form class="submit-form" action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" id="task"/>
    <input type="hidden" name="controller" value="accountsetting" />
    <input type="hidden" name="id" value="<?php  echo $this->openbalance_data->id; ?>" />
    
    <table>
       
        <tr>
            <td width="30%">
                Bank Balance
            </td>
            <td>
                <input type="text" name="bank_balance" id="bank_balance" value="<?php echo $this->openbalance_data->bank_balance; ?>" size="50" />
            </td>
        </tr>
         <tr>
            <td>
                Payable
            </td>
            <td>
                <input type="text" name="payable" id="payable" value="<?php echo $this->openbalance_data->payable; ?>" size="50" />
            </td>
        </tr>
         <tr>
            <td>
                Receivable
            </td>
            <td>
                <input type="text" name="receivable" id="receivable" value="<?php echo $this->openbalance_data->receivable; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>
                Description
            </td>
            <td>
                <textarea name="description" id="description" cols="35" rows="5"><?php echo $this->openbalance_data->description; ?></textarea>
            </td>
        </tr>
        
    </table>
     </form>
</div>