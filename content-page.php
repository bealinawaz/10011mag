<?php
/**
 * The template used for displaying page content
 *
 * @package 10011mag
 * @since Resonar 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		if ( has_post_thumbnail() && ! post_password_required() ) :
			$featuredimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'mag10011-large' );
	?>
		<div class="entry-header-background" style="background-image:url(<?php echo esc_url( $featuredimage[0] ); ?>)">
			<div class="entry-header-wrapper">
				<header id="entry-header" class="entry-header">
					<div class="entry-header-inner">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</div>
					<div class="scroll-indicator-wrapper">
						<a href="#" id="scroll-indicator" class="scroll-indicator"><span class="screen-reader-text"><?php esc_html_e( 'Scroll down to see more content', '10011mag' );?></span></a>
					</div>
				</header>
			</div>
		</div>
	<?php else : ?>
		<header class="entry-header">
			<div class="entry-header-inner">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</div>
		</header>
	<?php endif; ?>

	<div class="entry-content-footer">
		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', '10011mag' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', '10011mag' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				) );
			?>
		</div><!-- .entry-content -->

		<?php edit_post_link( __( 'Edit', '10011mag' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer><!-- .entry-footer -->' ); ?>
	</div>
</article><!-- #post-## -->
