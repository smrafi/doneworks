<?php

/* * *****************************************************************************
 * Developer        :   Saraniptha Nonis
 * Developer Email  :   saraniptha@archmage.lk
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   21 October 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


$numrows = count($this->notice_list);

$filter_subject = JRequest::getVar('filter_subject', '');
$filter_type = JRequest::getVar('filter_type', '');
?>

<form action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTIOIN_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="controller" value="notice" />
    
    
    
    <br/><br/>
    <table class="adminlist">
        <thead>
            <tr>
                <th width="50"><?php echo JText::_('COM_TELLMEMD_NOTICE_ID'); ?></th>
		<th width="20"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php //echo $numrows; ?>);" /></th>
                           
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_NOTICE_PATIENT_LIST'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_NOTICE_DOCTOR_LIST'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_NOTICE_SUBJECT'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_NOTICE_SENT_DATE'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_NOTICE_STATUS'); ?></th>
            </tr>
        
    </thead>
       
       <tfoot>
            <tr>
                <td colspan="7"><?php echo $this->pagination->getListFooter(); ?></td>
            </tr>
        </tfoot>
        
     <?php
            $k = 0;
            
            for($x = 0; $x < $numrows; $x++)
            {
                $row = $this->notice_list[$x];
                  $checked = JHtml::_('grid.id', $x, $row->id);//                
                  $link = JRoute::_(COMPONENT_LINK.'&controller=notice&task=edit&cid[]='.$row->id);                
                ?>
            <tr class="<?php echo 'row'.$k; ?>">
                <td align="center">
                    <?php  echo JHtml::link($link, $row->id); ?>
                </td>
                <td align="center">
                    <?php echo $checked; ?>
                </td>
                <td align="center">
                    <?php 
                          if($row->patient_ids==-1)
                            {echo JText::_('COM_TELLMEMD_NOTICE_ID_ALL');}
                          else if($row->patient_ids==0)
                            {echo JText::_('COM_TELLMEMD_NOTICE_ID_NONE');} 
                          else
                            {echo JText::_('COM_TELLMEMD_NOTICE_ID_VARY');}
                     ?>
                </td>
                <td align="center">
                    <?php 
                          if($row->doctor_ids==-1)
                            {echo JText::_('COM_TELLMEMD_NOTICE_ID_ALL');}
                          else if($row->doctor_ids==0)
                            {echo JText::_('COM_TELLMEMD_NOTICE_ID_NONE');} 
                          else
                            {echo JText::_('COM_TELLMEMD_NOTICE_ID_VARY');}
                     ?>
                </td>
                <td align="center">
                    <?php echo $row->subject; ?>
                </td>
                <td align="center">
                    <?php if($row->sent_date!='0000-00-00 00:00:00'){echo $row->sent_date;}else{echo "-";}?>
                </td>
                 <td align="center">
                    <?php if($row->status==EMAIL_SENT)
                            {
                                  echo JText::_('COM_TELLMEMD_NOTICE_EMAIL_SENT');
                            } 
                          if($row->status==EMAIL_NOT_SENT)
                            {
                                  echo JText::_('COM_TELLMEMD_NOTICE_EMAIL_NOT_SENT');
                            } ?>
                </td>
            </tr>
            <?php
            
            $k = 1 - $k;
            
            }
            
            ?>
        </tbody>
    </table>
    
</form>