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
if($this->notice_data->id>0){
       JToolBarHelper::title(   JText::_( COMPONENT_NAME ).': <small><small> ' . JText::_( COM_TELLMEMD_EDIT_NOTICE ).' </small></small>' );
}

 //create doctor select list 
  $default = explode(",",$this->notice_data->doctor_ids);  
  $options = array();
  $attribs = array( 'multiple' => 'multiple', 'size' => '5' );
  foreach($this->doc_list as $key=>$value) :   
    $options[] = JHTML::_('select.option', $key, $value);
  endforeach;
   
  $doctor_list = JHTML::_('select.genericlist', $options, 'doctor_ids[]', $attribs, 'value', 'text', $default);
   
  //create patient select list 
  $default = explode(",",$this->notice_data->patient_ids);  
   
  $options = array();
  $attribs = array( 'multiple' => 'multiple', 'size' => '5' );
  foreach($this->pat_list as $key=>$value) :   
    $options[] = JHTML::_('select.option', $key, $value);
  endforeach;
   
  $pat_list = JHTML::_('select.genericlist', $options, 'patient_ids[]', $attribs, 'value', 'text', $default);


?>

<form action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTIOIN_NAME; ?>" />
    <input type="hidden" name="task" value="save" />
    <input type="hidden" name="controller" value="notice" />
    <input type="hidden" name="id" value="<?php echo $this->notice_data->id; ?>" />
    
    <table>
        <tr>
            <th style="text-align:left;width:10%;">Notice Subject</th>
            <td><input type="text" name="subject" id="subject" value="<?php echo $this->notice_data->subject;?>"/></td>
            <th style="text-align:left;width:10%;">Created Date</th>
            <td><input type="text" name="created_date" readonly="true" id="created_date" value="<?php echo $this->notice_data->created_date;?>"/></td>
        </tr>
        <tr>
            <th style="text-align:left;width:10%;vertical-align:text-top;">Doctors</th>
            <td style="width:30%"><?php echo $doctor_list;?></td>
            <th style="text-align:left;width:10%;vertical-align:text-top;">Patients</th>
            <td style="width:30%"><?php echo $pat_list;?></td>
        </tr>
    </table>
    <table>
        <tr>
            <th style="text-align:left;width:22%;vertical-align:text-top;">Notice</th>
            <td >
                <textarea name="notice" id="nt-notice" rows="8" cols="51"><?php echo $this->notice_data->notice; ?></textarea>
            </td>
        </tr>
    </table>
        
   
</form>