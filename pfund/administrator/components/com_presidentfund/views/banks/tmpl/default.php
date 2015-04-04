<?php
/* * *****************************************************************************
 * Developer        :   Mohamed Asfaran
 * Developer Email  :   asfaransl@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   07 December 2011
 * ***************************************************************************** */
defined( '_JEXEC' ) or die( 'Restricted access' );

?>

<form  action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" />
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
        <th>Action</th>
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
                <td>
                    <a href="<?php echo COMPONENT_LINK.'&controller=accountsetting&task=deletebanks&cid='.$banks->id; ?>">
                        <img src="<?php echo JURI::root().'administrator/components/com_presidentfund/assets/images/delete.png' ?>" />
                    </a>
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