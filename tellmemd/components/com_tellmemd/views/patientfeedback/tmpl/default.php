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
// echo 'Patient -> Feedback';
?>

<div class="blue_wrapper clearfix">
  <div class="gray_line clearfix">
    <div class="key_area">
      <table width="200" border="0" class="feedback_key" cellspacing="0">
        <tr>
          <td class="title"><img src="<?php echo JURI::root(); ?>templates/tellmemd_template/images/positive.png" />Positive</td>
          <td class="value">3</td>
        </tr>
        <tr>
          <td class="title"><img src="<?php echo JURI::root(); ?>templates/tellmemd_template/images/natural.png" />Neutral</td>
          <td class="value">1</td>
        </tr>
        <tr>
          <td class="title"><img src="<?php echo JURI::root(); ?>templates/tellmemd_template/images/negative.png" />Negative</td>
          <td class="value">1</td>
        </tr>
      </table>
    </div>
    <div class="feedback_table">
      <div id="filter-table-box" class="clearfix">
        <div id="left-sort">
          <div id="sort-by-list"> <span>Sort By:
              <select name="sort_by" class="input_left_sort"><option value="" default>Date</option>
            </select>
            </span> </div>
        </div>
        <div id="right-sort">
          <table id="filter-table">
            <tr>
              <td><select name="filter" class="input_right_sort"><option value="" default>All Feedback</option>
                </select></td>
            </tr>
          </table>
        </div>
      </div>
      
                  <div class="data_table">
            
            <table class="adminlist">
            
        <thead>
        <tr>
        <th>CID</th>
        <th>Date</th>
        <th>Subject</th>
        <th>Doctor</th>
        <th>Feedback</th>
        <th>Comment</th>
        </tr>
        </thead>
        <tbody>
        </tr>
        <tr>
        <td><a href="#">A00001</a></td>
        <td>01/06/11<br />CST 18:20</td>
        <td class="comment">Lorem ipsum dolor sit amet, consectetur</td>
        <td>Dr. Sally</td>
        <td><img src="<?php echo JURI::root(); ?>templates/tellmemd_template/images/positive.png" /></td>
        <td class="comment">Lorem ipsum dolor sit amet, consecteturLorem ipsum dolor sit amet, consecteturLorem ipsum dolor sit amet, consecteturLorem ipsum dolor sit amet, consectetur				</td>
        </tr>
        </tbody>
        </table>
        
            
            </div>
    </div>
  </div>
</div>
