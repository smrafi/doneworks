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

    <form action="index.php" method="post" name="adminForm">
        <input type="hidden" name="option" value="<?php echo OPTION_NAME ; ?>" />
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="controller" value="application" />
        <input type="hidden" name="boxchecked" value="0" />
        
        <table>
            <tr>
                <td></td>
                <td>
                    <a href=<?php echo COMPONENT_LINK.'&controller=application&task=appnic';  ?> >
                        <?php echo 'Normal Application'; ?>
                    </a>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href="">Reimbursement</a>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href="">Kandy Hospital / Karagampittiya Hospital</a>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href="">Military Hospitals</a>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href="">Special</a>
                </td>
            </tr>
        </table>
    </form>
