<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   19 Dec 2011
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );
$numrows = count($this->hospital_list);


?>
<h1>Hospital List</h1>
<div class="comp-button">
    
    <button type="button" name="new_btn" class="new_btn">New</button>
    <button type="button" name="delete_btn" class="delete_btn">Delete</button>
    <button type="button" name="new_btn" onclick="routeback('hospital', 'linkback');">Back</button>
</div>
<div class="comp-content">
<form class="submit-form" action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" id="task"/>
    <input type="hidden" name="controller" value="hospital" />
    <input type="hidden" name="boxchecked" value="0" />

     <table class="adminlist">
   	<thead>
		<tr>
			<th>
				<?php echo '#'; ?>
			</th>
			<th width="5%">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo$numrows; ?>);" />
                        </th>
                        <th class="title" nowrap="nowrap">Hospital Name</th>
                        <th class="title" nowrap="nowrap">Hospital Address</th>
			<th class="title" nowrap="nowrap">Phone Number</th>
                        <th class="title" nowrap="nowrap">Email Address</th>
                        <th class="title" nowrap="nowrap">Bank Name</th>
                        <th class="title" nowrap="nowrap">Branch Code</th>
                        <th class="title" nowrap="nowrap">Account No</th>
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
                $row = $this->hospital_list[$x];
                $link = JRoute::_(COMPONENT_LINK.'&controller=hospital&task=edit&cid='.$row->id);
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
                            <?php echo JHtml::link($link, $row->hos_name); ?>
			</td>
                        <td>
                            <?php echo $row->hos_address; ?>
			</td>
                        <td>
                            <?php echo $row->hos_phone; ?>
			</td>
                        <td>
                            <?php echo $row->hos_email; ?>
			</td>
                        <td>
                            <?php echo $row->bank_name; ?>
			</td>
                         <td>
                            <?php echo $row->hos_branch; ?>
			</td>
                         <td>
                            <?php echo $row->hos_accno; ?>
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