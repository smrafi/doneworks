<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   30 December 2011
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );

$application_id = JRequest::getInt('application_id');
$numrows = count($this->letter_list);

?>


    <form action="index.php" method="post" name="adminForm">
        <input type="hidden" name="option" value="<?php echo OPTION_NAME ; ?>" />
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="controller" value="letter" />
        <input type="hidden" name="application_id" value="<?php echo $application_id; ?>" />
        
        <table class="adminlist">
   	<thead>
		<tr>
			<th width="40">
				<?php echo '#'; ?>
			</th>
                        <th width="40">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo $numrows; ?>);" />
                        </th>
                                           
			<th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Letter Name' ); ?>
			</th>
                        <th class="title" nowrap="nowrap">
				<?php echo JText::_( 'Letter Note' ); ?>
			                       
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
                $row = $this->letter_list[$x];
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
                      <?php  echo $row->template_name; ?>
		</td>
                <td>
                     <?php echo $row->letter_note; ?>
		</td>
               
               
        </tr>
    <?php
	         $k = 1 - $k;
	    }
    ?>
        </tbody>
        </table>
        
    </form>
