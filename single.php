<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package 10011mag
 * @since Resonar 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			get_template_part( 'content', 'single' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			// Previous/next post navigation.
			the_post_navigation( array(
				'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', '10011mag' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Next post:', '10011mag' ) . '</span> ' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', '10011mag' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Previous post:', '10011mag' ) . '</span> ' .
					'<span class="post-title">%title</span>',
			) );

		// End the loop.
		endwhile;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->
    <div id="fixednav" class="fixed-nav"><div class="fixed-nav-wrap">
		<?php if ( is_active_sidebar( 'sidebar-2' ) ) : dynamic_sidebar( 'sidebar-2' ); endif; // sidebar 2 ?>
    </div></div>

<?php get_footer(); ?>
