<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   11 January 2012
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );

JHTML::_('behavior.modal');
JHTML::_('behavior.mootools');
JHTML::_('behavior.tooltip');

$numrows = count($this->letter_list);
$application_type = PFundHelper::getApplicationTypes();
?>

<h1>Letters Generated for President Approval</h1>
<div class="comp-button">
    <button type="button" name="back_btn" class="back_btn">Back</button>
</div>
<div class="comp-content">
    <form class="submit-form" action="index.php" method="post" name="adminForm">
        <input type="hidden" name="option" value="<?php echo OPTION_NAME ; ?>" />
        <input type="hidden" name="task" id="task" value="" />
        <input type="hidden" name="controller" value="special" />
        <input type="hidden" name="boxchecked" value="0" />
        
        <table class="adminlist">
            <thead>
                <th width="5%" style="height: 30px;">#</th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('Date'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('File No'); ?></th>
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
//                    $viewlink = JRoute::_(COMPONENT_LINK.'&controller=special&task=viewletterlist&record_id='.$row->id);
                    $print_link = JRoute::_(COMPONENT_LINK.'&controller=special&task=printletter&record_id='.$row->id.'&tmpl=component');
                    
                    ?>
                <tr class="<?php echo 'row'.$k; ?>">
                    <td align="center" style="height: 30px;">
                        <?php echo $this->pagination->getRowOffset($x); ?>
                    </td>
                    <td>
                        <?php echo date('d-m-Y', strtotime($row->date)); ?>
                    </td>
                    <td>
                        <?php echo $row->file_no; ?>
                    </td>
                    <td>
<!--                        <a href="<?php //echo $viewlink;  ?>"><button name="viewbtn" id="viewbtn" type="button">View</button></a>&nbsp;&nbsp;&nbsp;-->
                        <a class="modal"  rel="{handler: 'iframe', size: {x: 800, y: 500}}" href="<?php echo $print_link;  ?>"><button name="bulkprint_btn" id="bulkprint_btn" type="button">Print</button></a>
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