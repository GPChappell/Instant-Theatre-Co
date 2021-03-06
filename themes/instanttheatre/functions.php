<?php
/**
 * RED Starter Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package RED_Starter_Theme
 */

if ( ! function_exists( 'instant_theatre_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function instant_theatre_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html( 'Primary Menu' ),
	) );

	// Switch search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

}
endif; // instant_theatre_setup
add_action( 'after_setup_theme', 'instant_theatre_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * @global int $content_width
 */
function instant_theatre_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'instant_theatre_content_width', 640 );
}
add_action( 'after_setup_theme', 'instant_theatre_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function instant_theatre_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html( 'Footage Our Mission' ),
		'id'            => 'our-mission',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html( 'Footage contact info' ),
		'id'            => 'contact-info',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html( 'Footage Subscribe' ),
		'id'            => 'subscribe',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html( 'Contact Page Contact Sidebar' ),
		'id'            => 'contact-page-contact-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html( 'Shows Calendar' ),
		'id'            => 'shows-calendar',
		'description'   => '',
		'before_widget' => '<div id="shows-calendar">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'instant_theatre_widgets_init' );

/**
 * Filter the stylesheet_uri to output the minified CSS file.
 */
function instant_theatre_minified_css( $stylesheet_uri, $stylesheet_dir_uri ) {
	if ( file_exists( get_template_directory() . '/build/css/style.min.css' ) ) {
		$stylesheet_uri = $stylesheet_dir_uri . '/build/css/style.min.css';
	}

	return $stylesheet_uri;
}
add_filter( 'stylesheet_uri', 'instant_theatre_minified_css', 10, 2 );

/**
 * Enqueue scripts and styles.
 */
function instant_theatre_scripts() {
	wp_enqueue_style( 'instant-theatre-style', get_stylesheet_uri() );
	wp_enqueue_style('fontawesome' ,'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
	wp_enqueue_style ('Roboto', 'https://fonts.googleapis.com/css?family=Roboto:300,400,700', false);
	wp_enqueue_script('jquery','https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js');
	wp_enqueue_script( 'it-skip-link-focus-fix', get_template_directory_uri() . '/build/js/skip-link-focus-fix.min.js', array(), '20130115', true );
	wp_enqueue_script( 'it_instant.js', get_template_directory_uri() . '/build/js/instant.min.js', array(), '20130115', true );
	wp_enqueue_script( 'isotope', get_template_directory_uri() . '/build/js/isotope.pkgd.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'taxonomy-role.js', get_template_directory_uri() . '/build/js/taxonomy-role.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'it_list-of-classes.js', get_template_directory_uri() . '/build/js/list-of-classes.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'spectragram', get_template_directory_uri().'/build/js/spectragram.min.js', array('jquery'), false, true );
	wp_enqueue_script( 'instagram-feed',  get_template_directory_uri().'/build/js/instagram-feed.min.js', array('jquery'), false, true );
	wp_enqueue_script( 'flickity',   get_template_directory_uri().'/build/js/flickity.pkgd.min.js', array('jquery'), false, true  );
	wp_enqueue_script( 'it_form', get_template_directory_uri().'/build/js/form-submit-button.min.js', array('jquery'), false, true );
	wp_enqueue_script( 'it_banner-carousel',   get_template_directory_uri().'/build/js/carousel.min.js', array('jquery'), false, true  );
	wp_enqueue_script( 'it_shows-function',   get_template_directory_uri().'/build/js/shows-function.min.js', array('jquery'), false, true  );
	
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_localize_script( 'taxonomy-role.js', 'api_vars', array(
		'root_url' => esc_url_raw( rest_url() ),
		'home_url' => esc_url_raw( home_url() )
	));
}
add_action( 'wp_enqueue_scripts', 'instant_theatre_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';


 /**
 * Custom WP API modifications.
 */
require get_template_directory() . '/inc/api.php';
