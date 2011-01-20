<?php
// Fist full of comments
function custom_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
                 
<li class="comment wrap" id="comment-<?php comment_ID() ?>">

    <div class="col-left">
        <div class="inside">
			<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>
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
            
	<?php echo comment_reply_link(array('before' => '<span class="reply">', 'after' => '</span>', 'reply_text' => 'Reply to this comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ));  ?>

	<div class="fix"></div>

<?php 
}

// PINGBACK / TRACKBACK OUTPUT
function list_pings($comment, $args, $depth) {

	$GLOBALS['comment'] = $comment; ?>
	
	<li id="comment-<?php comment_ID(); ?>">
		<span class="author"><?php comment_author_link(); ?></span> - 
		<span class="date"><?php echo get_comment_date(get_option('date_format')) ?></span>
		<span class="pingcontent"><?php comment_text() ?></span>

<?php  
}

function the_commenter_link() {
    $commenter = get_comment_author_link();
    if ( ereg( ']* class=[^>]+>', $commenter ) ) {$commenter = ereg_replace( '(]* class=[\'"]?)', '\\1url ' , $commenter );
    } else { $commenter = ereg_replace( '(<a )/', '\\1class="url "' , $commenter );}
    echo $commenter ;
}

function the_commenter_avatar() {
    $email = get_comment_author_email();
    $avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( "$email", "32" ) );
    echo $avatar;
}

?>