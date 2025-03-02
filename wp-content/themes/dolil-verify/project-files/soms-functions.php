<?php
/**
 * SOMS functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package SOMS
 */

/* 
* Removes WordPress framework dashboard horizontal banners (adminbar & footer)
*/
if (!function_exists('disable_framework_banners'))
{
    function disable_framework_banners()
    {
        function remove_admin_bar_style_frontend() 
        {
            // CSS override for the frontend
            echo '<style type="text/css" media="screen">html { margin-top: 0px !important; } * html body { margin-top: 0px !important; } </style>';
        }
       // add_filter('wp_head','remove_admin_bar_style_frontend', 99);
        
        function remove_wpadminbar_backend()
        {
            // CSS override for the admin page
            echo '<style>html.wp-toolbar { padding-top:0!important; }</style>';
            echo '<style>#wpadminbar { display:none!important }</style>';
        }
        //add_filter('admin_head','remove_wpadminbar_backend');

        function remove_wpfooter_backend()
        {
            // CSS override for the admin page
            echo '<style>#wpfooter { display:none!important }</style>';
        }
        //add_filter('admin_head','remove_wpfooter_backend');
    }
}
add_action('init','disable_framework_banners');

/* 
* Adding Custom CSS and JS Files in WordPress Admin Pages
*/
function hs_load_custom_wp_admin_style($hook)
{
    wp_enqueue_style('custom_wp_admin_css', get_template_directory_uri() . '/project-files/assets/bootstrap.min.css');
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Tiro+Bangla&display=swap', false );
	//wp_enqueue_style('custom_wp_admin_app_css', get_template_directory_uri() . '/project-files/assets/app.css');
	wp_enqueue_style('custom_wp_admin_style_css', get_template_directory_uri() . '/project-files/assets/style.css');
    // Load color picker styles.
    //wp_enqueue_style('wp-color-picker');
    //wp_enqueue_script('custom_wp_admin_js', get_template_directory_uri() . '/project-files/assets/script.js');
}
add_action('admin_enqueue_scripts', 'hs_load_custom_wp_admin_style');


/* 
* Adding Custom CSS and JS Files in WordPress Admin Pages
*/
function dashboard_redirect($url) {
    global $current_user;
             $url = admin_url('admin.php?page=soms');
        return $url;
}
add_filter('login_redirect', 'dashboard_redirect');


/* 
* Change the WordPress admin home page
*/
//Login redirect
function redirect_on_login($user_login, $user)
{
  $userRedirect = 'admin.php?page=soms';
  $url = admin_url($userRedirect);
  wp_safe_redirect($url);
  exit();
}
add_filter('wp_login', 'redirect_on_login', 10, 2);

//Catch requests to the admin home page
function redirect_on_home()
{
  $currentURL = home_url(sanitize_url($_SERVER['REQUEST_URI']));
  $adminURL = get_admin_url();

  //Only redirect if we are on empty /wp-admin/
  if ($currentURL != $adminURL) {
    return;
  }

  $userRedirect = 'users.php';
  $url = admin_url($userRedirect);
  wp_safe_redirect($url);
  exit();
}
add_filter('admin_init', 'redirect_on_home', 10);


//Generate auto title inside wordpress post when publishing
add_filter( 'wp_insert_post_data' , 'modify_your_post_title' , '99', 1 ); 

function modify_your_post_title( $data )
{
  if($data['post_type'] == 'restricted_land') {

    $id = get_the_ID();
    $title = 'Dolil-' . $id;
    $data['post_title'] =  $title ; //Updates the post title to your new title.
  }
  return $data; // Returns the modified data.
}


//Extending the search context in the admin list post screen
function custom_search_query( $query ) {
    $custom_fields = array(
        // put all the meta fields you want to search for here
        "_deed_code",
		"_deed_buyer",
		"_deed_seller",
		"_mouza_name",
		"_khatian_number",
		"_plot_number",
		"_land_value"
    );
    $searchterm = $query->query_vars['s'];

    // we have to remove the "s" parameter from the query, because it will prevent the posts from being found
    $query->query_vars['s'] = "";

    if ($searchterm != "") {
        $meta_query = array('relation' => 'OR');
        foreach($custom_fields as $cf) {
            array_push($meta_query, array(
                'key' => $cf,
                'value' => $searchterm,
                'compare' => 'LIKE'
            ));
        }
        $query->set("meta_query", $meta_query);
    };
}
add_filter( "pre_get_posts", "custom_search_query");


// Remove a column from the Posts page
function my_manage_columns( $columns ) {
  unset($columns['date']);
  return $columns;
}

function my_column_init() {
  add_filter( 'manage_posts_columns' , 'my_manage_columns' );
}
add_action( 'admin_init' , 'my_column_init' );


/**
 * Redirect to the post/page itself after publishing or updating a post in
 * WordPress.
 */
add_filter('redirect_post_location', function($location)
{
    global $post;

    if (
        (isset($_POST['publish']) || isset($_POST['save'])) &&
        preg_match("/post=([0-9]*)/", $location, $match) &&
        $post &&
        $post->ID == $match[1] &&
        (isset($_POST['publish']) || $post->post_status == 'publish') && // Publishing draft or updating published post
        $pl = get_admin_url() . 'edit.php?post_type=restricted_land'
    ) {
        // Always redirect to the post
        $location = $pl;
    }

    return $location;

});


/**
 * Remove hyperlink to edit post in edit.php
 */
if ( ! function_exists( 'wpse65613_remove_a' ) ) {

    add_action( 'admin_footer-edit.php', 'wpse65613_remove_a' );

    function wpse65613_remove_a() {
        ?>
        <script type="text/javascript">
            jQuery('table.wp-list-table a.row-title').contents().unwrap();
        </script>
        <?php
    }

}

/**
 * Add extra dropdowns to the List Tables
 * @param required string $post_type    The Post Type that is being displayed
 */
add_action('restrict_manage_posts', 'add_extra_tablenav');
function add_extra_tablenav($post_type){
    
    global $wpdb;
    
    /** Ensure this is the correct Post Type*/
    if($post_type !== 'restricted_land')
        return;
    
    /** Grab the results from the DB */
    $query = $wpdb->prepare('
        SELECT DISTINCT pm.meta_value FROM %1$s pm
        LEFT JOIN %2$s p ON p.ID = pm.post_id
        WHERE pm.meta_key = "%3$s" 
        AND p.post_status = "%4$s" 
        AND p.post_type = "%5$s"
        ORDER BY "%6$s"',
        $wpdb->postmeta,
        $wpdb->posts,
        '_mouza_name', // Your meta key - change as required
        'publish',          // Post status - change as required
        $post_type,
        '_mouza_name'
    );
    $results = $wpdb->get_col($query);
    
    /** Ensure there are options to show */
    if(empty($results))
        return;

    // get selected option if there is one selected
    if (isset( $_GET['mouza-name'] ) && $_GET['mouza-name'] != '') {
        $selectedName = $_GET['mouza-name'];
    } else {
        $selectedName = -1;
    }
    
    /** Grab all of the options that should be shown */
    $options[] = sprintf('<option value="-1">%1$s</option>', __('All Mouzas', 'your-text-domain'));
    foreach($results as $result) :
        if ($result == $selectedName) {
            $options[] = sprintf('<option value="%1$s" selected>%2$s</option>', esc_attr($result), $result);
        } else {
            $options[] = sprintf('<option value="%1$s">%2$s</option>', esc_attr($result), $result);
        }
    endforeach;

    /** Output the dropdown menu */
    echo '<select class="" id="mouza-name" name="mouza-name">';
    echo join("\n", $options);
    echo '</select>';

}


add_filter( 'parse_query', 'prefix_parse_filter' );
function  prefix_parse_filter($query) {
   global $pagenow;
   $current_page = isset( $_GET['post_type'] ) ? $_GET['post_type'] : '';
   
   if ( is_admin() && 
     'restricted_land' == $current_page &&
     'edit.php' == $pagenow && 
      isset( $_GET['mouza-name'] ) && 
      $_GET['mouza-name'] != '' ) {
   
    $competition_name                  = $_GET['mouza-name'];
    $query->query_vars['meta_key']     = '_mouza_name';
    $query->query_vars['meta_value']   = $competition_name;
    $query->query_vars['meta_compare'] = '=';
  }
}




// Add custom admin columns for your WordPress custom post type
$post_type = 'restricted_land';
// Register the columns.
add_filter( "manage_{$post_type}_posts_columns", function ( $defaults ) {
$defaults['custom-one'] = 'ধরণ';
$defaults['custom-two'] = 'দলিল নম্বর';
$defaults['custom-three'] = 'গ্রহীতা';
$defaults['custom-four'] = 'দাতা';
$defaults['custom-five'] = 'মৌজা';
$defaults['custom-six'] = 'খতিয়ান নং';
$defaults['custom-seven'] = 'দাগ নং';
$defaults['custom-eight'] = 'জমির পরিমাণ';
$defaults['custom-nine'] = 'মুল্য';
$defaults['custom-ten'] = 'মন্তব্য';
return $defaults;
} );
// Handle the value for each of the new columns.
add_action( "manage_{$post_type}_posts_custom_column", function ( $column_name, $post_id ) {
if ( $column_name == 'custom-one' ) {
echo get_field( '_restrcited_land_type', $post_id );
}
if ( $column_name == 'custom-two' ) {
// Display an ACF field
echo get_field( '_deed_code', $post_id );
}
if ( $column_name == 'custom-three' ) {
// Display an ACF field
echo get_field( '_deed_buyer', $post_id );
}
if ( $column_name == 'custom-four' ) {
// Display an ACF field
echo get_field( '_deed_seller', $post_id );
}
if ( $column_name == 'custom-five' ) {
// Display an ACF field
echo get_field( '_mouza_name', $post_id );
}
if ( $column_name == 'custom-six' ) {
// Display an ACF field
echo get_field( '_khatian_number', $post_id );
}
if ( $column_name == 'custom-seven' ) {
// Display an ACF field
echo get_field( '_plot_number', $post_id );
}
if ( $column_name == 'custom-eight' ) {
// Display an ACF field
echo get_field( '_land_area', $post_id );
}
if ( $column_name == 'custom-nine' ) {
// Display an ACF field
echo get_field( '_land_value', $post_id );
}
if ( $column_name == 'custom-ten' ) {
// Display an ACF field
echo get_field( '_deed_comments', $post_id );
}
}, 10, 2 );


