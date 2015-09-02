<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Seventeen
 */

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function seventeen_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'seventeen_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'seventeen_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so seventeen_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so seventeen_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in seventeen_categorized_blog.
 */
function seventeen_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'seventeen_categories' );
}
add_action( 'edit_category', 'seventeen_category_transient_flusher' );
add_action( 'save_post',     'seventeen_category_transient_flusher' );


if ( ! function_exists( 'seventeen_exhibition_dates' ) ) :
/**
 * Outputs the date in the Exhibitions posts into a pretty format.
 *
 * @since seventeen 1.1
 */
function seventeen_exhibition_dates() {
	global $post;
	$meta_sd = get_post_meta($post->ID, '_seventeen_startdate', true);
	$meta_ed = get_post_meta($post->ID, '_seventeen_enddate', true);

    if ( '' != $meta_sd ):
        //convert to pretty formats 
        $clean_sd = date("jS F", $meta_sd);
        $clean_ed = date("jS F Y", $meta_ed);
        
        //output the date
        $exhibition_date = '';
        $exhibition_date .= ' ' . $clean_sd;
        $exhibition_date .= ' - ' . $clean_ed;
        
        return '<span class="exhibition-dates">' . esc_html( $exhibition_date ) . '</span>';
    endif;
}
endif;
