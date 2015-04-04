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
$numrows = count($this->letter_list);
$office_array = PFundHelper::getOfficeType('Select');

?>

<h1>Application Letters <?php echo '&nbsp;&nbsp;'.$pnum; ?></h1>

<div class="comp-button">
    <button type="button" name="new_btn" class="new_btn">New</button>
    <button type="button" name="delete_btn" class="delete_btn">Delete</button>
    <button type="button" name="back_btn" class="back_btn">Back</button>
</div>
<div class="comp-content">
    <form class="submit-form" action="index.php" method="post" name="adminForm">
        <input type="hidden" name="option" value="<?php echo OPTION_NAME ; ?>" />
        <input type="hidden" name="task" id="task" value="" />
        <input type="hidden" name="controller" value="letter" />
        <input type="hidden" name="boxchecked" value="0" />
        <input type="hidden" name="application_id" value="<?php echo $application_id; ?>" />
        <input type="hidden" name="pnum" value=<?php echo $pnum; ?> />
        <input type="hidden" name="app_type" id="app_type" value="<?php echo $app_type; ?>" />
        
        <table class="adminlist">
            <thead>
                <th width="5%">#</th>
                <th width="5%"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo $numrows; ?>);" /></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('Letter to'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('Letter Template'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('Action'); ?></th>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="7"><?php echo $this->pagination->getListFooter(); ?></td>
                </tr>
            </tfoot>
            <tbody>
                <?php
                $k = 0;
                
                for($x = 0; $x < $numrows; $x++)
                {
                    $row = $this->letter_list[$x];
                    $print_link = COMPONENT_LINK.'&controller=letter&task=printletter&letter_id='.$row->id.'&tmpl=component';
                    $link = JRoute::_(COMPONENT_LINK.'&controller=letter&task=edit&cid='.$row->id);
                    $checked = JHtml::_('grid.id', $x, $row->id);
                    $disabled = '';
                    $disabled_class = '';
                    $print_title = 'Letter is ready to print';
                    if(!$row->approved)
                    {
                        $disabled = 'disabled = "disabled"';
                        $disabled_class = 'disabled';
                        $print_title = 'Letter has not been approved';
                    }
                    
                    ?>
                <tr class="<?php echo 'row'.$k; ?>">
                    <td align="center">
                        <?php echo $this->pagination->getRowOffset($x); ?>
                    </td>
                    <td align="center">
                        <?php echo $checked; ?>
                    </td>
                    <td>
                        <?php echo JHtml::link($link, $office_array[$row->office_type]); ?>
                    </td>
                    <td>
                        <?php echo $row->template_name; ?>
                    </td>
                    <td>
                        <a class="modal <?php echo $disabled_class; ?>"  rel="{handler: 'iframe', size: {x: 800, y: 500}}" <?php echo $disabled; ?> href="<?php echo $print_link;  ?>">
                            <button type="button" name="print_btn" <?php echo $disabled; ?> title="<?php echo $print_title; ?>" class="printlink_btn <?php echo $disabled_class; ?>">Print</button>
                        </a>
                    </td>
                </tr>
                <?php
                    
                    $k = 1 - $k;
                }
                ?>
            </tbody>
        </table>
    </form>
</div>