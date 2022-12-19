<?php
/**
 * Plugin Name: Adept Cores
 * Description: Simple plugin developed by Awal Bashar
 * Version:     1.0.0
 * Author:      Awal Bashar
 * Author URI:  github.com/bashar0091
 * Text Domain: adept
 */

function register_adept_widget( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/blog-widget.php' );

	$widgets_manager->register( new \blog_widget() );

}
add_action( 'elementor/widgets/register', 'register_adept_widget' );