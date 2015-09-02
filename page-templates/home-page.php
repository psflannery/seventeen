<?php
/*
 * Template Name: Home Page
 * Description: The template to display an overview of current and forthcoming exhibitions along with recent news.
 *
 * @package Seventeen
 */
 
get_header(); ?>

	<main id="main" class="site-main container-fluid" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
		
			<?php if($post->post_content != "") : ?>
			
				<div class="row">
					<div class="col-sm-6">
					
						<?php get_template_part( 'template-parts/content', 'page' ); ?>
						
					</div>
				</div>
				
			<?php endif; ?>
		
		<?php endwhile; ?>
		
		<div class="row">
			<div class="col-sm-4 col-md-6">
				<h2 class="label"><?php esc_html_e( 'Current Exhibitions', 'seventeen' ); ?></h2>
				
				<?php get_template_part( 'template-parts/loop', 'current' ); ?>
				
			</div>
			<div class="col-sm-4 col-md-3">
				<h2 class="label"><?php esc_html_e( 'Forthcoming Exhibitions', 'seventeen' ); ?></h2>
				
				<?php get_template_part( 'template-parts/loop', 'forthcoming' ); ?>
				
			</div>
			<div class="col-sm-4 col-md-3">
				<h2 class="label"><?php esc_html_e( 'Recent News', 'seventeen' ); ?></h2>
				
				<?php get_template_part( 'template-parts/loop', 'recent-news' ); ?>
				
			</div>
		</div>
	</main>

<?php get_footer(); ?>
