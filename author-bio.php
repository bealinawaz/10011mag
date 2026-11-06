<?php
/**
 * The template for displaying Author bios
 *
 * @package 10011mag
 * @since Resonar 1.0
 */
?>

<div class="author-info">
	<div class="author-avatar">
		<?php
		/**
		 * Filter the author bio avatar size.
		 *
		 * @since Resonar 1.0
		 *
		 * @param int $size The avatar height and width size in pixels.
		 */
		$mag10011_avatar_size = apply_filters( 'mag10011_author_bio_avatar_size', 64 );

		echo get_avatar( get_the_author_meta( 'user_email' ), $mag10011_avatar_size );
		?>
	</div><!-- .author-avatar -->

	<div class="author-description">
		<h2 class="author-heading"><?php esc_html_e( 'Published by', '10011mag' ); ?></h2>

		<h3 class="author-title"><?php echo esc_html( get_the_author() ); ?></h3>

		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?>
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php /* translators: %s: Author name. */
				printf( esc_html__( 'View all posts by %s', '10011mag' ), esc_html( get_the_author() ) ); ?>
			</a>
		</p><!-- .author-bio -->

	</div><!-- .author-description -->
</div><!-- .author-info -->
