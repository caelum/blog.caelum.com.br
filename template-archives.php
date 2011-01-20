<?php
/*
Template Name: Archives Page
*/
?>

<?php get_header(); ?>

	<!-- Middle Starts -->
	<div id="middle-out-top">
	<div id="middle-out-bottom">
	<div id="middle-content" <?php if ( comments_open() ) : ?>class="single"<?php endif; ?>>
	<div id="middle-content-bottom">
		<!-- Content Starts -->
		<div id="content" class="wrap">
			<div class="col-left">
				<div id="main-content">
															
					<div class="post">
                        <h1 class="title"><?php _e('The Last 30 Posts',woothemes); ?></h1>
            
                        <ul>
                            <?php query_posts('showposts=30'); ?>
                            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                                <?php $wp_query->is_home = false; ?>
                                <li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a> - <?php the_time('j F Y') ?> - <?php echo $post->comment_count ?> <?php _e('comments',woothemes); ?></li>
                            
                            <?php endwhile; endif; ?>	
                        </ul>				
					</div>
                    
					<div class="post">
                
                        <h2><?php _e('Categories',woothemes); ?></h2>
            
                        <ul>
                            <?php wp_list_categories('title_li=&hierarchical=0&show_count=1') ?>	
                        </ul>	
					</div>                    

					<div class="post">
                        <h2><?php _e('Monthly Archives',woothemes); ?></h2>
            
                        <ul>
                            <?php wp_get_archives('type=monthly&show_post_count=1') ?>	
                        </ul>				
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
