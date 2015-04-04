<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   21 December 2011
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );

JHTML::_('behavior.modal');
JHTML::_('behavior.mootools');
JHTML::_('behavior.tooltip');

$app_id = JRequest::getInt('app_id');
$pnum = JRequest::getInt('pnum');
$app_type = JRequest::getInt('app_type');
$status_array = PFundHelper::getStatusArray();
$common_status = PFundHelper::getCommonStatus();
$amount_type = PFundHelper::getAmountTypeList('Select a type');

if(!$app_id)
    $application->redirect(JRoute::_(COMPONENT_LINK.'&controller=application'), 'Couldn\'t reach the link you were trying.', 'error');

?>

<h1>Make DS Response <?php echo '&nbsp;&nbsp;'.$pnum; ?></h1>
<div class="comp-button">
    <button type="button" name="recommend_btn" class="recommend_btn">Recommend</button>
    <button type="button" name="reject_btn" class="reject_btn">Reject</button>
    <button type="button" name="cancel_btn" class="cancel_btn">Back</button>
</div>
<div class="comp-content">
    <form class="submit-form" action="index.php" method="post" name="adminForm" enctype="multipart/form-data">
        <input type="hidden" name="option" value="<?php echo OPTION_NAME ; ?>" />
        <input type="hidden" name="task" id="task" value="" />
        <input type="hidden" name="controller" value="manageapp" />
        <input type="hidden" name="app_id" value="<?php echo $app_id; ?>" />
        <input type="hidden" name="pnum" value=<?php echo $pnum; ?> />
        <input type="hidden" name="app_type" id="app_type" value="<?php echo $app_type; ?>" />
        
        <table>
            <tr>
                <td>
                    <?php echo JText::_('DS Reply File').':'; ?>
                </td>
                <td>
                    <input type="file" name="dsresponse_file" id="dsresponse_file" />
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo JText::_('DS Response Note').':'; ?>
                </td>
                <td>
                    <textarea cols="30" rows="5" name="dsoffice_note" id="dsoffice_note"></textarea>
                </td>
            </tr>
        </table>
    </form>
</div>

