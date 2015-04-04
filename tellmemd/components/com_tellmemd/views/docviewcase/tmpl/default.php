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

$user =& JFactory::getUser();
$patient_user = JFactory::getUser($this->case_data->patient_id);

$doc_name = 'Dr. '.$user->name;
$patient_name = $patient_user->name;
?>

<form name="docviewcaseform" id="docviewcaseform" action="<?php echo COMPONENT_FRONT_LINK; ?>" method="post">
    <input type="hidden" name="controller" value="cases" />
    <input type="hidden" name="task" id="task" value="casepost" />
    <input type="hidden" name="case_id" id="case_id" value="<?php echo $this->case_data->id; ?>" />
    <input type="hidden" name="patient_id" id="patient_id" value="<?php echo $this->case_data->patient_id; ?>" />
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
              <th>Estimated<br />
                Deadline/<br />
                Sealed<br />
                Time</th>
              <th>DL1</th>
              <th>DL2</th>
              <th>Case Type</th>
              <th>Answer Medium</th>
              <th>Urgency Level</th>
              <th>Level of Details</th>
              <th>FB1</th>
              <th>FB2</th>
              </tr>
          </thead>
          <tbody>
              
            
            <tr>
              <td><?php echo date('d/m/y T G:i:s', strtotime($this->case_data->date_added)); ?></td>
              <td><?php echo $this->case_data->cat_name; ?></td>
              <td><?php echo TellMeMDHelper::getStatusArray($this->case_data->status); ?></td>
              <td><?php echo '$'.$this->case_data->price; ?></td>
              <td><a href="#"><?php echo $patient_name; ?></a></td>
              <td><?php echo date('d/m/y T G:i:s', strtotime($this->case_data->deadline_time)); ?></td>
              <td>
                      <div class="DL1">
                          <?php
                          if($this->case_data->deadline1 == 0)
                              echo '<div class="active"></div>';
                          else
                              echo '<div class="inactive" style="display:block;"></div>';
                          ?>
                      </div>
                  </td>
                  <td>
                      <div class="DL2">
                          <?php
                          if($this->case_data->deadline2 == 0)
                              echo '<div class="active"></div>';
                          else
                              echo '<div class="inactive" style="display:block;"></div>';
                          ?>
                      </div>
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
                  <td>
                      <div class="FB1"></div>
                  </td>
                  <td>
                      <div class="FB2"></div>
                  </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="time_counter">
        <table class="adminlist">
          <thead>
            <tr>
              <th>Current LOCK End Time</th>
              <th>Number of RELOCK's Remaing</th>
              <th>Deadline Time for New Doctor</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>01/06/11<br />
                CST 16:17:00</td>
              <td>0</td>
              <td>01/06/11<br />
                CST 16:17:00</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
      <?php
      $chat_disabled = 'disabled="disabled"';
      $skype_disabled = 'disabled="disabled"';
      
      if($this->case_data->status == CASE_STATUS_ACCEPTED)
      {
          //if doctor online and case medium chat, then we enable chat
          if($this->case_data->answer_medium == MEDIUM_TYPE_LIVE_CHAT && (TellMeMDHelper::checkUserOnline($this->case_data->patient_id)))
                  $chat_disabled = '';
          
          //if doctor online and medium type skype, then we enable skype chat
          if($this->case_data->answer_medium == MEDIUM_TYPE_SKYPE && (TellMeMDHelper::checkUserOnline($this->case_data->patient_id)))
                  $skype_disabled = '';
      }
      ?>
    <div class="gray_box_right">
      <div class="doctor_box"> <img src="<?php echo JURI::root(); ?>templates/tellmemd_template/images/doc_icon.jpg" /> <?php echo $patient_name; ?> </div>
      <div class="chat_box"> <span>
        <input class="chat" name="chat" type="button" value="Request Chat" <?php echo $chat_disabled; ?> />
        </span><span><input class="start_chat" name="chat" type="button" value="" <?php echo $chat_disabled; ?> /></span> </div>
      <div class="skype_box"> <span>
        <input class="chat" name="skype" type="button" value="Request Skype" <?php echo $skype_disabled; ?> />
        </span><span><input class="start_chat" name="skype" type="button" value="" <?php echo $skype_disabled; ?> /></div>
    </div>
  </div>
  <div class="lab_details">
    <h1>Questions | Laboratary Details</h1>
    <p>
        <?php echo $this->case_data->content; ?>
    </p>
  </div>
    <?php
    $answered_disabled = 'disabled="disabled"';
    $decline_disabled = 'disabled="disabled"';
    $review_disabled = 'disabled="disabled"';
    $feedback_disabled = 'disabled="disabled"';
    $radio_disabled = 'disabled="disabled"';
    
    if($this->case_data->status == CASE_STATUS_ACCEPTED)
        $radio_disabled = '';
    if($this->case_data->status == CASE_STATUS_ACCEPTED)
        $answered_disabled = '';
    if($this->case_data->status == CASE_STATUS_ACCEPTED || $this->case_data->status == CASE_STATUS_SENT || $this->case_data->status == CASE_STATUS_INFO)
        $decline_disabled = '';
    ?>
  <div class="buttons">
    <table width="100%">
      <tr>
        <td><input class="case_buttons" name="answered_btn" id="answered_btn" type="button" value="Set as Answered" <?php echo $answered_disabled; ?> /></td>
        <td><input class="case_buttons" name="history_btn" id="history_btn" type="button" value='Patient Medical History'  /></td>
        <td><input class="case_buttons" name="decline_btn" id="decline_btn" type="button" value="Decline Case" <?php echo $decline_disabled; ?>  /></td>
        <td><input class="case_buttons" name="review_btn" id="review_btn" type="button" value="Send for Review" <?php echo $review_disabled; ?> /></td>
        <td><input class="case_buttons" name="feedback_btn" id="feedback_btn" type="button" value="Leave Feedback" <?php echo $feedback_disabled; ?> /></td>
      </tr>
    </table>
  </div>
  <div class="post_message clearfix">
    <textarea name="answer_msg" id="answer_msg"></textarea>
    <br />
    <span class="left">
    <input name="information_radio" type="checkbox" value="1" <?php echo $radio_disabled; ?> />
    &nbsp;&nbsp;Set as Information Needed</span> <span class="right">
    <input class="case_buttons" name="post_btn" id="post_btn" type="submit" value="Post Message" />
    <input class="case_buttons" name="attach_btn" id="attach_btn" type="button" value="Add Attachement" />
    </span> </div>
  <div class="messages_alerts">
    <table width="100%" class="messages" cellspacing="0">
      <tr class="table_head">
        <th>Type</th>
        <th>Sender</th>
        <th>Message/Attachements</th>
        <th>Date/Time</th>
      </tr>
      <tr>
        <td><img src="<?php echo JURI::root(); ?>templates/tellmemd_template/images/report_active.png" /></td>
        <td>EthanB</td>
        <td>In hac habitasse platea dictumst. Donec porta congue nisl, eget porta nibh euismod quis. Cras lobortis venenatis nibh, ac consequat metus fringilla eget. Nam facilisis, ante vitae blandit commodo, ipsum metus euismod lectus, ut molestie dolor orci nec neque. Ut mattis viverra mauris sed porttitor. Etiam in est mollis ante cursus aliquet eu vel ante. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean semper metus et turpis cursus sit amet adipiscing diam iaculis. Quisque ut dolor vitae sem pharetra laoreet sed a mauris. Cras tristique pulvinar vulputate. Etiam nec tortor nunc, at condimentum erat. Suspendisse potenti.<b>[Status Accepted - Timers Started]</b></td>
        <td>01/06/11<br />
          CST 15:42:00</td>
      </tr>
    </table>
  </div>
</div>
</form>