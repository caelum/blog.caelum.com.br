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
  <div id="header">
    <div id="header_container">
      <h1>
        <a href="http://www.caelum.com.br/" class="logocaelum">
          <img src="<?php echo get_bloginfo( 'template_url' ) . '/images/caelum_objects.png' ?>" alt="Caelum - Cursos de Java, Scrum, Ruby on Rails" width="147" height="50">
        </a>
      </h1>
      <div id="menu-topo">
        <div id="facebook-like">
          <iframe src="http://www.facebook.com/plugins/like.php?locale=en_US&amp;href=http%3A%2F%2Fwww.facebook.com%2Fcaelumbr&amp;layout=button_count&amp;show_faces=false&amp;width=100&amp;action=like&amp;colorscheme=light&amp;aheight=30" scrolling="no" frameborder="0" allowtransparency="true" style=""></iframe>
        </div>
      </div>
    </div>
  </div>
	<!-- Top Starts -->
	<div id="top-out">
		<div id="top">
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
