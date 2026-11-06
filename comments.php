<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package 10011mag
 * @since Resonar 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				$mag10011_comment_count = get_comments_number();
				if ( '1' === (string) $mag10011_comment_count ) {
					/* translators: %s: Post title. */
					printf( esc_html__( 'One thought on &ldquo;%s&rdquo;', '10011mag' ), esc_html( get_the_title() ) );
				} else {
					printf(
						/* translators: 1: Number of comments, 2: Post title. */
						esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $mag10011_comment_count, 'comments title', '10011mag' ) ),
						esc_html( number_format_i18n( $mag10011_comment_count ) ),
						esc_html( get_the_title() )
					);
				}
			?>
		</h2>

		<?php mag10011_comment_nav(); ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 64,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php mag10011_comment_nav(); ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', '10011mag' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- .comments-area -->
