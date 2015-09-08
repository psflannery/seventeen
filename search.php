<?php
/**
 * The template for displaying search results pages.
 *
 * @package Seventeen
 */

get_header(); ?>

    <main id="main" class="site-main container-fluid" role="main">

    <?php if ( have_posts() ) : ?>

        <header class="page-header">
            <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'seventeen' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
        </header>
        
        <?php while ( have_posts() ) : the_post(); ?>

            <?php
            /**
             * Run the loop for the search to output the results.
             * If you want to overload this in a child theme then include a file
             * called content-search.php and that will be used instead.
             */
            get_template_part( 'template-parts/content', 'search' );
            ?>

        <?php endwhile; ?>

        <?php the_posts_navigation(); ?>

    <?php else : ?>

        <?php get_template_part( 'template-parts/content', 'none' ); ?>

    <?php endif; ?>

    </main>

<?php get_footer(); ?>
