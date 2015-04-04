<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
$district = PFundHelper::getAllDistrict('Select a district');


?>
<form  action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME ; ?>" />
    <input type="hidden" name="task" value="" />
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