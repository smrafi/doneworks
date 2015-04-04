<?php

/* * *****************************************************************************
 * Developer        :   Saraniptha Nonis
 * Developer Email  :   saranitpha@archmage.lk  
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   17 October 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
$numrows = count($this->case_list);


$filter_subject = JRequest::getVar('filter_subject', '');
$filter_status = JRequest::getVar('filter_status', '');


?>

<form action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTIOIN_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="controller" value="cases" />
    
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
                 $status_list = TellMeMDHelper::getStatusArray('all','All Status');
                 echo TellMeMDHelper::createList('filter_status',(int)$filter_status,$status_list,0,'input','onchange="document.adminForm.submit();"'); ?>
            </td>
        </tr>
    </table>
   <br/><br/>
    <table class="adminlist">
        <thead>
            <tr>
                <th width="50"><?php echo JText::_('COM_TELLMEMD_CASEID'); ?></th>
		<th width="20"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo $numrows; ?>);" /></th>
                
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_DATE'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_SUBJECT'); ?></th>               
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_CATEGORY'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_STATUS'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_PRICE'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_PATIENT'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_LAST_DOCTOR'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('DL1'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('DL2'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_CASE_TYPE'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_ANSWER_MEDIUM'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_URGENCY_LEVEL'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_LEVEL_DETAILS'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('FB1'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('FB2'); ?></th>
            </tr>
       </thead>
       
       <tfoot>
            <tr>
                <td colspan="18"><?php echo $this->pagination->getListFooter(); ?></td>
            </tr>
        </tfoot>
        <tbody>
            <?php
            $k = 0;
            
            for($x = 0; $x < $numrows; $x++)
            {
                $row = $this->case_list[$x];
                  $checked = JHtml::_('grid.id', $x, $row->id);//                
                  $link = JRoute::_(COMPONENT_LINK.'&controller=cases&task=edit&cid[]='.$row->id);                
                ?>
            <tr class="<?php echo 'row'.$k; ?>">
                <td align="center">
                    <?php  echo JHtml::link($link, $row->id); ?>
                </td>
                <td align="center">
                    <?php echo $checked; ?>
                </td>
                <td align="center">
                     <?php echo $row->date_added; ?>
                </td>
                <td align="center">
                    <?php echo $row->subject; ?>
                </td>               
                <td align="center">
                    <?php echo $row->cat_name; ?>
                </td>
                <td align="center">
                    <?php echo TellMeMDHelper::getStatusArray($row->status); ?>
                </td>
                <td align="center">
                    <?php echo "$ ".$row->price; ?>
                </td>
                <td align="center">
                    <?php echo $row->p_name; ?>
                </td>
                <td align="center">
                    <?php if($row->d_name!=''){echo "Dr. ".$row->d_name;} ?>
                </td>
                <td align="center">
                    <?php echo $row->deadline1; ?>
                </td>
                <td align="center">
                    <?php echo $row->deadline2; ?>
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
                <td align="center">
                    <?php echo TellMeMDHelper::getPriorityCodeArray($row->urgency_level); ?>    
                </td>
                <td align="center">
                    <?php echo TellMeMDHelper::getPriorityCodeArray($row->detail_level); ?>   
                </td>
                <td align="center">
                    <?php echo $row->patient_feedback_id; ?>
                </td>
                <td align="center">
                    <?php echo $row->doctor_feedback_id; ?>
                </td>
                
            </tr>
            <?php
            
            $k = 1 - $k;
            
            }
            
            ?>
        </tbody>
    </table>
    
</form>