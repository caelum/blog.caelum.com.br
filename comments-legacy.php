<?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>

			<p>This post is password protected. Enter the password to view comments.<p>

			<?php
			return;
		}
	}

	/* This variable is for alternating comment background */
	$oddcomment = 'comment';
?>

<!-- You can start editing here. -->

<?php if ($comments) : ?>

<div id="comments_wrap">

<h3><?php comments_number('No Comments', 'One Comment', '% Comments' );?></h3>

<?php foreach ($comments as $comment) : ?>

    <div class="comment wrap" id="comment-<?php comment_ID() ?>">
        <div class="col-left">
            <div class="inside">
                <img src="<?php gravatar('X', '70'); ?>" alt="<?php //_e('Gravatar'); ?>" />
                <p><?php comment_author_link() ?><br /></p>
                <p><small><?php comment_date('d. M, Y'); ?></small></p>
            </div>
        </div>
        <div class="col-right">
            <?php comment_text() ?>
            <?php if ($comment->comment_approved == '0') : ?>
            <p><em>Your comment is awaiting moderation.</em></p>
            <?php endif; ?>
        </div>
    </div>

	<?php /* Changes every other comment to a different class */
		if ('comment' == $oddcomment) $oddcomment = 'alt';
		else $oddcomment = 'comment';
	?>

	<?php endforeach; /* end for each comment */ ?>
	
	</div>


 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<!--<p class="nocomments">Comments are closed.</p>-->

	<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>
<div id="form_wrap">

<h3 class="lc">Leave a reply</h3>


<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<h3>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>">logged in</a> to post a comment.</h3>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" onsubmit="if (url.value == 'Website (optional)') {url.value = '';}">
<div>
<?php if ( $user_ID ) : ?>
<p class="lc_logged">Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Logout</a></p>
<textarea rows="9" cols="10" name="comment" tabindex="4" onfocus="if (this.value == 'Type your comment here...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Type your comment here...';}">Type your comment here...</textarea>
<input type="image" name="submit" tabindex="5" src="<?php bloginfo('template_directory'); ?>/<?php woo_style_path(); ?>/img_leave_comment.gif" class="sb" />
<?php else : ?>


<div class="form-left">
<input type="text" name="author" id="author" tabindex="1" value="Name <?php if ($req) echo "(required)"; ?>" onfocus="if (this.value == 'Name (required)') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Name (required)';}" />
<input type="text" name="email" id="email" tabindex="2" value="Email <?php if ($req) echo "(required)"; ?>" onfocus="if (this.value == 'Email (required)') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Email (required)';}" />
<input type="text" name="url" id="url" tabindex="3" value="Website (optional)" onfocus="if (this.value == 'Website (optional)') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Website (optional)';}" />
</div>
<div class="form-right">
<textarea rows="9" cols="10" name="comment" tabindex="4" onfocus="if (this.value == 'Type your comment here...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Type your comment here...';}">Type your comment here...</textarea>
<input type="image" name="submit" tabindex="5" src="<?php bloginfo('template_directory'); ?>/<?php woo_style_path(); ?>/img_leave_comment.gif" class="sb" />
</div>
<?php endif; ?>
<!--<p><small><strong>XHTML:</strong> You can use these tags: <?php echo allowed_tags(); ?></small></p>-->

<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />

<?php do_action('comment_form', $post->ID); ?>
</div>
<div class="fix"></div>
</form>

<?php endif; // If registration required and not logged in ?>
</div>

<?php endif; // if you delete this the sky will fall on your head ?>

