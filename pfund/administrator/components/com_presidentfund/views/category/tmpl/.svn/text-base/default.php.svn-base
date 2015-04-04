<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<form  action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="category" />
    <input type="hidden" name="id" value="<?php echo $this->category_data->id; ?>" />
    
     <table>
        <tr>
            <td width="30%">Publish</td>
            <td>
                <?php echo PFundHelper::createCheckBox('published', $this->category_data->published, 1); ?>
            </td>
        </tr> 
        <tr>
            <td>Category Name</td>
            <td><input type="text" name="category_name" id="category_name" value="<?php echo $this->category_data->category_name; ?>" size="50"/></td>
        </tr>
    </table>
    
</form>