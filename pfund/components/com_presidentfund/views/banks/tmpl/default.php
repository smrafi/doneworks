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


?>
<h1>Banks</h1>
<div class="comp-button">
    
    <div class="comp-button" ><button type="button" name="back_btn" class="back_btn" >Bank Account</button></div>
    <button type="button" name="apply_btn" class="apply_btn">Apply</button>
    <button type="button" name="save_btn" class="save_btn">Save</button>
    <button type="button" name="cancel_btn" class="cancel_btn">Back</button>
</div>
<div class="comp-content">
<form  action="index.php" method="post" name="adminForm" class="submit-form">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" id="task" />
    <input type="hidden" name="controller" value="accountsetting" />
    
     
    <table  id="banktable">
        <tr>
        <td width="20%">Bank Name</td>
        <td><input type="Text"  name="bank_name" value="" size="50"/></td>
        </tr>
        <tr>
        <td width="20%">Bank Code</td>
        <td><input type="Text"  name="bank_code" value="" size="50"/></td>
        </tr>
    </table>
    
    <?php
    if(!empty ($this->banks))
    {
        ?>
    <table class="adminlist">
        <thead>
        <th>Bank Name's</th>
        <th>Bank Code</th>
        </thead>
        <tbody>
            <?php
            foreach($this->banks as $banks)
            {
                ?>
            <tr>
                <td width="30%">
                    <?php echo $banks->bank_name ; ?>
                </td>
                <td width="30%">
                    <?php echo $banks->bank_code ; ?>
                </td>  
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <?php
    }
    ?>
</form>
    </div>