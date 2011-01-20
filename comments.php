<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.',woothemes); ?></p>
	<?php
		return;
	}
?>

<?php $comments_by_type = &separate_comments($comments); ?>    

<!-- You can start editing here. -->

<div id="comments_wrap">

<?php if ( have_comments() ) : ?>

	<?php if ( ! empty($comments_by_type['comment']) ) : ?>

	<h3><?php comments_number(__('No Responses',woothemes), __('One Response',woothemes), __('% Responses',woothemes) );?> <?php _e('to',woothemes); ?> &#8220;<?php the_title(); ?>&#8221;</h3>

	<ol class="commentlist">
	<?php wp_list_comments('avatar_size=70&callback=custom_comment&type=comment'); ?>
	</ol>
	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
		<div class="fix"></div>
	</div>
 
	<?php endif; ?>
		
	<?php if ( ! empty($comments_by_type['pings']) ) : ?>
    		
        <h3 id="pings"><?php _e('Trackbacks/Pingbacks', 'woothemes') ?></h3>
    
        <ol class="pinglist">
            <?php wp_list_comments('type=pings&callback=list_pings'); ?>
        </ol>
    	
	<?php endif; ?>

<?php else : // this is displayed if there are no comments so far ?>
	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->
		<p class="nocomments"><?php _e('No comments.',woothemes); ?></p>

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php _e('Comments are closed.',woothemes); ?></p>

	<?php endif; ?>

<?php endif; ?>

</div> <!-- end #comments_wrap -->

<div id="respond">
<div id="form_wrap">
<?php if ('open' == $post->comment_status) : ?>


<h3><?php comment_form_title( __('Leave a Reply',woothemes), __('Leave a Reply to %s',woothemes) ); ?></h3>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>

<p><?php _e('You must be',woothemes); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('logged in',woothemes); ?></a> <?php _e('to post a comment.',woothemes); ?></p>

<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" onsubmit="if (url.value == '<?php _e('Website (optional)',woothemes); ?>') {url.value = '';}">

<?php if ( $user_ID ) : ?>

<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>

<p><?php _e('Logged in as',woothemes); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account"><?php _e('Log out &raquo;',woothemes); ?></a></p>

<textarea rows="9" cols="10" name="comment" tabindex="4" onfocus="if (this.value == '<?php _e('Type your comment here...',woothemes); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Type your comment here...',woothemes); ?>';}"><?php _e('Type your comment here...',woothemes); ?></textarea>
<input type="image" name="submit" tabindex="5" src="<?php bloginfo('template_directory'); ?>/<?php woo_style_path(); ?>/img_leave_comment.gif" class="sb" />

<?php else : ?>

<div class="form-left">
<input type="text" name="author" id="author" tabindex="1" value="<?php if ( $comment_author ) echo esc_attr($comment_author); else _e('Name (required)', woothemes); ?>" onfocus="if (this.value == '<?php _e('Name (required)',woothemes); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Name (required)',woothemes); ?>';}" />
<input type="text" name="email" id="email" tabindex="2" value="<?php if ( $comment_author_email ) echo esc_attr($comment_author_email); else _e('Email (required)', woothemes); ?>" onfocus="if (this.value == '<?php _e('Email (required)',woothemes); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Email (required)',woothemes); ?>';}" />
<input type="text" name="url" id="url" tabindex="3" value="<?php if ( $comment_author_url ) echo esc_attr($comment_author_url); else _e('Website (optional)', woothemes); ?>" onfocus="if (this.value == '<?php _e('Website (optional)',woothemes); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Website (optional)',woothemes); ?>';}" />
<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>

</div>
<div class="form-right">
<textarea rows="9" cols="10" name="comment" id="comment" tabindex="4" onfocus="if (this.value == '<?php _e('Type your comment here...',woothemes); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Type your comment here...',woothemes); ?>';}"><?php _e('Type your comment here...',woothemes); ?></textarea>
<input type="image" name="submit" tabindex="5" src="<?php bloginfo('template_directory'); ?>/<?php woo_style_path(); ?>/img_leave_comment.gif" class="sb" />

</div>

<?php endif; // If logged in ?>

<?php comment_id_fields(); ?>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>


<?php endif; // if you delete this the sky will fall on your head ?>
<div class="fix"></div>
</div> <!-- end #form_wrap -->
</div> <!-- end #respond -->
