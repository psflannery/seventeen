<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Seventeen
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content row">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'seventeen' ),
				'after'  => '</div>',
			) );
		?>
	</div>

	<?php edit_post_link('edit', '<footer class="entry-footer">', '</footer>'); ?>
    
</article>
