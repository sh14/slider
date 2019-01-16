<?php
/*
Plugin Name: Slider
Plugin URI: https://oiplug.com/plugin/
Description: --
Version: 1.0
Author: sh14ru
Author URI: https://oiplug.com/member/isaenko_alexei
License: A "Slug" license name e.g. GPL2
Text domain: slider
Date: 13.12.18
*/

namespace slider;

require 'includes/post-types.php';

function get_plugin_path() {

	$plugin_path = plugin_dir_path( __FILE__ );
	$plugin_path = explode( '/', $plugin_path );
	$plugin_name = array_filter( $plugin_path, function ( $value ) {
		return ! empty( $value );
	} );
	$plugin_name = end( $plugin_name );

	return trailingslashit( plugins_url() ) . $plugin_name;
}

function get_template( $file, $atts ) {

	$pathes = array(
		plugin_dir_path( __FILE__ ) . '/templates/' . $file . '.php',
		get_template_directory() . '/templates/' . $file . '.php',
	);

	foreach ( $pathes as $path ) {
		if ( file_exists( $path ) ) {
			ob_start();

			include 'templates/' . $file . '.php';

			$out = ob_get_contents();
			ob_clean();

			return $out;
		}
	}

	return '';
}

function enqueue_styles() {
	wp_enqueue_style( __NAMESPACE__, get_plugin_path() . '/assets/styles/style.css' /*,array(), date( 'His' )*/ );
	wp_enqueue_script( __NAMESPACE__, get_plugin_path() . '/assets/js/functions.js', array( 'jquery' ), '1', true );
}

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_styles' );

function get_slider() {
	$attr   = array(
		// тип публикации
		'post_type'      => 'slide',
		// количество получаемых публикаций
		'posts_per_page' => 3,
		// статус публикаций
		'post_status'    => 'publish',
	);
	$slides = new \WP_Query( $attr );
	echo '<pre>';
//print_r($slides);
	echo '</pre>';
	if ( empty( $slides->posts ) ) {
		return '';
	}

	$slider = array();
	foreach ( $slides->posts as $slide ) {
		$slide        = (array) $slide;
		$post_id      = $slide['ID'];
		$slide['url'] = get_the_post_thumbnail_url( $post_id, 'full' );

		$slide    = get_template( 'slide', $slide );
		$slider[] = $slide;
	}

	$slider = '<ul class="slider js-slider">' . implode( '', $slider ) . '</ul>';

	return $slider . 'asdvbf';
}

add_shortcode( 'slider', __NAMESPACE__ . '\get_slider' );
// eof
