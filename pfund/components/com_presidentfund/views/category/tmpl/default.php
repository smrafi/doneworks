<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

if($this->category_data->id == 0)
    echo '<h1>New Category</h1>';
else
    echo '<h1>Edit Category</h1>';

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
    </div>