<?php
/**
* Al Custom Post Type
*/

// Flush rewrite rules for custom post
add_action( 'after_switch_theme', 'dolilsheba_flush_rewrite_rules' );

// Flush your rewrite rules
function dolilsheba_flush_rewrite_rules() {
	flush_rewrite_rules();
}

// Let's create the function for the Gazette post type
function cptui_register_my_cpts() {

	/**
	 * Post Type: Gazette.
	 */

	$labels = [
		"name" => __( "দলিল", "dolilsheba" ),
		"singular_name" => __( "Dolil", "dolilsheba" ),
	];

	$args = [
		"label" => __( "Dolil", "dolilsheba" ),
		"labels" => $labels,
		"description" => "",
		"public" => false,
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => false,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "page",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => false,
		"query_var" => true,
		"menu_position" => 7,
		"menu_icon" => "dashicons-media-document",
		"supports" => [ "title"],
		"show_in_graphql" => false,
	];

	register_post_type( "gazettes", $args );
	
}

add_action( 'init', 'cptui_register_my_cpts' );

