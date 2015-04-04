<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   19 Dec 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
$numrows = count($this->contact_list);
$contact_office = PFundHelper::getOfficeType(JText::_('Select a type'));

?>
<h1>Contact List</h1>
<div class="comp-button">
    <button type="button" name="new_btn" class="new_btn">New</button>
    <button type="button" name="delete_btn" class="delete_btn">Delete</button>
    <button type="button" name="new_btn" onclick="routeback('contact', 'linkback');">Back</button>
</div>
<div class="comp-content">
<form class="submit-form" action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" id="task" />
    <input type="hidden" name="controller" value="contact" />
    <input type="hidden" name="boxchecked" value="0" />

<table class="adminlist">
        
     <thead>
            <th width="5%">#</th>
            <th width="5%"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo $numrows; ?>);" /></th>
            <th class="title" nowrap="nowrap"><?php echo JText::_('Contact Name'); ?></th>
            <th class="title" nowrap="nowrap"><?php echo JText::_('Contact Office'); ?></th>
            <th class="title" nowrap="nowrap"><?php echo JText::_('Address'); ?></th>
            <th class="title" nowrap="nowrap"><?php echo JText::_('Email'); ?></th>
            <th class="title" nowrap="nowrap"><?php echo JText::_('Phone'); ?></th>
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
                $row = $this->contact_list[$x];
                $link = JRoute::_(COMPONENT_LINK.'&controller=contact&task=edit&cid='.$row->id);
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
                    <?php echo JHtml::link($link, $row->contact_name); ?>
            </td>
            <td>
                    <?php echo $contact_office[$row->contact_office]; ?>
            </td>
            <td>
                    <?php echo $row->address; ?>
            </td>
            <td>
                    <?php echo $row->email; ?>
            </td>
            <td>
                    <?php echo $row->phone; ?>
            </td>
	</tr>
        <?php
	         $k = 1 - $k;
	}
	?>
    <tbody>
</table>
</form>
</div>