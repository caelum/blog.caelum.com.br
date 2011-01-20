<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">

<title><?php woo_title(); ?></title>
<?php woo_meta(); ?>

<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php if ( get_option('woo_feedburner_url') <> "" ) { echo get_option('woo_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
   
<!--[if lt IE 7]>
<script src="http://ie7-js.googlecode.com/svn/version/2.0(beta2)/IE7.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/includes/js/menu.js"></script>	
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/includes/js/pngfix.js"></script>	
<![endif]-->

<?php if ( is_single() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<!-- Set video category -->
<?php $cat = get_option('woo_video_category'); $GLOBALS[vid_cat] = $wpdb->get_var("SELECT term_id FROM $wpdb->terms WHERE name='$cat'"); ?>

<div id="wrap">
	<!-- Top Starts -->
	<div id="top-out">
		<div id="top">
		<!-- Page Nav Starts -->
			<div id="page_navi" class="wrap">
				<div class="col-left">
					<?php
					if ( function_exists('has_nav_menu') && has_nav_menu('primary-menu') ) {
						wp_nav_menu( array( 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'nav', 'theme_location' => 'primary-menu' ) );
					} else {
					?>
					<ul id="nav">
					<?php 
                    if ( get_option('woo_custom_nav_menu') == 'true' ) {
                        if ( function_exists('woo_custom_navigation_output') )
							woo_custom_navigation_output('name=Woo Menu 1');
        
                    } else { ?>
                    
						<?php if (is_page()) { $highlight = "page_item"; } else {$highlight = "page_item current_page_item"; } ?>
						<li class="<?php echo $highlight; ?>"><a href="<?php bloginfo('url'); ?>"><?php _e('Home',woothemes); ?></a></li>
						<?php wp_list_pages('sort_column=menu_order&depth=0&title_li='); ?>
                        
                    <?php } ?>
					</ul>
					<?php } ?>
				</div>
				<div class="col-right">
					<ul class="rss">
						<li><a href="<?php if ( get_option('woo_feedburner_url') <> "" ) { echo get_option('woo_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>"><?php _e('Posts',woothemes); ?></a></li>
						<li <?php if ( get_option('woo_feedburner_id') == "" ) echo 'class="last"'; ?>><a href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comments',woothemes); ?></a></li>
						<?php if ( get_option('woo_feedburner_id') <> "" ) { ?><li class="last"><a href="<?php echo get_option('woo_feedburner_id'); ?>" target="_blank"><?php _e('Email',woothemes); ?></a></li><?php } ?>
					</ul>
				</div>
			</div>
			<!-- Page Nav Ends -->
			<div id="header">
			
	            <div id="logo">
	               
	                <?php if (get_option('woo_texttitle') <> "true") { ?><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('description'); ?>"><img class="title" src="<?php if ( get_option('woo_logo') <> "" ) { echo get_option('woo_logo'); } else { bloginfo('template_directory'); ?>/images/logo-trans.png<?php } ?>" alt="<?php bloginfo('name'); ?>" /></a><?php } ?>
	                
	                <?php if(is_single() || is_page()) : ?>
	                    <span class="site-title"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></span>
	                <?php else: ?>
	                    <h1 class="site-title"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
	                <?php endif; ?>
	                
	                    <span class="site-description"><?php bloginfo('description'); ?></span>
	                
	            </div><!-- /#logo -->
				
				<!-- Top Ad Starts -->
				<?php if (get_option('woo_ad_top_disable') == "false" && !get_option('woo_twitter')) include (TEMPLATEPATH . "/ads/top_ad.php"); ?>
				<!-- Top Ad Ends -->

				<!-- Twitter Starts -->
				<?php if (get_option('woo_twitter')) { ?>
                <div class="latest_twitter">
                	<a href="http://www.twitter.com/<?php echo get_option('woo_twitter'); ?>" title="<?php _e('Follow me on Twitter',woothemes); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/twitter-trans.png" alt="<?php _e('Latest Tweet from Twitter',woothemes); ?>" /></a>
					<ul id="twitter_update_list"><li></li></ul>
                </div>
                <?php } ?>
				<!-- Twitter Ad Ends -->
                
				
			</div>
			<!-- Category Nav Starts -->
			<div id="cat_navi" class="wrap">
				<?php
				if ( function_exists('has_nav_menu') && has_nav_menu('secondary-menu') ) {
					wp_nav_menu( array( 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'secnav', 'theme_location' => 'secondary-menu' ) );
				} else {
				?>
				<ul id="secnav">
					<?php					
                    if ( get_option('woo_custom_nav_menu') == 'true' ) {
                        if ( function_exists('woo_custom_navigation_output') )
							woo_custom_navigation_output('name=Woo Menu 2&desc=1');
        
                    } else { ?>
                    
					<?php if (get_option('woo_home_link') == "true") : ?>
					<li><a href="<?php bloginfo('url'); ?>"><?php echo get_option('woo_home_link_text'); ?><br /><span><?php echo get_option('woo_home_link_desc'); ?></span></a></li>
					<?php endif; ?>

					<?php foreach ( (get_categories('exclude='.get_option('woo_cat_ex') ) ) as $category ) { if ( $category->category_parent == '0' ) { ?>
  
                    <li>
                        <a href="<?php echo get_category_link($category->cat_ID); ?>"><?php echo $category->cat_name; ?><br/> <span><?php echo $category->category_description; ?></span></a>
                        
                        <?php if (get_category_children($category->cat_ID) ) { ?>
                        <ul><?php wp_list_categories('title_li&child_of=' . $category->cat_ID ); ?></ul>
                        <?php } ?>
                    </li>
	
					<?php } } ?>
                    
                    <?php } ?>
                    
				</ul>
				<?php } ?>
			</div>
			<!-- Category Nav Ends -->
		</div>
	</div>
	<!-- Top Ends -->