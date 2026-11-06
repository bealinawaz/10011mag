<?php
/**
 * Resonar Theme Customizer
 *
 * @package 10011mag
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function mag10011_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';

	// Add custom description to controls or sections.
	$wp_customize->get_control( 'blogdescription' )->description  = __( 'Tagline is hidden in this theme.', '10011mag' );
}
add_action( 'customize_register', 'mag10011_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function mag10011_customize_preview_js() {
	wp_enqueue_script( 'mag10011_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
	wp_enqueue_script( 'mag10011-dotorg-customizer', get_template_directory_uri() . '/js/dotorg-customizer.js', array( 'customize-preview' ), '20150414', true );
}
add_action( 'customize_preview_init', 'mag10011_customize_preview_js' );
