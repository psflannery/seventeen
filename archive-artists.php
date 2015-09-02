<?php
/**
 * The template for displaying the Artist Archive.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Seventeen
 */
get_header(); ?>

	<main id="main" class="site-main container-fluid" role="main">
		<div class="row">
		
		<?php if ( have_posts() ) : ?>
		
			<header class="page-header col-sm-12">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header>
			<ul class="list-unstyled col-sm-12">
			
			<?php while ( have_posts() ) : the_post(); ?>

				<?php the_title( sprintf( '<li><h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2></li>' ); ?>

			<?php endwhile; ?>

			</ul>
			
			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</div>
    </main>

<?php get_footer(); ?>
