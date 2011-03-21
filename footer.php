    <?php if ( ( function_exists('woo_sidebar') && (woo_active_sidebar("footer-1") || woo_active_sidebar("footer-2") || woo_active_sidebar("footer-3")) ) ) : ?>
      <div id="footer-out">
        <div id="footer">
          <div class="position wrap">
            <div class="block">
              <?php woo_sidebar("footer-1"); ?>
            </div>
            <div class="block">
              <?php woo_sidebar("footer-2"); ?>
            </div>
            <div class="block">
              <?php woo_sidebar("footer-3"); ?>
            </div>
          </div><!-- .position.wrap -->
        </div><!-- #footer -- >
      </div><!-- #footer-out -->
    <?php endif; ?>

    <div id="copyright-out">
      <div id="copyright" class="wrap">
        <div class="col-left">
          <p>&copy; <?php echo date('Y'); ?> <?php bloginfo(); ?>. <?php _e('All Rights Reserved.',woothemes); ?></p>
        </div><!-- .col-left -->
        <div class="col-right">
          <ul id="footer-link">
            <li><a href="http://www.caleum.com.br/" target="_blank">Caelum</a></li>
            <li><a href="<?php echo home_url() . '/feed/' ?>" target="_blank">RSS</a></li>
            <li><a href="http://www.caelum.com.br/newsletter/" target="_blank">Newsletter</a></li>
            <li><a href="http://www.caelum.com.br/contato/" target="_blank">Contato</a></li>
          </ul>
        </div><!-- .col-right -->
      </div><!-- #copyright.wrap -->
    </div><!-- #copyright-out -->

  </div>

  <?php wp_footer(); ?>
  <?php if ( get_option('woo_twitter') ) { ?>
    <script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
    <script type="text/javascript" src="http://twitter.com/statuses/user_timeline/<?php echo get_option('woo_twitter'); ?>.json?callback=twitterCallback2&amp;count=1"></script>
  <?php } ?>

  </body>
</html>