<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   26 August 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

JHTML::_('behavior.tooltip');

$patient_user =& JFactory::getUser($this->case_data->patient_id);
$patient_name = $patient_user->name;
?>

<form name="thank_form" id="thank-from" action="<?php echo COMPONENT_FRONT_LINK; ?>" method="post">
    
    <input type="hidden" name="controller" value="cases" />
    <input type="hidden" name="task" value="poolcaseaccept" />
    <input type="hidden" name="case_id" id="case_id" value="<?php echo $this->case_data->id; ?>" />
    
<div class="blue_wrapper clearfix">
  <div class="grey_box_wrapper clearfix">
    <div class="gray_box_left">
      <table class="adminlist">
        <thead>
          <tr>
            <th>CID</th>
            <th>Subject</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo 'AA'.  str_pad((int)$this->case_data->id, 5, '0', STR_PAD_LEFT); ?></td>
            <td style=" width: 75%;"><?php echo $this->case_data->subject; ?></td>
          </tr>
        </tbody>
      </table>
      <div class="data_table_view_case">
        <table class="adminlist" width="690px">
          <thead>
            <tr>
              <th>Date</th>
              <th>Category</th>
              <th>Status</th>
              <th>Price</th>
              <th>Patient</th>
              <th>Previous Doctor</th>
              <th>Estimated<br />
                Deadline</th>
              <?php
              if($this->case_data->deadline1 == 0)
                  echo '<th>DL1</th>';
              else
                  echo '<th>DL2</th>';
              ?>
              
              <th>Case Type</th>
              <th>Answer Medium</th>
              <th>Urgency Level</th>
              <th>Level of Details</th>
              </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo date('d/m/y T G:i:s', strtotime($this->case_data->date_added)); ?></td>
              <td><?php echo $this->case_data->cat_name; ?></td>
              <td><?php echo TellMeMDHelper::getStatusArray($this->case_data->status); ?></td>
              <td><?php echo '$'.$this->case_data->price; ?></td>
              <td><?php echo $patient_name; ?></td>
              <td></td>
              <td><?php echo date('d/m/y T G:i:s', strtotime($this->case_data->deadline_time)); ?></td>
              <td>
                  <?php
                  if($this->case_data->deadline1 == 0)
                  {
                  ?>
                      <div class="DL1">
                          <?php
                          if($this->case_data->deadline1 == 0)
                              echo '<div class="active"></div>';
                          else
                              echo '<div class="inactive" style="display:block;"></div>';
                          ?>
                      </div>
                  <?php
                  }
                  else
                  {
                      ?>
                        <div class="DL2">
                          <?php
                          if($this->case_data->deadline2 == 0)
                              echo '<div class="active"></div>';
                          else
                              echo '<div class="inactive" style="display:block;"></div>';
                          ?>
                      </div>
                  <?php
                  }
                  ?>
                  </td>
                  <td>
                      <div class="case_type">
                          <?php
                          if($this->case_data->case_type == CASE_TYPE_QUEANS)
                          {
                              echo '<div class="questions">';
                              echo '<div class="active"></div>';
                              echo '<div class="inactive"></div>';
                              echo '</div>';
                          }
                          if($this->case_data->case_type == CASE_TYPE_LABTEST)
                          {
                              echo '<div class="lab_report">';
                              echo '<div class="active"></div>';
                              echo '<div class="inactive"></div>';
                              echo '</div>';
                          }
                          ?>
                      </div>
                  </td>
              <td>
                      <div class="answer_medium">
                          <?php
                          if($this->case_data->answer_medium == MEDIUM_TYPE_FORM_SUBMIT)
                          {
                              echo '<div class="report">';
                              echo '<div class="active"></div>';
                              echo '<div class="inactive"></div>';
                              echo '</div>';
                          }
                          if($this->case_data->answer_medium == MEDIUM_TYPE_LIVE_CHAT)
                          {
                              echo '<div class="chat">';
                              echo '<div class="active"></div>';
                              echo '<div class="inactive"></div>';
                              echo '</div>';
                          }
                          if($this->case_data->answer_medium == MEDIUM_TYPE_SKYPE)
                          {
                              echo '<div class="skype">';
                              echo '<div class="active"></div>';
                              echo '<div class="inactive"></div>';
                              echo '</div>';
                          }
                          ?>
                      </div>
                  </td>
              <td>
                      <?php echo TellMeMDHelper::getPriorityCodeArray($this->case_data->urgency_level); ?>
                  </td>
                  <td>
                      <?php echo TellMeMDHelper::getPriorityCodeArray($this->case_data->detail_level); ?>
                  </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="gray_box_right">
      <div class="doctor_box"> <img src="<?php echo JURI::root(); ?>templates/tellmemd_template/images/doc_icon.jpg" /> Docter Name </div>
      <div class="chat_box"> <span>
        <input class="chat" name="chat" type="button" value="Request Chat" disabled="disabled" />
        </span><span><input class="start_chat" name="chat" type="button" value="" disabled="disabled" /></span> </div>
      <div class="skype_box"> <span>
        <input class="chat" name="skype" type="button" value="Request Skype" disabled="disabled" />
        </span><span><input class="start_chat" name="skype" type="button" value="" disabled="disabled" /></div>
    </div>
  </div>
  <div class="lab_details">
    <h1>Questions | Laboratary Details</h1>
    <p>
        <?php echo $this->case_data->content ?>
    </p>
  </div>
    <?php
    //determine weather how we need to enable the accept button
    $accept_disabled = 'disabled="disabled"';
    $accept_var = 0;
    
    if($this->case_data->status == CASE_STATUS_OPEN)
    {
        if(($this->case_data->deadline1 == 0) || ($this->case_data->deadline1 == 1 && $this->case_data->deadline2 == 0))
        {
            $accept_disabled = '';
            $accept_var = 1;
        }
    }
    ?>
  <div class="buttons">
    <table width="100%">
      <tr>
        <td>
            <input type="hidden" name="accept_var" id="accept_var" value="<?php echo $accept_var; ?>" />
            <input class="case_buttons" name="accept" type="submit" value="Accept Case" <?php echo $accept_disabled; ?> />
        </td>
      </tr>
    </table>
  </div>
  
</div>
</form>