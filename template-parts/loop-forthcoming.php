<?php
/**
 * The loop used for displaying forthcoming exhibitions.
 *
 * @package Seventeen
 */

?>

<?php
	$args = array(
		'meta_query' => array(
				array(
					'key' => '_seventeen_startdate',
					'value' => time(),
					'compare' => '>'
				)
		),
		'order' => 'DESC',
		'post_type' => 'exhibitions',
		'meta_key' => '_seventeen_startdate',
		'posts_per_page' =>	5,	
		'orderby' => 'meta_value',
	);
	$forthcoming_exhibtions = new WP_Query();
	$forthcoming_exhibtions->query( $args );
?>

<?php if ( $forthcoming_exhibtions->have_posts() ) : ?>

	<?php while ( $forthcoming_exhibtions->have_posts()) : $forthcoming_exhibtions->the_post(); ?>
	
		<?php get_template_part( 'template-parts/content', get_post_format() ); ?>

	<?php endwhile; ?>

<?php else : ?>

	<?php get_sidebar( 'forthcoming' ); ?>

<?php endif; ?>

<?php wp_reset_postdata(); ?>
