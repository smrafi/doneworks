<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   15 September 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

?>

<style type="text/css">
    .listselect{
        width: 235px;
    }
</style>


<form action="index.php" method="post" name="adminForm" enctype="multipart/form-data">
    <input type="hidden" name="option" value="<?php echo OPTIOIN_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="controller" value="labtest" />
    <input type="hidden" name="id" value="<?php echo $this->labtest_data->id; ?>" />
    
    <table width="100%">
        <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_PUBLISH'); ?>
            </td>
            <td>
                <?php echo TellMeMDHelper::createCheckBox('published', $this->labtest_data->published, 1); ?>
            </td>
        </tr>
         <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_CATEGORY'); ?>
            </td>
            <td>
                <?php echo TellMeMDHelper::createList('cat_id', (int)$this->labtest_data->cat_id, $this->catlist_array, 0, 'listselect'); ?>
            </td>
        </tr>
         <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_COMPLEXITY'); ?>
            </td>
            <td>
                <?php echo TellMeMDHelper::createList('complex_id', (int)$this->labtest_data->complex_id, $this->complex_array, 0, 'listselect'); ?>
            </td>
        </tr>
        <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_TEST_NAME'); ?>
            </td>
            <td>
                <input type="text" name="test_name" value="<?php echo $this->labtest_data->test_name; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('COM_TELLMEMD_TEST_DESC'); ?>
            </td>
            <td>
                <textarea name="test_description" rows="4" cols="31"><?php echo $this->labtest_data->test_description; ?></textarea>
            </td>
        </tr>
        <tr>
            <td width="10%" valign="top">
                <?php echo JText::_('COM_TELLMEMD_LABTEST_FILE'); ?>
            </td>
            <td>
                <input type="file" name="lab_file" size="50" />
                <?php if($this->labtest_data->lab_filename != ''): ?>
                <br/><br/>
                <a href="<?php echo JURI::root().'components/com_tellmemd/uploads/labtests/'.$this->labtest_data->lab_filename; ?>"><span><?php echo $this->labtest_data->lab_filename; ?></span></a>
                <input type="hidden" name="lab_filename" value="<?php echo $this->labtest_data->lab_filename; ?>" />
                <?php endif; ?>
            </td>
        </tr>
    </table>
    
</form>