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

$sortby_array = array(1 => 'Date', 'Subject', 'Category', 'Status', 'Price', 'Doctor', 'Estimated Deadline/Sealed Time');

$staus_list = TellMeMDHelper::getStatusArray('all', 'All Status');

$user =& JFactory::getUser();
if($this->view_type == CASE_VIEW_TYPE_PATIENT)
    $welcome_note = 'Welcome '.$user->name.'!';
if($this->view_type == CASE_VIEW_TYPE_DOCTOR)
    $welcome_note = 'Welcome Dr. '.$user->name.'!';
if($this->view_type == CASE_VIEW_TYPE_POOL)
    $welcome_note = '';
?>

<form name="casetableform" id="casetableform" action="<?php echo COMPONENT_FRONT_LINK; ?>" method="post">
  <input type="hidden" name="controller" value="<?php echo $this->controller_name; ?>" />
  <input type="hidden" name="task" value="<?php echo $this->task_name; ?>" />
  
  <div class="welcome_note">
    <h3><?php echo $welcome_note;?></h3>
  </div>
  <div class="blue_wrapper clearfix">
    <div class="gray_line clearfix">
      <div id="data-form-box">
        <div id="filter-table-box" class="clearfix">
          <div id="left-sort">
            <div id="sort-by-list"> <span>Sort By:
              <select name="sort_by" id="sort_by" class="input_left_sort">
                <option value="date">Date</option>
              </select>
              </span> </div>
          </div>
          <div id="right-sort">
            <table id="filter-table">
              <tr>
                <td>
                    <?php echo TellMeMDHelper::createList('filter_cats', 0, $this->cat_list, 0, 'input_right_sort'); ?>
                    </td>
                <td>
                    <?php echo TellMeMDHelper::createList('filter_status', 0, $staus_list, 0, 'input_right_sort'); ?>
                <td><select name="filter" class="input_right_sort">
                    <option value="" >All Cases</option>
                  </select></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="data_table">
        <table class="adminlist">
          <thead>
            <tr>
              <th>CID</th>
              <th>Date</th>
              <th>Subject</th>
              <th>Category</th>
              <th>Status</th>
              <th>Price</th>
              <?php
              if($this->view_type == CASE_VIEW_TYPE_PATIENT)
                  echo '<th>Doctor</th>';
              else
                  echo '<th>Patient</th>';
              ?>
              <th><span style="color:#ff0000;">Estimated<br />
                Deadline</span>/<br />
                <span style="color:#008056;">Sealed<br />
                Time</span></th>
              <th>DL1</th>
              <th>DL2</th>
              <th>Case Type</th>
              <th>Answer Medium</th>
              <th>Urgency Level</th>
              <th>Level of Details</th>
              <?php
              if($this->view_type != CASE_VIEW_TYPE_POOL)
              {
              ?>
              <th>FB1</th>
              <th>FB2</th>
              <?php
              }
              else
              {
                  echo '<th>Accept</th>';
              }
              ?>
            </tr>
          </thead>
          <tfoot>
              <tr>
                  <td colspan="16"><?php echo $this->pagination->getListFooter(); ?></td>
              </tr>
          </tfoot>
          <tbody>
              <?php
              if(!empty ($this->case_data))
              {
                  foreach($this->case_data as $case)
                  {
                      $case_id = 'AA'.  str_pad((int)$case->id, 5, '0', STR_PAD_LEFT);
                      $update_date = date('d/m/y T G:i:s', strtotime($case->date_added));
                      $deadline_date = date('d/m/y T G:i:s', strtotime($case->deadline_time));
                      $link = JRoute::_(COMPONENT_LINK.'&controller=cases&task=viewcase&cid='.$case->id.'&view_type='.$this->view_type);
                      if($this->view_type == CASE_VIEW_TYPE_PATIENT)
                      {
                          if($case->doctor_id)
                          {
                              $extuser = JFactory::getUser($case->doctor_id);
                              $extname = 'Dr. '.$extuser->name;
                          }
                          else
                              $extname = '';
                      }
                      else
                      {
                          $extuser = JFactory::getUser($case->patient_id);
                          $extname = $extuser->name;
                      }
                      
                      ?>
              <tr>
                  <td>
                      <?php echo JHtml::link($link, $case_id); ?>
                  </td>
                  <td>
                      <?php echo $update_date; ?>
                  </td>
                  <td align="right">
                      <?php echo $case->subject; ?>
                  </td>
                  <td>
                      <?php echo $case->cat_name; ?>
                  </td>
                  <td>
                      <?php echo TellMeMDHelper::getStatusArray($case->status); ?>
                  </td>
                  <td>
                      <?php echo '$'.$case->price; ?>
                  </td>
                  <td>
                      <?php echo $extname; ?>
                  </td>
                  <td>
                      <?php echo $deadline_date; ?>
                  </td>
                  <td>
                      <div class="DL1">
                          <?php
                          if($case->deadline1 == 0)
                              echo '<div class="active"></div>';
                          else
                              echo '<div class="inactive" style="display:block;"></div>';
                          ?>
                      </div>
                  </td>
                  <td>
                      <div class="DL2">
                          <?php
                          if($case->deadline2 == 0)
                              echo '<div class="active"></div>';
                          else
                              echo '<div class="inactive" style="display:block;"></div>';
                          ?>
                      </div>
                  </td>
                  <td>
                      <div class="case_type">
                      	<?php
                          if($case->case_type == CASE_TYPE_QUEANS)
                          {
                              echo '<div class="questions">';
                              echo '<div class="active"></div>';
                              echo '<div class="inactive"></div>';
                              echo '</div>';
                          }
                          if($case->case_type == CASE_TYPE_LABTEST)
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
                          if($case->answer_medium == MEDIUM_TYPE_FORM_SUBMIT)
                          {
                              echo '<div class="report">';
                              echo '<div class="active"></div>';
                              echo '<div class="inactive"></div>';
                              echo '</div>';
                          }
                          if($case->answer_medium == MEDIUM_TYPE_LIVE_CHAT)
                          {
                              echo '<div class="chat">';
                              echo '<div class="active"></div>';
                              echo '<div class="inactive"></div>';
                              echo '</div>';
                          }
                          if($case->answer_medium == MEDIUM_TYPE_SKYPE)
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
                      <?php echo TellMeMDHelper::getPriorityCodeArray($case->urgency_level); ?>
                  </td>
                  <td>
                      <?php echo TellMeMDHelper::getPriorityCodeArray($case->detail_level); ?>
                  </td>
                  <?php
                  if($this->view_type != CASE_VIEW_TYPE_POOL)
                  {
                  ?>
                  <td>
                      <div class="FB1"></div>
                  </td>
                  <td>
                      <div class="FB2"></div>
                  </td>
                  <?php
                  }
                  else
                  {
                      ?>
                  <td></td>
                  <?php
                  }
                  ?>
              </tr>
              <?php
                  }
              }
              ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</form>
