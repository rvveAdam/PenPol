<?php
/**
 * Pen-pol functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Pen-pol
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function pen_pol_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Pen-pol, use a find and replace
		* to change 'pen-pol' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'pen-pol', get_template_directory() . '/languages' );

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
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'pen-pol' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'pen_pol_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'pen_pol_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pen_pol_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'pen_pol_content_width', 640 );
}
add_action( 'after_setup_theme', 'pen_pol_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pen_pol_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'pen-pol' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'pen-pol' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'pen_pol_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function pen_pol_scripts() {
	// Domyślny style.css WordPress
	wp_enqueue_style( 'pen-pol-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'pen-pol-style', 'rtl', 'replace' );

	// Nasz główny plik stylów SCSS
	wp_enqueue_style(
		'pen-pol-main-style', 
		get_template_directory_uri() . '/assets/scss/main.css', 
		array(), 
		_S_VERSION
	);

	// Swiper CSS
	wp_enqueue_style(
		'swiper-css', 
		'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css',
		array(),
		'8.0.0'
	);

	// Navigation JS
	wp_enqueue_script( 
		'pen-pol-navigation', 
		get_template_directory_uri() . '/js/navigation.js', 
		array(), 
		_S_VERSION, 
		true 
	);

	// Swiper JS
	wp_enqueue_script(
		'swiper-js',
		'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js',
		array(),
		'8.0.0',
		true
	);

	// Hero swiper JS
	wp_enqueue_script(
		'hero-swiper-js',
		get_template_directory_uri() . '/assets/dist/hero-swiper.js',
		array('swiper-js'),
		_S_VERSION,
		true
	);

	wp_enqueue_style(
    'pen-pol-fonts', 
    get_template_directory_uri() . '/assets/dist/fonts.css', 
    array(), 
    _S_VERSION
	);

	// Comment reply
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	// Accordion Poradniki JS
	wp_enqueue_script(
		'accordion-poradniki-js',
		get_template_directory_uri() . '/assets/dist/accordion-poradniki.js',
		array('swiper-js'),
		_S_VERSION,
		true
	);

	// FAQ JS
	wp_enqueue_script(
		'faq-js',
		get_template_directory_uri() . '/assets/dist/faq.js',
		array(), // Nie wymaga Swipera, jest niezależny
		_S_VERSION,
		true
	);

	// Carousel Opinie JS
	wp_enqueue_script(
		'home-carousel-js',
		get_template_directory_uri() . '/assets/dist/home-carousel.js',
		array('swiper-js'),
		_S_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'pen_pol_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}