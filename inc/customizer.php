<?php
/**
 * Seventeen Theme Customizer
 *
 * @package Seventeen
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function seventeen_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	/**
	 * Logo link
	 */
	$wp_customize->add_section(	
		'seventeen_logo_link', 
		array(
			'title'     => __( 'Logo Link', 'seventeen' ),
			'description' => sprintf( __( 'Select the page you would like the Seventeen logo to link to.', 'seventeen' ) ),
			'priority'  => 120,
		)
	);
    
	// Add the About Menu Setting and Control
	$wp_customize->add_setting(
		'seventeen_page_link',
		array(
			'sanitize_callback' => 'seventeen_sanitize_integer',
		)
	);
	
	$wp_customize->add_control(
		'seventeen_page_link',
		array(
			'type' => 'dropdown-pages',
			'label' => 'Page',
			'section' => 'seventeen_logo_link',
		)
	);
	
    /**
	 * Address
	 *
	
	// Add the Address Section
    $wp_customize->add_section(	
		'seventeen_address',
		array(
			'title' => __( 'Address', 'seventeen' ),
			'description' => sprintf( __( 'The Gallery address. This will appear in the page footer.', 'seventeen' ) ),
			'priority' => 125,
		)
	);

    // Add the Address Setting and Control
	$wp_customize->add_setting(
		'seventeen_address_street',
		array(
			'sanitize_callback' => 'seventeen_sanitize_text',
		)
	);
	
    $wp_customize->add_control(
		'seventeen_address_street',
		array(
			'label' => __( 'Street Address', 'seventeen' ),
			'section' => 'seventeen_address',
			'type' => 'text',
		)
	);

	$wp_customize->add_setting(
		'seventeen_address_city',
		array(
			'sanitize_callback' => 'seventeen_sanitize_text',
		)
	);
	
    $wp_customize->add_control(
		'seventeen_address_city',
		array(
			'label' => __( 'City', 'seventeen' ),
			'section' => 'seventeen_address',
			'type' => 'text',
		)
	);
    
	$wp_customize->add_setting(
		'seventeen_address_post_code',
		array(
			'sanitize_callback' => 'seventeen_sanitize_text',
		)
	);
	
    $wp_customize->add_control(
		'seventeen_address_post_code',
		array(
			'label' => __( 'Post Code', 'seventeen' ),
			'section' => 'seventeen_address',
			'type' => 'text',
		)
	);
    
    // Phone
    $wp_customize->add_setting( 
        'seventeen_phone', 
        array(
            'default' => '',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => '',
            'sanitize_callback' => 'seventeen_sanitize_text',
        )
    );

    $wp_customize->add_control(
        'seventeen_phone',
        array(
            'label' => __( 'Phone Number', 'seventeen' ),
            'section' => 'seventeen_address',
            'type' => 'text',
        )
    );
    
    // Email
    $wp_customize->add_setting( 
        'seventeen_email', 
        array(
            'default' => '',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => '',
            'sanitize_callback' => 'seventeen_sanitize_text',
        )
    );

    $wp_customize->add_control(
        'seventeen_email',
        array(
            'label' => __( 'Email', 'seventeen' ),
            'section' => 'seventeen_address',
            'type' => 'text',
        )
    );
	*/
    
}
add_action( 'customize_register', 'seventeen_customize_register' );

/**
 * Sanitize the Text Inputs.
 */
function seventeen_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Sanitize the Integer Inputs.
 */
function seventeen_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function seventeen_customize_preview_js() {
	wp_enqueue_script( 'seventeen_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'seventeen_customize_preview_js' );
