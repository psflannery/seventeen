<?php
/**
 * The loop used for displaying current exhibitions.
 *
 * @package Seventeen
 * @return Current Exhibitions -- Home Page
 */

?>

<?php
	$args = array(
		'meta_query' => array(
				array(
					'key' => '_seventeen_startdate',
					'value' => time(),
					'compare' => '<='
				),
				array(
					'key' => '_seventeen_enddate',
					'value' => time(),
					'compare' => '>=',
				)
		),
		'order' => 'DESC',
		'post_type' => 'exhibitions',
		'meta_key' => '_seventeen_startdate',
		'posts_per_page' =>	5,	
		'orderby' => 'meta_value',
	);
	$current_exhibtions = new WP_Query();
	$current_exhibtions->query( $args );
?>

<?php if ( $current_exhibtions->have_posts() ) : ?>
	<?php if ( $current_exhibtions->found_posts == 1 ) : ?>
		<?php while ( $current_exhibtions->have_posts()) : $current_exhibtions->the_post(); ?>

			<?php get_template_part( 'template-parts/content', get_post_format() ); ?>

		<?php endwhile; ?>
	<?php else : ?>
	
		<div class="row masonry-container">
		
		<?php while ( $current_exhibtions->have_posts()) : $current_exhibtions->the_post(); ?>

			<div class="col-md-6 masonry-item">
			
				<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
				
			</div>
			
		<?php endwhile; ?>
		
		</div>
		
	<?php endif; ?>
<?php else : ?>

	<?php get_sidebar( 'current' ); ?>

<?php endif; ?>

<?php wp_reset_postdata(); ?>
