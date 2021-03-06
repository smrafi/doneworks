					<!-- BEGIN #recent-news-block -->
					<div id="recent-news-block">
					
						<h3 class="widget-title"><?php echo ($tz_recent_title); ?></h3>
						
						<?php $rc = 0; ?>
					
						<?php /* show recent post list */
						$tz_recent_posts = new WP_Query(); $tz_recent_posts->query('offset=1&caller_get_posts=1&posts_per_page=' . $tz_recent_number . ''); ?>
						<?php while ($tz_recent_posts->have_posts()) : $tz_recent_posts->the_post(); ?>
						
						<?php $rc++; ?>
						
						<?php if ( $rc == 1 ) { /* if is the first post in the list */ ?>
						<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { /* if post has post thumbnail */ ?>
						<div class="post-thumb">
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>"><?php the_post_thumbnail('thumbnail-wide'); /* post thumbnail settings configured in functions.php */ ?></a>
						</div>
						<?php } } ?>
						
						<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>"> <?php the_title(); ?></a></h2>
						
						<!--BEGIN .entry-meta .entry-header-->
						<div class="entry-meta entry-header">
							<span class="published"><?php the_time( get_option('date_format') ); ?></span>
							<span class="meta-sep">&middot;</span>
							<span class="comment-count"><?php comments_popup_link(__('No comments', 'framework'), __('1 Comment', 'framework'), __('% Comments', 'framework')); ?></span>
						<!--END .entry-meta entry-header -->
						</div>							
			
						<?php endwhile; /* end latest post */ ?>
							
					<!-- END #recent-news-block -->
					</div>