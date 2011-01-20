<div id="search_main" class="block">
    <form method="get" id="searchform" action="<?php bloginfo('url'); ?>">
        <div>
        <input type="text" class="field" name="s" id="s"  value="<?php _e('Enter keywords...',woothemes); ?>" onfocus="if (this.value == '<?php _e('Enter keywords...',woothemes); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Enter keywords...',woothemes); ?>';}" />
        <input type="image" src="<?php bloginfo('template_directory'); ?>/<?php woo_style_path(); ?>/img_search.gif" class="submit" name="submit" />
        </div>
    </form>
</div>
