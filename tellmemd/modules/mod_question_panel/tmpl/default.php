<?php
//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?>

<div class="question_main_wrapper clearfix">
<div class="col-0">120 Doctors are Online Now</div>
<div class="col-1">
  <div class="wrapper">
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
              <li id="first_div"><a href="#right_div1">General</a></li>
              <li><a href="#right_div1">Anemia</a></li>
              <li><a href="#right_div1">Cold and Flu</a></li>
              <li><a href="#right_div1">Diabetes</a></li>
              <li><a href="#right_div1">Ear,Nose and Throat</a></li>
              <li><a href="#right_div1">Muscle Pains</a></li>
              <li><a href="#right_div1">Heartburn and GERD</a></li>
              <li id="last"><a href="#right_div1">More</a></li>
            </ul>
          </div>
        </div>
        <div id="right_div1" class="right_div">
        <h3>Type your question below</h3>
        
        <form>
        <table>
        <tr>
        <td><label>Category</label></td><td><label class="category">General</label></td>
        </tr>
        <tr>
        <td><label>Subject</label></td><td><input type="text" width="25"/></td>
        </tr>
        <tr>
        <td><label>Question</label></td><td></td>
        </tr>
        <tr>
        <td colspan="2"><textarea rows="3" cols="20"> </textarea></td>
        </tr>
        <tr>
        <td colspan="2" align="right"><input class="button" type="button" value="Get an Answer" /></td>
        </tr>
		</table>
		</form>
        
        </div>
        
        <!--Tab 2-->
        <div id="tab2" class="tab_content">
          <div class="padding_container">
            <ul class="submenu">
              <li id="first_div"><a href="#right_div9">Lab Test 1</a></li>
              <li><a href="#right_div9">Lab Test 2</a></li>
              <li><a href="#right_div9">Lab Test 3</a></li>
              <li><a href="#right_div9">Lab Test 4</a></li>
              <li><a href="#right_div9">Lab Test 5</a></li>
              <li><a href="#right_div9">Lab Test 6</a></li>
              <li><a href="#right_div9">Lab Test 7</a></li>
              <li id="last"><a href="#right_div16">More</a></li>
            </ul>
          </div>
        </div>
        <div id="right_div9" class="right_div">
        <h3>Enter or Attach Lab Details</h3>
        <form>
		<label>Lab Test</label>
        <label class="category">Test 1</label><span><input class="button_dwnload" type="button" value="Download Template" /></span>
		<br />
		<label>Subject</label><input class="subject" type="text" width="25"/>
        <br />
		<label>Details</label><br />
		<textarea rows="3" cols="20"> </textarea>
        <br />
        <input class="button_attach" type="button" value="Attach Report" />
		<input class="button_int" type="button" value="Get Interpretation" />
		</form>
		</form>
        
        
        
        
        
        
        
        
        </div>
        <div id="right_div10" class="right_div">Test 2 Content</div>
        <div id="right_div11" class="right_div">Test 3 Content</div>
        <div id="right_div12" class="right_div">Test 4 Content</div>
        <div id="right_div13" class="right_div">Test 5 Content</div>
        <div id="right_div14" class="right_div">Test 6 Content</div>
        <div id="right_div15" class="right_div">Test 7 Content</div>
        <div id="right_div16" class="right_div">Test 8 Content</div>
      </div>
    </div>
  </div>
</div>
