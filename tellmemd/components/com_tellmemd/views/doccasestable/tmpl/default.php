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

?>
<form name="cases_form" id="cases_form" action="<?php echo COMPONENT_FRONT_LINK; ?>" method="post">
<div class="welcome_note">
  <h3><?php echo 'Welcome Dr. Loren Gray!';?></h3>
</div>
<div class="blue_wrapper clearfix">
  <div class="gray_line clearfix">
    <div id="data-form-box">
      <div id="filter-table-box" class="clearfix">
        <div id="left-sort">
          <div id="sort-by-list"> <span>Sort By:
            <select name="sort_by" class="input_left_sort">
              <option value="" default>Date</option>
            </select>
            </span> </div>
        </div>
        <div id="right-sort">
          <table id="filter-table">
            <tr>
              <td><select name="filter" class="input_right_sort">
                  <option value="" default>All Category</option>
                </select></td>
              <td><select name="filter" class="input_right_sort">
                  <option value="" default>All Status</option>
                </select></td>
              <td><select name="filter" class="input_right_sort">
                  <option value="" default>All Cases</option>
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
            <th>Patient</th>
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
            <th>FB1</th>
            <th>FB2</th>
        </thead>
        <tbody>
            </tr>
          
          <tr>
            <td><a href="#">A00001</a></td>
            <td>01/06/11<br />
              CST 18:20</td>
            <td align="right">Lorem ipsum dolor sit amet, consectetur</td>
            <td>General</td>
            <td>Accepted</td>
            <td>$22</td>
            <td><a href="#">Ethen Bee</a></td>
            <td>01/06/11<br />
              CST 18:20</td>
            <td><div class="DL1">
                <div class="active"></div>
                <div class="inactive"></div>
              </div></td>
            <td><div class="DL2">
                <div class="active"></div>
                <div class="inactive"></div>
              </div></td>
            <td><div class="case_type">
                <div class="active"></div>
                <div class="inactive"></div>
              </div></td>
            <td><div class="answer_medium">
                <div class="report">
                  <div class="active"></div>
                  <div class="inactive"></div>
                </div>
                <div class="chat" style="display:none">
                  <div class="active"></div>
                  <div class="inactive"></div>
                </div>
                <div class="skype" style="display:none">
                  <div class="active"></div>
                  <div class="inactive"></div>
                </div>
              </div></td>
            <td>M</td>
            <td>H</td>
            <td><div class="FB1">
                <div class="active"></div>
                <div class="inactive"></div>
              </div></td>
            <td><div class="FB2">
                <div class="active"></div>
                <div class="inactive"></div>
              </div></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
</form>