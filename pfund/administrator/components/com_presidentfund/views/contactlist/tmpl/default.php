<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Jazeer
 * Developer Email  :   jazeermim@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
$numrows = count($this->contact_list);
$contact_office = PFundHelper::getOfficeType(JText::_('Select a type'));

?>

<form action="index.php" method="post" name="adminForm">

    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="contact" />
    <input type="hidden" name="boxchecked" value="0" />

<table class="adminlist">
        
     <thead>
            <th width="40">#</th>
            <th width="40"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo $numrows; ?>);" /></th>
            <th class="title" nowrap="nowrap"><?php echo JText::_('JPUBLISHED'); ?></th>
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
                $link = JRoute::_(COMPONENT_LINK.'&controller=contact&task=edit&cid[]='.$row->id);
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