<?php

/*-----------------------------------------------------------------------------------

TABLE OF CONTENTS

- Hook Definitions

-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Hook Definitions */
/*-----------------------------------------------------------------------------------*/

// header.php
function woo_head() { do_action( 'woo_head' ); }					
function woo_top() { do_action( 'woo_top' ); }					
function woo_header_before() { do_action( 'woo_header_before' ); }			
function woo_header_inside() { do_action( 'woo_header_inside' ); }				
function woo_header_after() { do_action( 'woo_header_after' ); }			
function woo_nav_before() { do_action( 'woo_nav_before' ); }					
function woo_nav_inside() { do_action( 'woo_nav_inside' ); }					
function woo_nav_after() { do_action( 'woo_nav_after' ); }		

// Template files: 404, archive, single, page, sidebar, index, search
function woo_content_before() { do_action( 'woo_content_before' ); }					
function woo_content_after() { do_action( 'woo_content_after' ); }					
function woo_main_before() { do_action( 'woo_main_before' ); }					
function woo_main_after() { do_action( 'woo_main_after' ); }					
function woo_post_before() { do_action( 'woo_post_before' ); }					
function woo_post_after() { do_action( 'woo_post_after' ); }					
function woo_post_inside_before() { do_action( 'woo_post_inside_before' ); }					
function woo_post_inside_after() { do_action( 'woo_post_inside_after' ); }	
function woo_loop_before() { do_action( 'woo_loop_before' ); }	
function woo_loop_after() { do_action( 'woo_loop_after' ); }	

// Tumblog Functionality
function woo_tumblog_content_before() { do_action( 'woo_tumblog_content_before', 'Before' ); }	
function woo_tumblog_content_after() { do_action( 'woo_tumblog_content_after', 'After' ); }

// Sidebar
function woo_sidebar_before() { do_action( 'woo_sidebar_before' ); }					
function woo_sidebar_inside_before() { do_action( 'woo_sidebar_inside_before' ); }					
function woo_sidebar_inside_after() { do_action( 'woo_sidebar_inside_after' ); }					
function woo_sidebar_after() { do_action( 'woo_sidebar_after' ); }					

// footer.php
function woo_footer_top() { do_action( 'woo_footer_top' ); }					
function woo_footer_before() { do_action( 'woo_footer_before' ); }					
function woo_footer_inside() { do_action( 'woo_footer_inside' ); }					
function woo_footer_after() { do_action( 'woo_footer_after' ); }	
function woo_foot() { do_action( 'woo_foot' ); }					

?>