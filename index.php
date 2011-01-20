<?php get_header(); ?>

	<?php if (is_paged()) $is_paged = true; $archives = get_option('woo_home_arc'); ?>

	<!-- Middle Starts -->
	<div id="middle-out-top">
	<div id="middle-out-bottom">
	<div id="middle-content">
	<div id="middle-content-bottom">
		<!-- Content Starts -->
		<div id="content" class="wrap">
			<div class="col-left">
				<div id="main-content">
																			
					<!-- Latest Starts -->
					<div class="<?php if ($is_paged || $archives == "true") { echo 'archives'; } else { echo 'latest'; } ?> post wrap">
						
					<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; query_posts("cat=-".$GLOBALS[vid_cat]."&paged=$paged"); ?>
					<?php if (have_posts()) : $count = 0; ?>
					<?php while (have_posts()) : the_post(); $postcount++;?>
	
                        <!-- Featured Starts -->
                        <?php if ( $postcount <= get_option('woo_featured_posts') && !$is_paged ) { ?>
                        
                        <div class="featured">
                            <?php woo_get_image('image',get_option('woo_image_width'),get_option('woo_image_height')); ?> 
                                    
                            <div class="post-title">
                                <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                                <p class="post-details"><?php _e('Posted on',woothemes); ?> <?php the_time('d. M, Y'); ?> <?php _e('by',woothemes); ?>  <?php the_author_posts_link(); ?>.</p>
                                <div class="comment-cloud">
                                    <a href="<?php comments_link(); ?>"><?php comments_number('0','1','%'); ?></a>
                                </div>
                            </div>
                            <?php if ( get_option('woo_content_feat') == "true" ) { the_content('[...]'); } else { the_excerpt(); ?><?php } ?>
                            
                            <h4 class="continue"><a href="<?php the_permalink() ?>"><?php _e('Continue Reading',woothemes); ?></a></h4>
                        
                        </div>
 
                        <!-- Content Ad Starts -->
                        <?php if (get_option('woo_ad_content_disable') == "false" && !$is_paged && !$ad_shown) { include (TEMPLATEPATH . "/ads/content_ad.php"); $ad_shown = true; } ?>
                        <!-- Content Ad Ends -->
                        
						<?php continue; } ?>
                        <!-- Featured Ends -->
    
                        <!-- Normal Post Starts -->
                        <div class="block">
                        
							<?php if (!$is_paged && $archives == "false") { ?>
								<?php woo_image('class=thumbnail&width='.get_option('woo_home_thumb_width').'&height='.get_option('woo_home_thumb_height')); ?> 
                                <div class="post-title">
                                    <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                                    <p class="post-details"><?php _e('Posted on',woothemes); ?> <?php the_time('d. M, Y'); ?> <?php _e('by',woothemes); ?>  <?php the_author_posts_link(); ?>.</p>
                                    <div class="comment-cloud">
                                        <a href="<?php comments_link(); ?>"><?php comments_number('0','1','%'); ?></a>
                                    </div>
                                </div>
                            <?php } else { ?>
								<?php woo_image('class=alignleft thumbnail&width='.get_option('woo_thumb_width').'&height='.get_option('woo_thumb_height')); ?> 
                                <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                                <p class="post-details"><?php _e('Posted on',woothemes); ?> <?php the_time('d. M, Y'); ?> <?php _e('by',woothemes); ?>  <?php the_author_posts_link(); ?>.</p>
                                <div class="comment-cloud">
                                    <a href="<?php comments_link(); ?>"><?php comments_number('0','1','%'); ?></a>
                                </div>
                            <?php } ?>

                            <?php if ( get_option('woo_content') == "true" ) { the_content('[...]'); } else { the_excerpt(); ?><?php } ?>
                            <h4 class="continue"><a href="<?php the_permalink() ?>"><?php _e('Continue Reading',woothemes); ?></a></h4>
                        
                        </div>
                        <!-- Normal Post Ends -->
                        
                        <?php if ($archives == "false") { $count++; if ($count == 2) { $count = 0; ?><div class="fix"></div><?php } } ?>
					
					<?php endwhile; ?>
					<?php endif; ?>

					</div>
					<!-- Latest Ends -->
					
                    <div class="more_entries wrap">
                        <?php if (function_exists('wp_pagenavi')) wp_pagenavi(); else { ?>
                        <div class="fl"><?php previous_posts_link(__('&laquo; Newer Entries ',woothemes)) ?></div>
                        <div class="fr"><?php next_posts_link(__(' Older Entries &raquo;',woothemes)) ?></div>
                        <br class="fix" />
                        <?php } ?>
                    </div>
									
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