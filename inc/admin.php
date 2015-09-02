<?php
/**
 * Custom functions that tidy things up in the backend
 *
 * @package Seventeen
 */

/* Custom Login Page */
function seventeen_login_css() {
	wp_enqueue_style( 'seventeen_login_css', get_template_directory_uri() . '/css/login.css', false );
}

// changing the logo link from wordpress.org to your site
function seventeen_login_url() {  return home_url(); }
// changing the alt text on the logo to show your site name
function seventeen_login_title() { return get_option( 'blogname' ); }
// calling it only on the login page
add_action( 'login_enqueue_scripts', 'seventeen_login_css', 10 );
add_filter( 'login_headerurl', 'seventeen_login_url' );
add_filter( 'login_headertitle', 'seventeen_login_title' );
 
/**
 * Add Custom Post Types and Taxonomies to "At a Glance" Dashboard Widget
 *
 * Ref Link: http://wpsnipp.com/index.php/functions-php/include-custom-post-types-in-right-now-admin-dashboard-widget/
 * http://wordpress.org/support/topic/dashboard-at-a-glance-custom-post-types
 * http://halfelf.org/2012/my-custom-posttypes-live-in-mu/
 */
function seventeen_right_now_content_table_end() {
    $args = array(
        'public' => true ,
        '_builtin' => false
    );
    $output = 'object';
    $operator = 'and';
    $post_types = get_post_types( $args , $output , $operator );
    foreach( $post_types as $post_type ) {
        $num_posts = wp_count_posts( $post_type->name );
        $num = number_format_i18n( $num_posts->publish );
        $text = _n( $post_type->labels->name, $post_type->labels->name , intval( $num_posts->publish ) );
        if ( current_user_can( 'edit_posts' ) ) {
            $cpt_name = $post_type->name;
        }
		echo '<li class="post-count ' . $post_type->name . '-count"><tr><a href="edit.php?post_type='.$cpt_name.'"><td class="first b b-' . $post_type->name . '"></td>' . $num . '&nbsp;<td class="t ' . $post_type->name . '">' . $text . '</td></a></tr></li>';
	}
    $taxonomies = get_taxonomies( $args , $output , $operator );
    foreach( $taxonomies as $taxonomy ) {
        $num_terms  = wp_count_terms( $taxonomy->name );
        $num = number_format_i18n( $num_terms );
        $text = _n( $taxonomy->labels->name, $taxonomy->labels->name , intval( $num_terms ));
        if ( current_user_can( 'manage_categories' ) ) {
            $cpt_tax = $taxonomy->name;
        }
		echo '<li class="taxonomy-count ' . $taxonomy->name . '-count"><tr><a href="edit-tags.php?taxonomy='.$cpt_tax.'"><td class="first b b-' . $taxonomy->name . '"></td>' . $num . '&nbsp;<td class="t ' . $taxonomy->name . '">' . $text . '</td></a></tr></li>';
	}
}
add_action( 'dashboard_glance_items' , 'seventeen_right_now_content_table_end' );

/*
 * Add Dashicons to the Custom Post Types and Taxonomies we just added to the "At a Glance" Dashboard Widget.
 * @link: http://melchoyce.github.io/dashicons/
 */
function seventeen_cpts_css() {
    echo "<style type='text/css'>
        #dashboard_right_now .artists-count a:before {
            content: '\\f309';
            margin-left: -1px;
        }
        #dashboard_right_now .exhibitions-count a:before {
            content: '\\f233';
            margin-left: -1px;
        }
        #dashboard_right_now .publications-count a:before {
            content: '\\f331';
            margin-left: -1px;
        }
        #dashboard_right_now .news-count a:before {
            content: '\\f488';
            margin-left: -1px;
        }
    </style>";
}
add_action('admin_head', 'seventeen_cpts_css');
