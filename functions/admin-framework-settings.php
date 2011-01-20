<?php
/*-----------------------------------------------------------------------------------*/
/* Framework Settings page - woothemes_framework_settings_page */
/*-----------------------------------------------------------------------------------*/

function woothemes_framework_settings_page(){
    $themename =  get_option('woo_themename');      
    $manualurl =  get_option('woo_manual'); 
	$shortname =  'framework_woo'; 

    //Framework Version in Backend Head
    $woo_framework_version = get_option('woo_framework_version');
    
    //Version in Backend Head
    $theme_data = get_theme_data(TEMPLATEPATH . '/style.css');
    $local_version = $theme_data['Version'];
    
    //GET themes update RSS feed and do magic
	include_once(ABSPATH . WPINC . '/feed.php');

	$pos = strpos($manualurl, 'documentation');
	$theme_slug = str_replace("/", "", substr($manualurl, ($pos + 13))); //13 for the word documentation
	
    //add filter to make the rss read cache clear every 4 hours
    add_filter( 'wp_feed_cache_transient_lifetime', create_function( '$a', 'return 14400;' ) );
	
	$framework_options = array();
	
	$framework_options[] = array( 	"name" => "Framework Options",
									"type" => "heading");

	$framework_options[] = array( 	"name" => "Theme Version Checker",
									"desc" => "This will enable notices on your theme options page that there is an update available for your theme.",
									"id" => $shortname."_theme_version_checker",
									"std" => "",
									"type" => "checkbox");	
									
	$framework_options[] = array( 	"name" => "Disable Buy Themes Tab",
									"desc" => "This disables the 'Buy Themes' tab. This page lists the latest availabe themes from the WooThemes.com website.",
									"id" => $shortname."_buy_themes",
									"std" => "",
									"type" => "checkbox");	
								
	$framework_options[] = array( 	"name" => "Disable Shortcodes Stylesheet",
									"desc" => "This disables the output of shortcodes.css in the HEAD section of your site.",
									"id" => $shortname."_disable_shortcodes",
									"std" => "",
									"type" => "checkbox");	
									
	$framework_options[] = array( 	"name" => "Remove Generator Meta Tags",
									"desc" => "This disables the output of generator meta tags in the HEAD section of your site.",
									"id" => $shortname."_disable_generator",
									"std" => "",
									"type" => "checkbox");	

	$framework_options[] = array( 	"name" => "Super User ID",
									"desc" => "Add the User ID to this field to hide the Framework Settings panel from other users. Can be reset from the <code>wp-admin/options.php</code> under <em>framework_woo_super_user</em>.",
									"id" => $shortname."_super_user", 
									"std" => "",
									"class" => "mini",
									"type" => "text");		
										
	$framework_options[] = array( 	"name" => "Image Placeholder",
									"desc" => "Set a default image placeholder for your thumbnails. Use this if you want a default image to be shown if you haven't added a custom image to your post.",
									"id" => $shortname."_default_image",
									"std" => "",
									"type" => "upload");

	$framework_options[] = array( 	"name" => "Branding",
									"type" => "heading");
	
	$framework_options[] = array( 	"name" => "Options panel header",
									"desc" => "Change the header image for the WooThemes Backend.",
									"id" => $shortname."_backend_header_image",
									"std" => "",
									"type" => "upload");
									
	$framework_options[] = array( 	"name" => "Options panel icon",
									"desc" => "Change the icon image for the WordPress backend sidebar.",
									"id" => $shortname."_backend_icon",
									"std" => "",
									"type" => "upload");
									
	$framework_options[] = array( 	"name" => "Import Options",
									"type" => "heading");
									
	$framework_options[] = array( 	"name" => "Import options from another WooThemes instance",
									"desc" => "You can transfer options from another WooThemes (same theme) to this one by copying the export code and adding it here. Works best if it's imported from identical themes.",
									"id" => $shortname."_import_options",
									"std" => "",
									"type" => "textarea");
									
	$framework_options[] = array( 	"name" => "Export Options",
									"type" => "heading");
									
								//Create, Encrypt and Update the Saved Settings
                                global $wpdb;
								delete_option('framework_woo_export_options');
                                $options = get_option('woo_template');
                                $query_inner = '';
                                $count = 0;
								foreach($options as $option){
									
									if(isset($option['id'])){ 
										$count++;
										$option_id = $option['id'];
										
										if($count > 1){ $query_inner .= ' OR '; }
										$query_inner .= "option_name = '$option_id'";
									}
								}
								
								$query = "SELECT * FROM $wpdb->options WHERE $query_inner";
								                                
                                $results = $wpdb->get_results($query);
                                
                                foreach ($results as $result){
                                
                                     $output[$result->option_name] = $result->option_value;
                                
                                }
                                $output = serialize($output);										
													
	$framework_options[] = array( 	"name" => "Use the code below to export this themes settings to another theme",
									"desc" => "You can transfer options from another WooThemes (same theme) to this one by copying the export code and adding it here. Works best if it's imported from identical themes.",
									"id" => $shortname."_export_options",
									"std" => base64_encode($output),
									"type" => "textarea");
									
	$framework_options[] = array( 	"name" => "Font Stacks (Beta)",
									"type" => "heading");		
	
	$framework_options[] = array( 	"name" => "Font Stack Builder",
									"desc" => "Use the font stack builder to add your own custom font stacks to your theme.
									To create a new stack, fill in the name and a CSS ready font stack.
									Once you have added a stack you can select it from the font menu on any of the 
									Typography settings in your theme options.",
									"id" => $shortname."_font_stack", 
									"std" => "Added Font Stacks",
									"type" => "string_builder");
	
						
	
					
	update_option('woo_framework_template',$framework_options);

    
	?>

    <div class="wrap" id="woo_container">
    <div id="woo-popup-save" class="woo-save-popup"><div class="woo-save-save">Options Updated</div></div>
    <div id="woo-popup-reset" class="woo-save-popup"><div class="woo-save-reset">Options Reset</div></div>
        <form action="" enctype="multipart/form-data" id="wooform">
            <div id="header">
                <div class="logo">
                <?php if(get_option('framework_woo_backend_header_image')) { ?>
                <img alt="" src="<?php echo get_option('framework_woo_backend_header_image'); ?>"/>
                <?php } else { ?>
                <img alt="WooThemes" src="<?php echo bloginfo('template_url'); ?>/functions/images/logo.png"/>
                <?php } ?>
                </div>
                <div class="theme-info">
                    <span class="theme"><?php echo $themename; ?> <?php echo $local_version; ?></span>
                    <span class="framework">Framework <?php echo $woo_framework_version; ?></span>
                </div>
                <div class="clear"></div>
            </div>
            <div id="support-links">
                <ul>
                    <li class="changelog"><a title="Theme Changelog" href="<?php echo $manualurl; ?>#Changelog">View Changelog</a></li>
                    <li class="docs"><a title="Theme Documentation" href="<?php echo $manualurl; ?>">View Themedocs</a></li>
                    <li class="forum"><a href="http://forum.woothemes.com" target="_blank">Visit Forum</a></li>
                    <li class="right"><img style="display:none" src="<?php echo bloginfo('template_url'); ?>/functions/images/loading-top.gif" class="ajax-loading-img ajax-loading-img-top" alt="Working..." /><a href="#" id="expand_options">[+]</a> <input type="submit" value="Save All Changes" class="button submit-button" /></li>
                </ul>
            </div>
            <?php $return = woothemes_machine($framework_options); ?>
            <div id="main">
                <div id="woo-nav">
                    <ul>
                        <?php echo $return[1]; ?> 
                    </ul>		
                </div>
                <div id="content">
   				<?php echo $return[0]; ?> 
                </div>
                <div class="clear"></div>
                
            </div>
            <div class="save_bar_top">
            <img style="display:none" src="<?php echo bloginfo('template_url'); ?>/functions/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />
            <input type="submit" value="Save All Changes" class="button submit-button" />        
            </form>
            
             <form action="<?php echo wp_specialchars( $_SERVER['REQUEST_URI'] ) ?>" method="post" style="display:inline" id="wooform-reset">
            <span class="submit-footer-reset">
            <input name="reset" type="submit" value="Reset Options" class="button submit-button reset-button" onclick="return confirm('Click OK to reset. Any settings will be lost!');" />
            <input type="hidden" name="woo_save" value="reset" /> 
            </span>
        	</form>
            
            
            </div>    
    
    <div style="clear:both;"></div>    
    </div><!--wrap-->

<?php } ?>