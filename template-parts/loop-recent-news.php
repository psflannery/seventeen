<?php
/**
 * The loop used for displaying the Recent News overview.
 *
 * @package Seventeen
 */

?>

<?php
	$args = array(
		'order' => 'DESC',
		'post_type' => 'news',
		'posts_per_page' =>	2,	
		'orderby' => 'date',
	);
	$recent_news = new WP_Query();
	$recent_news->query( $args );
?>

<?php if ( $recent_news->have_posts() ) : ?>

	<?php while ( $recent_news->have_posts()) : $recent_news->the_post(); ?>
	
		<?php get_template_part( 'template-parts/content', 'news-excerpt' ); ?>

	<?php endwhile; ?>

<?php endif; ?>

<?php wp_reset_postdata(); ?>
