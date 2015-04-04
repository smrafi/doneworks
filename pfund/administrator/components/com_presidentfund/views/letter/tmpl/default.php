<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   30 December 2011
 * ***************************************************************************** */


defined( '_JEXEC' ) or die( 'Restricted access' );

$application_id = JRequest::getInt('application_id');
$office_array = PFundHelper::getOfficeType('Select');
$editor = & JFactory::getEditor();

?>

<div class="comp-content">
    <form class="submit-form" action="index.php" method="post" name="adminForm">
        <input type="hidden" name="option" value="<?php echo OPTION_NAME ; ?>" />
        <input type="hidden" name="task" id="task" value="" />
        <input type="hidden" name="controller" value="letter" />
        <input type="hidden" name="id" value="<?php echo $this->letter_data->id; ?>" />
        <input type="hidden" name="application_id" value="<?php echo $this->letter_data->application_id; ?>" />
        
        <table>
            <tr>
                <td>Letter To</td>
                <td>
                    <?php echo PFundHelper::createList('office_type', $this->letter_data->office_type, $office_array); ?>
                </td>
            </tr>
            <tr>
                <td>Letter Template</td>
                <td>
                    <?php echo PFundHelper::createList('template_id', $this->letter_data->template_id, $this->template_array); ?>
                </td>
            </tr>
            <tr>
                <td>Letter Note</td>
                <td>
                    <textarea name="letter_note" id="letter_note" rows="5" cols="35"><?php echo $this->letter_data->letter_note; ?></textarea>
                </td>
            </tr>
            <tr>
                <td>Edit Letter</td>
                <td id="letterrtxt-area">
                    <?php echo $editor->display('letter_content', $this->letter_data->letter_content, 550, 400, 70, 10); ?>
                </td>
            </tr>
        </table>
        
    </form>
</div>