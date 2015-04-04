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

$application =& JFactory::getApplication();
$app_id = JRequest::getInt('app_id');
$action_link = COMPONENT_LINK.'&controller=manageapp&task=app_action&app_id='.$app_id;
$doc_link = COMPONENT_LINK.'&controller=file&application_id='.$app_id;
$letter_link = COMPONENT_LINK.'&controller=letter&application_id='.$app_id;

if(!$app_id)
    $application->redirect(JRoute::_(COMPONENT_LINK.'&controller=application'), 'Couldn\'t reach the link you were trying.', 'error');

?>

<h1>Manage Application</h1>
<div class="comp-content">
    <form action="index.php" method="post" name="adminForm">
        <input type="hidden" name="option" value="<?php echo OPTION_NAME ; ?>" />
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="controller" value="manageapp" />
        
        <table class="adminlist">
            <tr>
                <td></td>
                <td>
                    <?php echo JHtml::link($action_link, 'Application Action'); ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <?php echo JHtml::link($doc_link, 'Application Documents'); ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <?php echo JHtml::link($letter_link, 'Generate Letters'); ?>
                </td>
            </tr>
        </table>
        
    </form>
</div>