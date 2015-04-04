<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   19 Dec 2011
 * ***************************************************************************** */
defined( '_JEXEC' ) or die( 'Restricted access' );
$account_type = PFundHelper::getBankAccountType('Select a Account Type');

$check_acc_type_1="";
$check_acc_type_2="";

if($this->bankaccount_list->acc_type==ACCOUNT_TYPE_CURRENT)
        $check_acc_type_1= "checked='checked'";
else 
       $check_acc_type_2= "checked='checked'";


if($this->bankaccount_list->id == 0)
    echo '<h1>New Bank Account</h1>';
else
    echo '<h1>Edit Bank Account</h1>';

?>
<div class="comp-button">
    <button type="button" name="apply_btn" class="apply_btn">Apply</button>
    <button type="button" name="save_btn" class="save_btn">Save</button>
    <button type="button" name="cancel_btn" class="cancel_btn">Back</button>
</div>
<div class="comp-content">
<form  action="index.php" method="post" name="adminForm" class="submit-form">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" id="task" value="" />
    <input type="hidden" name="controller" value="bankaccount" />
    <input type="hidden" name="id" value="<?php echo $this->bankaccount_list->id; ?>" />
     
    <table  >
        <tr>
        <td width="20%">Bank Name</td>
        <td><?php echo PFundHelper::createList('bank', (int)$this->bankaccount_list->bank, $this->bank_array); ?></td>
        </tr>
        <tr>
        <td width="20%">Account Type</td>
        <td> 
           Current
           <input type="radio" name="acc_type" value="<?php echo ACCOUNT_TYPE_CURRENT; ?>" id="acc_type_1" <?php echo $check_acc_type_1;?> /><br />
           Saving
           <input type="radio" name="acc_type" value="<?php echo ACCOUNT_TYPE_SAVING; ?>" id="acc_type_2"  <?php echo $check_acc_type_2;?> />
          
        </td>
        </tr>
        <tr>
        <td width="20%">Account Name</td>
        <td><input type="Text"  name="acc_name" value="<?php echo $this->bankaccount_list->acc_name;?>" size="50"/></td>
        </tr>
        <tr>
        <td width="20%">Account Number</td>
        <td><input type="Text"   name="acc_number" value="<?php echo $this->bankaccount_list->acc_number;?>" size="50"/></td>
        </tr>
        
     </table>
     
</form>
</div>