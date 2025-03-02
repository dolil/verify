<?php
/* 
* This file handle enqueue scripts and styles in WordPress way.
* Developed by: Jihan Ahmed
* URL: http://dolilsheba.com
*/

function dependent_dropdown_scripts() { 
  
  if (!is_admin()) {
	  
	//Add the Select2 CSS file
    //wp_enqueue_style( 'select2-css', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css', array(), '4.1.0-rc.0');
	
	//wp_enqueue_style( 'select2-bootstrap', 'https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css', array(), '4.1.0-rc.0');

    //Add the Select2 JavaScript file
    //wp_enqueue_script( 'select2-js', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', 'jquery', '4.1.0-rc.0');


    //Add a JavaScript file to initialize the Select2 elements
    //wp_enqueue_script( 'select2-init', '/wp-content/plugins/select-2-tutorial/select2-init.js', 'jquery', '4.1.0-rc.0');
	  
	// Add bootstrap-select
   //wp_enqueue_style( 'bootstrap-select', get_stylesheet_directory_uri() . '/project-files/bootstrap-select/css/bootstrap-select.min.css', array(), '4.0.0');
	
	//wp_enqueue_script( 'bootstrap-select-js', get_template_directory_uri() . '/project-files/bootstrap-select/js/bootstrap-select.min.js', array(), '4.0.0', true);
    
    // Add dependent-dropdown
    //wp_enqueue_style( 'dependent-dropdown', get_stylesheet_directory_uri() . '/project-files/dependent-dropdown/css/dependent-dropdown.min.css', array(), '4.0.0');
	
	//wp_enqueue_script( 'dependent-dropdown', get_template_directory_uri() . '/project-files/dependent-dropdown/js/dependent-dropdown.min.js', array(), '4.0.0', true);
	
	//wp_enqueue_script( 'dynamic-dropdown', get_template_directory_uri() . '/project-files/dynamic-dropdown/dist/jquery.cascadingdropdown.min.js', array(), '', true);
	
	//wp_enqueue_script( 'dynamic-dropdown-res', get_template_directory_uri() . '/project-files/dynamic-dropdown/res/ajax-mocks.js', array(), '', true);

 }
}
add_action('wp_enqueue_scripts', 'dependent_dropdown_scripts', 999);



