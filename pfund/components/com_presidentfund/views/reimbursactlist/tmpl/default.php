<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   14 January 2012
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );

JHTML::_('behavior.modal');
JHTML::_('behavior.mootools');
JHTML::_('behavior.tooltip');

$numrows = count($this->application_list);
$application_type = PFundHelper::getApplicationTypes();
?>

<h1>Set Application Type</h1>
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
                <th width="7%">#</th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('Patient Number'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('Patient Name'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('Application Type'); ?></th>
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
                    $row = $this->application_list[$x];
                    if($row->application_type != APPLICATION_TYPE_KANDY_KARAPITIYA)
                    {
                    $link = JRoute::_(COMPONENT_LINK.'&controller=application&task=edit&cid='.$row->id);
                    $manage_link = JRoute::_(COMPONENT_LINK.'&controller=manageapp&app_id='.$row->id);
                    $patient_link = JRoute::_(COMPONENT_LINK.'&controller=application&pnum='.$row->patient_num);
                    $checked = JHtml::_('grid.id', $x, $row->id);
                    
                    $normal_disabled = $reimburse_disabled = '';
                    $normal_addclass = $reimburse_addclass = '';
                    if($row->application_type == APPLICATION_TYPE_NORMAL or $row->application_type == APPLICATION_TYPE_EXIST_NORMAL)
                    {
                        $normal_disabled = 'disabled="disabled"';
                        $normal_addclass = 'disabled';
                    }
                    if($row->application_type == APPLICATION_TYPE_REIMBURSMENT)
                    {
                        $reimburse_disabled = 'disabled="disabled"';
                        $reimburse_addclass = 'disabled';
                    }
                    
                    ?>
                <tr class="<?php echo 'row'.$k; ?>">
                    <td align="center">
                        <?php echo $this->pagination->getRowOffset($x); ?>
                    </td>
                    <td>
                        <?php echo $row->patient_num; ?>
                    </td>
                    <td>
                        <?php echo $row->patient_fullname; ?>
                    </td>
                    <td>
                        <?php echo $application_type[$row->application_type]; ?>
                    </td>
                    <td>
                        <button type="button" id="mknormal<?php echo $row->id; ?>" name="mknormal_btn" value="<?php echo APPLICATION_TYPE_NORMAL.','.$row->id; ?>" class="mknormal_btn <?php echo $normal_addclass; ?>" <?php echo $normal_disabled; ?> >Normal</button>&nbsp;
                        <button type="button" id="mkreimburs<?php echo $row->id; ?>" name="mkreimburs_btn" value="<?php echo APPLICATION_TYPE_REIMBURSMENT.','.$row->id; ?>" class="mkreimburs_btn <?php echo $reimburse_addclass; ?>"  <?php echo $reimburse_disabled; ?> >Reimbursement</button>&nbsp;
                        <a class="modal"  rel="{handler: 'iframe', size: {x: 800, y: 500}}" href=<?php echo $link.'&tmpl=component&action=view';  ?> >
                            <button type="button" name="viewbtn" id="viewbtn">View</button>
                        </a>
                    </td>
                </tr>
                <?php
                $k = 1 - $k;
                }
                }
                ?>
            </tbody>
        </table>
        
    </form>
</div>