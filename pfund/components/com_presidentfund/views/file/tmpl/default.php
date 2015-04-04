<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );
JHTML::_('behavior.modal');
JHTML::_('behavior.mootools');
JHTML::_('behavior.tooltip');

$pnum = JRequest::getInt('pnum');
$app_type = JRequest::getInt('app_type');

if($this->file_data->id == 0)
    echo '<h1>New Document&nbsp;&nbsp;'.$pnum.'</h1>';
else
    echo '<h1>Edit Document&nbsp;&nbsp;'.$pnum.'</h1>';

?>
<div class="comp-button">
    <button type="button" name="apply_btn" class="apply_btn">Apply</button>
    <button type="button" name="save_btn" class="save_btn">Save</button>
    <button type="button" name="back_btn" class="back_btn">Back</button>
</div>
<div class="comp-content">
<form  action="" method="post" name="adminForm" class="submit-form" enctype="multipart/form-data">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME ?>" />
    <input type="hidden" name="task" value="" id="task" />
    <input type="hidden" name="controller" value="file" />
    <input type="hidden" name="id" value="<?php echo $this->file_data->id; ?>" />
    <input type="hidden" name="application_id" value="<?php echo $this->file_data->application_id; ?>" />
    <input type="hidden" name="pnum" value=<?php echo $pnum; ?> />
    <input type="hidden" name="app_type" id="app_type" value="<?php echo $app_type; ?>" />
    
    <table>
  <tr>
    <td width="100">Publish</td>
    <td><?php echo PFundHelper::createCheckBox('published', $this->file_data->published , 1); ?></td>
    
  </tr>
  <tr>
    <td>File Purpose</td>
    <td><input name="file_purpose" id="file_purpose" value="<?php echo $this->file_data->file_purpose; ?>" size="50" /></td>
  </tr>
  <tr>
    <td>Document</td>
    <td><input type="file" name="document" id="document" value="" size="50" />
        <br/>
        <?php 
        if($this->file_data->document_name != '')
        {
            
        ?>
        <a class="modal"  rel="{handler: 'iframe', size: {x: 800, y: 450}}" href=<?php echo JURI::root().'components/com_presidentfund/files/documents/'.$this->file_data->document_name;  ?> ><?php echo $this->file_data->document_name; ?></a>
        
        <?php
        }
                
        ?>
        
        
    </td>
  </tr>
  <tr>
    <td valign="top">Description</td>
    <td><textarea name="file_description" id="file_description" cols="40" rows="5"><?php echo $this->file_data->file_description; ?></textarea>
    <input type="hidden" name="document_name" value="<?php echo $this->file_data->document_name; ?>" /></td>
  </tr>
    </table>
</form>
    </div>
        
