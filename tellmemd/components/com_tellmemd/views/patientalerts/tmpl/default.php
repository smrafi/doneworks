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
// echo 'Patient -> Alerts';
?>

<div class="blue_wrapper clearfix">
  <div class="gray_line clearfix">
    <div id="filter-table-box" class="clearfix">
      <div id="left-sort">
        <div id="sort-by-list"> <span>Sort By:
            <select name="sort_by" class="input_left_sort"><option value="" default>Date</option></select>
          </select>
          </span> <span>
          <input type="button" name="delete" value="Delete" class="delete"/>
          </span> <span>
          <select name="sort_by" class="input_left_sort"><option value="" default>Mark</option></select>
          </select>
          </span> </div>
      </div>
      <div id="right-sort">
        <table id="filter-table">
          <tr>
            <td><select name="filter" class="input_right_sort"><option value="" default>All Alerts</option></select>
              </select></td>
            <td><select name="filter" class="input_right_sort"><option value="" default>All Types</option></select>
              </select></td>
          </tr>
        </table>
      </div>
    </div>
    <div class="data_table">
            
        <table class="adminlist" cellspacing="0">    
        <thead>
        <tr>
        <th><input type="checkbox" /></th>
        <th>Alert #</th>
        <th>Date</th>
        <th>Subject</th>
        <th>Type</th>
        <th>From</th>
        </thead>
        <tbody>
        </tr>
        <tr>
        <td><input type="checkbox" /></td>
        <td><a href="#">10</a></td>
        <td>01/06/11<br />CST 16:02:00</td>
        <td>Lorem ipsum dolor sit amet, consectetur</td>
        <td><b>Deadline</b></td>
        <td><b>System</b></td>
        </tr>
        </tbody>
        </table>
        
            
            </div>
  </div>
</div>
