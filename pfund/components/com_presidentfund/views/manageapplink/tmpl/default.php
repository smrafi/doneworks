<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   28 December 2011
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );
JHTML::_('behavior.modal');
JHTML::_('behavior.mootools');
JHTML::_('behavior.tooltip');

$application =& JFactory::getApplication();
$app_id = JRequest::getInt('app_id');
$pnum = JRequest::getInt('pnum');
$app_type = JRequest::getInt('app_type');
$action_link = COMPONENT_LINK.'&controller=manageapp&task=app_action&app_id='.$app_id.'&pnum='.$pnum.'&app_type='.$app_type;
$doc_link = COMPONENT_LINK.'&controller=file&application_id='.$app_id.'&pnum='.$pnum.'&app_type='.$app_type;
$letter_link = COMPONENT_LINK.'&controller=letter&application_id='.$app_id.'&pnum='.$pnum.'&app_type='.$app_type;
$dsoffice_link = COMPONENT_LINK.'&controller=manageapp&task=dsresponse&app_id='.$app_id.'&pnum='.$pnum.'&app_type='.$app_type;
$healthmin_link = COMPONENT_LINK.'&controller=healthmin&app_id='.$app_id.'&pnum='.$pnum.'&app_type='.$app_type;
$reqdocupload_link = COMPONENT_LINK.'&controller=file&task=reqAppDocUpload&application_id='.$app_id.'&pnum='.$pnum.'&app_type='.$app_type;
$recptprint_link = COMPONENT_LINK.'&controller=manageapp&task=printrecpt&application_id='.$app_id.'&pnum='.$pnum.'&app_type='.$app_type;


if(!$app_id)
    $application->redirect(JRoute::_(COMPONENT_LINK.'&controller=application'), 'Couldn\'t reach the link you were trying.', 'error');

?>

<h1>Manage Application<?php echo '&nbsp;&nbsp;&nbsp;'.$pnum; ?></h1>
<div class="comp-button">
    <button type="button" name="back_btn" class="back_btn">Back</button>
</div>
<div class="comp-content">
    <form class="submit-form" action="index.php" method="post" name="adminForm">
        <input type="hidden" name="option" value="<?php echo OPTION_NAME ; ?>" />
        <input type="hidden" name="task" id="task" value="" />
        <input type="hidden" name="controller" value="application" />
        
        <table class="link-list">
            <tr>
                <td width="5%"><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/application_action.png' ?>" title="Application Action" /></td>
                <td>
                    <?php echo JHtml::link($action_link, 'Application Action'); ?>
                </td>
            </tr>
            <tr>
                <td><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/application_docs.png' ?>" title="Application Documents" /></td>
                <td>
                    <?php echo JHtml::link($doc_link, 'Application Documents'); ?>
                </td>
            </tr>
            <tr>
                <td><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/letter_gen.png' ?>" title="Generate Letters" /></td>
                <td>
                    <?php echo JHtml::link($letter_link, 'Generate Letters'); ?>
                </td>
            </tr>
            <tr>
                <td><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/dS_office_response.png' ?>" title="DS Office Response" /></td>
                <td>
                    <?php echo JHtml::link($dsoffice_link, 'DS Office Response'); ?>
                </td>
            </tr>
            <tr>
                <td><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/health_ministry_response.png' ?>" title="Health Ministry Response" /></td>
                <td>
                    <?php echo JHtml::link($healthmin_link, 'Health Ministry Response'); ?>
                </td>
            </tr>
            <tr>
                <td><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/required_document.png' ?>" title="Required Document" /></td>
                <td>
                    <?php echo JHtml::link($reqdocupload_link, 'Required Document'); ?>
                </td>
            </tr>
            </tr>
            <tr>
                <td><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/printer.png' ?>" title="Print Reciept" /></td>
                <td>
                    <a class="modal"  rel="{handler: 'iframe', size: {x: 800, y: 500}}" href="<?php echo COMPONENT_LINK.'&controller=manageapp&task=printrecpt&application_id='.$app_id.'&tmpl=component';  ?>">    
                        Print Receipt</a>
                    <?php //echo JHtml::link($recptprint_link, 'Print Receipt'); ?>
                </td>
            </tr>
        </table>
        
    </form>
</div>