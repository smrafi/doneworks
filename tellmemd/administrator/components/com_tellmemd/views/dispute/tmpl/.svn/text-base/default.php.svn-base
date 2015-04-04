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
    <input type="hidden" name="controller" value="dispute" />
    <input type="hidden" name="id" value="<?php echo $this->dispute_data->id; ?>" />
    
    <table width="100%">
        <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_DATE_ADDED'); ?>
            </td>
            <td>
                 <label><?php echo $this->dispute_data->date_added; ?></label>
            </td>
        </tr>
         <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_SUBJECT'); ?>
            </td>
            <td>
                 <label><?php echo $this->dispute_data->subject; ?></label>
            </td>
        </tr>
        <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_SUBJECT'); ?>
            </td>
            <td>
                 <label><?php echo $this->cat_list[$this->dispute_data->cat_id];?></label>
            </td>
        </tr
        <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_DOCTOR'); ?>
            </td>
            <td>
                <label> <?php if($this->dispute_data->doctor_id){ $doctor =& JFactory::getUser($this->dispute_data->doctor_id); echo "Dr.".$doctor->name;}else{echo "-";}?></label>
            </td>
        </tr>
        <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_STATUS'); ?>
            </td>
            <td>
                 <label><?php echo $this->dispute_data->status; ?></label>
            </td>
        </tr>
        <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_PRICE'); ?>
            </td>
            <td>
                 <label><?php echo $this->dispute_data->price; ?></label>
            </td>
        </tr>
        <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_PATIENT'); ?>
            </td>
            <td>
                 <label><?php if($this->dispute_data->patient_id){ $patient =& JFactory::getUser($this->dispute_data->patient_id); echo $patient->name;}else{echo "-";}?></label>
            </td>
        </tr>
         <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_DEADLINE_TIME'); ?>
            </td>
            <td>
                 <label><?php echo $this->dispute_data->deadline_time; ?></label>
            </td>
        </tr>
        <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_DEADLINE_ONE'); ?>
            </td>
            <td>
                 <label><?php echo $this->dispute_data->deadline1; ?></label>
            </td>
        </tr>
        <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_DEADLINE_TWO'); ?>
            </td>
            <td>
                 <label><?php echo $this->dispute_data->deadline2; ?></label>
            </td>
        </tr>
        <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_CASE_TYPE'); ?>
            </td>
            <td>
                 <?php                     
                    $case_type='';
                    if(isset($this->dispute_data->case_type)){
                        if($this->dispute_data->case_type==CASE_TYPE_QUEANS){
                            $case_type=JText::_('COM_TELLMEMD_QUESTIONS');
                        }
                        if($this->dispute_data->case_type==CASE_TYPE_LABTEST){
                            $case_type=JText::_('COM_TELLMEMD_LABTEST');
                        }
                    }
                 ?>
                 <label><?php echo $case_type; ?></label>
            </td>
        </tr>
        <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_MEDIUM_ANSWER'); ?>
            </td>
            <td>
                 <?php                     
                    $answer_medium='';
                    if(isset($this->dispute_data->answer_medium)){
                        if($this->dispute_data->answer_medium==MEDIUM_TYPE_FORM_SUBMIT){
                            $answer_medium=JText::_('COM_TELLMEMD_MEDIUM_FORM_SUBMIT');
                        }
                        if($this->dispute_data->answer_medium==MEDIUM_TYPE_LIVE_CHAT){
                            $answer_medium=JText::_('COM_TELLMEMD_MEDIUM_CHAT');
                        }
                        if($this->dispute_data->answer_medium==MEDIUM_TYPE_SKYPE){
                            $answer_medium=JText::_('COM_TELLMEMD_MEDIUM_SKYPE');
                        }
                    }
                 ?>
                 <label><?php echo $answer_medium; ?></label>
            </td>
        </tr>
        <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_URGENCY_LEVEL'); ?>
            </td>
            <td>
                 <?php                     
                    $urgency_level='';
                    if(isset($this->dispute_data->urgency_level)){
                        if($this->dispute_data->urgency_level==PRIORITY_TYPE_LOW){
                            $urgency_level=JText::_('COM_TELLMEMD_LOW');
                        }
                        if($this->dispute_data->urgency_level==PRIORITY_TYPE_MEDIUM){
                            $urgency_level=JText::_('COM_TELLMEMD_MEDIUM');
                        }
                        if($this->dispute_data->urgency_level==PRIORITY_TYPE_HIGH){
                            $urgency_level=JText::_('COM_TELLMEMD_HIGH');
                        }
                    }
                 ?>
                 <label><?php echo $urgency_level; ?></label>
            </td>
        </tr>
        <tr>
            <td width="10%">
                <?php echo JText::_('COM_TELLMEMD_LAB_REPORT'); ?>
            </td>
            <td> 
                <?php 
                 if(isset($this->dispute_data->labreport_path) && $this->dispute_data->labreport_path!=''){?>
                    <a href="<?php echo JURI::root().'components/com_tellmemd/uploads/labreports/'.$this->dispute_data->labreport_path; ?>" target="_blank">Download Report</a>
                <?php                
                }
                else{                 
                ?>                
                    <label><?php echo "no file attached"; ?></label>
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
                    if(isset($this->dispute_data->detail_level)){
                        if($this->dispute_data->detail_level==PRIORITY_TYPE_LOW){
                            $detail_level=JText::_('COM_TELLMEMD_LOW');
                        }
                        if($this->dispute_data->detail_level==PRIORITY_TYPE_MEDIUM){
                            $detail_level=JText::_('COM_TELLMEMD_MEDIUM');
                        }
                        if($this->dispute_data->detail_level==PRIORITY_TYPE_HIGH){
                            $detail_level=JText::_('COM_TELLMEMD_HIGH');
                        }
                    }
                 ?>
                 <label><?php echo $detail_level; ?></label>
            </td>
        </tr>
        <tr>
            <td width="10%">
                <?php echo JText::_('FB1'); ?>
            </td>
            <td>
                 <label><?php echo $this->p_feedback; ?></label>
            </td>
        </tr>
        <tr>
            <td width="10%">
                <?php echo JText::_('FB2'); ?>
            </td>
            <td>
                 <label><?php echo $this->d_feedback; ?></label>
            </td>
        </tr>
    </table>
        
   
</form>