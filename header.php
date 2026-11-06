<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package 10011mag
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>

<body <?php body_class( mag10011_header_body_class() ); ?>>
<?php wp_body_open(); ?>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', '10011mag' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="secondary-menus">
			<nav class="secondary-navigation" aria-label="<?php esc_attr_e( 'Secondary Menu', '10011mag' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'menu_id'        => 'menu-secondary-menu',
						'menu_class'     => 'nav-menu',
						'theme_location' => 'secondary',
					)
				);
				?>
			</nav><!-- .secondary-navigation -->
			<nav class="jetpack-social-navigation jetpack-social-navigation-svg" aria-label="<?php esc_attr_e( 'Social Links Menu', '10011mag' ); ?>">
				<?php wp_nav_menu( array( 'theme_location' => 'social' ) ); ?>
			</nav><!-- .jetpack-social-navigation -->
		</div>
		<div class="site-branding">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo-link" rel="home">
				<?php
				$mag10011_logo = has_custom_logo() ? wp_get_attachment_image_src( (int) get_theme_mod( 'custom_logo' ), 'full' ) : false;
				if ( $mag10011_logo ) :
					?>
					<img width="300" height="113" src="<?php echo esc_url( $mag10011_logo[0] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" sizes="(max-width: 300px) 100vw, 300px">
				<?php else : ?>
					<span class="site-title"><?php bloginfo( 'name' ); ?></span>
				<?php endif; ?>
			</a>
		</div><!-- .site-branding -->
		<button id="sidebar-toggle" class="sidebar-toggle" aria-expanded="false"><?php esc_html_e( 'Widgets', '10011mag' ); ?></button>
		<nav class="main-navigation" aria-label="<?php esc_attr_e( 'Primary Menu', '10011mag' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'menu_class'     => 'nav-menu',
					'theme_location' => 'primary',
				)
			);
			?>
		</nav><!-- .main-navigation -->
	</header>

	<div id="content" class="site-content">
