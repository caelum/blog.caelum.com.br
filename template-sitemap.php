<?php
/*
Template Name: Sitemap
*/
?>

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
						
                    <h1 class="title"><?php the_title(); ?></h1>			
									

					<div class="archives post wrap">
            
                        
                        <h3><?php _e('Pages',woothemes); ?></h3>
            
                        <ul>
                            <?php wp_list_pages('depth=1&sort_column=menu_order&title_li=' ); ?>		
                        </ul>				

					</div>
                    
					<div class="page post wrap">
                
                        <h3><?php _e('Categories',woothemes); ?></h3>
            
                        <ul>
                            <?php wp_list_categories('title_li=&hierarchical=0&show_count=1') ?>	
                        </ul>	
					</div>                    

					<div class="page post wrap">
					<?php
                
                        $cats = get_categories();
                        foreach ($cats as $cat) {
                
                        query_posts('cat='.$cat->cat_ID);
            
                    ?>
                    
                        <h3 style="margin-top:10px !important; padding:0px;"><?php echo $cat->cat_name; ?></h3>
            
                        <ul>	
                                <?php while (have_posts()) : the_post(); ?>
                                <li style="font-weight:normal !important;"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a> - <?php _e('Comments',woothemes); ?> (<?php echo $post->comment_count ?>)</li>
                                <?php endwhile;  ?>
                        </ul>
                
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

