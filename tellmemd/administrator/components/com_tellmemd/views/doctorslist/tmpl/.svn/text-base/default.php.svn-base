<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   27 July 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$numrows = count($this->doc_list);
$filter_name = JRequest::getVar('filter_qualy', '');

?>

<form action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTIOIN_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="controller" value="doctors" />
    
    <table>
        <tr>
            <td>
                <?php echo JText::_('COM_TELLMEMD_FILTER_QUALIY'); ?>
            </td>
            <td>
                <input type="text" name="filter_qualy" id="filter_qualy" value="<?php echo $filter_name; ?>" />
            </td>
            <td>
                <input type="submit" name="sbmit_btn" id="sbmit_btn" value="Go" />
            </td>
        </tr>
    </table>
    <br/><br/>
    
    <table class="adminlist">
        <thead>
            <tr>
                <th width="50"><?php echo JText::_('ID'); ?></th>
		<th width="20"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo $numrows; ?>);" /></th>
                
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_DATE'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_FULL_NAME'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_DOB'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_MED_QUALIF'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_EXPERTISE'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_CURR_EMPLO'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_DISIGNATION'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_APPROVE'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_DISAPPROVE'); ?></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="11"><?php echo $this->pagination->getListFooter(); ?></td>
            </tr>
        </tfoot>
        <tbody>
            <?php
            $k = 0;
            
            for($x = 0; $x < $numrows; $x++)
            {
                $row = $this->doc_list[$x];
                $checked = JHtml::_('grid.id', $x, $row->id);
                $doc_id = 'D'.  str_pad((int)$row->user_id, 6, '0', STR_PAD_LEFT);
                $regi_date = date('d/m/y T G:i:s', strtotime($row->registerDate));
                $link = JRoute::_(COMPONENT_LINK.'&controller=doctors&task=edit&cid[]='.$row->id);
                ?>
            
            <tr class="<?php echo 'row'.$k; ?>">
                <td align="center">
                    <?php echo JHtml::link($link, $doc_id); ?>
                </td>
                <td align="center">
                    <?php echo $checked; ?>
                </td>
                <td align="center">
                    <?php echo $regi_date; ?>
                </td>
                <td>
                    <?php echo $row->name; ?>
                </td>
                <td>
                    <?php echo date('d/m/y', strtotime($row->date_birth)); ?>
                </td>
                <td>
                    <?php echo $row->medical_background; ?>
                </td>
                <td>
                    <?php echo $row->speciality; ?>
                </td>
                <td>
                    <?php echo $row->employment; ?>
                </td>
                <td>
                    <?php echo $row->designation; ?>
                </td>
                <td>
                    <button type="button">Approve</button>
                </td>
                <td>
                    <button type="button">Disapprove</button>
                </td>
            </tr>
            
            <?php
            
            $k = 1 - $k;
            }
            
            ?>
        </tbody>
    </table>
    
</form>