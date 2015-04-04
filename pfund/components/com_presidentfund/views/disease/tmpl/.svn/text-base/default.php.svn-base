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

if($this->disease_data->id == 0)
    echo '<h1>New Disease</h1>';
else
    echo '<h1>Edit Disease</h1>';

?>
<div class="comp-button">
    <button type="button" name="apply_btn" class="apply_btn">Apply</button>
    <button type="button" name="save_btn" class="save_btn">Save</button>
    <button type="button" name="cancel_btn" class="cancel_btn">Back</button>
</div>
<div class="comp-content">
<form  action="" method="post" name="adminForm" class="submit-form">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" id="task" value="" />
    <input type="hidden" name="controller" value="disease" />
    <input type="hidden" name="id" value="<?php echo $this->disease_data->id; ?>" />
    
    <table>
  <tr>
    <td>Publish</td>
    <td><?php echo PFundHelper::createCheckBox('published',$this->disease_data->published, 1); ?></td>
    
  </tr>
  <tr>
    <td>Category</td>
    <td>
        <?php echo PFundHelper::createList('cat_id', (int)$this->disease_data->cat_id, $this->cat_array); ?>
    </td>
   
  </tr>
  <tr>
    <td>Disease Name</td>
    <td>
      
      <input type="text" name="disease_name" id="disease_name" value="<?php echo $this->disease_data->disease_name; ?>" size="50" />
   </td>
   
  </tr>
  <tr>
    <td>Approved Amount To Private</td>
    <td>
      
      <input type="text" name="private_amount" id="private_amount" value="<?php echo $this->disease_data->private_amount; ?>" size="50" />
   </td>
   
  </tr>
  <tr>
    <td>Approved Amount To SJGH</td>
    <td><input type="text" name="sjgh_amount" id="sjgh_amount"  value="<?php echo $this->disease_data->sjgh_amount; ?>" size="50"/></td>
   
  </tr>
  <tr>
    <td>Approved Amount To Govt.Hospitel</td>
    <td><input type="text" name="gh_amount" id="gh_amount"  value="<?php echo $this->disease_data->gh_amount; ?>" size="50"/></td>
   
  </tr>
  
</table>
    </form>
    </div>