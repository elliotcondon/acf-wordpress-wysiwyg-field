<?php

/*
Plugin Name: Advanced Custom Fields: WP WYSIWYG
Plugin URI: https://github.com/elliotcondon/acf-wordpress-wysiwyg-field
Description: Adds a native WordPress WYSIWYG field to the Advanced Custom Fields plugin. Please note this field does not work as a sub field.
Version: 1.0.2
Author: Elliot Condon
Author URI: http://www.elliotcondon.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// Set text domain
// Reference: https://codex.wordpress.org/Function_Reference/load_plugin_textdomain
//load_plugin_textdomain( 'acf-wp_wysiwyg', false, dirname( plugin_basename(__FILE__) ) . '/lang/' );


// Include field type for ACF5
// $version = 5 and can be ignored until ACF6 exists
function include_field_types_wp_wysiwyg( $version ) {

	include_once('acf-wp_wysiwyg-v5.php');

}

add_action('acf/include_field_types', 'include_field_types_wp_wysiwyg');	


// Include field type for ACF4
function register_fields_wp_wysiwyg() {

	include_once('acf-wp_wysiwyg-v4.php');

}

add_action('acf/register_fields', 'register_fields_wp_wysiwyg');	


// Include field type for ACF3
function init_wp_wysiwyg() {
	
	if( function_exists('register_field') ) {
		
		register_field('acf_field_wp_wysiwyg', dirname(__File__) . '/acf-wp_wysiwyg-v3.php');
	
	}

}
	
add_action('init', 'init_wp_wysiwyg');	

?>