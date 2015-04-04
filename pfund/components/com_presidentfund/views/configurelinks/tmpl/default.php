<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   10 December 2012
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

?>
<h1>Configurations</h1>
<div class="comp-content">
<form action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="configure" />
    
    <table class="link-list">
        <tr>
            <td width="5%">
                <img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/category.png' ?>" title="Categories" />
            </td>
            <td>
                <b><?php echo JHtml::link('index.php/category', 'Categories'); ?></b>
            </td>
        </tr>
        <tr>
            <td>
                <img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/medical_condition.png' ?>" title="Medical Conditions" />
            </td>
            <td>
                <b><?php echo JHtml::link('index.php/disease', 'Medical Conditions'); ?></b>
            </td>
        </tr>
        <tr>
            <td>
                <img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/ds_office.png' ?>" title="DS office" />
            </td>
            <td>
                <b><?php echo JHtml::link('index.php/ds-offices', 'Divisional Secretariat Offices'); ?></b>
            </td>
        </tr>
        <tr>
            <td>
                <img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/contacts.png' ?>" title="Contacts" />
            </td>
            <td>
                <b><?php echo JHtml::link('index.php/contacts', 'Contacts'); ?></b>
            </td>
        </tr>
        <tr>
            <td>
                <img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/approved_hospital.png' ?>" title="Hospitals" />
            </td>
            <td>
                <b><?php echo JHtml::link('index.php/hospitals', 'Approved Hospitals & pharmaceuticals'); ?></b>
            </td>
        </tr>
        <tr>
            <td>
                <img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/template_icon.png' ?>" title="Templates" />
            </td>
            <td>
                <b><?php echo JHtml::link('index.php/template', 'Templates'); ?></b>
            </td>
        </tr>
    </table>
</form>
</div>