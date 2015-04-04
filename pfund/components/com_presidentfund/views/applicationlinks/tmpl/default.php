<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   10 December 2012
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );

$user =& JFactory::getUser();

?>
<h1>Application Links</h1>
<div class="comp-content">
<form  action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="account" />
    
     
    <table class="link-list">
        <?php if(PFundPermissionHelper::checkAcces($user->id, 'application', 'all')): ?>
        <tr> 
            <td width="5%"><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/account_administration.png' ?>" title="Account Administration" /></td>
            <td>
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=application&task=applist', 'Applications'); ?></b>
            </td>
        </tr> 
        <?php endif; ?>
        <?php if(PFundPermissionHelper::checkAcces($user->id, 'special', 'reimbursact')): ?>
        <tr>
            <td><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/reimbursment.png' ?>" title="Set Reimbursment" /></td>
            <td> 
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=special&task=reimbursact', 'Set Reimbursment'); ?></b></td>
        </tr>
        <?php endif; ?>
        <?php if(PFundPermissionHelper::checkAcces($user->id, 'special', 'recommendationlist')): ?>
        <tr>
            <td><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/health_ministry.png' ?>" title="Health Ministry Generate Letter" /></td>
            <td> 
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=special&task=recommendationlist', 'Health Ministry Generate Letter'); ?></b></td>
        </tr>
        <?php endif; ?>
        <?php if(PFundPermissionHelper::checkAcces($user->id, 'special', 'hmletters')): ?>
        <tr>
            <td><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/ministry_letters.png' ?>" title="Health Ministry Letters" /></td>
            <td> 
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=special&task=hmletters', 'Health Ministry Letters'); ?></b></td>
        </tr>
        <?php endif; ?>
        <?php if(PFundPermissionHelper::checkAcces($user->id, 'asstsec', 'all')): ?>
        <tr>
            <td><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/sas.png' ?>" title="SAS Action" /></td>
            <td> 
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=asstsec', 'SAS Action'); ?></b></td>
        </tr>
        <?php endif; ?>
        <?php if(PFundPermissionHelper::checkAcces($user->id, 'account', 'accountapps')): ?>
        <tr>
            <td><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/account_head.png' ?>" title="Account Head Action" /></td>
            <td> 
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=account&task=accountapps', 'Account Head Action'); ?></b></td>
        </tr>
        <?php endif; ?>
        <?php if(PFundPermissionHelper::checkAcces($user->id, 'prsec', 'all')): ?>
        <tr>
            <td><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/secretary_President.png' ?>" title="Secretary of President Fund" /></td>
            <td> 
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=prsec', 'Secretary of President Fund Action'); ?></b></td>
        </tr>
        <?php endif; ?>
        <?php if(PFundPermissionHelper::checkAcces($user->id, 'special', 'presidentlist')): ?>
        <tr>
            <td><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/letter_to_president.png' ?>" title="Letter to President" /></td>
            <td> 
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=special&task=presidentlist', 'Letter to President'); ?></b></td>
        </tr>
        <?php endif; ?>
        <?php if(PFundPermissionHelper::checkAcces($user->id, 'special', 'viewprletters')): ?>
        <tr>
            <td><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/letter_to_president.png' ?>" title="President Office Letters" /></td>
            <td> 
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=special&task=viewprletters', 'President Office Letters'); ?></b></td>
        </tr>
        <?php endif; ?>
        <?php if(PFundPermissionHelper::checkAcces($user->id, 'special', 'upprresponse')): ?>
        <tr>
            <td><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/president_letter.png' ?>" title="Account Views" /></td>
            <td> 
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=special&task=upprresponse', 'Upload President Letter'); ?></b></td>
        </tr>
        <?php endif; ?>
    </table>
</form>
</div>