<?php
/**
 * The sidebar containing the current exhibitions widget area.
 *
 * @package Seventeen
 */

if ( ! is_active_sidebar( 'sidebar-3' ) ) {
	return;
}
?>

<footer id="colophon" class="site-footer container-fluid" role="contentinfo">
	<?php 
		// @link http://wordpress.stackexchange.com/questions/19907/limit-number-of-widgets-in-sidebars
		$footer_sidebars = wp_get_sidebars_widgets();
		$total_widgets = count( $footer_sidebars['sidebar-3'] );
		$limit_allowed = 1;
   
		if ($total_widgets > $limit_allowed) {
			echo 'Your ' . $total_widgets . ' added widgets goes over the allowed limit: <strong>' . $limit_allowed . '</strong>';
		} else {
			dynamic_sidebar( 'sidebar-3' );
		};
	?>
</footer>