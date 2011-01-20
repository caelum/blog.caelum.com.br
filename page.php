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