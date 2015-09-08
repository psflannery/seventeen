<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Seventeen
 */

get_header(); ?>

    <main id="main" class="site-main container-fluid" role="main">
        <section class="error-404 not-found row">
            <header class="page-header col-sm-12 text-center">
                <h1 class="page-title"><?php esc_html_e( 'Not Found', 'seventeen' ); ?></h1>
            </header>

            <div class="page-content col-sm-6 col-sm-push-3 text-center">
                <p><?php esc_html_e( 'Sorry, that page wasn&rsquo;t found. Try a search or return to ', 'seventeen' ); ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>

                <?php get_search_form(); ?>

            </div>
        </section>
    </main>

<?php get_footer(); ?>
