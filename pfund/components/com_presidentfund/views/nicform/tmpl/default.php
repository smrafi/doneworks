<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   05 January 2012
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );
$app_type = JRequest::getInt('app_type');
?>

<h1>NIC Verification</h1>
<div class="comp-button">
    <button type="button" name="new_btn" class="new_btn">Back</button>
</div>
<div class="comp-content">
    <form class="submit-form" action="index.php" method="post" name="adminForm">
        <input type="hidden" name="option" value="<?php echo OPTION_NAME ; ?>" />
        <input type="hidden" name="task" id="task" value="processnic" />
        <input type="hidden" name="controller" value="application" />
        <input type="hidden" name="boxchecked" value="0" />
        <input type="hidden" name="app_type" id="app_type" value="<?php echo $app_type; ?>" />
        
        <span>NIC Number : </span>
        <input type="text" name="nic_num" id="nic_num" maxlength="12" value="" />
        <input type="submit" name="nic_submit" id="nic_submit" value="Submit" />
        <span class="instant-error"></span>
        <span class="instant-note">Testing note</span>
        
    </form>
</div>