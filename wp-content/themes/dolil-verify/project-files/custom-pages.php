<?php
/**
 * Dolilsheba functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Dolilsheba
 */

add_filter('comment_form_defaults', 'ocean_custom_comment_title', 20);
function ocean_custom_comment_title( $defaults ){
  $defaults['title_reply'] = __('আপনার মতামত দিন', 'customizr-child');
  return $defaults;
}

// Remove the last breadcrumb, the post name, from the Yoast SEO breadcrumbs
function adjust_single_breadcrumb( $link_output) {
	if(strpos( $link_output, 'breadcrumb_last' ) !== false ) {
		$link_output = '';
	}
   	return $link_output;
}
//add_filter('wpseo_breadcrumb_single_link', 'adjust_single_breadcrumb' );

// Remove Yoast SEO Social Profiles From All Users
add_filter('user_contactmethods', 'yoast_seo_admin_user_remove_social');
function yoast_seo_admin_user_remove_social ( $contactmethods ) {
	//unset( $contactmethods['facebook'] );
	unset( $contactmethods['instagram'] );
	unset( $contactmethods['linkedin'] );
	unset( $contactmethods['myspace'] );
	unset( $contactmethods['pinterest'] );
	unset( $contactmethods['soundcloud'] );
	unset( $contactmethods['tumblr'] );
	unset( $contactmethods['twitter'] );
	unset( $contactmethods['youtube'] );
	unset( $contactmethods['wikipedia'] );
return $contactmethods;
}

// Add theme support for yoast breadcrumb
add_theme_support( 'yoast-seo-breadcrumbs' );

// Place yoast metabox after all content
function lower_wpseo_priority( $html ) {
    return 'low';
}
add_filter( 'wpseo_metabox_prio', 'lower_wpseo_priority' );

// Disable the wincher dashboard widget in Yoast SEO
function remove_wpseo_wincher_dashboard_widget() {
    remove_meta_box('wpseo-wincher-dashboard-overview', 'dashboard', 'normal');
}
add_action('wp_dashboard_setup', 'remove_wpseo_wincher_dashboard_widget');

// CF7 Loading JavaScript and stylesheet only when it is necessary
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

// CF7 Loading Recaptcha only when it is necessary
add_action('wp_print_scripts', function () {
	global $post;
	if ( is_a( $post, 'WP_Post' ) && !has_shortcode( $post->post_content, 'contact-form-7') ) {
		wp_dequeue_script( 'google-recaptcha' );
		wp_dequeue_script( 'wpcf7-recaptcha' );
	}
});

// Remove Editorial Flow meta box for users that cannot delete pages 
add_action( 'do_meta_boxes', 'wpdocs_remove_plugin_metaboxes' );
function wpdocs_remove_plugin_metaboxes(){
    if ( ! current_user_can( 'delete_others_pages' ) ) { // Only run if the user is an Author or lower.
        remove_meta_box( 'yarpp_relatedposts', 'post', 'normal' ); // Remove Edit Flow Editorial Metadata
		remove_meta_box( 'wpseo_meta', 'post', 'normal' );
		remove_meta_box('tagsdiv-post_tag', 'post', 'side');
    }
}

// Wordpress Custom Post Type + (YARPP)
function wpurp_register_post_type( $args )
{
    $args['yarpp_support'] = true;
    return $args;
} 

// Dequeue YARPP's CSS Style Sheet (related.css):
add_filter( 'yarpp_enqueue_related_style', '__return_false' );

// Dequeue YARPP's Thumbnails Template Style Sheet (styles_thumbnails.css):
add_filter( 'yarpp_enqueue_thumbnails_style', '__return_false' );

// To disable automatic creation of YARPP thumbnail sizes:
add_filter( 'yarpp_add_image_size', '__return_false' );

//Remove WordPress Gutenberg / Block
add_action( 'wp_enqueue_scripts', 'wp_juice_cleanse', 200 );
function wp_juice_cleanse() {

    wp_dequeue_style('wp-block-library');

    // This also removes some inline CSS variables for colors since 5.9 - global-styles-inline-css
    wp_dequeue_style('global-styles');

    // WooCommerce - you can remove the following if you don't use Woocommerce
    wp_dequeue_style('wc-block-style');
    wp_dequeue_style('wc-blocks-vendors-style');
    wp_dequeue_style('wc-blocks-style'); 

    // since 6.1 or so, WP has been adding this nonsense
    wp_dequeue_style( 'classic-theme-styles' );
}

// Disable WooCommerce Blocks package
function disable_woocommerce_blocks() {
// Check if WooCommerce Blocks is active
if ( ! class_exists( 'Automattic\WooCommerce\Blocks\Package' ) ) {
return;
}

// Remove WooCommerce Blocks package action hooks
remove_action( 'init', array( 'Automattic\WooCommerce\Blocks\Package', 'container' ) );
remove_action( 'init', array( 'Automattic\WooCommerce\Blocks\Package', 'on_init' ) );
}
add_action( 'plugins_loaded', 'disable_woocommerce_blocks', 11 );