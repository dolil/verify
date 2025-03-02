<?php
/* 
* This file handle enqueue scripts and styles in WordPress way.
* Developed by: Jihan Ahmed
* URL: http://dolilsheba.com
*/

function dependent_dropdown_scripts() { 
  
  if (!is_admin()) {

	
	//wp_enqueue_script( 'dependent-dropdown', get_template_directory_uri() . '/project-files/dependent-dropdown/js/dependent-dropdown.min.js', array(), '4.0.0', true);
	
	//wp_enqueue_script( 'dynamic-dropdown', get_template_directory_uri() . '/project-files/dynamic-dropdown/dist/jquery.cascadingdropdown.min.js', array(), '', true);
	
	//wp_enqueue_script( 'dynamic-dropdown-res', get_template_directory_uri() . '/project-files/dynamic-dropdown/res/ajax-mocks.js', array(), '', true);

 }
}
add_action('wp_enqueue_scripts', 'dependent_dropdown_scripts', 999);



