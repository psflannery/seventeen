<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Seventeen
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
		<div class="col-sm-9">
			<header class="entry-header">
				<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

				<?php if ( 'post' == get_post_type() ) : ?>
				<div class="entry-meta">
					<?php seventeen_posted_on(); ?>
				</div>
				<?php endif; ?>
			</header>

			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div>

			<?php edit_post_link('edit', '<footer class="entry-footer">', '</footer>'); ?>

	    </div>
    </div>
</article>

