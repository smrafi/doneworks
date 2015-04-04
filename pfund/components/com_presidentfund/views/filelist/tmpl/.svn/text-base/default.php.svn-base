<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */
//give no direct access

defined( '_JEXEC' ) or die( 'Restricted access' );
JHTML::_('behavior.modal');
JHTML::_('behavior.mootools');
JHTML::_('behavior.tooltip');

$numrows = count($this->file_list);
$application_id = JRequest::getInt('application_id');
$pnum = JRequest::getInt('pnum');
$app_type = JRequest::getInt('app_type');
?>
<h1>File List <?php echo '&nbsp;&nbsp;'.$pnum; ?></h1>
<div class="comp-button">
    <button type="button" name="new_btn" class="new_btn">New</button>
    <button type="button" name="delete_btn" class="delete_btn">Delete</button>
    <button type="button" name="back_btn" class="back_btn">Back</button>
</div>
<div class="comp-content">
<form action="index.php" method="post" name="adminForm" class="submit-form">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" id="task" />
    <input type="hidden" name="controller" value="file" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="pnum" value=<?php echo $pnum; ?> />
    <input type="hidden" name="app_type" id="app_type" value="<?php echo $app_type; ?>" />
    <?php
    if($application_id)
        echo '<input type="hidden" name="application_id" value="'.$application_id.'" />';
    ?>
 <table class="adminlist">
   	<thead>
		<tr>
			<th width="5%">
				<?php echo '#'; ?>
			</th>
			<th width="5%">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo $numrows; ?>);" />
                        </th>
			<th class="title" nowrap="nowrap" width="35%">
				<?php echo "File Purpose"; ?>
			</th>
                        <th class="title" nowrap="nowrap" width="40%">
				<?php echo "Document"; ?>
			</th>
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
                $row = $this->file_list[$x];
                $link = JRoute::_(COMPONENT_LINK.'&controller=file&task=edit&cid='.$row->id);
                
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
                      <?php  echo JHtml::link($link, $row->file_purpose); ?>
		</td>
                <td>
                    <a class="modal"  rel="{handler: 'iframe', size: {x: 800, y: 450}}" href=<?php echo JURI::root().'components/com_presidentfund/files/documents/'.$row->document_name;  ?> ><?php echo $row->document_name; ?></a> 
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