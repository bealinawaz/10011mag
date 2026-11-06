<?php
/**
 * The template for displaying a single post.
 *
 * @package 10011mag
 */

$mag10011_page_links = array(
	'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', '10011mag' ) . '</span>',
	'after'       => '</div>',
	'link_before' => '<span>',
	'link_after'  => '</span>',
	'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', '10011mag' ) . ' </span>%',
	'separator'   => '<span class="screen-reader-text">, </span>',
);
?>

<?php if ( 'featured' === get_post_meta( get_the_ID(), 'bb_featured', true ) ) : ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php mag10011_featured_header( 'h2', ' ' ); ?>

	</article>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( $mag10011_page_links ); ?>
	</div><!-- .entry-content -->
<?php else : ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<header id="entry-header" class="entry-header">
			<?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>
			<div class="entry-category">
				<?php mag10011_entry_categories(); ?>
			</div>
		</header>

		<?php the_post_thumbnail( 'large-square-thumb' ); ?>

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( $mag10011_page_links ); ?>
			<div class="entry-metadata">
				<p><?php esc_html_e( 'Added:', '10011mag' ); ?> <?php mag10011_entry_dates(); ?></p>
			</div>
		</div><!-- .entry-content -->
		<footer class="entry-footer"><div class="posted-in">
			<span class="cat-links productcategory-links">
				<span class="screen-reader-text"><?php esc_html_e( 'Categories', '10011mag' ); ?></span>
				<span class="posted-in-text"><?php esc_html_e( 'Posted in', '10011mag' ); ?> </span>
				<?php the_terms( get_the_ID(), 'category', '', ' ' ); ?>
			</span>

			<span class="cat-links productguide-links">
				<span class="screen-reader-text"><?php esc_html_e( 'Gift Guides', '10011mag' ); ?></span>
				<span class="posted-in-text"><?php esc_html_e( 'Gift Guides:', '10011mag' ); ?> </span>
				<?php the_terms( get_the_ID(), 'productguide', '', ' ' ); ?>
			</span>

			<span class="tags-links">
				<span class="screen-reader-text"><?php esc_html_e( 'Tags', '10011mag' ); ?></span>
				<?php the_tags( '', ' ' ); ?>
			</span>
		</div></footer><!-- .entry-footer -->

	</article>

<?php endif; ?>
