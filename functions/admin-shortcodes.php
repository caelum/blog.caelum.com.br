<?php
/*-----------------------------------------------------------------------------------

TABLE OF CONTENTS

1. Woo Shortcodes 
  1.1 Output shortcode JS in footer (in development)
2. Boxes
3. Buttons
4. Related Posts
5. Tweetmeme Button
6. Twitter Button
7. Digg Button
8. FaceBook Like Button
9. Columns
10. Horizontal Rule / Divider
11. Quote
12. Icon Links
13. jQuery Toggle (in development)
14. Facebook Share Button

-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* 1. Woo Shortcodes  */
/*-----------------------------------------------------------------------------------*/

// Enable shortcodes in widget areas
add_filter('widget_text', 'do_shortcode');

// Add stylesheet for shortcodes to HEAD (added to HEAD in admin-setup.php)
if (!function_exists("woo_shortcode_stylesheet")) {
	function woo_shortcode_stylesheet() {
		echo '<link href="'. get_bloginfo('template_directory') .'/functions/css/shortcodes.css" rel="stylesheet" type="text/css" />'."\n";	
	}
}

// Replace WP autop formatting
if (!function_exists("woo_remove_wpautop")) {
	function woo_remove_wpautop($content) { 
		$content = do_shortcode( shortcode_unautop( $content ) ); 
		$content = preg_replace('#^<\/p>|^<br \/>|<p>$#', '', $content);
		return $content;
	}
}

/*-----------------------------------------------------------------------------------*/
/* 1.1 Output shortcode JS in footer */
/*-----------------------------------------------------------------------------------*/

// Check if option to output shortcode JS is active
if (!function_exists("woo_check_shortcode_js")) {
	function woo_check_shortcode_js($shortcode) {
	   	$js = get_option("woo_sc_js");
	   	if ( !$js ) 
	   		woo_add_shortcode_js($shortcode);
	   	else {
	   		if ( !in_array($shortcode, $js) ) {
		   		$js[] = $shortcode;
	   			update_option("woo_sc_js", $js);
	   		}
	   	}
	}
}

// Add option to handle JS output
if (!function_exists("woo_add_shortcode_js")) {
	function woo_add_shortcode_js($shortcode) {
		$update = array();
		$update[] = $shortcode;
		update_option("woo_sc_js", $update);
	}
}

// Output queued shortcode JS in footer
if (!function_exists("woo_output_shortcode_js")) {
	function woo_output_shortcode_js() {
		$option = get_option('woo_sc_js');
		if ( $option ) {
		
			// Toggle JS output
			if ( in_array('toggle', $option) ) {
			   	
			   	$output = '
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery(".woo-sc-toggle-box").hide();
		jQuery(".woo-sc-toggle-trigger").click(function() {
			jQuery(this).next(".woo-sc-toggle-box").slideToggle(400);
		});
	});
</script>
';
				echo $output;
			}
			
			// Reset option
			delete_option('woo_sc_js');
		}
	}
}
add_action('wp_footer', 'woo_output_shortcode_js');

/*-----------------------------------------------------------------------------------*/
/* 2. Boxes - box
/*-----------------------------------------------------------------------------------*/
/*

Optional arguments:
 - type: info, alert, tick, download, note
 - size: medium, large
 - style: rounded
 - border: none, full
 - icon: none OR full URL to a custom icon 

*/
function woo_shortcode_box($atts, $content = null) {
   extract(shortcode_atts(array(	'type' => 'normal',
   									'size' => '',
   									'style' => '',
   									'border' => '',
   									'icon' => ''), $atts)); 
   									
   	if ( $icon == "none" )  
   		$custom = ' style="padding-left:15px;background-image:none;"';
   	elseif ( $icon )  
   		$custom = ' style="padding-left:50px;background-image:url('.$icon.'); background-repeat:no-repeat; background-position:20px 45%;"';
   		
   										
   	return '<p class="woo-sc-box '.$type.' '.$size.' '.$style.' '.$border.'"'.$custom.'>' . woo_remove_wpautop($content) . '</p>';
}
add_shortcode('box', 'woo_shortcode_box');

/*-----------------------------------------------------------------------------------*/
/* 3. Buttons - button
/*-----------------------------------------------------------------------------------*/
/*

Optional arguments:
 - size: small, large
 - style: info, alert, tick, download, note
 - color: red, green, black, grey OR custom hex color (e.g #000000)
 - border: border color (e.g. red or #000000)
 - text: black (for light color background on button) 
 - class: custom class
 - link: button link (e.g http://www.woothemes.com)
 
*/
function woo_shortcode_button($atts, $content = null) {
   	extract(shortcode_atts(array(	'size' => '',
   									'style' => '',
   									'color' => '',   									
   									'border' => '',   									
   									'text' => '',   									
   									'class' => '',
   									'link' => '#'), $atts));

   	
   	// Set custom background and border color
   	if ( $color ) {
   	
   		if ( 	$color == "red" OR 
   			 	$color == "orange" OR
   			 	$color == "green" OR
   			 	$color == "aqua" OR
   			 	$color == "teal" OR
   			 	$color == "purple" OR
   			 	$color == "pink" OR
   			 	$color == "silver"
   			 	 ) {
	   		$class .= " ".$color;
   		
   		} else {
		   	if ( $border ) 
		   		$border_out = $border;
		   	else
		   		$border_out = $color;
		   		
	   		$color_output = 'style="background:'.$color.';border-color:'.$border_out.'"';
	   		
	   		// add custom class
	   		$class .= " custom";
   		}
   	}

	$class_output = '';

	// Set text color
	if ( $text )
		$class_output .= ' dark';

	// Set class
	if ( $class )
		$class_output .= ' '.$class;

	// Set Size
	if ( $size )
		$class_output .= ' '.$size;
	
   	
   	$output = '<a href="'.$link.'"class="woo-sc-button'.$class_output.'" '.$color_output.'><span class="woo-'.$style.'">' . woo_remove_wpautop($content) . '</span></a>';
   	return $output;
}
add_shortcode('button', 'woo_shortcode_button');


/*-----------------------------------------------------------------------------------*/
/* 4. Related Posts - related_posts
/*-----------------------------------------------------------------------------------*/
/*

Optional arguments:
 - limit: number of posts to show (default: 5)
 - image: thumbnail size, 0 = off (default: 0)
*/

function woo_shortcode_related_posts( $atts ) {
 
	extract(shortcode_atts(array(
	    'limit' => '5',
	    'image' => '',
	), $atts));
 
	global $wpdb, $post, $table_prefix;
 
	if ($post->ID) {
 
		$retval = '
<ul class="woo-sc-related-posts">';
 
		// Get tags
		$tags = wp_get_post_tags($post->ID);
		$tagsarray = array();
		foreach ($tags as $tag) {
			$tagsarray[] = $tag->term_id;
		}
		$tagslist = implode(',', $tagsarray);
 
		// Do the query
		$q = "
			SELECT p.*, count(tr.object_id) as count
			FROM $wpdb->term_taxonomy AS tt, $wpdb->term_relationships AS tr, $wpdb->posts AS p
			WHERE tt.taxonomy ='post_tag'
				AND tt.term_taxonomy_id = tr.term_taxonomy_id
				AND tr.object_id  = p.ID
				AND tt.term_id IN ($tagslist)
				AND p.ID != $post->ID
				AND p.post_status = 'publish'
				AND p.post_date_gmt < NOW()
			GROUP BY tr.object_id
			ORDER BY count DESC, p.post_date_gmt DESC
			LIMIT $limit;";
 
		$related = $wpdb->get_results($q);
 
		if ( $related ) {
			foreach($related as $r) {
				if ( $image ) {
					$image_out = "";
					$image_out .= '<a class="thumbnail" href="'.get_permalink($r->ID).'">';
					$image_out .= woo_image("link=img&width=".$image."&height=".$image."&return=true&id=".$r->ID);
					$image_out .= '</a>';
				}
				$retval .= '
	<li>'.$image_out.'<a class="related-title" title="'.wptexturize($r->post_title).'" href="'.get_permalink($r->ID).'">'.wptexturize($r->post_title).'</a></li>
';
			}
		} else {
			$retval .= '
	<li>No related posts found</li>
';
		}
		$retval .= '</ul>
';
		return $retval;
	}
	return;
}
add_shortcode('related_posts', 'woo_shortcode_related_posts');


/*-----------------------------------------------------------------------------------*/
/* 5. Tweetmeme button - tweetmeme
/*-----------------------------------------------------------------------------------*/
/*

Source: http://help.tweetmeme.com/2009/04/06/tweetmeme-button/

Optional arguments:
 - link: specify URL directly 
 - style: compact
 - source: username
 - float: none, left, right (default: left)
 
*/
function woo_shortcode_tweetmeme($atts, $content = null) {
   	extract(shortcode_atts(array(	'link' => '',
   									'style' => '',
   									'source' => '',
   									'float' => 'left'), $atts));
	$output = '';

	if ( $link )
		$output .= "tweetmeme_url = '".$link."';";
		
	if ( $style )
		$output .= "tweetmeme_style = 'compact';";

	if ( $source )
		$output .= "tweetmeme_source = '".$source."';";

	if ( $link OR $style )
		$output = '<script type="text/javascript">'.$output.'</script>';
	
	$output .= '<div class="woo-tweetmeme '.$float.'"><script type="text/javascript" src="http://tweetmeme.com/i/scripts/button.js"></script></div>';
	return $output;

}
add_shortcode('tweetmeme', 'woo_shortcode_tweetmeme');

/*-----------------------------------------------------------------------------------*/
/* 6. Twitter button - twitter
/*-----------------------------------------------------------------------------------*/
/*

Source: http://twitter.com/goodies/tweetbutton

Optional arguments:
 - style: vertical, horizontal, none ( default: vertical )
 - url: specify URL directly 
 - source: username to mention in tweet
 - related: related account 
 - text: optional tweet text (default: title of page)
 - float: none, left, right (default: left)
 - lang: fr, de, es, js (default: english)
*/
function woo_shortcode_twitter($atts, $content = null) {
   	extract(shortcode_atts(array(	'url' => '',
   									'style' => 'vertical',
   									'source' => '',
   									'text' => '',
   									'related' => '',
   									'lang' => '',
   									'float' => 'left'), $atts));
	$output = '';

	if ( $url )
		$output .= ' data-url="'.$url.'"';
		
	if ( $source )
		$output .= ' data-via="'.$source.'"';
	
	if ( $text ) 
		$output .= ' data-text="'.$text.'"';

	if ( $related ) 			
		$output .= ' data-related="'.$related.'"';

	if ( $lang ) 			
		$output .= ' data-lang="'.$lang.'"';
	
	$output = '<div class="woo-sc-twitter '.$float.'"><a href="http://twitter.com/share" class="twitter-share-button"'.$output.' data-count="'.$style.'">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div>';	
	return $output;

}
add_shortcode('twitter', 'woo_shortcode_twitter');

/*-----------------------------------------------------------------------------------*/
/* 7. Digg Button - digg
/*-----------------------------------------------------------------------------------*/
/*

Source: http://about.digg.com/button

Optional arguments:
 - link: specify URL directly 
 - title: specify a title (must add link also)
 - style: medium, large, compact, icon (default: medium)
 - float: none, left, right (default: left)
 
*/
function woo_shortcode_digg($atts, $content = null) {
   	extract(shortcode_atts(array(	'link' => '',
   									'title' => '',
   									'style' => 'medium',
   									'float' => 'left'), $atts));
	$output .= "		
	<script type=\"text/javascript\">
	(function() {
	var s = document.createElement('SCRIPT'), s1 = document.getElementsByTagName('SCRIPT')[0];
	s.type = 'text/javascript';
	s.async = true;
	s.src = 'http://widgets.digg.com/buttons.js';
	s1.parentNode.insertBefore(s, s1);
	})();
	</script>		
	";
	
	// Add custom URL
	if ( $link ) {
		// Add custom title
		if ( $title ) 
			$title = '&amp;title='.urlencode( $title );
			
		$link = ' href="http://digg.com/submit?url='.urlencode( $link ).$title.'"';
	}
	
	if ( $style == "large" )
		$style = "Large";
	elseif ( $style == "compact" )
		$style = "Compact";
	elseif ( $style == "icon" )
		$style = "Icon";
	else
		$style = "Medium";		
		
	$output .= '<div class="woo-digg '.$float.'"><a class="DiggThisButton Digg'.$style.'"'.$link.'></a></div>';
	return $output;

}
add_shortcode('digg', 'woo_shortcode_digg');


/*-----------------------------------------------------------------------------------*/
/* 8. Facebook Like Button - fblike
/*-----------------------------------------------------------------------------------*/
/*

Source: http://developers.facebook.com/docs/reference/plugins/like

Optional arguments:
 - float: none (default), left, right 
 - url: link you want to share (default: current post ID)
 - style: standard (default), button
 - showfaces: true or false (default)
 - width: 450
 - verb: like (default) or recommend
 - colorscheme: light (default), dark
 - font: arial (default), lucida grande, segoe ui, tahoma, trebuchet ms, verdana 
 
*/
function woo_shortcode_fblike($atts, $content = null) {
   	extract(shortcode_atts(array(	'float' => 'none',
   									'url' => '',
   									'style' => 'standard',
   									'showfaces' => 'false',
   									'width' => '450',
   									'verb' => 'like',
   									'colorscheme' => 'light',
   									'font' => 'arial'), $atts));
		
	if ( $style == "button" )
		$style = "button_count";
	else
		$style = "standard";		
	
	if ( !$url )
		$url = get_permalink($post->ID);
		
	$output .= '
<div class="woo-fblike '.$float.'">		
<iframe src="http://www.facebook.com/plugins/like.php?href='.$url.'&amp;layout='.$style.'&amp;show_faces='.$showfaces.'&amp;width='.$width.'&amp;action='.$verb.'&amp;colorscheme='.$colorscheme.'" scrolling="no" frameborder="0" allowTransparency="true" style="border:none; overflow:hidden; width:'.$width.'px; height:40px"></iframe>
</div>
	';
	return $output;

}
add_shortcode('fblike', 'woo_shortcode_fblike');


/*-----------------------------------------------------------------------------------*/
/* 9. Columns
/*-----------------------------------------------------------------------------------*/
/*

Description:

Columns are named with this convention Xcol_Y where X is the total number of columns and Y is 
the number of columns you want this column to span. Add _last behind the shortcode if it is the
last column.

*/

/* ============= Two Columns ============= */

function woo_shortcode_twocol_one($atts, $content = null) {
   return '<div class="twocol-one">' . woo_remove_wpautop($content) . '</div>';
}
add_shortcode('twocol_one', 'woo_shortcode_twocol_one');

function woo_shortcode_twocol_one_last($atts, $content = null) {
   return '<div class="twocol-one last">' . woo_remove_wpautop($content) . '</div>';
}
add_shortcode('twocol_one_last', 'woo_shortcode_twocol_one_last');


/* ============= Three Columns ============= */

function woo_shortcode_threecol_one($atts, $content = null) {
   return '<div class="threecol-one">' . woo_remove_wpautop($content) . '</div>';
}
add_shortcode('threecol_one', 'woo_shortcode_threecol_one');

function woo_shortcode_threecol_one_last($atts, $content = null) {
   return '<div class="threecol-one last">' . woo_remove_wpautop($content) . '</div>';
}
add_shortcode('threecol_one_last', 'woo_shortcode_threecol_one_last');

function woo_shortcode_threecol_two($atts, $content = null) {
   return '<div class="threecol-two">' . woo_remove_wpautop($content) . '</div>';
}
add_shortcode('threecol_two', 'woo_shortcode_threecol_two');

function woo_shortcode_threecol_two_last($atts, $content = null) {
   return '<div class="threecol-two last">' . woo_remove_wpautop($content) . '</div>';
}
add_shortcode('threecol_two_last', 'woo_shortcode_threecol_two_last');

/* ============= Four Columns ============= */

function woo_shortcode_fourcol_one($atts, $content = null) {
   return '<div class="fourcol-one">' . woo_remove_wpautop($content) . '</div>';
}
add_shortcode('fourcol_one', 'woo_shortcode_fourcol_one');

function woo_shortcode_fourcol_one_last($atts, $content = null) {
   return '<div class="fourcol-one last">' . woo_remove_wpautop($content) . '</div>';
}
add_shortcode('fourcol_one_last', 'woo_shortcode_fourcol_one_last');

function woo_shortcode_fourcol_two($atts, $content = null) {
   return '<div class="fourcol-two">' . woo_remove_wpautop($content) . '</div>';
}
add_shortcode('fourcol_two', 'woo_shortcode_fourcol_two');

function woo_shortcode_fourcol_two_last($atts, $content = null) {
   return '<div class="fourcol-two last">' . woo_remove_wpautop($content) . '</div>';
}
add_shortcode('fourcol_two_last', 'woo_shortcode_fourcol_two_last');

function woo_shortcode_fourcol_three($atts, $content = null) {
   return '<div class="fourcol-three">' . woo_remove_wpautop($content) . '</div>';
}
add_shortcode('fourcol_three', 'woo_shortcode_fourcol_three');

function woo_shortcode_fourcol_three_last($atts, $content = null) {
   return '<div class="fourcol-three last">' . woo_remove_wpautop($content) . '</div>';
}
add_shortcode('fourcol_three_last', 'woo_shortcode_fourcol_three_last');

/* ============= Five Columns ============= */

function woo_shortcode_fivecol_one($atts, $content = null) {
   return '<div class="fivecol-one">' . woo_remove_wpautop($content) . '</div>';
}
add_shortcode('fivecol_one', 'woo_shortcode_fivecol_one');

function woo_shortcode_fivecol_one_last($atts, $content = null) {
   return '<div class="fivecol-one last">' . woo_remove_wpautop($content) . '</div>';
}
add_shortcode('fivecol_one_last', 'woo_shortcode_fivecol_one_last');

function woo_shortcode_fivecol_two($atts, $content = null) {
   return '<div class="fivecol-two">' . woo_remove_wpautop($content) . '</div>';
}
add_shortcode('fivecol_two', 'woo_shortcode_fivecol_two');

function woo_shortcode_fivecol_two_last($atts, $content = null) {
   return '<div class="fivecol-two last">' . woo_remove_wpautop($content) . '</div>';
}
add_shortcode('fivecol_two_last', 'woo_shortcode_fivecol_two_last');

function woo_shortcode_fivecol_three($atts, $content = null) {
   return '<div class="fivecol-three">' . woo_remove_wpautop($content) . '</div>';
}
add_shortcode('fivecol_three', 'woo_shortcode_fivecol_three');

function woo_shortcode_fivecol_three_last($atts, $content = null) {
   return '<div class="fivecol-three last">' . woo_remove_wpautop($content) . '</div>';
}
add_shortcode('fivecol_three_last', 'woo_shortcode_fivecol_three_last');

function woo_shortcode_fivecol_four($atts, $content = null) {
   return '<div class="fivecol-four">' . woo_remove_wpautop($content) . '</div>';
}
add_shortcode('fivecol_four', 'woo_shortcode_fivecol_four');

function woo_shortcode_fivecol_four_last($atts, $content = null) {
   return '<div class="fivecol-four last">' . woo_remove_wpautop($content) . '</div>';
}
add_shortcode('fivecol_four_last', 'woo_shortcode_fivecol_four_last');


/* ============= Six Columns ============= */

function woo_shortcode_sixcol_one($atts, $content = null) {
   return '<div class="sixcol-one">' . woo_remove_wpautop($content) . '</div>';
}
add_shortcode('sixcol_one', 'woo_shortcode_sixcol_one');

function woo_shortcode_sixcol_one_last($atts, $content = null) {
   return '<div class="sixcol-one last">' . woo_remove_wpautop($content) . '</div>';
}
add_shortcode('sixcol_one_last', 'woo_shortcode_sixcol_one_last');

function woo_shortcode_sixcol_two($atts, $content = null) {
   return '<div class="sixcol-two">' . woo_remove_wpautop($content) . '</div>';
}
add_shortcode('sixcol_two', 'woo_shortcode_sixcol_two');

function woo_shortcode_sixcol_two_last($atts, $content = null) {
   return '<div class="sixcol-two last">' . woo_remove_wpautop($content) . '</div>';
}
add_shortcode('sixcol_two_last', 'woo_shortcode_sixcol_two_last');

function woo_shortcode_sixcol_three($atts, $content = null) {
   return '<div class="sixcol-three">' . woo_remove_wpautop($content) . '</div>';
}
add_shortcode('sixcol_three', 'woo_shortcode_sixcol_three');

function woo_shortcode_sixcol_three_last($atts, $content = null) {
   return '<div class="sixcol-three last">' . woo_remove_wpautop($content) . '</div>';
}
add_shortcode('sixcol_three_last', 'woo_shortcode_sixcol_three_last');

function woo_shortcode_sixcol_four($atts, $content = null) {
   return '<div class="sixcol-four">' . woo_remove_wpautop($content) . '</div>';
}
add_shortcode('sixcol_four', 'woo_shortcode_sixcol_four');

function woo_shortcode_sixcol_four_last($atts, $content = null) {
   return '<div class="sixcol-four last">' . woo_remove_wpautop($content) . '</div>';
}
add_shortcode('sixcol_four_last', 'woo_shortcode_sixcol_four_last');

function woo_shortcode_sixcol_five($atts, $content = null) {
   return '<div class="sixcol-five">' . woo_remove_wpautop($content) . '</div>';
}
add_shortcode('sixcol_five', 'woo_shortcode_sixcol_five');

function woo_shortcode_sixcol_five_last($atts, $content = null) {
   return '<div class="sixcol-five last">' . woo_remove_wpautop($content) . '</div>';
}
add_shortcode('sixcol_five_last', 'woo_shortcode_sixcol_five_last');


/*-----------------------------------------------------------------------------------*/
/* 10. Horizontal Rule / Divider - hr - divider
/*-----------------------------------------------------------------------------------*/
/*

Description: Use to separate text. 

*/
function woo_shortcode_hr($atts, $content = null) {
   return '<div class="woo-sc-hr"></div>';
}
add_shortcode('hr', 'woo_shortcode_hr');

function woo_shortcode_divider($atts, $content = null) {
   return '<div class="woo-sc-divider"></div>';
}
add_shortcode('divider', 'woo_shortcode_divider');

function woo_shortcode_divider_flat($atts, $content = null) {
   return '<div class="woo-sc-divider flat"></div>';
}
add_shortcode('divider_flat', 'woo_shortcode_divider_flat');


/*-----------------------------------------------------------------------------------*/
/* 11. Quote - quote
/*-----------------------------------------------------------------------------------*/
/*

Optional arguments:
 - style: boxed 
 - float: left, right
 
*/
function woo_shortcode_quote($atts, $content = null) {
   	extract(shortcode_atts(array(	'style' => '',
   									'float' => ''), $atts));
   $class = '';
   if ( $style )
   		$class .= ' '.$style;
   if ( $float )
   		$class .= ' '.$float;
   
   return '<div class="woo-sc-quote' . $class . '"><p>' . woo_remove_wpautop($content) . '</p></div>';
}
add_shortcode('quote', 'woo_shortcode_quote');

/*-----------------------------------------------------------------------------------*/
/* 12. Icon links - ilink
/*-----------------------------------------------------------------------------------*/
/*

Optional arguments:
 - style: download, note, tick, info
 - url: the url for your link 
 - icon: add an url to a custom icon
 
*/
function woo_shortcode_ilink($atts, $content = null) {
   	extract(shortcode_atts(array( 'style' => 'info', 'url' => '', 'icon' => ''), $atts));  
   	
   	if ( $icon )
   		$custom_icon = 'style="background:url('.$icon.') no-repeat left 40%;"'; 

   return '<span class="woo-sc-ilink"><a class="'.$style.'" href="'.$url.'" '.$custom_icon.'>' . woo_remove_wpautop($content) . '</a></span>';
}
add_shortcode('ilink', 'woo_shortcode_ilink');

/*-----------------------------------------------------------------------------------*/
/* 13. jQuery Toggle
/*-----------------------------------------------------------------------------------*/
/*

}

Optional arguments:
 - link: The toggle box trigger link
 - hide: Hide the toggle box on load 
 
*/
function woo_shortcode_toggle($atts, $content = null) {
   	extract(shortcode_atts(array( 	'link' => 'Toggle link', 
   									'hide' => '' ), $atts));  
   	
   	woo_check_shortcode_js('toggle');
   	
	$output .= '<a class="woo-sc-toggle-trigger">' . $link . '</a>';
	$output .= '<div class="woo-sc-toggle-box' . $show . '">' . woo_remove_wpautop($content) . '</div>';

	return $output; 
}
add_shortcode('toggle', 'woo_shortcode_toggle');


/*-----------------------------------------------------------------------------------*/
/* 8. Facebook Share Button - fbshare
/*-----------------------------------------------------------------------------------*/
/*

Source: http://developers.facebook.com/docs/share

Optional arguments:
 - type: box_count, button_count, button (default), icon_link, or icon
 - float: none, left, right (default: left)

*/
function woo_shortcode_fbshare($atts, $content = null) {
   	extract(shortcode_atts(array( 'type' => 'button', 'float' => 'left'), $atts));
				
	$output .= '
<div class="woo-fbshare '.$float.'">	
<a name="fb_share" type="'.$type.'" share_url="'.get_permalink($post->ID).'">' . woo_remove_wpautop($content) . '</a> 
<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" 
        type="text/javascript">
</script>
</div>
	';
	return $output;

}
add_shortcode('fbshare', 'woo_shortcode_fbshare');


/*-----------------------------------------------------------------------------------*/
/* THE END */
/*-----------------------------------------------------------------------------------*/
?>