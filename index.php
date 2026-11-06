<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package 10011mag
 * @since Resonar 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

			<?php
			// Start the loop.
			$mag10011_count = 1;
			while ( have_posts() ) :
				the_post();

				$mag10011_featured = get_post_meta( get_the_ID(), 'bb_featured', true );

				if ( 1 === $mag10011_count ) {
					if ( is_sticky() && ! is_paged() ) : get_template_part( 'content', 'sticky' ); else : get_template_part( 'content', "featured" ); endif;
				} elseif ( 'featured' === $mag10011_featured ) {
					if ( is_sticky() && ! is_paged() ) : get_template_part( 'content', 'sticky' ); else : get_template_part( 'content', "featured" ); endif;
				} else {
					if ( is_sticky() && ! is_paged() ) :
						get_template_part( 'content', 'sticky' );
					else :
						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					endif;
				}

			// End the loop.
				$mag10011_count++;
			endwhile;

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->
    <div id="fixednav" class="fixed-nav"><div class="fixed-nav-wrap">
		<?php if ( is_active_sidebar( 'sidebar-2' ) ) : dynamic_sidebar( 'sidebar-2' ); endif; // sidebar 2 ?>
    </div></div>

	<?php
		if ( have_posts() ) :
			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', '10011mag' ),
				'next_text'          => __( 'Next page', '10011mag' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', '10011mag' ) . ' </span>',
			) );
		endif;
	?>

<?php get_footer(); ?>
