<?php
/**
 * The sidebar containing the forthcoming exhibitions widget area.
 *
 * @package Seventeen
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>

<div id="no-forthcoming" class="widget-area <?php seventeen_sidebar_no_exhibition_classes(); ?>" role="complementary">
	
	<?php dynamic_sidebar( 'sidebar-2' ); ?>
	
</div>
