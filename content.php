<?php
/**
 * The default template for displaying a post in a list.
 *
 * @package 10011mag
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'not-featured' ); ?>>

	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		<?php mag10011_entry_subtitle(); ?>
		<div class="entry-metadata">
			<?php mag10011_entry_byline(); ?>
		</div>
		<div class="entry-category">
			<?php mag10011_entry_categories( ' — ' ); ?>
		</div>
	</header>
	<a class="wp-post-image" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" aria-hidden="true"><?php the_post_thumbnail( 'full' ); ?></a>
	<div class="entry-content"><?php echo esc_html( wp_trim_words( get_the_content(), 60, '...' ) ); ?></div><!-- .entry-content -->

</article>
