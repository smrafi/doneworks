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

$document = & JFactory::getDocument();
$document->addStyleSheet(JURI::base().'components/'.OPTIOIN_NAME.'/assets/css/tellmemd.style.css');
$document->addScript(JURI::base().'components/'.OPTIOIN_NAME.'/assets/js/jquery-1.6.2.min.js');
$document->addScript(JURI::base().'components/'.OPTIOIN_NAME.'/assets/js/script.js');

$numrows = count($this->dispute_list);
$filter_subject = JRequest::getVar('filter_subject', '');
$filter_type = JRequest::getVar('filter_type', '');
?>

<form action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTIOIN_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="controller" value="dispute" />
    
    
    <table>
        <tr>
            <td>
                <?php echo JText::_('COM_TELLMEMD_FILTER_SUBJECT'); ?>
            </td>
            <td>
                <input type="text" name="filter_subject" id="filter_subject" value="<?php echo $filter_subject; ?>" />
            </td>
            <td>
                <input type="submit" name="sbmit_btn" id="sbmit_btn" value="Go" />
            </td>
            <td style="width:75%;">
            </td>
            <td>
                 <?php 
                 $type_list = TellMeMDHelper::getDisputeTypeArray((int)'all','All Types');
                 echo TellMeMDHelper::createList('filter_type',(int)$filter_type,$type_list,0,'input','onchange="document.adminForm.submit();"'); ?>
            </td>
        </tr>
    </table>
    <br/><br/>
    <table class="adminlist">
        <thead>
            <tr>
                <th width="50"><?php echo JText::_('COM_TELLMEMD_CASEID'); ?></th>
		<th width="20"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php //echo $numrows; ?>);" /></th>
                
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_DATE'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_SUBJECT'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_DISPUTE_TYPE'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_DOCTOR'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_PATIENT'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_CASE_TYPE'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_DISPUTES_STATUS'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_ANSWER_MEDIUM'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_URGENCY_LEVEL'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_LEVEL_DETAILS'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_AWARD_DOCTOR'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_AWARD_PATIENT'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_REFUND_HALF'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_REFUND_PATIENT'); ?></th>
            </tr>
        
    </thead>
       
       <tfoot>
            <tr>
                <td colspan="16"><?php echo $this->pagination->getListFooter(); ?></td>
            </tr>
        </tfoot>
        <tbody>
            <?php
            $k = 0;
            
            for($x = 0; $x < $numrows; $x++)
            {
                $row = $this->dispute_list[$x];
                  $checked = JHtml::_('grid.id', $x, $row->id);

                  $link = JRoute::_(COMPONENT_LINK.'&controller=dispute&task=view&cid[]='.$row->case_id);
                  
                  $status_class='';
                  if($row->status==CASE_DISPUTE_STATUS_NEW){
                      $status_class='class="status-new"';
                  }
                
                ?>
            <tr class="<?php echo 'row'.$k; ?>">
                <td align="center" <?php echo $status_class; ?>>
                    <?php  echo JHtml::link($link,$row->case_id); ?>
                </td>
                <td align="center">
                    <?php echo $checked; ?>
                </td>
                <td align="center" <?php echo $status_class; ?>>
                     <?php echo $row->added_date; ?>
                </td>
                <td align="center" <?php echo $status_class; ?>>
                    <?php echo $row->subject; ?>
                </td>               
                <td align="center" <?php echo $status_class; ?>>
                    <?php $dispute=TellMeMDHelper::getDisputeTypeArray($row->dispute_type);
                     echo TellMeMDHelper::getDisputeTypeArray($row->dispute_type); ?>                      
                </td>
                <td align="center" <?php echo $status_class; ?>>                    
                    <?php if($row->d_name){echo "Dr. ".$row->d_name;}else{echo "-";} ?>
                </td>  
                <td align="center" <?php echo $status_class; ?>>
                    <?php echo $row->p_name; ?>
                </td>  
                <td align="center" <?php echo $status_class; ?>>
                      <?php echo TellMeMDHelper::getDisputeStatusArray($row->status); ?>      
                </td> 
                <td align="center">
                      <?php                           
                          if($row->case_type==CASE_TYPE_QUEANS){?>
                               <img src="<?php echo JURI::base().'components/'.OPTIOIN_NAME.'/assets/images/case_type_active.png';?>" title="Question & Answer" style="width:30px;height:30px;"/>
                      <?php }
                          if($row->case_type==CASE_TYPE_LABTEST){                          ?>  
                               <img src="<?php echo JURI::base().'components/'.OPTIOIN_NAME.'/assets/images/tube_active.png';?>" title="Read Lab Report" style="width:30px;height:30px;"/>
                      <?php }?>       
                </td>                 
                <td align="center">
                   <?php 
                    if($row->answer_medium==MEDIUM_TYPE_FORM_SUBMIT){?>
                         <img src="<?php echo JURI::base().'components/'.OPTIOIN_NAME.'/assets/images/form_submit_active.png';?>" title="Form Submit" style="width:30px;height:30px;"/>
                   <?php }
                    if($row->answer_medium==MEDIUM_TYPE_LIVE_CHAT){?>
                        <img src="<?php echo JURI::base().'components/'.OPTIOIN_NAME.'/assets/images/live_chat_active.png';?>" title="Live Chat" style="width:30px;height:30px;"/>
                   <?php }
                    if($row->answer_medium==MEDIUM_TYPE_SKYPE){?>
                         <img src="<?php echo JURI::base().'components/'.OPTIOIN_NAME.'/assets/images/skype_call_active.png';?>" title="Skype Call" style="width:30px;height:30px;"/>
                   <?php }                    
                    ?>
                </td>  
                <td align="center" <?php echo $status_class; ?>>
                     <?php echo TellMeMDHelper::getPriorityCodeArray($row->urgency_level); ?>                     
                </td>  
                <td align="center" <?php echo $status_class; ?>>
                     <?php echo TellMeMDHelper::getPriorityCodeArray($row->detail_level); ?>                    
                </td>
                <script>
                    jQuery(document).ready(function($){
                           change_button_state('<?php echo $dispute;?>','<?php echo ($x+1);?>','<?php echo $row->status;?>');
                    });
                </script>
                <td align="center">
                     <input type="image" src="<?php echo JURI::base().'components/'.OPTIOIN_NAME.'/assets/images/award_doctor.png';?>" id="dp-award-doctor<?php echo ($x+1);?>" title="Click to Award Doctor"/>               
                </td> 
                <td align="center">
                     <input type="image" src="<?php echo JURI::base().'components/'.OPTIOIN_NAME.'/assets/images/award_patient.png';?>" id="dp-award-patient<?php echo ($x+1);?>" title="Click to Award Patient" />                                     
                </td> 
                <td align="center">
                     <input type="image" src="<?php echo JURI::base().'components/'.OPTIOIN_NAME.'/assets/images/refund_half.png';?>" onClick="return refundHalf('<?php echo $row->case_id;?>');" id="dp-refund-half<?php echo ($x+1);?>" title="Click to Refund Half"/>
                </td> 
                <td align="center">
                     <input type="image" src="<?php echo JURI::base().'components/'.OPTIOIN_NAME.'/assets/images/refund_patient.png';?>" onClick="return refundFull('<?php echo $row->case_id;?>');" id="dp-refund-patient<?php echo ($x+1);?>" title="Click to Refund Patient" />                       
                </td> 
            </tr>
            <?php
            
            $k = 1 - $k;
            
            }
            
            ?>
        </tbody>
    </table>
    
</form>