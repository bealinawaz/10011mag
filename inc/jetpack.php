<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package 10011mag
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function mag10011_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'mag10011_jetpack_setup' );

/**
 * Add theme support for Responsive Videos
 *
 * @since Resonar 1.0
 */
function mag10011_responsive_videos_init() {
	add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'mag10011_responsive_videos_init' );

/**
 * Overwritte default gallery widget content width.
 *
 * @since Resonar 1.0
 */
function mag10011_gallery_widget_content_width( $width ) {
	return 576;
}
add_filter( 'gallery_widget_content_width', 'mag10011_gallery_widget_content_width');
