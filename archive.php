<?php get_header(); ?>

	<!-- Middle Starts -->
	<div id="middle-out-top">
	<div id="middle-out-bottom">
	<div id="middle-content">
	<div id="middle-content-bottom">
		<!-- Content Starts -->
		<div id="content" class="wrap">
			<div class="col-left">
				<div id="main-content">
				
				<?php if (have_posts()) : ?>
				<?php $post = $posts[0]; ?>

				<?php if (is_category()) { ?><h2 class="arh"><?php _e('Archive for',woothemes); ?> '<?php echo single_cat_title(); ?>'</h2>
				<?php } elseif (is_day()) { ?><h2 class="arh"><?php _e('Archive for',woothemes); ?> <?php the_time('F jS, Y'); ?></h2>
				<?php } elseif (is_month()) { ?><h2 class="arh"><?php _e('Archive for',woothemes); ?> <?php the_time('F, Y'); ?></h2>
				<?php } elseif (is_year()) { ?><h2 class="arh"><?php _e('Archive for the year',woothemes); ?> <?php the_time('Y'); ?></h2>
				<?php } elseif (is_author()) { ?><h2 class="arh"><?php _e('Archive by Author',woothemes); ?></h2>
				<?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?><h2 class="arh"><?php _e('Archives',woothemes); ?></h2>
				<?php } elseif (is_tag()) { ?><h2 class="arh"><?php _e('Tag Archives:',woothemes); ?> <?php echo single_tag_title('', true); ?></h2>	

				<?php } ?>
	
				<?php while (have_posts()) : the_post(); ?>
				
				<!-- Latest Starts -->
					<div class="archives post wrap">
					
						<div class="block">
							
							<?php woo_get_image('image',get_option('woo_thumb_width'),get_option('woo_thumb_height'),'thumbnail alignleft'); ?>
                            
                            <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
							<p class="post-details"><?php _e('Posted on',woothemes); ?> <?php the_time('d. M, Y'); ?> <?php _e('by',woothemes); ?>  <?php coauthors_posts_links(); ?>.</p>
							<div class="comment-cloud">
								<a href="<?php comments_link(); ?>"><?php comments_number('0','1','%'); ?></a>
							</div>
                            
							<?php 
							// If this is the video category
							if ( $GLOBALS[vid_cat] && is_category($GLOBALS[vid_cat]) ) echo woo_get_embed('embed','550','360');
							
							if ( get_option('woo_content_archives') == "true" ) 
								the_content('[...]'); 
							else 
								the_excerpt(); 
							?>
							
                            <h4 class="continue"><a href="<?php the_permalink() ?>"><?php _e('Continue Reading',woothemes); ?></a></h4>
						</div>
					
					</div>
					<!-- Latest Ends -->
					
				<?php endwhile; ?>
                <div class="more_entries wrap">
                    <?php if (function_exists('wp_pagenavi')) wp_pagenavi(); else { ?>
                    <div class="fl"><?php previous_posts_link(__('&laquo; Newer Entries ',woothemes)) ?></div>
                    <div class="fr"><?php next_posts_link(__(' Older Entries &raquo;',woothemes)) ?></div>
                    <br class="fix" />
                    <?php } ?>
                </div>
				
				<?php endif; ?>
					
				</div>
			</div>
			
			<div class="col-right">
				<?php get_sidebar(); ?>
			</div>
		</div>
		<!-- Content Ends -->
	</div>
	</div>
	</div>
	</div>
	<!-- Middle Ends -->
	<?php get_footer(); ?>