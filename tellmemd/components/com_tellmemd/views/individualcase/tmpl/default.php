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

if($this->case_data->doctor_id)
{
    $doc_user =& JFactory::getUser($this->case_data->doctor_id);
    $doc_name = 'Dr. '.$doc_user->name;
}

?>

<form name="viewcaseform" id="viewcaseform" action="<?php echo COMPONENT_FRONT_LINK; ?>" method="post">
    
    <input type="hidden" name="controller" value="cases" />
    <input type="hidden" name="task" value="caseaction" />
    <input type="hidden" name="case_id" id="case_id" value="<?php echo $this->case_data->id; ?>" />
    <input type="hidden" name="doctor_id" id="doctor_id" value="<?php echo $this->case_data->doctor_id; ?>" />
    
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
              <th>Doctor</th>
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
              <td><a href="#"><?php echo $doc_name; ?></a></td>
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
                          print_r($$this->case_data->answer_medium);
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
    </div>
      <?php
      $chat_disabled = 'disabled="disabled"';
      $skype_disabled = 'disabled="disabled"';
      
      if($this->case_data->status == CASE_STATUS_ACCEPTED)
      {
          //if doctor online and case medium chat, then we enable chat
          if($this->case_data->answer_medium == MEDIUM_TYPE_LIVE_CHAT && (TellMeMDHelper::checkUserOnline($this->case_data->doctor_id)))
                  $chat_disabled = '';
          
          //if doctor online and medium type skype, then we enable skype chat
          if($this->case_data->answer_medium == MEDIUM_TYPE_SKYPE && (TellMeMDHelper::checkUserOnline($this->case_data->doctor_id)))
                  $skype_disabled = '';
      }
      ?>
    <div class="gray_box_right">
      <div class="doctor_box"> <img src="<?php echo JURI::root(); ?>templates/tellmemd_template/images/doc_icon.jpg" /> <?php echo $doc_name; ?> </div>
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
    //all going about to enable following buttons
    $accept_disabled = 'disabled="disabled"';
    $reject_disabled = 'disabled="disabled"';
    $newdoc_disabled = 'disabled="disabled"';
    $refund_disabled = 'disabled="disabled"';
    $radio_disabled = 'disabled="disabled"';
    
    //enable the button only if status is open and deadline 1 is passsed but deadline two is not passed yet
    if($this->case_data->status == CASE_STATUS_OPEN && $this->case_data->deadline1 == 1 && $this->case_data->deadline2 == 0)
        $newdoc_disabled = '';
    
    if($this->case_data->status == CASE_STATUS_INFO)
        $radio_disabled = '';
    ?>
  <div class="buttons">
    <table width="100%">
      <tr>
        <td><input class="case_buttons" name="accept_btn" id="accept_btn" type="button" value="Accept Response" <?php echo $accept_disabled; ?> /></td>
        <td><input class="case_buttons" name="reject_btn" id="reject_btn" type="button" value="Reject Response" <?php echo $reject_disabled; ?>  /></td>
        <td><input class="case_buttons" name="newdoc_btn" id="newdoc_btn" type="button" value="New Doctor" <?php echo $newdoc_disabled; ?> /></td>
        <td><input class="case_buttons" name="refund_btn" id="refund_btn" type="button" value="Request Refund" disabled="disabled" <?php echo $refund_disabled; ?> /></td>
      </tr>
    </table>
  </div>
  <div class="post_message clearfix">
    <textarea name="answer_msg" id="answer_msg"></textarea>
    <br />
    <span class="left">
    <input name="information_radio" type="checkbox" value="1" <?php echo $radio_disabled; ?> />
    &nbsp;&nbsp;Set as Information Provided</span> <span class="right">
    <input class="case_buttons" name="postmsg_btn" id="postmsg_btn" type="submit" value="Post Message" />
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