<?php defined( '_JEXEC' ) or die( 'Access to this location is RESTRICTED.' );	

	$logo				    			= $this->params->get("logo");
	$width 								= $this->params->get("width");
	$leftwidth 							= $this->params->get("leftwidth");
	$rightwidth 						= $this->params->get("rightwidth");
	$show_backlink 						= $this->params->get("showBacklink" );
	$show_pathway 						= $this->params->get("showPathway" );

	$app = JFactory::getApplication();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >

<head>

<?php require("head.php"); ?>
<jdoc:include type="head" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
<link href="css/template.css?v=1" rel="stylesheet" type="text/css" />

</head>
<body>
<div id="main">
<div class="container">
<table class="content-table" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="<?php echo $leftwidth; ?>" id="left-column" valign="top">
    	<div id="left_out">
            <div id="left_topright">
                <div id="logo">
                  	<div align="center"><a href="<?php echo $this->baseurl; ?>" >
                  	<?php if ( strlen ($logo) >= 6 ) {
							echo '<img src="'.$logo.'" alt="logo" />';
						} else {
							echo '<img src="templates/massarbeit/images/logo.jpg" alt="logo" />';
						}
					?>
                    </a></div>
                </div>
                <div class="sidebar"><jdoc:include type="modules" name="left" style="rounded" /></div> 
            </div>
   	    </div>
    </td>
    <td valign="top">
    	<div id="right_out">
            <div id="header">
                <div id="schriftzug"><?php echo $app->getCfg('sitename'); ?></div>
                <div id="navigation"><jdoc:include type="modules" name="position-1" /></div>
            </div>
            <?php if($show_pathway == 0) {	?> 
            <div id="pathway_out"> 
                <div class="box_tl">
                <div class="box_tr">
                <div class="box_bl">
                <div class="box_br">
                    <div id="pathway"><jdoc:include type="modules" name="position-2" /></div>
                    <?php if($this->countModules('position-0')) { ?>
                        <div id="suche"><jdoc:include type="modules" name="position-0" /></div>
                    <?php } ?>
                    <div class="clearfloat"></div>
                </div>
                </div>
                </div>
                </div>
            </div>
            <?php } ?>
            <div id="maincontent">
        		<?php if($this->countModules('right')) { ?>
                    <div id="right">
                        <div class="sidebar"><jdoc:include type="modules" name="right" style="rounded" /></div>
                    </div>
              <?php } ?>
                <div id="content_out<?php echo $contentwidth; ?>">
					<?php if($this->countModules('position-2 or position-3')) : ?>
                    <div id="box_content">
						<?php if($this->countModules('position-2')) : ?> 
                        <div id="top_module_<?php echo $topmodulewidth; ?>" style="float:left;">
                        <div class="user"><jdoc:include type="modules" name="position-3" style="rounded" /></div>
                        </div>
						<?php endif; ?>
						<?php if($this->countModules('position-3')) : ?> 
                        <div id="top_module_<?php echo $topmodulewidth; ?>" style="float:right;">
                        <div class="user"><jdoc:include type="modules" name="position-4" style="rounded" /></div>
                        </div>
						<?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <div class="error-msgs"><jdoc:include type="message" /></div>
                    <div id="content">
                        <div id="component"><jdoc:include type="component" /></div>
                    </div>
                </div>
            </div>
            <div class="clearfloat"></div>
        </div>
        </td>
  </tr>
</table>  
</div>
</div>
<!-- Main END -->

<?php if($this->countModules('position-5 or position-6 or position-7 or position-8')) { ?>
<div id="bottom">
    <div class="container">
 	 	<div id="userbottom">
 			<?php if($this->countModules('position-5')) : ?>
 				<div class="user<?php echo $position_width; ?>"><jdoc:include type="modules" name="position-5" style="xhtml" /></div>
	 		<?php endif; ?>
     		<?php if($this->countModules('position-6')) : ?>
        		<div class="separator"></div>
           		<div class="user<?php echo $position_width; ?>"><jdoc:include type="modules" name="position-6" style="xhtml" /></div>
			 <?php endif; ?>
            <?php if($this->countModules('position-7')) : ?>
             	<div class="separator"></div>
               	<div class="user<?php echo $position_width; ?>"><jdoc:include type="modules" name="position-7" style="xhtml" /></div>
            <?php endif; ?>
            <?php if($this->countModules('position-8')) : ?>
             	<div class="separator"></div>
				<div class="user<?php echo $position_width; ?>"><jdoc:include type="modules" name="position-8" style="xhtml" /></div>
            <?php endif; ?>
		</div>
    </div>
</div>
<?php } ?>

<!-- Bottom END -->
<div id="footer">
    <div class="container">
        <span class="sitetitle">&copy; <?php echo JHTML::Date( 'now', 'Y' ); ?> <?php echo $app->getCfg('sitename'); ?></span>
        <span class="footer">Solution By <a target="_blank" href="http://www.maadya.com">Maadya Digital</a>.</span>
    </div>
</div>

</body>
</html>