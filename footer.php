	<?php if ( ( function_exists('woo_sidebar') && (woo_active_sidebar("footer-1") || woo_active_sidebar("footer-2") || woo_active_sidebar("footer-3")) ) ) : ?>

	<!-- Footer Starts -->
	<div id="footer-out">
	<div id="footer">
	<div class="position wrap">
		
		<!-- Footer Widget Area Starts -->
		
		<div class="block">
			<?php woo_sidebar("footer-1"); ?>		           
		</div>
		<div class="block">
			<?php woo_sidebar("footer-2"); ?>		           
		</div>
		<div class="block">
			<?php woo_sidebar("footer-3"); ?>		           
		</div>
		
		<!-- Footer Widget Area Ends -->
		
	</div>
	</div>
	</div>
	<!-- Footer Ends -->
	
		<?php endif; ?>
		
	<!-- Copyright Starts -->
	<div id="copyright-out">
	<div id="copyright" class="wrap">
		<div class="col-left">
			<p>&copy; <?php echo date('Y'); ?> <?php bloginfo(); ?>. <?php _e('All Rights Reserved.',woothemes); ?></p>
		</div>
		<div class="col-right">
			<p><?php _e('Powered by WordPress. Designed by',woothemes); ?> <a href="#"><img src="<?php bloginfo('template_directory'); ?>/<?php woo_style_path() ?>/img_woothemes.jpg" width="87" height="footer-21" alt="Woo Themes" /></a></p>
		</div>
	</div>
	</div>
	<!-- Copyright Ends -->
	
</div>
<?php wp_footer(); ?>


<?php if ( get_option('woo_twitter') ) { ?>
	<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
	<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/<?php echo get_option('woo_twitter'); ?>.json?callback=twitterCallback2&amp;count=1"></script>
<?php } ?>

</body>
</html>