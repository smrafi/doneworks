<?php

/* * *****************************************************************************
 * Developer        :   Saraniptha Nonis
 * Developer Email  :   saraniptha@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   17 October 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

?>
<style>
    .listselect {
    width: 235px;
}
</style>

<form action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTIOIN_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="cases" />
    <input type="hidden" name="id" value="<?php echo $this->case_data->id; ?>" />
    
    <table width="100%">
        <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_DATE_ADDED'); ?>
            </td>
            <td>
                 <input type="text" name="date_added" id="ca-date_added" disabled="disabled" value="<?php echo $this->case_data->date_added; ?>" size="50" />
            </td>
        </tr>
         <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_SUBJECT'); ?>
            </td>
            <td>
                 <input type="text" name="subject" id="ca-subject"  value="<?php echo $this->case_data->subject; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_SUBJECT'); ?>
            </td>
            <td>
                 <?php echo TellMeMDHelper::createList('cat_id', (int)$this->case_data->cat_id, $this->cat_list, 0, 'listselect');?>
            </td>
        </tr
        <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_DOCTOR'); ?>
            </td>
            <td>
                 <?php echo TellMeMDHelper::createList('doctor_id', (int)$this->case_data->doctor_id, $this->doc_list, 0, 'listselect');?>
            </td>
        </tr>
        <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_STATUS'); ?>
            </td>
            <td>
                 <input type="text" name="status" id="ca-status" disabled="disabled" value="<?php echo $this->case_data->status; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_PRICE'); ?>
            </td>
            <td>
                 <input type="text" name="price" id="ca-price" disabled="disabled" value="<?php echo $this->case_data->price; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_PATIENT'); ?>
            </td>
            <td> <?php 
                 if($this->case_data->patient_id){  
                      $patient =& JFactory::getUser($this->case_data->patient_id);?> 
                
                      <input type="text" name="patient_id" id="ca-patient_id" disabled="disabled" value="<?php echo $patient->username; ?>" size="50" />
                 <?php }?>
            </td>
        </tr>
         <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_DEADLINE_TIME'); ?>
            </td>
            <td>
                 <input type="text" name="deadline_time" id="ca-deadline_time" disabled="disabled" value="<?php echo $this->case_data->deadline_time; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_DEADLINE_ONE'); ?>
            </td>
            <td>
                 <input type="text" name="deadline1" id="ca-deadline1" disabled="disabled" value="<?php echo $this->case_data->deadline1; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_DEADLINE_TWO'); ?>
            </td>
            <td>
                 <input type="text" name="deadline2" id="ca-deadline2" disabled="disabled" value="<?php echo $this->case_data->deadline2; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_CASE_TYPE'); ?>
            </td>
            <td>
                 <?php                     
                    $case_type='';
                    if(isset($this->case_data->case_type)){
                        if($this->case_data->case_type==CASE_TYPE_QUEANS){
                            $case_type=JText::_('COM_TELLMEMD_QUESTIONS');
                        }
                        if($this->case_data->case_type==CASE_TYPE_LABTEST){
                            $case_type=JText::_('COM_TELLMEMD_LABTEST');
                        }
                    }
                 ?>
                 <input type="text" name="case_type" id="ca-case_type" disabled="disabled" value="<?php echo $case_type; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_MEDIUM_ANSWER'); ?>
            </td>
            <td>
                 <?php                     
                    $answer_medium='';
                    if(isset($this->case_data->answer_medium)){
                        if($this->case_data->answer_medium==MEDIUM_TYPE_FORM_SUBMIT){
                            $answer_medium=JText::_('COM_TELLMEMD_MEDIUM_FORM_SUBMIT');
                        }
                        if($this->case_data->answer_medium==MEDIUM_TYPE_LIVE_CHAT){
                            $answer_medium=JText::_('COM_TELLMEMD_MEDIUM_CHAT');
                        }
                        if($this->case_data->answer_medium==MEDIUM_TYPE_SKYPE){
                            $answer_medium=JText::_('COM_TELLMEMD_MEDIUM_SKYPE');
                        }
                    }
                 ?>
                 <input type="text" name="answer_medium" id="ca-answer_medium" disabled="disabled" value="<?php echo $answer_medium; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_URGENCY_LEVEL'); ?>
            </td>
            <td>
                 <?php                     
                    $urgency_level='';
                    if(isset($this->case_data->urgency_level)){
                        if($this->case_data->urgency_level==PRIORITY_TYPE_LOW){
                            $urgency_level=JText::_('COM_TELLMEMD_LOW');
                        }
                        if($this->case_data->urgency_level==PRIORITY_TYPE_MEDIUM){
                            $urgency_level=JText::_('COM_TELLMEMD_MEDIUM');
                        }
                        if($this->case_data->urgency_level==PRIORITY_TYPE_HIGH){
                            $urgency_level=JText::_('COM_TELLMEMD_HIGH');
                        }
                    }
                 ?>
                 <input type="text" name="urgency_level" id="ca-urgency_level" disabled="disabled" value="<?php echo $urgency_level; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_LAB_REPORT'); ?>
            </td>
            <td> 
                <?php 
                 if(isset($this->case_data->labreport_path) && $this->case_data->labreport_path!=''){?>
                    <a href="<?php echo JURI::root().'components/com_tellmemd/uploads/labreports/'.$this->case_data->labreport_path; ?>" target="_blank">Download Report</a>
                <?php                
                }
                else{                 
                ?>                
                    <input type="text" name="labreport_path" id="ca-labreport_path" disabled="disabled" value="<?php echo "no file attached"; ?>" size="50" />
                <?php } ?>
                  
            </td>
        </tr>
        <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_LEVEL_DETAIL'); ?>
            </td>
            <td>
                 <?php                     
                    $detail_level='';
                    if(isset($this->case_data->detail_level)){
                        if($this->case_data->detail_level==PRIORITY_TYPE_LOW){
                            $detail_level=JText::_('COM_TELLMEMD_LOW');
                        }
                        if($this->case_data->detail_level==PRIORITY_TYPE_MEDIUM){
                            $detail_level=JText::_('COM_TELLMEMD_MEDIUM');
                        }
                        if($this->case_data->detail_level==PRIORITY_TYPE_HIGH){
                            $detail_level=JText::_('COM_TELLMEMD_HIGH');
                        }
                    }
                 ?>
                 <input type="text" name="detail_level" id="ca-detail_level" disabled="disabled" value="<?php echo $detail_level; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td width="10%">
                <?php echo JText::_('FB1'); ?>
            </td>
            <td>
                 <input type="text" name="patient_feedback_id" id="ca-patient_feedback_id" disabled="disabled" value="<?php echo $this->p_feedback; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td width="10%">
                <?php echo JText::_('FB2'); ?>
            </td>
            <td>
                 <input type="text" name="doctor_feedback_id" id="ca-doctor_feedback_id" disabled="disabled" value="<?php echo $this->d_feedback; ?>" size="50" />
            </td>
        </tr>
    </table>
        
   
</form>