<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Seventeen
 */

?>

	</div><!-- #content -->
	
	<?php if ( ! is_front_page() && 'page' == get_option( 'show_on_front' ) ): ?>
		
	<?php get_sidebar( 'footer' ); ?>
	
	<?php endif; ?>
        
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
