<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Build css classes from terms of the post.
 *
 * @param $value
 * @param $data
 *
 * @since 4.4
 *
 * @return string
 */
function vc_gitem_template_attribute_filter_terms_css_classes( $value, $data ) {
	$output = '';
	/**
	 * @var null|Wp_Post $post ;
	 */
	extract( array_merge( array(
		'post' => null,
	), $data ) );
	if ( isset( $post->filter_terms ) ) {
		foreach ( $post->filter_terms as $t ) {
			$output .= ' vc_grid-term-' . $t;
		}
	}

	return $output;
}

/**
 * Get image for post
 *
 * @param $data
 *
 * @return mixed|string|void
 */
function vc_gitem_template_attribute_post_image( $value, $data ) {
	/**
	 * @var null|Wp_Post $post ;
	 */
	extract( array_merge( array(
		'post' => null,
		'data' => '',
	), $data ) );
	if ( 'attachment' === $post->post_type ) {
		return wp_get_attachment_image( $post->ID, 'large' );
	}
	$html = get_the_post_thumbnail( $post->ID );

	return apply_filters( 'vc_gitem_template_attribute_post_image_html', $html );
}

function vc_gitem_template_attribute_featured_image( $value, $data ) {
	/**
	 * @var Wp_Post $post
	 * @var string $data
	 */
	extract( array_merge( array(
		'post' => null,
		'data' => '',
	), $data ) );

	return vc_include_template( 'params/vc_grid_item/attributes/featured_image.php', array(
		'post' => $post,
		'data' => $data,
	) );
}

/**
 * Create new btn
 *
 * @param $value
 * @param $data
 *
 * @since 4.5
 *
 * @return mixed
 */
function vc_gitem_template_attribute_vc_btn( $value, $data ) {
	/**
	 * @var Wp_Post $post
	 * @var string $data
	 */
	extract( array_merge( array(
		'post' => null,
		'data' => '',
	), $data ) );

	return vc_include_template( 'params/vc_grid_item/attributes/vc_btn.php', array(
		'post' => $post,
		'data' => $data,
	) );

}

/**
 * Get post image url
 *
 * @param $data
 *
 * @return string
 */
function vc_gitem_template_attribute_post_image_url( $value, $data, $user_empty = true ) {
	$output = '';
	/**
	 * @var null|Wp_Post $post ;
	 */
	extract( array_merge( array(
		'post' => null,
		'data' => '',
	), $data ) );
	if ( 'attachment' === $post->post_type ) {
		$src = wp_get_attachment_image_src( $post->ID, 'large' );
	} else {
		$attachment_id = get_post_thumbnail_id( $post->ID );
		$src = wp_get_attachment_image_src( $attachment_id, 'large' );
	}
	if ( empty( $src ) && ! empty( $data ) ) {
		$output = esc_attr( rawurldecode( $data ) );
	} elseif ( ! empty( $src ) ) {
		$output = $src[0];
	} elseif ( $user_empty ) {
		$output = vc_asset_url( 'vc/vc_gitem_image.png' );
	}

	return apply_filters( 'vc_gitem_template_attribute_post_image_url_value', $output );
}

/**
 * Get post image url with href for a dom element
 *
 * @param $value
 * @param $data
 *
 * @return string
 */
function vc_gitem_template_attribute_post_image_url_href( $value, $data ) {
	$link = vc_gitem_template_attribute_post_image_url( $value, $data );

	return strlen( $link ) ? ' href="' . esc_attr( $link ) . '"' : '';
}

/**
 * Add image url as href with css classes for PrettyPhoto js plugin.
 *
 * @param $value
 * @param $data
 *
 * @return string
 */
function vc_gitem_template_attribute_post_image_url_attr_prettyphoto( $value, $data ) {
	$data_default = $data;
	/**
	 * @var Wp_Post $post ;
	 */
	extract( array_merge( array(
		'post' => null,
		'data' => '',
	), $data ) );
	$href = vc_gitem_template_attribute_post_image_url_href( $value, array( 'post' => $post, 'data' => '' ) );
	$rel = ' rel="' . esc_attr( 'prettyPhoto[rel-' . md5( vc_request_param( 'shortcode_id' ) ) . ']' ) . '"';
	return $href . $rel . ' class="' . esc_attr( $data . ( strlen( $href ) ? ' prettyphoto' : '' ) )
	       . '" title="' . esc_attr(
		   apply_filters( 'vc_gitem_template_attribute_post_title', $post->post_title, $data_default ) ) . '"';
}

/**
 * Get post image alt
 *
 * @return string
 */
function vc_gitem_template_attribute_post_image_alt( $value, $data ) {
	if ( empty( $data['post']->ID ) ) {
		return '';
	}

	if ( 'attachment' === $data['post']->post_type ) {
		$attachment_id = $data['post']->ID;
	} else {
		$attachment_id = get_post_thumbnail_id( $data['post']->ID );
	}

	if ( ! $attachment_id ) {
		return '';
	}

	$alt = trim( strip_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) );

	return apply_filters( 'vc_gitem_template_attribute_post_image_url_value', $alt );
}

/**
 * Get post image url
 *
 * @param $data
 *
 * @return string
 */
function vc_gitem_template_attribute_post_image_background_image_css( $value, $data ) {
	$output = '';
	/**
	 * @var null|Wp_Post $post ;
	 */
	extract( array_merge( array(
		'post' => null,
		'data' => '',
	), $data ) );
	if ( 'attachment' === $post->post_type ) {
		$src = wp_get_attachment_image_src( $post->ID, 'large' );
	} else {
		$attachment_id = get_post_thumbnail_id( $post->ID );
		$src = wp_get_attachment_image_src( $attachment_id, 'large' );
	}
	if ( ! empty( $src ) ) {
		$output = 'background-image: url(' . $src[0] . ') !important;';
	} else {
		$output = 'background-image: url(' . vc_asset_url( 'vc/vc_gitem_image.png' ) . ') !important;';
	}

	return apply_filters( 'vc_gitem_template_attribute_post_image_background_image_css_value', $output );
}

/**
 * Get post link
 *
 * @param $data
 *
 * @return bool|string
 */
function vc_gitem_template_attribute_post_link_url( $value, $data ) {
	/**
	 * @var null|Wp_Post $post ;
	 */
	extract( array_merge( array(
		'post' => null,
	), $data ) );

	return get_permalink( $post->ID );
}

/**
 * Get post date
 *
 * @param $data
 *
 * @return bool|int|string
 */
function vc_gitem_template_attribute_post_date( $value, $data ) {
	/**
	 * @var null|Wp_Post $post ;
	 */
	extract( array_merge( array(
		'post' => null,
	), $data ) );

	return get_the_date( '', $post->ID );
}

/**
 * Get post date time
 *
 * @param $data
 *
 * @return bool|int|string
 */
function vc_gitem_template_attribute_post_datetime( $value, $data ) {
	/**
	 * @var null|Wp_Post $post ;
	 */
	extract( array_merge( array(
		'post' => null,
	), $data ) );

	return get_the_time( 'F j, Y g:i', $post->ID );
}

/**
 * Get custom fields.
 *
 * @param $data
 *
 * @return mixed|string
 */
function vc_gitem_template_attribute_post_meta_value( $value, $data ) {
	/**
	 * @var null|Wp_Post $post ;
	 * @var string $data ;
	 */
	extract( array_merge( array(
		'post' => null,
		'data' => '',
	), $data ) );

	return strlen( $data ) > 0 ? get_post_meta( $post->ID, $data, true ) : $value;
}

/**
 * Get post data. Used as wrapper for others post data attributes.
 *
 * @param $data
 *
 * @return mixed|string
 */
function vc_gitem_template_attribute_post_data( $value, $data ) {
	/**
	 * @var null|Wp_Post $post ;
	 * @var string $data ;
	 */
	extract( array_merge( array(
		'post' => null,
		'data' => '',
	), $data ) );

	return strlen( $data ) > 0 ? apply_filters( 'vc_gitem_template_attribute_' . $data, (
		isset( $post->$data ) ? $post->$data : ''
	), array( 'post' => $post, 'data' => '' ) ) : $value;
}

/**
 * Get post excerpt. Used as wrapper for others post data attributes.
 *
 * @param $data
 *
 * @return mixed|string
 */
function vc_gitem_template_attribute_post_excerpt( $value, $data ) {
	/**
	 * @var null|Wp_Post $post ;
	 * @var string $data ;
	 */
	extract( array_merge( array(
		'post' => null,
		'data' => '',
	), $data ) );

	return apply_filters( 'the_excerpt', apply_filters( 'get_the_excerpt', $value ) );
}

/**
 * Get post excerpt. Used as wrapper for others post data attributes.
 *
 * @param $data
 *
 * @return mixed|string
 */
function vc_gitem_template_attribute_post_title( $value, $data ) {
	/**
	 * @var null|Wp_Post $post ;
	 * @var string $data ;
	 */
	extract( array_merge( array(
		'post' => null,
		'data' => '',
	), $data ) );

	return the_title( '', '', false );
}

/**
 * Adding filters to parse grid template.
 */
add_filter( 'vc_gitem_template_attribute_filter_terms_css_classes', 'vc_gitem_template_attribute_filter_terms_css_classes', 10, 2 );
add_filter( 'vc_gitem_template_attribute_post_image', 'vc_gitem_template_attribute_post_image', 10, 2 );
add_filter( 'vc_gitem_template_attribute_post_image_url', 'vc_gitem_template_attribute_post_image_url', 10, 2 );
add_filter( 'vc_gitem_template_attribute_post_image_url_href', 'vc_gitem_template_attribute_post_image_url_href', 10, 2 );
add_filter( 'vc_gitem_template_attribute_post_image_url_attr_prettyphoto', 'vc_gitem_template_attribute_post_image_url_attr_prettyphoto', 10, 2 );
add_filter( 'vc_gitem_template_attribute_post_image_alt', 'vc_gitem_template_attribute_post_image_alt', 10, 2 );
add_filter( 'vc_gitem_template_attribute_post_link_url', 'vc_gitem_template_attribute_post_link_url', 10, 2 );
add_filter( 'vc_gitem_template_attribute_post_date', 'vc_gitem_template_attribute_post_date', 10, 2 );
add_filter( 'vc_gitem_template_attribute_post_datetime', 'vc_gitem_template_attribute_post_datetime', 10, 2 );
add_filter( 'vc_gitem_template_attribute_post_meta_value', 'vc_gitem_template_attribute_post_meta_value', 10, 2 );
add_filter( 'vc_gitem_template_attribute_post_data', 'vc_gitem_template_attribute_post_data', 10, 2 );
add_filter( 'vc_gitem_template_attribute_post_image_background_image_css', 'vc_gitem_template_attribute_post_image_background_image_css', 10, 2 );
add_filter( 'vc_gitem_template_attribute_post_excerpt', 'vc_gitem_template_attribute_post_excerpt', 10, 2 );
add_filter( 'vc_gitem_template_attribute_post_title', 'vc_gitem_template_attribute_post_title', 10, 2 );
add_filter( 'vc_gitem_template_attribute_featured_image', 'vc_gitem_template_attribute_featured_image', 10, 2 );
add_filter( 'vc_gitem_template_attribute_vc_btn', 'vc_gitem_template_attribute_vc_btn', 10, 2 );
