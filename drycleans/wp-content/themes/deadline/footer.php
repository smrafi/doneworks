<?php include( TEMPLATEPATH . '/functions/get-options.php' ); /* include theme options */ ?>

		<!-- END #content -->
		</div>
			
		<!-- BEGIN #footer -->
		<div id="footer">
		
			<!-- BEGIN #foot-inner -->
			<div id="foot-inner" class="clearfix">
				
				<?php	/* Widgetised Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer 1') ) ?>
				
				<?php	/* Widgetised Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer 2') ) ?>
				
				<?php	/* Widgetised Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer 3') ) ?>
				
				<?php	/* Widgetised Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer 4') ) ?>
				
			<!-- END #foot-inner -->
			</div>

		
		<!-- END #footer -->
		</div>
		
		<!-- BEGIN #foot-notes -->
		<div id="foot-notes">
		
			<p class="copyright">&copy; <?php the_time( 'Y' ); ?> <a href="<?php bloginfo( 'url' ); ?>"><?php bloginfo( 'name' ); ?></a></p>
			
			<p class="credit"><?php _e('Powered by', 'framework') ?> <a href="http://themecrunch.blogspot.com/2010/11/deadline.html">Deadline Theme</a></p>
		
		<!-- END #foot-notes -->
		</div>
		
	<!-- END #container -->
	</div> 
	<!-- Theme Hook -->
	<?php wp_footer(); ?>
	
	<?php if ($tz_g_analytics) { /* if google analytics is set in theme options then show code */ echo stripslashes($tz_g_analytics); } ?>
			
<!--END body-->
</body>
<!--END html-->
</html>