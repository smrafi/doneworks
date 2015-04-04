<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <jdoc:include type="head" />
    <link rel="stylesheet" href="<?php echo JURI::root(); ?>templates/system/css/system.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo JURI::root(); ?>templates/system/css/general.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo JURI::root(); ?>templates/tellmemd_template/css/style.css" type="text/css" />
    <!--    <script src="<?php //echo JURI::root(); ?>/modules/mod_question_panel/js/jquery-1.4.2.min.js" type="text/javascript"></script>
    <script src="<?php //echo JURI::root(); ?>/modules/mod_question_panel/js/tabs.js" type="text/javascript"></script>
    <script src="<?php //echo JURI::root(); ?>/modules/mod_question_panel/js/jquery.jcarousel.pack.js"  type="text/javascript"></script>
    <script src="<?php //echo JURI::root(); ?>/modules/mod_question_panel/js/loopedslider.js"  type="text/javascript"></script>-->
    <script type="text/javascript">    
            jQuery(document).ready(function() {			
                jQuery('#third-carousel').jcarousel({
                    vertical: true
                });
            });		
	</script>
    <script type="text/javascript" src="<?php echo JURI::root(); ?>/modules/mod_question_panel/js/imagepreloader.js"></script>
    <script type="text/javascript">
        preloadImages([
            '../images/prev-h.gif', 
            '../images/next-h.gif']);
    </script>
    </head>
    <body>
<?php 
	$mainframe = JFactory::getApplication();
	$params =& $mainframe->getParams();
    $document =& JFactory::getDocument();
	$title = $params->get('page_heading');
	if($title == '')
		$title = $document->getTitle();
		
	$controller = JRequest::getVar('controller','');
    $task = JRequest::getVar('task','');
	
	$menu = JSite::getMenu();
	if($active = $menu->getActive())        //Dev Rafi - Modified to avoid php warnings
        {
            $activeId = $active->id;
            $menutitle = $active->title;
            $alias = $menu->getItem($activeId)->alias;
        }
	$currentMenuParent = $active->parent_id;
	 ?>
<div class="main_wrapper">
      <div class="header_wrapper">
    <div class="login_panel">
          <jdoc:include type="modules" name="login_panel" style="xhtml" />
        </div>
    <div class="logo_wrapper clearfix">
          <table width="100%">
        <tr>
              <td><div class="logo"><img src="<?php echo JURI::root(); ?>templates/tellmemd_template/images/logo.jpg" /></div></td>
              <td><jdoc:include type="modules" name="confidential" style="xhtml" /></td>
              <td width="410px"><div class="header_right">
                  <jdoc:include type="modules" name="header_right" style="xhtml" />
                </div></td>
            </tr>
      </table>
        </div>
    <div class="main_menu">
          <jdoc:include type="modules" name="main_menu" style="xhtml" />
        </div>
    <?php
	$user   = &JFactory::getUser();
    $usr_id = $user->get('id');
    $userGroups = $user->get('groups');
	$uid    = $user->get('id');
    $group='';
	foreach( $userGroups as $key => $val ) {
    $group=$key;
     }
	?>
    <?php if (JRequest::getVar('view') != "featured" ) { ?>
    <?php if(($group == 'Patients')) :?>
    <div class="patients_menu">
          <jdoc:include type="modules" name="patients_menu" style="xhtml" />
        </div>
    <?php endif; ?>
    <?php if(($group == 'Doctors')):?>
    <div class="patients_menu">
          <jdoc:include type="modules" name="doctors_menu" style="xhtml" />
        </div>
    <?php endif; ?>
    <?php  } ?>
    <?php if (($activeId == '101') or ($activeId == '102') or ($activeId == '103') or ($activeId == '104') or $controller = 'patient') {?>
    <div class="page_title" style="display:none"></div>
    <?php } else { ?>
    <div class="page_title">
          <div class="title_text">
        <h1>
              <?php  echo $title; ?>
            </h1>
      </div>
        </div>
    <?php  } ?>
  </div>
      <div class="question_pane">
    <jdoc:include type="modules" name="question_pane" style="xhtml" />
  </div>
      <div class="doctor_slider">
    <jdoc:include type="modules" name="doctor_slider" style="xhtml" />
  </div>
      <!-- Display joomla errors -->
      <div class="joom_messages" id="header">
    <jdoc:include type="message" />
  </div>
      <?php if($this->countModules('right_module')){ ?>
      <div class="content_area clearfix">
    <?php if ($menu->getActive() == $menu->getDefault()) { // No Menu Item Title or Page Heading if Home Page ?>
    <div class="content">
          <jdoc:include type="component" />
        </div>
    <div class="right_module">
          <jdoc:include type="modules" name="right_module" style="xhtml" />
        </div>
  </div>
      <?php } else { ?>
      <div class="content_area clearfix" style="background-color:#f6fbff; border-radius:10px 10px 10px 10px; padding:20px; border-bottom:1px solid #D3D3D3; border-left:1px solid #D3D3D3; border-right:1px solid #D3D3D3; border-top:1px solid #D3D3D3; ">
    <div class="content">
          <jdoc:include type="component" />
        </div>
    <div class="right_module">
          <jdoc:include type="modules" name="right_module" style="xhtml" />
        </div>
  </div>
      <?php } ?>
      <?php } else { ?>
      <div class="content_area clearfix">
    <div class="content_full_width">
          <jdoc:include type="component" />
        </div>
    <?php } ?>
  </div>
    </div>
<div class="footer_full_width">
      <div class="main_wrapper">
    <div class="footer_menu">
          <jdoc:include type="modules" name="footer_menu" style="xhtml" />
          <br />
          Copyright © TellmeMD. All Rights Reserved.<br />
          Design & development by <a href="http://www.archmage.lk">Archmage</a>. </div>
  </div>
    </div>
</body>
</html>
