<?php
/**
 * Template part for displaying posts.
 *
 * @package Seventeen
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
	
		<?php if ( has_post_thumbnail() ): ?>
		
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?></a>
			
		<?php endif; ?>
	
		<?php the_title( sprintf( '<h2 class="entry-title entry-title-italic"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '' . seventeen_exhibition_dates() . '</a></h2>' ); ?>
		
		<?php if ( ! has_post_thumbnail() ): ?>
		
			<?php the_excerpt(); ?>
		
		<?php endif; ?>
		
	</div>


    <?php edit_post_link('edit', '<footer class="entry-footer">', '</footer>'); ?>

</article>
