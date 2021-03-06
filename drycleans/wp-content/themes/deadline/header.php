<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php include( TEMPLATEPATH . '/functions/get-options.php' ); /* include theme options */ ?>

<!-- BEGIN html -->
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<!-- An Awesem design by Orman Clark (http://www.ormanclark.com + http://www.awesem.co.uk) - Proudly powered by WordPress (http://wordpress.org) -->

<!-- BEGIN head -->
<head profile="http://gmpg.org/xfn/11">

	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	
	<!-- Title -->
	<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo ($tz_favicon_url); ?>" />
	
	<!-- Stylesheets -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/<?php echo ($tz_theme_stylesheet); ?>" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/print.css" type="text/css" media="print" />
	
	<!-- RSS, Atom & Pingbacks -->
	<?php if ($tz_feedburner) { /* if FeedBurner URL is set in theme options */ ?>
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php echo ($tz_feedburner); ?>" />
	<?php } else { /* if not then use the standard WP feed */ ?>
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php bloginfo( 'rss2_url' ); ?>" />
	<?php } ?>
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo( 'rss_url' ); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo( 'atom_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<!-- Theme Hook -->
	<?php wp_enqueue_script("jquery"); /* load JQuery (modified to use Google over WP Bundle in functions.php) */ ?>
    <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); /* loads the javascript required for threaded comments */ ?>
	<?php wp_head(); ?>
	
	<!-- JS Scripts -->
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/superfish.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.color.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.custom.js"></script>
	
	<?php if (($tz_news_pictures == "true") && (is_home())) { /* if is hompage and "news in pcitures" is enabled */ ?>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.galleriffic.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.opacityrollover.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
		// We only want these styles applied when javascript is enabled
		$('#picture-posts .navigation').css({'width' : '300px', 'position' : 'absolute', 'left' : '320px', 'top' : '45px' });
		$('div.content').css('display', 'block');

		// Initially set opacity on thumbs and add
		// additional styling for hover effect on thumbs
		var onMouseOutOpacity = 0.67;
		$('#thumbs ul.thumbs li').opacityrollover({
			mouseOutOpacity:   onMouseOutOpacity,
			mouseOverOpacity:  1.0,
			fadeSpeed:         'fast',
			exemptionSelector: '.selected'
		});
		
		// Initialize Advanced Galleriffic Gallery
		var gallery = $('#thumbs').galleriffic({
			delay: <?php echo( $tz_news_delay); ?>,
			numThumbs: 16,
			preloadAhead: 10,
			enableTopPager: false,
			enableBottomPager: false,
			maxPagesToShow: 1,
			imageContainerSel: '#slideshow',
			controlsContainerSel: '#controls',
			captionContainerSel: '#caption',
			loadingContainerSel: '#loading',
			renderSSControls: false,
			renderNavControls: false,
			playLinkText: 'Play Slideshow',
			pauseLinkText: 'Pause Slideshow',
			prevLinkText:	 '&lsaquo; Previous Photo',
			nextLinkText: 'Next Photo &rsaquo;',
			nextPageLinkText: 'Next &rsaquo;',
			prevPageLinkText: '&lsaquo; Prev',
			enableHistory: false,
			autoStart: <?php echo ($tz_news_autostart); ?>,
			syncTransitions: true,
			defaultTransitionDuration: 900,
			onSlideChange: function(prevIndex, nextIndex) {	
				// 'this' refers to the gallery, which is an extension of $('#thumbs')
				this.find('ul.thumbs').children()
				.eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
				.eq(nextIndex).fadeTo('fast', 1.0);
			},
			onPageTransitionOut: function(callback) {
				this.fadeTo('fast', 0.0, callback);
			},
			onPageTransitionIn: function() {
				this.fadeTo('fast', 1.0);
			}
		});
	});
	</script>
	<?php } ?>
	
	<?php if (is_page_template('template-contact.php')) { /* if the page uses the contact form template then load validation js */ ?>
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.validate.min.js"></script>
		<script>
			$(document).ready(function(){
				$("#contactForm").validate();
			});
	  </script>
	<?php } ?>

<!-- END head -->
</head>

<!-- BEGIN body -->
<body <?php body_class(); ?>>

	<!-- BEGIN .container -->
	<div id="container">
	
		<!-- BEGIN #top-bar -->
		<div id="top-bar">
		
			<!-- BEGIN #top-bar-inner -->
			<div id="top-bar-inner">
			
				<!-- BEGIN #date -->
				<div id="date">
					<p class="rounded"><?php echo date("l d F Y"); ?></p>
				<!-- END #date -->
				</div>
				
				<!-- BEGIN #secondary-nav -->
				<div id="secondary-nav">
					<?php if ( has_nav_menu( 'secondary-menu' ) ) { /* if menu location 'secondary-menu' exists then use custom menu */ ?>
					<?php wp_nav_menu( array( 'theme_location' => 'secondary-menu' ) ); ?>
					<?php } else { /* else use wp_page_menu
					if the home link is set to true in theme options then show "home" button
					if excluded categories are set in theme options then exclude from menu */
					if ($tz_home_link == "true") {
					$home_text = __('Home', 'framework'); 
					} elseif ($tz_home_link == "false") {
					$home_text = ''; 
					}
					wp_page_menu( array( 'echo' =>1, 'show_home' => $home_text, 'exclude' => $tz_nav_exclude, 'sort_column' => $tz_nav_order ) ); } ?>	
				<!-- END #secondary-nav -->
				</div>
				
				<!-- BEGIN #feeds -->
				<div id="feeds">
					<a href="<?php if ($tz_feedburner) { /* if FeedBurner URL is set in options */ echo ($tz_feedburner); } else { bloginfo('rss2_url'); } ?>"><?php _e('Subscribe by RSS', 'framework') ?></a>
					<?php if ($tz_feedburner_email) { /* if FeedBurner Email URL is set in theme options */ ?>
					<a href="<?php echo ($tz_feedburner_email); ?>"><?php _e('Subscribe by Email', 'framework') ?></a>
					<?php } ?>
				<!-- END #feeds -->
				</div>
				
			<!-- END #top-bar-inner -->
			</div>
			
		<!-- END #top-bar -->
		</div>
	
		<!-- BEGIN .header -->
		<div id="header" class="clearfix">
			
			<!-- BEGIN #logo -->
			<div id="logo">
				<?php /*
				If "plain text logo" is set in theme options then use text
				if a logo url has been set in theme options then use that
				if none of the above then use the default logo.png */
				if ($tz_plain_logo == "true") { ?>
				<a href="<?php bloginfo( 'url' ); ?>"><?php bloginfo( 'name' ); ?></a>
				<p id="tagline"><?php bloginfo( 'description' ); ?></p>
				<?php } elseif ($tz_logo_url) { ?>
				<a href="<?php bloginfo( 'url' ); ?>"><img src="<?php echo ($tz_logo_url); ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
				<?php } else { ?>
				<a href="<?php bloginfo( 'url' ); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" width="255" height="68" /></a>
				<?php } ?>
			<!-- END #logo -->
			</div>
			
			<?php if ($tz_banner_header == "true") { /* Display 468x60 banner if checked in theme options */ ?>
			<!-- BEGIN #banner-header -->
			<div id="banner-header">
				<a href="<?php echo ($tz_banner_dest_url); ?>"><img src="<?php echo ($tz_banner_img_url); ?>" alt="banner" width="468" height="60" /></a>
			<!-- END #banner-header -->
			</div>
			<?php } ?>
			
		<!--END .header-->
		</div>
		
		<!-- BEGIN #primary-nav -->
		<div id="primary-nav" class="rounded">
			<?php if ( has_nav_menu( 'primary-menu' ) ) { /* if menu location 'primary-menu' exists then use custom menu */ ?>
			<?php wp_nav_menu( array( 'theme_location' => 'primary-menu' ) ); ?>
			<?php } else { /* else use wp_list_categories */ ?>
			<ul>
				<?php wp_list_categories( array( 'exclude' => $tz_primary_nav_exclude, 'title_li' => '' )); ?>
			</ul>
			<?php } ?>
		<!-- END #primary-nav -->
		</div>
		

		<!--BEGIN #content -->
		<div id="content" class="clearfix">
	