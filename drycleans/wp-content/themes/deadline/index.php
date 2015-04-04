<?php get_header(); ?>
<?php include( TEMPLATEPATH . '/functions/get-options.php' ); /* include theme options */ ?>
			
			<!--BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed">
			
				<?php include( TEMPLATEPATH . '/includes/latest-post.php' ); ?>
				
				<!-- BEGIN #top-blocks -->
				<div id="top-blocks" class="clearfix">
				
					<?php include( TEMPLATEPATH . '/includes/recent-posts.php' ); ?>
					
					<?php include( TEMPLATEPATH . '/includes/featured-posts.php' ); ?>
				
				<!-- END #top-blocks-->
				</div>
				
				<?php if ($tz_news_pictures == "true") { /* if news by pictures is enabled in theme options */ ?>
				<?php include( TEMPLATEPATH . '/includes/picture-posts.php' ); ?>
				<?php } ?>
				
				<?php if ($tz_top_blocks == "true") { /* if top blocks are enabled*/ ?>
				<!-- BEGIN #category-blocks -->
				<div id="category-blocks" class="clearfix">
					
					<?php if ($tz_cat_one_select) { /* if block one category is set */ ?>
					<?php include( TEMPLATEPATH . '/includes/home-block-one.php' ); ?>
					<?php } ?>
					
					<?php if ($tz_cat_two_select) { /* if block two category is set */ ?> 
					<?php include( TEMPLATEPATH . '/includes/home-block-two.php' ); ?>
					<?php } ?>
				
				<!-- END #category-blocks -->
				</div>
				<?php } ?>
				
				
				<?php if ($tz_bottom_blocks == "true") { /* if top blocks are enabled*/ ?>
				<!-- BEGIN #category-blocks-summary -->
				<div id="category-blocks-summary" class="clearfix">
					
					<?php if ($tz_cat_three_select) { /* if block three category is set */ ?>
					<?php include( TEMPLATEPATH . '/includes/home-block-three.php' ); ?>
					<?php } ?>
					
					<?php if ($tz_cat_four_select) { /* if block four category is set */ ?> 
					<?php include( TEMPLATEPATH . '/includes/home-block-four.php' ); ?>
					<?php } ?>
				
				<!-- END #category-blocks-summary -->
				</div>
				<?php } ?>
				
			<!--END #primary .hfeed-->
			</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>