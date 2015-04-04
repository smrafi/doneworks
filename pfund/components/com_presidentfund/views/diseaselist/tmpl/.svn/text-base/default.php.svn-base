<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   19 Dec 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
$numrows = count($this->disease_list);
?>
<h1>Disease List</h1>
<div class="comp-button">
    <button type="button" name="new_btn" class="new_btn">New</button>
    <button type="button" name="delete_btn" class="delete_btn">Delete</button>
    <button type="button" name="new_btn" onclick="routeback('asstsec', 'linkback');">Back</button>
</div>
<div class="comp-content">
<form class="submit-form" action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" id="task" />
    <input type="hidden" name="controller" value="disease" />
    <input type="hidden" name="boxchecked" value="0" />
    
    <table class="adminlist">
        <thead>
            <th width="5%">#</th>
            <th width="5%"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo $numrows; ?>);" /></th>
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
                $link = JRoute::_(COMPONENT_LINK.'&controller=disease&task=edit&cid='.$row->id);
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
</div>

