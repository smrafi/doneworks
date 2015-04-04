<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   05 January 2012
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );

JHTML::_('behavior.modal');
JHTML::_('behavior.mootools');
JHTML::_('behavior.tooltip');

?>

<h1>New Application</h1>
<div class="comp-button">
    <button type="button" name="back_btn" class="back_btn">Back</button>
</div>
<div class="comp-content">
    <form class="submit-form" action="index.php" method="post" name="adminForm">
        <input type="hidden" name="option" value="<?php echo OPTION_NAME ; ?>" />
        <input type="hidden" name="task" id="task" value="" />
        <input type="hidden" name="controller" value="application" />
        <input type="hidden" name="boxchecked" value="0" />
        
        <table class="link-list">
            <tr>
                
                <td width="5%">
                    <img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/normal.png' ?>" title="Normal Application" /></td>
                <td>
                    <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=application&task=appnic&app_type='.APPLICATION_TYPE_NORMAL, 'Normal Application'); ?></b>
                </td>
                </td>
            </tr>
            <tr>
                <td width="5%">
                    <img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/reimbursment.png' ?>" title="Reimbursement" /></td>
                <td>
                    <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=application&task=appnic&app_type='.APPLICATION_TYPE_REIMBURSMENT, 'Reimbursement'); ?></b>
                </td>
            </tr>
            <tr>
                <td width="5%">
                    <img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/kandy.png' ?>" title="Kandy Hospital / Karapittiya Hospital" /></td>
                <td>
                    <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=application&task=appnic&app_type='.APPLICATION_TYPE_KANDY_KARAPITIYA, 'Kandy Hospital / Karapittiya Hospital'); ?></b>
                </td>
            </tr>
<!--            <tr>
                <td width="5%">
                    <img src="<?php //echo JURI::root().'components/com_presidentfund/assets/images/military.png' ?>" title="Military Hospitals" /></td>
                <td>
                    <b><?php //echo JHtml::link(COMPONENT_LINK.'&controller=application', 'Military Hospitals'); ?></b>
                </td>
            </tr>-->
            <tr>
                <td width="5%">
                    <img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/special.png' ?>" title="Special" /></td>
                <td>
                    <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=application&task=appnic&app_type='.APPLICATION_TYPE_SPECIAL, 'Special'); ?></b>
                </td>
            </tr>
            <tr>
                <td width="5%">
                    <img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/special.png' ?>" title="Special" /></td>
                <td>
                    <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=application&task=appnic&app_type='.APPLICATION_TYPE_SPECIAL_REIMBURSMENT, 'Special Reimbursement'); ?></b>
                </td>
            </tr>
        </table>
    </form>
</div>