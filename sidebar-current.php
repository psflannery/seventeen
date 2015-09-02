<?php
/**
 * The sidebar containing the current exhibitions widget area.
 *
 * @package Seventeen
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div id="no-current" class="widget-area <?php seventeen_sidebar_no_exhibition_classes(); ?>" role="complementary">

	<?php dynamic_sidebar( 'sidebar-1' ); ?>
	
</div>
