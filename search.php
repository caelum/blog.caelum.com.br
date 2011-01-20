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
				<h2 class="arh"><?php _e('Search results',woothemes); ?></h2>
				<?php while (have_posts()) : the_post(); ?>
				
				<!-- Latest Starts -->
					<div class="archives post wrap">
					
						<div class="block">
							<?php woo_get_image('image',get_option('woo_thumb_width'),get_option('woo_thumb_height'),'thumbnail alignleft'); ?>
							<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
							<p class="post-details"><?php _e('Posted on',woothemes); ?> <?php the_time('d. M, Y'); ?> <?php _e('by',woothemes); ?>  <?php the_author_posts_link(); ?>.</p>
							<div class="comment-cloud">
								<a href="<?php comments_link(); ?>"><?php comments_number('0','1','%'); ?></a>
							</div>
							<?php the_excerpt('[...]'); ?>
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
				
				<?php else : ?>
				
				<h2 class="arh"><?php _e('Search results',woothemes); ?></h2>
				<p><?php _e('No matches. Please try again, or use the navigation menus to find what you are looking for.',woothemes); ?></p>
				
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