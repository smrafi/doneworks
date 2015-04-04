<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   23 December 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

?>

<form action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="accountview" />
    
    <table class="adminlist">
        <tr>
            <td></td>
            <td>
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=accountview', 'Account Receivable'); ?></b>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=accountview', 'Account payable'); ?></b>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=accountview', 'Cash Book'); ?></b>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=accountview', 'Ledger Book'); ?></b>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=accountview', 'Recipt Summary'); ?></b>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=accountview', 'Account Summary'); ?></b>
            </td>
        </tr>
    </table>
</form>
