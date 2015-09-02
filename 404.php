<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Seventeen
 */

get_header(); ?>

    <main id="main" class="site-main" role="main">
        <section class="error-404 not-found">
            <header class="page-header">
                <h1 class="page-title"><?php esc_html_e( 'Not Found', 'seventeen' ); ?></h1>
            </header><!-- .page-header -->

            <div class="page-content">
                <p><?php esc_html_e( 'Sorry, that page wasn&rsquo;t found. Try a search or return to ', 'seventeen' ); ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>

                <?php get_search_form(); ?>

            </div>
        </section>
    </main>

<?php get_footer(); ?>
