<?php
/**
 * The template for displaying comments
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
ob_start();
if ( have_comments() ) {
		$comments_number = number_format_i18n( get_comments_number() );
		echo "<div class='comments_title'> " . esc_html__( 'Comments', 'kiddy' ) . " ($comments_number)" . '</div>';

		wp_list_comments( array(
			'walker' => new KIDDY_Walker_Comment(),
			'avatar_size' => 70,
		) );
		kiddy_comment_nav();
}

	// If comments are closed and there are comments, let's leave a little note, shall we?
if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
	echo "<p class='no-comments'>" . esc_html__( 'Comments are closed.', 'kiddy' ) . '</p>';
}

	$comment_form_args = array(
	);
	ob_start();
	comment_form( $comment_form_args );
	$comment_form = ob_get_clean();
	echo trim( $comment_form );

$comments_section_content = ob_get_clean();
echo ! empty( $comments_section_content ) ? "<div class='grid_row'><div id='comments' class='comments-area'>$comments_section_content</div></div>" : '';
?>
