<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package 10011mag
 * @since Resonar 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		$mag10011_featured_image = has_post_thumbnail() && ! post_password_required() ? get_the_post_thumbnail_url( null, 'mag10011-large' ) : false;
		if ( $mag10011_featured_image ) :
	?>
		<div class="entry-header-background" style="background-image:url(<?php echo esc_url( $mag10011_featured_image ); ?>)">
			<div class="entry-header-wrapper">
				<header class="entry-header">
					<div class="entry-header-inner">
						<div class="entry-date">
							<?php mag10011_entry_date(); ?>
						</div>

						<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
					</div>
				</header>
			</div>
		</div>
	<?php else : ?>
		<header class="entry-header">
			<div class="entry-header-inner">
				<div class="entry-date">
					<?php mag10011_entry_date(); ?>
				</div>

				<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			</div>
		</header>
	<?php endif; ?>
</article><!-- #post-## -->
