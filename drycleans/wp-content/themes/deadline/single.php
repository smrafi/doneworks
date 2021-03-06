<?php get_header(); ?>
<?php /* include theme options */ include( TEMPLATEPATH . '/functions/get-options.php' ); ?>

			<!--BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
				<!--BEGIN .hentry -->
				<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
					<?php if ( function_exists('yoast_breadcrumb') ) : ?> <p class="breadcrumb"><?php yoast_breadcrumb(); ?></p><?php endif; ?>
					<h1 class="entry-title single-entry-title"><?php the_title(); ?></h1>
					
					<!-- BEGIN #single-columns -->
					<div id="single-columns" class="clearfix">
					
						<!-- BEGIN #single-column-left-->
						<div id="single-column-left">
						
							<!--BEGIN .entry-meta .entry-header-->
							<div class="entry-meta entry-header">
								<span class="author"><?php _e('By', 'framework') ?> <?php the_author_posts_link(); ?></span>
								<span class="meta-sep">&middot;</span>
								<span class="published"><?php the_time( get_option('date_format') ); ?></span>
								<span class="meta-sep">&middot;</span>
								<span class="comment-count"><?php comments_popup_link(__('No comments', 'framework'), __('1 Comment', 'framework'), __('% Comments', 'framework')); ?></span><br />
								<span class="entry-categories"><?php the_category(', ') ?></span>
								<span class="meta-sep">&middot;</span>
                        		<span class="entry-tags"><?php the_tags(''.__('Tagged:', 'framework').' ', ', ', ''); ?></span>
								<?php edit_post_link( __('edit', 'framework'), '<span class="edit-post">[', ']</span>' ); ?>
							<!--END .entry-meta entry-header -->
							</div>
							
							<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { /* if post has post thumbnail */ ?>
							<div class="post-thumb">
								<?php the_post_thumbnail('lead-image'); /* post thumbnail settings configured in functions.php */ ?>
							</div>
							<?php } ?>
							
							<!--BEGIN .entry-content -->
							<div class="entry-content">
								<?php the_content(__('Read more...', 'framework')); ?>
								<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'framework').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
							<!--END .entry-content -->
							</div>
							
							<?php if /* if the author bio is checked in admin options then show and author bio box */ ($tz_author_bio == "true") { ?>
							<!--BEGIN .author-bio-->
							<div class="author-bio">
								<h3 class="widget-title author-title"><?php _e('About the author', 'framework') ?></h3>
								<div class="author-content clearfix">
									<?php echo get_avatar( get_the_author_email(), '75' ); ?>
									<div class="author-description"><?php the_author_meta("description"); ?></div>
								</div>
							<!--END .author-bio-->
							</div>
							<?php } ?>
							
							<?php if ($tz_show_related == "true") { ?>
							<?php include( TEMPLATEPATH . '/includes/related-posts.php' ); ?>
							<?php } ?>
						
						<!-- END #single-column-left-->
						</div>
						
						<!-- BEGIN #single-column-right-->
						<div id="single-column-right">
						<?php if ($tz_sharing_enable == "true") { /* Display 468x60 banner if checked in theme options */ ?>
							<ul class="share">
								<?php if ($tz_enable_twitter == "true") { /* Display Twitter link if checked in theme options */ ?>
								<li class="tweet"><a href="http://twitter.com/home/?status=<?php the_title(); ?>&nbsp;-&nbsp;<?php the_permalink(); ?>">Tweet this post</a></li>
								<?php } ?>
								
								<?php if ($tz_enable_fb == "true") { /* Display Facebook link if checked in theme options */ ?>
								<li class="fb"><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>?t=<?php the_title(); ?>" title="Post to Facebook">Post to Facebook</a></li>
								<?php } ?>
								
								<?php if ($tz_enable_digg == "true") { /* Display Digg link if checked in theme options */ ?>
								<li class="digg"><a href="http://digg.com/submit?url=<?php the_permalink();?>&amp;title=<?php the_title(); ?>&amp;thumbnails=1" title="Digg this!">Digg this!</a></li>
								<?php } ?>
								
								<?php if ($tz_enable_reddit == "true") { /* Display Reddit link if checked in theme options */ ?>
								<li class="reddit"><a href="http://www.reddit.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" title="Share on Reddit">Share on Reddit</a></li>
								<?php } ?>
								
								<?php if ($tz_enable_del == "true") { /* Display Deliciouos link if checked in theme options */ ?>
								<li class="del"><a href="http://del.icio.us/post?url=<?php the_permalink();?>&amp;title=<?php the_title(); ?>" title="Add To Delicious">Add to Delicious</a></li>
								<?php } ?>
								
								<?php if ($tz_enable_stumble == "true") { /* Display Stumble link if checked in theme options */ ?>
								<li class="stumble"><a href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" title="Stumble this">Stumble this</a></li>
								<?php } ?>
								
								<?php if ($tz_enable_gbuzz == "true") { /* Display Google Buzz link if checked in theme options */ ?>
								<li class="gbuzz"><a href="http://www.google.com/reader/link?title=<?php the_title();?>&amp;url=<?php the_permalink();?>" title="Google Buzz">Google Buzz</a></li>
								<?php } ?>
								
								<?php if ($tz_enable_ybuzz == "true") { /* Display Yahoo Buzz link if checked in theme options */ ?>
								<li class="ybuzz"><a href="http://buzz.yahoo.com/submit/?submitUrl=<?php the_permalink(); ?>&amp;submitHeadline=<?php the_title(); ?>" title="Yahoo Buzz">Yahoo Buzz</a></li>
								<?php } ?>
								
								<?php if ($tz_enable_techno == "true") { /* Display Technorati link if checked in theme options */ ?>
								<li class="techno"><a href="http://technorati.com/signup/?f=favorites&amp;Url=<?php the_permalink(); ?>" title="Post to Technorati">Post to Technorati</a></li>
								<?php } ?>
								
								<?php if ($tz_enable_linkedin == "true") { /* Display Linkedin link if checked in theme options */ ?>
								<li class="linkedin"><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>&amp;source="  title="Share on Linkedin">Share on Linkedin</a></li>
								<?php } ?>
								
								<?php if ($tz_enable_email == "true") { /* Display email link if checked in theme options */ ?>
								<li class="email"><a href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink(); ?>">Email a friend</a></li>
								<?php } ?>
								
							</ul>
						<?php } ?>	
						
						<ul class="rss">
						<?php
						foreach((get_the_category()) as $category) { // Get all categories of that post
						
							$tz_slug = $category->category_nicename; 
							$tz_url = get_bloginfo('url');
							$tz_catname = $category->cat_name;
							
							// Display feed links for each category
							echo '<li><a href="'.$tz_url.'/category/'.$tz_slug.'/feed">'.$tz_catname.'</a></li>';
						} 
						?>
						</ul>
									
						<!-- END #single-column-right-->
						</div>
					
					
					<!-- END #single-columns -->
					</div>
                
                <!--END .hentry-->  
				</div>

				<?php comments_template('', true); ?>
				
				<!--BEGIN .navigation .single-page-navigation -->
				<div class="navigation single-page-navigation">
					<div class="nav-previous"><?php previous_post_link('&larr; %link') ?></div>
					<div class="nav-next"><?php next_post_link('%link &rarr;') ?></div>
				<!--END .navigation .single-page-navigation -->
				</div>

				<?php endwhile; else: ?>

				<!--BEGIN #post-0-->
				<div id="post-0" <?php post_class() ?>>
				
					<h1 class="entry-title"><?php _e('Error 404 - Not Found', 'framework') ?></h1>
				
					<!--BEGIN .entry-content-->
					<div class="entry-content">
						<p><?php _e("Sorry, but you are looking for something that isn't here.", "framework") ?></p>
						<?php get_search_form(); ?>
					<!--END .entry-content-->
					</div>
				
				<!--END #post-0-->
				</div>

			<?php endif; ?>
			<!--END #primary .hfeed-->
			</div>

<?php include( TEMPLATEPATH . '/sidebar-page.php' ); ?>

<?php get_footer(); ?>