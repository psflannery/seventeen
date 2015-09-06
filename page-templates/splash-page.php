<?php
/*
 * Template Name: Splash Page
 * Description: The template to display a centered splash image upon first navigating to the site.
 *
 * @package Seventeen
 */
 
get_header(); ?>

	<main id="main" class="site-main container-fluid splash-header-offset" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'page' ); ?>

		<?php endwhile; // End of the loop. ?>

	</main>

<?php get_footer(); ?>
