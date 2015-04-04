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
$district = PFundHelper::getAllDistrict('Select a district');

if($this->dsoffice_data->id == 0)
    echo '<h1>New Divisional Secretariat Office</h1>';
else
    echo '<h1>Edit Divisional Secretariat Office</h1>';

?>
<div class="comp-button">
    <button type="button" name="apply_btn" class="apply_btn">Apply</button>
    <button type="button" name="save_btn" class="save_btn">Save</button>
    <button type="button" name="cancel_btn" class="cancel_btn">Back</button>
    
</div>
<div class="comp-content">
<form  action="index.php" method="post" name="adminForm" class="submit-form">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME ; ?>" />
    <input type="hidden" name="task" value="" id="task" />
    <input type="hidden" name="controller" value="dsoffice" />
    <input type="hidden" name="id" value="<?php echo $this->dsoffice_data->id; ?>" />
    <table>
       <tr>   
           <td width="35%">Published</td>
           <td><?php echo PFundHelper::createCheckBox('published', $this->dsoffice_data->published, 1); ?></td>
       </tr>
       <tr>   
           <td>District </td>
           <td><?php echo PFundHelper::createList('district', (int)$this->dsoffice_data->district, $district); ?></td>
       </tr>
       <tr>   
           <td>Office Name</td>
           <td><input name="ds_office" id="ds_office" value="<?php echo $this->dsoffice_data->ds_office; ?>" size="50"/></td>
       </tr>
    </table>
    
</form>
    </div>