<link rel="stylesheet" href="templates/_system/css/general.css" type="text/css" />
<link rel="stylesheet" href="templates/<?php echo $this->template ?>/css/template.css" type="text/css" />

<?php
if($this->countModules("right")){ $contentwidth="right";}
if(!$this->countModules("right")) {$contentwidth="noright"; }
if($this->countModules("position-1")&&$this->countModules("position-2")) {$topmodulewidth="2";}
if(!$this->countModules("position-1")&&$this->countModules("position-2")) {$topmodulewidth="1";}
if($this->countModules("position-1")&&!$this->countModules("position-2")) {$topmodulewidth="1";}
if($this->countModules("position-5")&&$this->countModules("position-6")&&$this->countModules("position-7")&&$this->countModules("position-8")) {$position_width="4";}
if(!$this->countModules("position-5")&&$this->countModules("position-6")&&$this->countModules("position-7")&&$this->countModules("position-8")) {$position_width="3";}
if($this->countModules("position-5")&&!$this->countModules("position-6")&&$this->countModules("position-7")&&$this->countModules("position-8")) {$position_width="3";}
if($this->countModules("position-5")&&$this->countModules("position-6")&&!$this->countModules("position-7")&&$this->countModules("position-8")) {$position_width="3";}
if($this->countModules("position-5")&&$this->countModules("position-6")&&$this->countModules("position-7")&&!$this->countModules("position-8")) {$position_width="3";}
if(!$this->countModules("position-5")&&!$this->countModules("position-6")&&$this->countModules("position-7")&&$this->countModules("position-8")) {$position_width="2";}
if(!$this->countModules("position-5")&&$this->countModules("position-6")&&!$this->countModules("position-7")&&$this->countModules("position-8")) {$position_width="2";}
if(!$this->countModules("position-5")&&$this->countModules("position-6")&&$this->countModules("position-7")&&!$this->countModules("position-8")) {$position_width="2";}
if($this->countModules("position-5")&&!$this->countModules("position-6")&&!$this->countModules("position-7")&&$this->countModules("position-8")) {$position_width="2";}
if($this->countModules("position-5")&&!$this->countModules("position-6")&&$this->countModules("position-7")&&!$this->countModules("position-8")) {$position_width="2";}
if($this->countModules("position-5")&&$this->countModules("position-6")&&!$this->countModules("position-7")&&!$this->countModules("position-8")) {$position_width="2";}
if(!$this->countModules("position-5")&&!$this->countModules("position-6")&&!$this->countModules("position-7")&&$this->countModules("position-8")) {$position_width="1";}
if(!$this->countModules("position-5")&&!$this->countModules("position-6")&&$this->countModules("position-7")&&!$this->countModules("position-8")) {$position_width="1";}
if(!$this->countModules("position-5")&&$this->countModules("position-6")&&!$this->countModules("position-7")&&!$this->countModules("position-8")) {$position_width="1";}
if($this->countModules("position-5")&&!$this->countModules("position-6")&&!$this->countModules("position-7")&&!$this->countModules("position-8")) {$position_width="1";}
?>

<style type="text/css">
	.container { width: <?php echo $width; ?>; }
	#left_out { width: <?php echo $leftwidth; ?> ; }
	#right { width: <?php echo $rightwidth; ?> ; }
    <?php if($this->countModules('right')) : ?> #content_outright { margin-right: <?php echo $rightwidth; ?>; } <?php endif; ?>
	<?php if($show_backlink == 1) { ?> span.footer, span.footer a { color: #111111 !important; } <?php } ?>
</style>