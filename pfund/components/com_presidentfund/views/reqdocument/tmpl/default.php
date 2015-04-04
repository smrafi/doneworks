<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   27 jan 2012
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );
JHTML::_('behavior.modal');
JHTML::_('behavior.mootools');
JHTML::_('behavior.tooltip');

$pnum = JRequest::getInt('pnum');
$app_type = JRequest::getInt('app_type');
?>
<h1>Upload Required Documents<?php echo '&nbsp;&nbsp;&nbsp;'.$pnum; ?></h1>
<div class="comp-button">
    <button type="button" name="uploadoc_btn" class="uploadoc_btn" onclick="routeback('file','storeReqAppDoc');">Upload</button>
    <button type="button" name="cancel_btn" onclick="routeback('file','backop');">Back</button>
</div>
<div class="comp-content">
<form  action="" method="post" name="adminForm" class="submit-form" enctype="multipart/form-data">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME ?>" />
    <input type="hidden" name="task" value="reqAppDocUpload" id="task" />
    <input type="hidden" name="controller" value="file" />
    <input type="hidden" name="id" value="<?php echo $this->file_data->id; ?>" />
    <input type="hidden" name="application_id" value="<?php echo $this->file_data->application_id; ?>" />
    <input type="hidden" name="pnum" value=<?php echo $pnum; ?> />
    <input type="hidden" name="app_type" id="app_type" value="<?php echo $app_type; ?>" />
    
    <div>
        <div><h3>Application</h3></div>
        <div>
             <input type="file" name="appdocument" id="appdocument" value="" size="50" />
        </div>
    </div>
    
    <div>
        <div><h3>Request letter</h3></div>
        <div>
             <input type="file" name="reqletter" id="reqletter" value="" size="50" />
        </div>
    </div>
    
    <div>
        <div><h3>Doctor's letter</h3></div>
        <div>
             <input type="file" name="doctletter" id="doctletter" value="" size="50" />
        </div>
    </div>
    
    <div>
        <div><h3>Estimate</h3></div>
        <div>
             <input type="file" name="estimate" id="estimate" value="" size="50" />
        </div>
    </div>
    
    
</form>
    </div>
        
