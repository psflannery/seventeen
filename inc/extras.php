<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Seventeen
 */

/**
 * Adds custom classes to the array of post classes.
 *
 * @param array $classes Classes for the posts.
 * @return array
 */
function seventeen_post_classes( $classes, $class, $post_id ) {
	global $wp_query;

	$classes[] = 'fitvids';
	
	if ( is_post_type_archive( 'exhibitions' ) ) {
		if ( $wp_query->found_posts == 1 ) {
			$classes[] = 'col-sm-4 col-md-3 col-lg-4';
		} else {
			$classes[] = 'col-sm-4 col-md-3 col-lg-2';
		}
	}
	
	if ( is_post_type_archive( 'news' ) ) {
		$classes[] = 'col-sm-4 col-md-3 grid-inline-block';
	}
	 
    return $classes;
}
add_filter( 'post_class', 'seventeen_post_classes', 10, 3 );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function seventeen_search_form_modify( $html ) {	
	$html = str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
	return $html;
}
add_filter( 'get_search_form', 'seventeen_search_form_modify' );

/**
 * Add a `form-control` class to the search form's input field
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function seventeen_search_form_modify_input( $html ) {
	$html = str_replace( 'class="search-field"', 'class="search-field form-control"', $html );
	return $html;
}
add_filter( 'get_search_form', 'seventeen_search_form_modify_input' );

/**
 * Filter the output of the archive title
 */
function seventeen_filter_archive_title($title) {
	if ( is_post_type_archive( 'artists' ) ) {
		$title =  post_type_archive_title( '', false );
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'seventeen_filter_archive_title' );

/**
 * Set the default image link in the Image Uploader to "None"
 * Prevents annoying and unnecessary linking to attachment posts.
 *
 * @link http://andrewnorcross.com/tutorials/stop-hyperlinking-images/
 */
function seventeen_imagelink_setup() {
	$image_set = get_option( 'image_default_link_type' );
	
	if ($image_set !== 'none') {
		update_option('image_default_link_type', 'none');
	}
}
add_action('admin_init', 'seventeen_imagelink_setup', 10);

/**
 * Custom excerpt length
 */
function seventeen_custom_excerpt_length( $length ) {
	return 50;
}
add_filter( 'excerpt_length', 'seventeen_custom_excerpt_length', 999 );

/**
 * Customize Exhibitions Query using Post Meta
 *
 * @link http://www.billerickson.net/customize-the-wordpress-query/
 * @return Current Exhibitions -- Exhibitions Page
 */
function seventeen_exhibitions_query( $query ) {
	if( $query->is_main_query() && !$query->is_feed() && !is_admin() && $query->is_post_type_archive( 'exhibitions' ) ) {
		$meta_query = array(
			array(
				'key' => '_seventeen_startdate',
				'value' => time(),
				'compare' => '<='
			),
            array(
                'key' => '_seventeen_enddate',
                'value' => time(),
                'compare' => '>=',
            )
		);
		$query->set( 'meta_query', $meta_query );
		$query->set( 'orderby', 'meta_value' );
		$query->set( 'meta_key', '_seventeen_startdate' );
		$query->set( 'order', 'DESC' );
		$query->set( 'posts_per_page', '5' );
        $query->set( 'post_type', 'exhibitions' );
	}
}
add_action( 'pre_get_posts', 'seventeen_exhibitions_query' );

/**
 * Customize Artist Query using Post Meta
 *
 * @link http://www.billerickson.net/customize-the-wordpress-query/
 * @return Artists, aphabetically
 */
function seventeen_artist_archive_query( $query ) {
	if( $query->is_main_query() && !$query->is_feed() && !is_admin() && $query->is_post_type_archive( 'artists' ) ) {
		$query->set( 'order', 'ASC' );
		$query->set( 'orderby', 'title' );
		$query->set( 'post_parent', 0 );
	}
}
add_action( 'pre_get_posts', 'seventeen_artist_archive_query' );

/**
 * Change Posts Per Page for Artist and News Archive
 * 
 * @link http://www.billerickson.net/customize-the-wordpress-query/
 * @param object $query data
 */
function seventeen_change_number_posts_per_page( $query ) {
	if( $query->is_main_query() && !is_admin() && is_post_type_archive( array( 'artists', 'news' ) ) ) {
		$query->set( 'posts_per_page', '-1' );
	}
}
add_action( 'pre_get_posts', 'seventeen_change_number_posts_per_page' );

/**
 * Sets the address that the logo links to.
 *
 */
function seventeen_logo_link() {
	$link = get_theme_mod( 'seventeen_page_link' );
	if ( '' != $link ) :
		return esc_url( get_page_link( $link ) );
	else:
		return esc_url( home_url( '/' ) );
	endif;
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a 'Continue reading' link.
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function seventeen_excerpt_more( $more ) {
	$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading %s', 'seventeen' ), '<span class="screen-reader-text">' . esc_html( get_the_title( get_the_ID() ) ) . '</span>' )
		);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'seventeen_excerpt_more' );

/**
 * Add a class for sidebar-current if we are in the exhibitions archive
 */
function seventeen_sidebar_no_exhibition_classes() {
	if( is_post_type_archive( 'exhibitions' ) )
	echo 'col-sm-12';
}

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 */
function seventeen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'seventeen_javascript_detection', 0 );
