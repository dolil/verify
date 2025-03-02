<?php
/**
 * Dolilsheba functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Dolilsheba
 */



/* 
* Creating a Top-Level Admin Page
*/
add_action('admin_menu', 'register_dolil_page');

function register_dolil_page() {
	
   	add_menu_page('দলিল', 'দলিল শাখা', 'manage_options', 'edit.php?post_type=gazettes', '', 'dashicons-text-page', 7);
	
	add_submenu_page( 'edit.php?post_type=gazettes', 'দলিল দাখিল গ্রহণ', 'দলিল দাখিল গ্রহণ', 'read', 'edit.php?post_type=gazettes' );
	
	add_submenu_page( 'edit.php?post_type=gazettes', 'দলিল ফেরত প্রদান', 'দলিল ফেরত প্রদান', 'read', '#' );
}
