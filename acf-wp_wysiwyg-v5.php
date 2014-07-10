<?php

/*
*  ACF WP WYSIWYG Field Class
*
*  All the logic for this field type
*
*  @class 		acf_field_wp_wysiwyg
*  @extends		acf_field
*  @package		ACF
*  @subpackage	Fields
*/

if( ! class_exists('acf_field_wp_wysiwyg') ) :

class acf_field_wp_wysiwyg extends acf_field {
	
	/*
	* __construct
	*
	* This function will setup the field type data
	*
	* @type function
	* @date 5/03/2014
	* @since 5.0.0
	*
	* @param n/a
	* @return n/a
	*/
	
	function __construct() {
		
		// vars
		$this->name = 'wp_wysiwyg';
		$this->label = __('Wysiwyg Editor (WordPress)');
		$this->category = 'content';
		$this->defaults = array(
			'media_buttons'	=> 1,
			'teeny'			=> 0,
			'dfw'			=> 1,
			'default_value'	=> '',
		);
		
		
		// do not delete!
    	parent::__construct();

	}
	

	/*
	* render_field_settings()
	*
	* Create extra settings for your field. These are visible when editing a field
	*
	* @type action
	* @since 3.6
	* @date 23/01/13
	*
	* @param $field (array) the $field being edited
	* @return n/a
	*/
	
	function render_field_settings( $field ) {
		
		// default_value
		acf_render_field_setting( $field, array(
			'label'			=> __('Default Value', 'acf-wp_wysiwyg'),
			'instructions'	=> __('Appears when creating a new post', 'acf-wp_wysiwyg'),
			'type'			=> 'textarea',
			'name'			=> 'default_value',
		));
		
		
		// teeny
		acf_render_field_setting( $field, array(
			'label'			=> __('Teeny Mode', 'acf-wp_wysiwyg'),
			'instructions'	=> __('Whether to output the minimal editor configuration used in PressThis', 'acf-wp_wysiwyg'),
			'type'			=> 'radio',
			'name'			=> 'teeny',
			'layout'		=> 'horizontal',
			'choices' 		=> array(
				1				=>	__("Yes",'acf'),
				0				=>	__("No",'acf'),
			)
		));
		
		
		// media_upload
		acf_render_field_setting( $field, array(
			'label'			=> __('Show Media Upload Buttons?','acf'),
			'instructions'	=> '',
			'type'			=> 'radio',
			'name'			=> 'media_buttons',
			'layout'		=> 'horizontal',
			'choices'		=> array(
				1				=>	__("Yes",'acf'),
				0				=>	__("No",'acf'),
			)
		));
		
		
		// media_upload
		acf_render_field_setting( $field, array(
			'label'			=> __('Distraction Free Writing','acf'),
			'instructions'	=> __('Whether to replace the default fullscreen editor with DFW', 'acf-wp_wysiwyg'),
			'instructions'	=> '',
			'type'			=> 'radio',
			'name'			=> 'dfw',
			'layout'		=> 'horizontal',
			'choices'		=> array(
				1				=>	__("Yes",'acf'),
				0				=>	__("No",'acf'),
			)
		));
	
	}
		
	
	/*
	* render_field()
	*
	* Create the HTML interface for your field
	*
	* @param $field (array) the $field being rendered
	*
	* @type action
	* @since 3.6
	* @date 23/01/13
	*
	* @param $field (array) the $field being edited
	* @return n/a
	*/
	
	function render_field( $field ) {
		
		// unique id
		$id = 'wysiwyg-' . $field['id'] . '-' . uniqid();
		
		
		// extra atts
		$field['textarea_name'] = $field['name'];
		
		
		// create Field HTML
		wp_editor( $field['value'], $id, $field );
		
	}
	
	
	/*
	* format_value()
	*
	* This filter is appied to the $value after it is loaded from the db and before it is returned to the template
	*
	* @type filter
	* @since 3.6
	* @date 23/01/13
	*
	* @param $value (mixed) the value which was loaded from the database
	* @param $post_id (mixed) the $post_id from which the value was loaded
	* @param $field (array) the field array holding all the field options
	*
	* @return $value (mixed) the modified value
	*/
	
	function format_value( $value, $post_id, $field ) {
		
		// bail early if no value
		if( empty($value) ) {
			
			return $value;
		
		}
		
		
		// apply filters
		$value = apply_filters( 'acf_the_content', $value );
		
		
		// follow the_content function in /wp-includes/post-template.php
		$value = str_replace(']]>', ']]&gt;', $value);
		
	
		return $value;
		
	}
	
	
}

new acf_field_wp_wysiwyg();

endif;

?>