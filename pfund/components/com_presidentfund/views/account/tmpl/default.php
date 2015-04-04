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

$itemid = JRequest::getInt('Itemid');
$application =& JFactory::getApplication();
$pathway =& $application->getPathway();
if(!$itemid)
    $pathway->addItem('Account Administration');
?>
<h1>Account Administration</h1>
<div class="comp-button">
    <button type="button" name="spback_btn" class="spback_btn" onclick="routeback('configure', 'accountlinks');">Back</button>
</div>
<div class="comp-content">
<form class="submit-form"  action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" id="task" value="" />
    <input type="hidden" name="controller" id="controller" value="account" />
    
    <table class="link-list">
        <tr>
            <td width="5%"><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/bank_settings.png' ?>" title="Bank Settings" /></td>
            <td>
                <b><?php echo JHtml::link('index.php/bank-settings', 'Bank Settings'); ?></b>
            </td>
        </tr>
        <tr>
            <td><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/ledger_setting.png' ?>" title="Ledger Settings" /></td>
            <td>
                <b><?php echo JHtml::link('index.php/ledger-settings', 'Ledger Settings'); ?></b>
            </td>
        </tr>
        <tr>
            <td ><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/mahapola.png' ?>" title="Mahapola" /></td>
            <td>
                <b><?php echo JHtml::link('index.php/mahapola', 'MHESTF'); ?></b>
            </td>
        </tr>
        <tr>
            <td ><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/opening_balance.png' ?>" title="Opening Balance" /></td>
            <td>
                <b><?php echo JHtml::link('index.php/opening-balance', 'Opening Balance'); ?></b>
            </td>
        </tr>
    </table>
</form>
    </div>