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
$account_type = PFundHelper::getBankAccountType('Select a Account Type');

?>

<form  action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="bankaccount" />
    <input type="hidden" name="id" value="<?php echo $this->bankaccount_list->id; ?>" />
     
    <table  >
        
        <tr>
        <td width="20%">Published</td>
        <td><?php echo PFundHelper::createCheckBox('published', $this->bankaccount_list->published, 1); ?></td>
        </tr>
        <tr>
        <td width="20%">Bank Name</td>
        <td><?php echo PFundHelper::createList('bank', (int)$this->bankaccount_list->bank, $this->bank_array); ?></td>
        </tr>
        <tr>
        <td width="20%">Account Type</td>
        <td><?php echo PFundHelper::createList('acc_type', (int)$this->bankaccount_list->acc_type, $account_type); ?></td>
        </tr>
        <tr>
        <td width="20%">Account Name</td>
        <td><input type="Text"  name="acc_name" value="<?php echo $this->bankaccount_list->acc_name;?>" size="50"/></td>
        </tr>
        <tr>
        <td width="20%">Account Number</td>
        <td><input type="Text"  name="acc_number" value="<?php echo $this->bankaccount_list->acc_number;?>" size="50"/></td>
        </tr>
     </table>
     
</form>
