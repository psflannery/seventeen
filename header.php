<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Seventeen
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'seventeen' ); ?></a>

	<header id="masthead" class="site-header container-fluid" role="banner">
		<div class="site-branding">
			<h1 class="site-title"><a href="<?php echo seventeen_logo_link(); ?>" class="site-logo" rel="home"><span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span></a></h1>
            <?php if ( '' != bloginfo( 'description' ) ) : ?>
			<p class="site-description"><?php bloginfo( 'description' ); ?></p>
            <?php endif; ?>
		</div>
        
		<?php if ( ! is_front_page() && 'page' == get_option( 'show_on_front' ) ): ?>
		
        <nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle menu-toggle-hamburger btn btn-link" aria-controls="primary-menu" aria-expanded="false"><?php get_template_part( 'img/inline', 'hamburger.svg' ); ?><span class="screen-reader-text"><?php esc_html_e( 'Menu', 'seventeen' ); ?></span></button>
			<?php 
                wp_nav_menu( array( 
                    'theme_location' => 'primary', 
                    'menu_id' => 'primary-menu',
                    'container' => false,
                    'depth' => 1,
                ) ); 
            ?>
		</nav>
		
		<?php endif; ?>
		
	</header>

	<div id="content" class="site-content">
