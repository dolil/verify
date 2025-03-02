<?php
/**
 * Dolilsheba functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Dolilsheba
 */

/**
 * Restricting Authors to View Only Posts They Created.
 */
function posts_for_current_author($query) {
        global $pagenow;
  
    if( 'edit.php' != $pagenow || !$query->is_admin )
        return $query;
  
    if( !current_user_can( 'manage_options' ) ) {
       global $user_ID;
       $query->set('author', $user_ID );
     }
     return $query;
}
//add_filter('pre_get_posts', 'posts_for_current_author');



/**
 * Restricting Authors to Draft Only Posts They Created.
 */
//add_filter( 'wp_insert_post_data', 'filter_handler', '99');

function filter_handler( $data ) {
    $user = wp_get_current_user();
    $userRole = $user->roles ? $user->roles[0] : false;

    if ( $userRole === 'author') {
        $data['post_status'] = 'pending';
    }

    return $data;
}

/**
 * Disable plugin notice for non-admin user.
 */
add_action('admin_enqueue_scripts', function () {
	if ( ! current_user_can( 'manage_options' ) ) {
		echo '<style>.update-nag, .updated, .error, .is-dismissible { display: none; }</style>';
	}
});

/**
 * Limit media library access.
 */
add_filter( 'ajax_query_attachments_args', 'wpb_show_current_user_attachments' );
 
function wpb_show_current_user_attachments( $query ) {
    $user_id = get_current_user_id();
    if ( $user_id && !current_user_can('activate_plugins') && !current_user_can('edit_others_posts
') ) {
        $query['author'] = $user_id;
    }
    return $query;
} 

/**
 * Hide Jetpack From Non-Admin Users.
 */
add_action( 'admin_menu', 'busitech_no_jetpack_menu_non_admins', 999 );
function busitech_no_jetpack_menu_non_admins() {
	if (
		class_exists( 'Jetpack' )
		&& ! current_user_can( 'manage_options' )
	) {
		remove_menu_page( 'jetpack' );
	}
}

/**
 * Remove personal options block.
 */
if( is_admin() ){
    remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );
    add_action( 'personal_options', 'prefix_hide_personal_options' );
}

function prefix_hide_personal_options() {
  ?>
    <script type="text/javascript">
        jQuery( document ).ready(function( $ ){
            $( '#your-profile .form-table:first, #your-profile h3:first' ).remove();
        } );
    </script>
  <?php
}

/**
* Remove all dashboard widgets.
 */
add_action('wp_dashboard_setup', 'wpse_73561_remove_all_dashboard_meta_boxes', 9999 );

function wpse_73561_remove_all_dashboard_meta_boxes()
{
    global $wp_meta_boxes;
    $wp_meta_boxes['dashboard']['normal']['core'] = array();
    $wp_meta_boxes['dashboard']['side']['core'] = array();
}

//Screen Options and the Help tabs:
add_filter( 'contextual_help', 'wpse_25034_remove_dashboard_help_tab', 999, 3 );
add_filter( 'screen_options_show_screen', 'wpse_25034_remove_help_tab' );

function wpse_25034_remove_dashboard_help_tab( $old_help, $screen_id, $screen )
{
    if( 'dashboard' != $screen->base )
        return $old_help;

    $screen->remove_help_tabs();
    return $old_help;
}

function wpse_25034_remove_help_tab( $visible )
{
    global $current_screen;
    if( 'dashboard' == $current_screen->base )
        return false;
    return $visible;
}

/**
 * Remove dashboard widgets.
 */
function remove_dashboard_meta() {
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
	remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'side' );
	//remove_meta_box('wp_mail_smtp_reports_widget_lite', 'dashboard', 'normal');
}
//add_action( 'admin_init', 'remove_dashboard_meta' );

function plt_hide_wp_mail_smtp_dashboard_widgets() {
	$screen = get_current_screen();
	if ( !$screen ) {
		return;
	}

	//Remove the "WP Mail SMTP" widget.
	remove_meta_box('wp_mail_smtp_reports_widget_lite', 'dashboard', 'normal');
}

add_action('wp_dashboard_setup', 'plt_hide_wp_mail_smtp_dashboard_widgets', 20);


/**
 * Disable the Application Passwords.
 */
function my_prefix_customize_app_password_availability(
    $available,
    $user
) {
    if ( ! user_can( $user, 'manage_options' ) ) {
        $available = false;
    }
 
    return $available;
}
 
add_filter( 'wp_is_application_passwords_available_for_user', 'my_prefix_customize_app_password_availability', 10, 2 );

/**
 * Hide the Screen Options and the Help tabs.
 */
//add_filter('screen_options_show_screen', '__return_false');

//add_action('admin_head', 'mytheme_remove_help_tabs');
function mytheme_remove_help_tabs() {
    $screen = get_current_screen();
    $screen->remove_help_tabs();
}

/**
 * Remove WordPress Version From The Admin Footer.
 */
add_filter( 'admin_footer_text', '__return_empty_string', 11 ); 
add_filter( 'update_footer', '__return_empty_string', 11 );

/**
 * Remove admin bar logo.
 */
function no_wp_logo_admin_bar_remove() {
	  global $wp_admin_bar;
	  $wp_admin_bar->remove_menu('new-content');
	  $wp_admin_bar->remove_menu('comments');
	  
	  $wp_admin_bar->remove_menu('wp-logo');
	  $wp_admin_bar->remove_menu('about');
	  $wp_admin_bar->remove_menu('wporg');
	  $wp_admin_bar->remove_menu('documentation');
	  $wp_admin_bar->remove_menu('support-forums');
	  $wp_admin_bar->remove_menu('feedback');
	  $wp_admin_bar->remove_menu('view-site');
}
add_action('wp_before_admin_bar_render', 'no_wp_logo_admin_bar_remove', 0);

/* 
* admin_init action works better than admin_menu in modern wordpress (at least v5+)
*/
add_action( 'admin_init', 'my_remove_menu_pages' );
function my_remove_menu_pages() {
  global $user_ID;
  if ( $user_ID != 1 ) { //your user id
   remove_menu_page('edit.php'); // Posts
   remove_menu_page('upload.php'); // Media
   remove_menu_page('link-manager.php'); // Links
   remove_menu_page('edit-comments.php'); // Comments
   //remove_menu_page('edit.php?post_type=page'); // Pages
   //remove_menu_page('plugins.php'); // Plugins
   remove_menu_page('themes.php'); // Appearance
   //remove_menu_page('users.php'); // Users
   remove_menu_page('tools.php'); // Tools
   //remove_menu_page('options-general.php'); // Settings
  }
}


function change_admin_footer_text() {
	
    echo '<a href="' . wp_logout_url( get_permalink() ) . '">Logout</a>';
}
add_filter('admin_footer_text', 'change_admin_footer_text');

/**
 * Remove tools & activity log metabox from dashboard.
 */
function TRIM_ADMIN_MENU() {
    global $current_user;
    if(!current_user_can('administrator')) {
        remove_menu_page( 'tools.php' ); // No tools for <= editors
        @remove_menu_page( 'activity_log_page' ); // Activity log
    }
}
add_action('admin_init', 'TRIM_ADMIN_MENU');

/**
 * Disable access to author page.
 */
add_action('template_redirect', 'my_custom_disable_author_page');

function my_custom_disable_author_page() {
    global $wp_query;

    if ( is_author() ) {
        // Redirect to homepage, set status to 301 permenant redirect. 
        // Function defaults to 302 temporary redirect. 
        wp_redirect(get_option('home'), 301); 
        exit; 
    }
}

/**
 * Disable embed.min.js.
 */
function my_deregister_scripts(){
 wp_dequeue_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );

/**
 * Remove Gutenberg Block Library CSS from loading on the frontend.
 */
function smartwp_remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
} 
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );

/**
 * Restoring the classic Widgets Editor.
 */
function example_theme_support() {
    remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'example_theme_support' );

/**
 * Disable the Password Reset Feature in WordPress.
 */
function disable_password_reset() { 
              return false;
              }
add_filter ( 'allow_password_reset', 'disable_password_reset' );

function remove_lostpassword_text ( $text ) {
     if ($text == 'Lost your password?'){$text = '';} 
        return $text; 
     }
add_filter( 'gettext', 'remove_lostpassword_text' ); 


/* 
* Remove the "dashboard from the admin menu"
*/
add_action( 'admin_menu', 'Wps_remove_tools', 99 );
function Wps_remove_tools(){

remove_menu_page( 'index.php' ); //dashboard

}

