<?php
/**
 * Slaves functions and definitions
 *
 * @package Slaves
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 769; /* pixels */

if ( ! function_exists( 'slaves_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function slaves_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on slaves, use a find and replace
	 * to change 'slaves' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'slaves', get_template_directory() . '/languages' );
 
	/**
	* The title tag
	*/
	add_theme_support( 'title-tag' );
 
	/**
	 * This theme styles the visual editor to resemble the theme style.
	 */
	add_editor_style();

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	
	add_image_size( 'slaves_home_thumb', '276', '184', true );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'slaves' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	//add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'slaves_custom_background_args', array(
		'default-color' => 'fff',
		'default-image' => '',
	) ) );
}
endif; // slaves_setup
add_action( 'after_setup_theme', 'slaves_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function slaves_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Sidebar', 'slaves' ),
		'id'            => 'main-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	
	register_sidebar(array(
		'name' => __( 'Footer Widgets', 'slaves' ),
		'id' => 'footer-widgets',
		'before_widget' => '<div class="widget col-xs-6 col-md-3 %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
}
add_action( 'widgets_init', 'slaves_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function slaves_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';
	/* translators: If there are characters in your language that are not supported by Droid Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Droid Sans font: on or off', 'slaves' ) ) {
		$fonts[] = 'Droid Sans:400,700';
	}
	/* translators: If there are characters in your language that are not supported by Lobster, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Lobster font: on or off', 'slaves' ) ) {
		$fonts[] = 'Lobster';
	}
 
	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		), '//fonts.googleapis.com/css' );
	}
	return $fonts_url;
}

function slaves_scripts() {
	wp_enqueue_style( 'slaves-style', get_stylesheet_uri() );
	wp_enqueue_style( 'slaves-bootstrap', get_template_directory_uri() . '/bootstrap/bootstrap.css');
	wp_enqueue_style('slaves-google-fonts', slaves_fonts_url(), array(), null);
	
	wp_enqueue_script( 'slaves-hoverIntent', get_template_directory_uri() . '/inc/js/hoverIntent.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'slaves-touchdown', get_template_directory_uri() . '/inc/js/touchdown.js', array( 'jquery' ) );
	wp_enqueue_script( 'slaves-scripts', get_template_directory_uri() . '/inc/js/scripts.js', array( 'jquery' ) );
	wp_enqueue_script( 'slaves-skip-link', get_template_directory_uri() . '/inc/js/skip-link-focus-fix.js', array( 'jquery' ), '2015', true );
	wp_enqueue_script( 'slaves-bootstrap-js', get_template_directory_uri() . '/bootstrap/bootstrap.min.js', array( 'jquery' ), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}


}
add_action( 'wp_enqueue_scripts', 'slaves_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Pagination
 */
require get_template_directory() . '/inc/paginate.php';