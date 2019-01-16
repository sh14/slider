<?php
/**
 * Date: 15/01/2019
 * @author Isaenko Alexey <info@oiplug.com>
 */

namespace slider;

function create_post_type() {
	register_post_type( 'slide',
		array(
			'labels'      => array(
				'name'          => __( 'Слайдер', __NAMESPACE__ ),
				'singular_name' => __( 'Слайдер-', __NAMESPACE__ )
			),
			'public'      => true,
			'has_archive' => true,
			'archives'    => false,
			'supports'    => array(
				'title','editor','thumbnail',
			),
		)
	);
}

add_action( 'init', __NAMESPACE__ . '\create_post_type' );

// eof
