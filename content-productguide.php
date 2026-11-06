<?php
/**
 * The template for displaying a product in a gift guide.
 *
 * @package 10011mag
 */

$mag10011_brand_name = get_post_meta( get_the_ID(), 'product-brand-name', true );
$mag10011_brand_link = get_post_meta( get_the_ID(), 'product-brand-link', true );
$mag10011_buy_link   = get_post_meta( get_the_ID(), 'product-buy-link', true );
$mag10011_product    = function_exists( 'wc_get_product' ) ? wc_get_product( get_the_ID() ) : null;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php the_post_thumbnail( 'large-square-thumb' ); ?>
	<div class="product-grid-item-overlay">
		<?php if ( $mag10011_brand_name ) : ?>
			<p class="product-brand-name product-brand-link">
				<?php if ( $mag10011_brand_link ) : ?>
					<a href="<?php echo esc_url( $mag10011_brand_link ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $mag10011_brand_name ); ?></a>
				<?php else : ?>
					<?php echo esc_html( $mag10011_brand_name ); ?>
				<?php endif; ?>
			</p>
		<?php endif; ?>
		<?php the_title( '<h2 class="entry-title product-title">', '</h2>' ); ?>
		<?php if ( $mag10011_product ) : ?>
			<p class="product-price"><?php echo wp_kses_post( $mag10011_product->get_price_html() ); ?></p>
		<?php endif; ?>
		<a class="product-expand" href="<?php the_permalink(); ?>"><span class="screen-reader-text"><?php esc_html_e( 'Expand product description', '10011mag' ); ?></span></a>
	</div>
	<div class="product-details">
		<?php the_excerpt(); ?>
		<div class="entry-metadata">
			<p><?php esc_html_e( 'Added:', '10011mag' ); ?> <?php mag10011_entry_dates(); ?></p>
		</div>
		<?php if ( $mag10011_buy_link ) : ?>
			<p class="product-buy-button"><a href="<?php echo esc_url( $mag10011_buy_link ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Buy', '10011mag' ); ?></a></p>
		<?php endif; ?>
	</div>
</article>
