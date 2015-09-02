<?php
/**
 * The template for displaying all single posts.
 *
 * @package Seventeen
 */

get_header(); ?>

    <main id="main" class="site-main container-fluid" role="main">

    <?php while ( have_posts() ) : the_post(); ?>

        <?php get_template_part( 'template-parts/content', 'single' ); ?>

    <?php endwhile; ?>

    </main>
        
<?php get_footer(); ?>
