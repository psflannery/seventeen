<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Seventeen
 */

get_header(); ?>

    <main id="main" class="site-main container-fluid" role="main">
		<div class="row">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</div>
    </main>

<?php get_footer(); ?>
