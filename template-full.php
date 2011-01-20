<?php
/*
Template Name: Full Width
*/
?>

<?php get_header(); ?>

	<!-- Middle Starts -->
	<div id="middle-out-top">
	<div id="middle-out-bottom">
	<div id="middle-content" class="full">
	<div id="middle-content-bottom" class="full">
		<!-- Content Starts -->
		<div id="content" class="wrap full">

            <div id="main-content" class="fullwidth">
            
            <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
            
            <!-- Sing Post Starts -->
                <div class="page post wrap">

                    <h1 class="title"><?php the_title(); ?></h1>
                    
                    <?php the_content(); ?>
                    <?php edit_post_link('Edit Page', '', ''); ?>

                </div>
                    <!-- Sing Post Ends -->
                    
            </div>
            
            <?php endwhile; ?>
            
            <div id="comments">
            
                <?php //comments_template(); ?>
                
            </div>
            
            <?php endif; ?>
							
		</div>
		<!-- Content Ends -->
	</div>
	</div>
	</div>
	</div>
	<!-- Middle Ends -->
	<?php get_footer(); ?>