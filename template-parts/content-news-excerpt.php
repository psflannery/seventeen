<?php
/**
 * Template part for displaying news excerpts.
 *
 * @package Seventeen
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
	
		<?php the_title( sprintf( '<h2 class="entry-title entry-title-italic"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	
	</header>
	<div class="entry-summary">
	
		<?php the_excerpt(); ?>
	
		<?php echo seventeen_exhibition_dates(); ?>
		
	</div>

    <?php edit_post_link('edit', '<footer class="entry-footer">', '</footer>'); ?>

</article>
