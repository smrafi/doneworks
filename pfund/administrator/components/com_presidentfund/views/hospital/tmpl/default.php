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

?>

<form  action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="hospital" />
    <input type="hidden" name="id" value="<?php echo $this->hospital_list->id ; ?>" />
     
    <table  class="adminlist"  >
        
        <tr>
        <td width="20%">Hospital Name</td>
        <td colspan="2"><input type="text" name="hos_name"  size="50" value="<?php echo $this->hospital_list->hos_name ; ?>" /></td>
        </tr>
        <tr>
        <td >Hospital Address</td>
        <td colspan="2"><textarea name="hos_address"  cols="35" rows="5"><?php echo $this->hospital_list->hos_address ; ?> </textarea></td>
        </tr>
        <tr>
        <td >Phone Number</td>
        <td colspan="2"><input type="text" name="hos_phone" size="50" value="<?php echo $this->hospital_list->hos_phone ; ?>" /></td>
        </tr>
        <tr>
        <td >Email Address</td>
        <td colspan="2"><input type="text" name="hos_email"  size="50" value="<?php echo $this->hospital_list->hos_email ; ?>" /></td>
        </tr>
        <tr>
        <td >Bank Account Details::</td>
        <td colspan="2"></td>
        </tr>
        <tr>
        <td ></td>
        <td>Bank code</td><td><?php  echo PFundHelper::createList('hos_bank', (int)$this->hospital_list->hos_bank, $this->bank_array); ?></td>
        </tr>
        <tr>
        <td ></td>
        <td>Bank Branch Code</td><td><input type="text" name="hos_branch"  value="<?php echo $this->hospital_list->hos_branch ; ?>"/></td>
        </tr>
        <tr>
        <td ></td>
        <td>Bank Account Number</td><td><input type="text" name="hos_accno" value="<?php echo $this->hospital_list->hos_accno ; ?>" /></td>
        </tr>
        
     </table>
     
</form>



