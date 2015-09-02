<?php
/**
 * Filter the output of the gallery
 *
 * @link http://stackoverflow.com/questions/14585538/customise-the-wordpress-gallery-html-layout
 * @link https://core.trac.wordpress.org/browser/tags/4.2.2/src/wp-includes/media.php#L0
 */
function seventeen_post_gallery( $output, $attr ) {

	// Initialize
	global $post, $wp_locale;

	// Gallery instance counter
	static $instance = 0;
	$instance++;

	// Validate the author's orderby attribute
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( ! $attr['orderby'] ) unset( $attr['orderby'] );
	}

	$html5 = current_theme_supports( 'html5', 'gallery' );
	$atts = shortcode_atts( array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post ? $post->ID : 0,
			'itemtag'    => $html5 ? 'figure'     : 'dl',
			'icontag'    => $html5 ? 'div'        : 'dt',
			'captiontag' => $html5 ? 'figcaption' : 'dd',
			'columns'    => 3,
			'size'       => 'large',
			'include'    => '',
			'exclude'    => '',
			'link'       => 'none'
		), $attr, 'gallery' );

	$id = intval( $atts['id'] );

	if ( ! empty( $atts['include'] ) ) {
		$_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( ! empty( $atts['exclude'] ) ) {
		$attachments = get_children( array( 'post_parent' => $id, 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
	} else {
		$attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
	}
	
	if ( empty( $attachments ) ) {
		return '';
	}
	
	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment ) {
			$output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . "\n";
		}
		return $output;
	}

	$itemtag = tag_escape( $atts['itemtag'] );
	$captiontag = tag_escape( $atts['captiontag'] );
	$icontag = tag_escape( $atts['icontag'] );
	$valid_tags = wp_kses_allowed_html( 'post' );
	if ( ! isset( $valid_tags[ $itemtag ] ) ) {
			$itemtag = 'dl';
	}
	if ( ! isset( $valid_tags[ $captiontag ] ) ) {
			$captiontag = 'dd';
	}
	if ( ! isset( $valid_tags[ $icontag ] ) ) {
			$icontag = 'dt';
	}

	$columns = intval( $atts['columns'] );
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";
	
	//build the slideshow
	$output = '<div class="cycle-slideshow" data-cycle-slides="> figure" data-cycle-timeout=0 data-cycle-prev="#cycle-prev" data-cycle-next="#cycle-next" data-cycle-center-horz=true data-cycle-center-vert=true data-cycle-swipe=true>';

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {

		$attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id" ) : '';
		if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
			$image_output = wp_get_attachment_link( $id, $atts['size'], false, false, false, $attr );
		} elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
			$image_output = wp_get_attachment_image( $id, $atts['size'], false, $attr );
		} else {
			$image_output = wp_get_attachment_link( $id, $atts['size'], true, false, false, $attr );
		}
		$image_meta  = wp_get_attachment_metadata( $id );

		$orientation = '';
		if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
			$orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
		}
		$output .= "<{$itemtag} class='gallery-item'>";
		$output .= "
				<{$icontag} class='gallery-icon {$orientation}'>
					$image_output
				</{$icontag}>";
		if ( $captiontag && trim($attachment->post_excerpt) ) {
			$output .= "
					<{$captiontag} class='wp-caption-text gallery-caption' id='$selector-$id'>
						" . wptexturize($attachment->post_excerpt) . "
					</{$captiontag}>";
		}
		$output .= "</{$itemtag}>";
		if ( ! $html5 && $columns > 0 && ++$i % $columns == 0 ) {
			$output .= '<br style="clear: both" />';
		}
	}
	$output .= '<div id="cycle-prev" class="cycle-prev cycle-nav"><span title="previous">' . esc_html( '&#8592;' ) . '</span></div>';
    $output .= '<div id="cycle-next" class="cycle-next cycle-nav"><span title="next">' . esc_html( '&#8594;' ) . '</span></div>';

	if ( ! $html5 && $columns > 0 && $i % $columns !== 0 ) {
		$output .= "<br style='clear: both' />";
	}

	$output .= "</div>\n";

	return $output;
}
// Apply filter to default gallery shortcode
add_filter( 'post_gallery', 'seventeen_post_gallery', 10, 2 );
