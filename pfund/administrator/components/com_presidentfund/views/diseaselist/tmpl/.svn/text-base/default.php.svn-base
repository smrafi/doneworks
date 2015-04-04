<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   06 December 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
$numrows = count($this->disease_list);
?>

<form action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="disease" />
    <input type="hidden" name="boxchecked" value="0" />
    
    <table class="adminlist">
        <thead>
            <th width="40">#</th>
            <th width="40"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo $numrows; ?>);" /></th>
            <th class="title" nowrap="nowrap"><?php echo JText::_('JPUBLISHED'); ?></th>
            <th class="title" nowrap="nowrap"><?php echo JText::_('Medical Condition'); ?></th>
            <th class="title" nowrap="nowrap"><?php echo JText::_('Category'); ?></th>
            <th class="title" nowrap="nowrap"><?php echo JText::_('Private Hospital Amount'); ?></th>
            <th class="title" nowrap="nowrap"><?php echo JText::_('SJGH Amount'); ?></th>
            <th class="title" nowrap="nowrap"><?php echo JText::_('General Hospital Amount'); ?></th>
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
                $row = $this->disease_list[$x];
                $link = JRoute::_(COMPONENT_LINK.'&controller=disease&task=edit&cid[]='.$row->id);
                $checked = JHtml::_('grid.id', $x, $row->id);
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
                    <?php echo JHtml::link($link, $row->disease_name); ?>
                </td>
                <td>
                    <?php echo $row->category_name; ?>
                </td>
                <td class="money_right">
                    <?php echo number_format($row->private_amount, 2, '.', ' '); ?>
                </td>
                <td class="money_right">
                    <?php echo number_format($row->sjgh_amount, 2, '.', ' '); ?>
                </td>
                <td class="money_right">
                    <?php echo number_format($row->gh_amount, 2, '.', ' '); ?>
                </td>
            </tr>
            <?php
                
                $k = 1 - $k;
            }
            ?>
        </tbody>
    </table>
    
</form>


