<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   21 September 2011
 * ***************************************************************************** */


//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$numrows = count($this->surgery_list);
?>

<form action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTIOIN_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="controller" value="surgery" />
    
    <table class="adminlist">
        <thead>
            <tr>
                <th width="50"><?php echo JText::_('#'); ?></th>
		<th width="20"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo $numrows; ?>);" /></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_PUBLISH'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_SURGERY_NAME'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_CATNAME'); ?></th>
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
                $row = $this->surgery_list[$x];
                $checked = JHtml::_('grid.id', $x, $row->id);
                $link = JRoute::_(COMPONENT_LINK.'&controller=surgery&task=edit&cid[]='.$row->id);
                $published = JHtml::_('grid.published', $row, $x);
                
                ?>
            <tr class="<?php echo 'row'.$k; ?>">
                <td align="center">
                    <?php echo $this->pagination->getRowOffset($x); ?>
                </td>
                <td align="center">
                    <?php echo $checked; ?>
                </td>
                <td align="center">
                    <?php echo $published; ?>
                </td>
                <td>
                    <?php echo JHtml::link($link, $row->surgery_name); ?>
                </td>
                <td>
                    <?php echo $row->cat_name; ?>
                </td>
            </tr>
            <?php
            $k = 1 - $k;
            }
            
            ?>
        </tbody>
    </table>
    
</form>