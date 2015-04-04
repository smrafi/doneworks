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

JHTML::_('behavior.modal');
JHTML::_('behavior.mootools');
JHTML::_('behavior.tooltip');

$application_id = JRequest::getInt('application_id');
$pnum = JRequest::getInt('pnum');
$app_type = JRequest::getInt('app_type');
$office_array = PFundHelper::getOfficeType('Select');
$editor = & JFactory::getEditor();

$disabled = '';
$disabled_class = '';
$print_title = 'Letter is ready to print';
if(!$this->letter_data->approved)
{
    $disabled = 'disabled = "disabled"';
    $disabled_class = 'disabled';
    $print_title = 'Letter has not been approved';
}

?>

<h1>Generate New Letter <?php echo '&nbsp;&nbsp;'.$pnum; ?></h1>

<div class="comp-button">
    
    <?php if(!$this->letter_data->id)
    {
        ?>
    <button type="button" name="save_btn" class="save_btn">Generate</button>
    <?php } 
    else
    {
        ?>
    <a class="modal <?php echo $disabled_class; ?>"  rel="{handler: 'iframe', size: {x: 800, y: 500}}" <?php echo $disabled; ?> href="<?php echo COMPONENT_LINK.'&controller=letter&task=printletter&letter_id='.$this->letter_data->id.'&tmpl=component';  ?>">
        <button type="button" name="print_btn" <?php echo $disabled; ?> title="<?php echo $print_title; ?>" class="printlink_btn <?php echo $disabled_class; ?>">Print</button>
    </a>
    <?php
    }
    ?>
    <button type="button" name="cancel_btn" class="back_btn">Back</button>
</div>
<div class="comp-content">
    <form class="submit-form" action="index.php" method="post" name="adminForm">
        <input type="hidden" name="option" value="<?php echo OPTION_NAME ; ?>" />
        <input type="hidden" name="task" id="task" value="" />
        <input type="hidden" name="controller" value="letter" />
        <input type="hidden" name="id" value="<?php echo $this->letter_data->id; ?>" />
        <input type="hidden" name="application_id" value="<?php echo $this->letter_data->application_id; ?>" />
        <input type="hidden" name="pnum" value=<?php echo $pnum; ?> />
        <input type="hidden" name="app_type" id="app_type" value="<?php echo $app_type; ?>" />
        
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
                    <?php echo PFundHelper::createList('template_id', $this->letter_data->template_id, $this->template_array, 0, 'lettertemplate'); ?>
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