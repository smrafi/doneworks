<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   21 December 2011
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );

JHTML::_('behavior.modal');
JHTML::_('behavior.mootools');
JHTML::_('behavior.tooltip');

$numrows = count($this->application_list);
?>

<h1>Application List to Sent President</h1>
<div class="comp-button">
    <button type="button" name="upload_btn" class="upload_btn">Upload File</button>
    <button type="button" name="back_btn" class="back_btn">Back</button>
</div>
<div class="comp-content">
    <form class="submit-form" action="index.php" method="post" name="adminForm" enctype="multipart/form-data">
        <input type="hidden" name="option" value="<?php echo OPTION_NAME ; ?>" />
        <input type="hidden" name="task" id="task" value="" />
        <input type="hidden" name="controller" value="special" />
        <input type="hidden" name="boxchecked" value="0" />
        
        <div class="search-input">
            <span>Upload File : </span>
            <input type="file" name="prfile_reply" id="prfile_reply" value="" />
        </div>
        
        <table class="adminlist">
            <thead>
                <th width="5%">#</th>
                <th width="5%"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo $numrows; ?>);" /></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('Patient Number'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('Patient Name'); ?></th>
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
                    $link = JRoute::_(COMPONENT_LINK.'&controller=application&task=edit&cid='.$row->id);
                    $manage_link = JRoute::_(COMPONENT_LINK.'&controller=manageapp&app_id='.$row->id);
                    $patient_link = JRoute::_(COMPONENT_LINK.'&controller=application&pnum='.$row->patient_num);
                    $checked = JHtml::_('grid.id', $x, $row->id);
                    
                    ?>
                <tr class="<?php echo 'row'.$k; ?>">
                    <td align="center">
                        <?php echo $this->pagination->getRowOffset($x); ?>
                    </td>
                    <td align="center">
                        <?php echo $checked; ?>
                    </td>
                    <td>
                        <?php echo $row->patient_num; ?>
                    </td>
                    <td>
                        <?php echo $row->patient_fullname; ?>
                    </td>
                    <td>
                        <a class="modal"  rel="{handler: 'iframe', size: {x: 800, y: 500}}" href=<?php echo $link.'&tmpl=component&action=view';  ?> >
                            <?php echo 'View Application'; ?>
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