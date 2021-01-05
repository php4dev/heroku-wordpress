<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

function buddyforms_exporter( $email_address, $page = 1 ) {
	global $buddyforms;

	$number       = 500; // Limit us to avoid timing out
	$page         = (int) $page;
	$export_items = array();
	$my_data      = array();
	foreach ( $buddyforms as $form_slug => $buddyform ) {

		$query_args = array(
			'post_type'    => $buddyform['post_type'],
			'author_email' => $email_address,
			'paged'        => $page,
		);

		$the_query = new WP_Query( $query_args );

		if ( $the_query->have_posts() ) {

			$i = 0;
			while ( $the_query->have_posts() ) {
				$the_query->the_post();

				$my_data[] = array(
					'name'  => __( 'Title', 'buddyforms' ),
					'value' => get_the_title()
				);
				$my_data[] = array(
					'name'  => __( 'Content', 'buddyforms' ),
					'value' => get_the_content()
				);

				if ( isset( $buddyform['form_fields'] ) ) {
					foreach ( $buddyform['form_fields'] as $field_key => $field ) {
						$user_id   = get_the_author_meta( 'ID' );
						$my_data[] = array(
							'name'  => $field['name'],
							'value' => get_post_meta( $user_id, $field['slug'], true )
						);
					}
				}

			}

			wp_reset_postdata();
		}

		$item_id = "buddyform-{$buddyform['slug']}";

		$export_items[] = array(
			'group_id'    => $buddyform['slug'],
			'group_label' => $buddyform['name'],
			'item_id'     => $item_id,
			'data'        => $my_data,
		);
	}


	// Tell core if we have more comments to work on still

	return array(
		'data' => $export_items,
		'done' => true,
	);
}

function buddyforms_register_exporter( $exporters ) {
	$exporters['buddyforms'] = array(
		'exporter_friendly_name' => __( 'BuddyForms', 'buddyforms' ),
		'callback'               => 'buddyforms_exporter',
	);

	return $exporters;
}

add_filter(
	'wp_privacy_personal_data_exporters',
	'buddyforms_register_exporter',
	10
);