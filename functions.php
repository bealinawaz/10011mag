<?php
/**
 * Resonar functions and definitions
 *
 * @package 10011mag
 * @since Resonar 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1088;
}

if ( ! function_exists( 'mag10011_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mag10011_setup() {

	// Make the theme available for translation. Translations can be added to the /languages/ directory.
	load_theme_textdomain( '10011mag', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_theme_support/
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 256, 256, true );
	add_image_size( 'mag10011-large', 2000, 1500, true  );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu',      '10011mag' ),
		'social'  => __( 'Social Links Menu', '10011mag' ),
		'secondary'  => __( 'Secondary Menu', '10011mag' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style', 'navigation-widgets' )
	);

	// Embeds keep their aspect ratio, and widgets refresh in the Customizer without a full reload.
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Site logo.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 100,
			'width'       => 400,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		)
	);

	// WooCommerce and its product gallery features.
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'mag10011_custom_background_args', array(
		'default-color'    => 'ffffff',
		'wp-head-callback' => 'mag10011_custom_background_cb'
	) ) );

	// Style the editor to resemble the front end: fonts, colors, icons and column width.
	add_theme_support( 'editor-styles' );
	add_editor_style( array( 'editor-style.css', 'genericons/genericons.css', mag10011_fonts_url() ) );
}
endif; // mag10011_setup
add_action( 'after_setup_theme', 'mag10011_setup' );

if ( ! function_exists( 'mag10011_custom_background_cb' ) ) :
/**
 * Add a wp-head callback to the custom background
 *
 * @since Resonar 1.0.3
 */
function mag10011_custom_background_cb() {
	$background_image = get_background_image();
	$color = get_background_color();
	if ( ! $background_image && ! $color ) { return; } ?>
	<style type="text/css" id="mag10011-custom-background-css">
	<?php if ( ! empty ( $background_image ) ) { ?>
			body.custom-background {
				background-image: url(<?php echo esc_url( $background_image ); ?>);
			}

	<?php } elseif ( 'ffffff' != $color ) { ?>
			body.custom-background,
			.site-header .sub-menu li,
			.sidebar {
				background-color: #<?php echo esc_attr( $color ); ?>;
			}

			.site-header .nav-menu > li > .sub-menu:after {
				border-color: #<?php echo esc_attr( $color ); ?> transparent;
			}

			.pagination .prev:hover,
			.pagination .prev:focus,
			.pagination .next:hover,
			.pagination .next:focus,
			.widget_calendar tbody a,
			.widget_calendar tbody a:hover,
			.widget_calendar tbody a:focus,
			.page-links a,
			.page-links a:hover,
			.page-links a:focus {
				color: #<?php echo esc_attr( $color ); ?>;
			}
	<?php } ?>
	</style>
<?php } endif;

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function mag10011_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widget Area', '10011mag' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', '10011mag' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Sidebar Area', '10011mag' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your sidebar.', '10011mag' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
} add_action( 'widgets_init', 'mag10011_widgets_init' );

if ( ! function_exists( 'mag10011_fonts_url' ) ) :
/**
 * Register Google fonts for Resonar.
 *
 * @since Resonar 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function mag10011_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Libre Baskerville, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Libre Baskerville font: on or off', '10011mag' ) ) {
		$fonts[] = 'Libre Baskerville:400,700,400italic';
	}

	/* translators: If there are characters in your language that are not supported by Lato, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Lato font: on or off', '10011mag' ) ) {
		$fonts[] = 'Lato:400,700,900,400italic,700italic,900italic';
	}

	/* translators: If there are characters in your language that are not supported by Playfair Display, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Playfair Display font: on or off', '10011mag' ) ) {
		$fonts[] = 'Playfair Display:400,700,400italic,700italic';
	}

	/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', '10011mag' ) ) {
		$fonts[] = 'Inconsolata:400';
	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'cyrillic'. Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Add new subset (cyrillic)', '10011mag' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Resonar 1.0
 */
function mag10011_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
	?><link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"><?php
}
add_action( 'wp_head', 'mag10011_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 *
 * @since Resonar 1.0
 */
function mag10011_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'mag10011-fonts', mag10011_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.3' );

	$version = wp_get_theme( get_template() )->get( 'Version' );

	// Load our main stylesheet.
	wp_enqueue_style( 'mag10011-style', get_stylesheet_uri(), array(), $version );

	// Magazine layout styles.
	wp_enqueue_style( 'mag10011-style2', get_template_directory_uri() . '/style2.css', array( 'mag10011-style' ), $version );

	// Styles for Jetpack features such as the social menu.
	wp_enqueue_style( 'mag10011-jetpack', get_template_directory_uri() . '/jetpack.css', array( 'mag10011-style2' ), $version );

	// Header and WooCommerce layout adjustments.
	wp_enqueue_style( 'mag10011-overrides', get_template_directory_uri() . '/css/overrides.css', array( 'mag10011-jetpack' ), $version );

	wp_enqueue_script( 'mag10011-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20150302', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'mag10011-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20150302' );
	}

	wp_enqueue_script( 'mag10011-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), $version, true );

	// Pins the widget area on scroll. It does nothing on pages without the fixed widget area.
	wp_enqueue_script( 'mag10011-fixed-nav', get_template_directory_uri() . '/js/fixed-nav.js', array( 'jquery' ), $version, true );

	wp_localize_script( 'mag10011-script', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', '10011mag' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', '10011mag' ) . '</span>',
	) );

	wp_localize_script( 'mag10011-script', 'toggleButtonText', array(
		'menu'    => __( 'Menu', '10011mag' ),
		'widgets' => __( 'Widgets', '10011mag' ),
		'both'    => __( 'Menu &amp; Widgets', '10011mag' ),
	) );
} add_action( 'wp_enqueue_scripts', 'mag10011_scripts' );

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 *
 * @since Resonar 1.0
 */
function mag10011_admin_fonts() {
	wp_enqueue_style( 'mag10011-fonts', mag10011_fonts_url(), array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'mag10011_admin_fonts' );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Resonar 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function mag10011_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'mag10011_search_form_modify' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function mag10011_body_classes( $classes ) {
	if ( is_singular() ) {
		$classes[] = 'single';
	}

	if ( has_nav_menu( 'primary' ) ) {
		$classes[] = 'custom-menu';
	}

	return $classes;
}
add_filter( 'body_class', 'mag10011_body_classes' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';




/**
 * Post and product option meta boxes.
 */
require get_template_directory() . '/inc/meta-boxes.php';



/**
 * Registers the Gift Guide taxonomy for products.
 */
function mag10011_register_gift_guides() {
	$labels = array(
		'name'              => _x( 'Gift Guides', 'taxonomy general name', '10011mag' ),
		'singular_name'     => _x( 'Gift Guide', 'taxonomy singular name', '10011mag' ),
		'search_items'      => __( 'Search Gift Guides', '10011mag' ),
		'all_items'         => __( 'All Gift Guides', '10011mag' ),
		'parent_item'       => __( 'Parent Gift Guide', '10011mag' ),
		'parent_item_colon' => __( 'Parent Gift Guide:', '10011mag' ),
		'edit_item'         => __( 'Edit Gift Guide', '10011mag' ),
		'update_item'       => __( 'Update Gift Guide', '10011mag' ),
		'add_new_item'      => __( 'Add New Gift Guide', '10011mag' ),
		'new_item_name'     => __( 'New Gift Guide Name', '10011mag' ),
		'menu_name'         => __( 'Gift Guides', '10011mag' ),
	);

	register_taxonomy(
		'productguide',
		array( 'product' ),
		array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_in_rest'      => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'buy-guides' ),
		)
	);
}
add_action( 'init', 'mag10011_register_gift_guides' );



/**
 * Replaces the WooCommerce sidebar with the theme's fixed widget area.
 */
function mag10011_woocommerce_sidebar() {
	?>
	<div id="fixednav" class="fixed-nav"><div class="fixed-nav-wrap">
		<?php
		if ( is_active_sidebar( 'sidebar-2' ) ) {
			dynamic_sidebar( 'sidebar-2' );
		}
		?>
	</div></div>
	<?php
}
add_action( 'woocommerce_sidebar', 'mag10011_woocommerce_sidebar' );

/**
 * Returns the extra body classes used by the header for full-screen featured posts.
 *
 * @return string
 */
function mag10011_header_body_class() {
	if ( is_home() ) {
		return 'blog has-fullscreen-featured-post';
	}

	if ( is_single() && 'featured' === get_post_meta( get_queried_object_id(), 'bb_featured', true ) ) {
		return 'blog has-fullscreen-featured-post';
	}

	return '';
}