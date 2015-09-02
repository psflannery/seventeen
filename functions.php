<?php
/**
 * Seventeen functions and definitions
 *
 * @package Seventeen
 */

if ( ! function_exists( 'seventeen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function seventeen_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Seventeen, use a find and replace
	 * to change 'seventeen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'seventeen', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
    add_theme_support( 'post-thumbnails', array( 
        'post',
        'artists',
        'exhibitions',
        'news',
        'publications'
    ) );
    add_image_size( 'seventeen-large', 2000, 1500 );
    
    // This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'seventeen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
    
    // Add Editor Styles.
	add_editor_style( 'css/editor.css' );    
}
endif; // seventeen_setup
add_action( 'after_setup_theme', 'seventeen_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function seventeen_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'seventeen_content_width', 1024 );
}
add_action( 'after_setup_theme', 'seventeen_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function seventeen_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Current Exhibitions', 'seventeen' ),
		'id'            => 'sidebar-1',
		'description'   => 'Displays a widget area when there are no current exhibitions',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Forthcoming Exhibitions', 'seventeen' ),
		'id'            => 'sidebar-2',
		'description'   => 'Displays a widget area when there are no forthcoming exhibitions',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area', 'seventeen' ),
		'id'            => 'sidebar-3',
		'description'   => 'Displays a widget area in the page footer. Should primarily be used for the Gallery contact information.',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'seventeen_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function seventeen_scripts() {
    // register styles
	wp_register_style( 'seventeen-style', get_stylesheet_uri(), array(), '1.0' );
    
    // register scripts
    wp_register_script( 'seventeen-main', get_template_directory_uri() . '/js/main.min.js', array( 'jquery' ), '1.0', true );
    wp_register_script( 'seventeen-plugins', get_template_directory_uri() . '/js/plugins.min.js', array( 'jquery' ), '1.0', true );
	wp_register_script( 'cycle2', get_template_directory_uri() . '/js/cycle2.min.js', array( 'jquery' ), '2.1.6', true );
    
    // enqueue styles
	wp_enqueue_style( 'seventeen-style' );
    
    // enqueue scripts
	global $post;
	
    wp_enqueue_script( 'seventeen-plugins' );
    wp_enqueue_script( 'seventeen-main' );
	
	if ( is_singular() && has_shortcode( $post->post_content, 'gallery') ) {
        wp_enqueue_script( 'cycle2' );
    }
	
	if ( is_page_template( 'page-templates/home-page.php' ) ) {
		wp_enqueue_script( 'masonry' );
	}
    
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'seventeen_scripts' );

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
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Admin customisations file.
 */
require get_template_directory() . '/inc/admin.php';

/**
 * Load Gallery customisations file.
 */
require get_template_directory() . '/inc/gallery.php';

/**
 * Tidy up some of the default Wordpress output.
 */
require get_template_directory() . '/inc/tidy.php';
