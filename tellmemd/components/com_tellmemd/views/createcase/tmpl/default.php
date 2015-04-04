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

?>

<div class="brown_wrapper">
<div class="new_case">
<div class="question_main_wrapper clearfix">
<div class="col-0">120 Doctors are Online Now</div>
<div class="col-1">
  <div class="wrapper clearfix">
    <ul class="tabs">
      <li id="first"><a href="#tab1">Question and Answer</a></li>
      <li id="second"><a href="#tab2">Read Lab Report</a></li>
    </ul>
    <!--  Tab 1-->
    <div class="tab_container">
      <div class="tab_content_wrapper clearfix">
        <div id="tab1" class="tab_content">
          <div class="padding_container">
            <ul class="submenu">
              <?php
              $count = 1;
              $more_tabs = '<div class="more-tabs" style="display:none">';
              foreach($this->cat_list as $id => $name)
              {
                  if($count == 1)
                      echo '<li id="first_div"> <a href="#value-'.$id.'" catname="'.$name.'">'.$name.'</a></li>';
                  elseif($count > 11)
                  {
                      if($count == 12)
                          echo '<li id="last"> <a href="#">More</a></li>';
                      $more_tabs .= '<li> <a href="#value-'.$id.'" catname="'.$name.'">'.$name.'</a></li>';
                  }
                  else
                      echo '<li> <a href="#value-'.$id.'" catname="'.$name.'">'.$name.'</a></li>';
                  
                  
                  $count++;
              }
              $more_tabs .= '</div>';
              echo $more_tabs;
              ?>
            </ul>
          </div>
        </div>
        <div id="right_div_cats" class="right_div">
        <h3>Type your question below</h3>
        
        <form name="questionform" id="questionform" action="<?php echo COMPONENT_FRONT_LINK; ?>" method="post">
            <input type="hidden" name="controller" value="patient" />
            <input type="hidden" name="task" value="processque" />
        <table>
        <tr>
        <td><label>Category</label></td><td><label class="category">General</label></td>
        </tr>
        <tr>
        <td><label>Subject</label></td><td><input type="text" name="que_subject" id="que_subject" width="25"/></td>
        </tr>
        <tr>
        <td><label>Question</label></td><td></td>
        </tr>
        <tr>
        <td colspan="2">
            <textarea name="que_content" id="que_content" rows="3" cols="20"> </textarea>
            <input type="hidden" name="cat_id" id="cat_id" value=""/>
        </td>
        </tr>
        <tr>
        <td colspan="2" align="center"><input class="button" type="submit" value="Get an Answer" /></td>
        </tr>
		</table>
		</form>
        
        </div>
        
        <!--Tab 2-->
        <div id="tab2" class="tab_content">
          <div class="padding_container">
            <ul class="submenu">
              <?php
              $count = 1;
              $more_tabs = '<div class="more-tabs-lab" style="display:none">';
              foreach($this->labtest_list as $id => $name)
              {
                  if($count == 1)
                  {
                      echo '<li id="first_div"> <a href="#value-'.$id.'" labname="'.$name.'">'.$name.'</a></li>';
                      $first_test = $name;
                      $first_id = $id;
                  }
                  elseif($count > 11)
                  {
                      if($count == 12)
                          echo '<li id="last"> <a href="#">More</a></li>';
                      $more_tabs .= '<li> <a href="#value-'.$id.'" labname="'.$name.'">'.$name.'</a></li>';
                  }
                  else
                      echo '<li> <a href="#value-'.$id.'" labname="'.$name.'">'.$name.'</a></li>';
                  
                  
                  $count++;
              }
              $more_tabs .= '</div>';
              echo $more_tabs;
              ?>
            </ul>
          </div>
        </div>
        <div id="right_div_labtest" class="right_div">
        <h3>Enter or Attach Lab Details</h3>
        <form name="labreportform" id="labreportform" action="<?php echo COMPONENT_FRONT_LINK; ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="controller" value="patient" />
            <input type="hidden" name="task" value="processlab" />
		<label>Lab Test</label>
        <label class="test-name"><?php echo $first_test; ?></label>
        <span id="template-download"><a href=""><input class="button_dwnload" type="button" value="Download Template" /></a></span>
		<br />
		<label>Subject</label><input class="subject" name="lab_subject" id="lab_subject" type="text" width="25"/>
        <br />
		<label>Details</label><br />
		<textarea name="lab_content" id="lab_content" rows="3" cols="20"> </textarea>
                <input type="hidden" name="lab_id" id="lab_id" value="<?php echo $first_id; ?>"/>
        <br />
        <input type="file" name="template_file" id="template_file" size="4" />
        <input class="button_attach" type="button" value="Attach Report" />
		<input class="button_int" type="submit" value="Get Interpretation" />
		</form>
        </div>
      </div>
    </div>
  </div>
</div>



</div>
</div>
</form>