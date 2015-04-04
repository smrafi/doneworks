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

$numrows = count($this->cat_list);
$filter_name = JRequest::getVar('filter_desc', '');
?>

<form action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTIOIN_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="controller" value="category" />
    
    <table>
        <tr>
            <td>
                <?php echo JText::_('COM_TELLMEMD_FILTER_DESC'); ?>
            </td>
            <td>
                <input type="text" name="filter_desc" id="filter_desc" value="<?php echo $filter_name; ?>" />
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
                <th width="50"><?php echo JText::_('COM_TELLMEMD_CATID'); ?></th>
		<th width="20"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo $numrows; ?>);" /></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_PUBLISH'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_DATE'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_CATNAME'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_CATDESC'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_NO_OF_DOCS'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_NO_OF_CASES'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_TOTAL_EARNINGS'); ?></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="9"><?php echo $this->pagination->getListFooter(); ?></td>
            </tr>
        </tfoot>
        <tbody>
            <?php
            $k = 0;
            
            for($x = 0; $x < $numrows; $x++)
            {
                $row = $this->cat_list[$x];
                $checked = JHtml::_('grid.id', $x, $row->id);
                $cat_id = 'C'.  str_pad((int)$row->id, 4, '0', STR_PAD_LEFT);
                $update_date = date('d/m/y T G:i:s', strtotime($row->updated_time));
                $link = JRoute::_(COMPONENT_LINK.'&controller=category&task=edit&cid[]='.$row->id);
                $row->cat_description = strip_tags(substr($row->cat_description, 0, 50));
                $published = JHtml::_('grid.published', $row, $x);
                $dummy_num = 100;
                
                ?>
            <tr class="<?php echo 'row'.$k; ?>">
                <td align="center">
                    <?php echo JHtml::link($link, $cat_id); ?>
                </td>
                <td align="center">
                    <?php echo $checked; ?>
                </td>
                <td align="center">
                    <?php echo $published; ?>
                </td>
                <td align="center">
                    <?php echo $update_date; ?>
                </td>
                <td>
                    <?php echo JHtml::link($link, $row->cat_name); ?>
                </td>
                <td>
                    <?php echo $row->cat_description.'...'; ?>
                </td>
                <td align="center">
                    <?php echo $dummy_num; ?>
                </td>
                <td align="center">
                    <?php echo $dummy_num; ?>
                </td>
                <td align="center">
                    <?php echo $dummy_num; ?>
                </td>
            </tr>
            <?php
            
            $k = 1 - $k;
            
            }
            
            ?>
        </tbody>
    </table>
    
</form>