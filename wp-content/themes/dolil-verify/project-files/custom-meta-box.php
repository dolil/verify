<?php
/*
Author: Dolilsheba.com
URL: https://dolilsheba.com

This is where you can drop your custom metabox codes
for post, page or any custom post types.
*/

/**
 * Adds a metabox to the gazettes post type
 */
function add_gazettes_metaboxes()
{

	add_meta_box(
		'wpt_gazettes_link',
		'Gazette Details',
		'wpt_gazettes_link',
		'gazettes',
		'normal',
		'high'
	);

}

add_action('add_meta_boxes', 'add_gazettes_metaboxes');

/**
 * Output the HTML for the metabox.
 */
function wpt_gazettes_link()
{
	global $post;

	// Nonce field to validate form request came from current site
	wp_nonce_field(basename(__FILE__), 'gezette_fields');

	// Get the gezette_link data if it's already been entered
	$gezette_link = get_post_meta($post->ID, 'gezette_link', true);
	$gezette_number = get_post_meta($post->ID, 'gezette_number', true);
	$gezette_source = get_post_meta($post->ID, 'gezette_source', true);
	$gezette_source_title = get_post_meta($post->ID, 'gezette_source_title', true);

	// Output the field
	echo '<table class="form-table">
		<tbody>
			<tr>
				<td><input type="text" name="gezette_link" value="' . esc_textarea($gezette_link) . '" class="widefat"><br><small>Gazette Google Drive Link ID</small></td>
				<td><input type="text" name="gezette_number" value="' . esc_textarea($gezette_number) . '" class="widefat"><br><small>Gazette Number (SRO)</small></td>
			</tr>
			<tr>
				<td><input type="url" name="gezette_source" value="' . esc_textarea($gezette_source) . '" class="widefat"><br><small>Gazette Source URL</small></td>
				<td><input type="text" name="gezette_source_title" value="' . esc_textarea($gezette_source_title) . '" class="widefat"><br><small>Gazette Source Title</small></td>
			</tr>
		</tbody>
	</table>';
}

/**
 * Save the metabox data
 */
function wpt_save_gazettes_meta($post_id, $post)
{

	// Return if the user doesn't have edit permissions.
	if (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}

	// Verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times.
	if (!isset($_POST['gezette_link']) || !isset($_POST['gezette_number']) || !isset($_POST['gezette_source_title']) || !isset($_POST['gezette_source']) || !wp_verify_nonce($_POST['gezette_fields'], basename(__FILE__))) {
		return $post_id;
	}

	// Now that we're authenticated, time to save the data.
	// This sanitizes the data from the field and saves it into an array $gazettes_meta.
	$gazettes_meta['gezette_link'] = esc_textarea($_POST['gezette_link']);
	$gazettes_meta['gezette_number'] = esc_textarea($_POST['gezette_number']);
	$gazettes_meta['gezette_source'] = esc_textarea($_POST['gezette_source']);
	$gazettes_meta['gezette_source_title'] = esc_textarea($_POST['gezette_source_title']);

	// Cycle through the $gazettes_meta array.
	// Note, in this example we just have one item, but this is helpful if you have multiple.
	foreach ($gazettes_meta as $key => $value):

		// Don't store custom data twice
		if ('revision' === $post->post_type) {
			return;
		}

		if (get_post_meta($post_id, $key, false)) {
			// If the custom field already has a value, update it.
			update_post_meta($post_id, $key, $value);
		} else {
			// If the custom field doesn't have a value, add it.
			add_post_meta($post_id, $key, $value);
		}

		if (!$value) {
			// Delete the meta key if there's no value
			delete_post_meta($post_id, $key);
		}

	endforeach;
}
add_action('save_post', 'wpt_save_gazettes_meta', 1, 2);

/**
 * Adds a metabox to the FAQs Post Type
 */
function add_faqs_metaboxes()
{
	$post_types = array('faqs');

	add_meta_box(
		'wpt_faqs_source',
		'FAQs Source',
		'wpt_faqs_source',
		'faqs',
		'normal',
		'high'
	);

	add_meta_box(
		'wpt_faqs_law', // $id
		'FAQs Related Law', // $title 
		'wpt_faqs_law', // $callback
		'faqs', // $post_type
		'normal', // $context
		'high' // $priority
	);
}

add_action('add_meta_boxes', 'add_faqs_metaboxes');

/**
 * Output the HTML for the metabox.
 */
function wpt_faqs_source()
{
	global $post;

	// Nonce field to validate form request came from current site
	wp_nonce_field(basename(__FILE__), 'faqs_fields');

	// Get the faqs_link data if it's already been entered
	$faqs_source = get_post_meta($post->ID, 'faqs_source', true);
	$faqs_source_title = get_post_meta($post->ID, 'faqs_source_title', true);

	// Output the field
	echo '<table class="form-table">
		<tbody>
			<tr>
				<td><input type="text" name="faqs_source_title" value="' . esc_textarea($faqs_source_title) . '" class="widefat"><br><small>Faqs Source Title</small></td>
				<td><input type="url" name="faqs_source" value="' . esc_textarea($faqs_source) . '" class="widefat"><br><small>Faqs Source URL</small></td>
			</tr>
			<tr>
		</tbody>
	</table>';
}

function wpt_faqs_law()
{
	global $post;

	// Nonce field to validate form request came from current site
	wp_nonce_field(basename(__FILE__), 'faqs_fields');

	// Get the faqs_law_title_01 data if it's already been entered
	$faqs_law_title_01 = get_post_meta($post->ID, 'faqs_law_title_01', true);
	$faqs_law_url_01 = get_post_meta($post->ID, 'faqs_law_url_01', true);

	$faqs_law_title_02 = get_post_meta($post->ID, 'faqs_law_title_02', true);
	$faqs_law_url_02 = get_post_meta($post->ID, 'faqs_law_url_02', true);

	$faqs_law_title_03 = get_post_meta($post->ID, 'faqs_law_title_03', true);
	$faqs_law_url_03 = get_post_meta($post->ID, 'faqs_law_url_03', true);

	$faqs_law_title_04 = get_post_meta($post->ID, 'faqs_law_title_04', true);
	$faqs_law_url_04 = get_post_meta($post->ID, 'faqs_law_url_04', true);

	$faqs_law_title_05 = get_post_meta($post->ID, 'faqs_law_title_05', true);
	$faqs_law_url_05 = get_post_meta($post->ID, 'faqs_law_url_05', true);

	// Output the field
	echo '<table class="form-table">
		<tbody>
			<tr>
				<td><input type="text" name="faqs_law_title_01" value="' . esc_textarea($faqs_law_title_01) . '" class="widefat"><br><small>Faqs Law Title 01</small></td>
				<td><input type="url" name="faqs_law_url_01" value="' . esc_textarea($faqs_law_url_01) . '" class="widefat"><br><small>Faqs Law URL 01</small></td>
			</tr>
			<tr>
				<td><input type="text" name="faqs_law_title_02" value="' . esc_textarea($faqs_law_title_02) . '" class="widefat"><br><small>Faqs Law Title 02</small></td>
				<td><input type="url" name="faqs_law_url_02" value="' . esc_textarea($faqs_law_url_02) . '" class="widefat"><br><small>Faqs Law URL 02</small></td>
			</tr>
			<tr>
				<td><input type="text" name="faqs_law_title_03" value="' . esc_textarea($faqs_law_title_03) . '" class="widefat"><br><small>Faqs Law Title 03</small></td>
				<td><input type="url" name="faqs_law_url_03" value="' . esc_textarea($faqs_law_url_03) . '" class="widefat"><br><small>Faqs Law URL 03</small></td>
			</tr>
			<tr>
				<td><input type="text" name="faqs_law_title_04" value="' . esc_textarea($faqs_law_title_04) . '" class="widefat"><br><small>Faqs Law Title 04</small></td>
				<td><input type="url" name="faqs_law_url_04" value="' . esc_textarea($faqs_law_url_04) . '" class="widefat"><br><small>Faqs Law URL 04</small></td>
			</tr>
			<tr>
				<td><input type="text" name="faqs_law_title_05" value="' . esc_textarea($faqs_law_title_05) . '" class="widefat"><br><small>Faqs Law Title 05</small></td>
				<td><input type="url" name="faqs_law_url_05" value="' . esc_textarea($faqs_law_url_05) . '" class="widefat"><br><small>Faqs Law URL 05</small></td>
			</tr>
		</tbody>
	</table>';
}

/**
 * Save the metabox data
 */
function wpt_save_faqs_meta($post_id, $post)
{

	// Return if the user doesn't have edit permissions.
	if (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}

	// Verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times.
	if (
		!isset($_POST['faqs_source']) || !isset($_POST['faqs_source_title']) || !isset($_POST['faqs_law_title_01']) || !isset($_POST['faqs_law_url_01']) || !isset($_POST['faqs_law_title_02']) || !isset($_POST['faqs_law_url_02']) || !isset($_POST['faqs_law_title_03']) || !isset($_POST['faqs_law_url_03']) || !isset($_POST['faqs_law_title_04']) || !isset($_POST['faqs_law_url_04']) || !isset($_POST['faqs_law_title_05']) || !isset($_POST['faqs_law_url_05']) || !wp_verify_nonce($_POST['faqs_fields'], basename(__FILE__))
	) {
		return $post_id;
	}

	// Now that we're authenticated, time to save the data.
	// This sanitizes the data from the field and saves it into an array $faqs_meta.
	$faqs_meta['faqs_source'] = esc_textarea($_POST['faqs_source']);
	$faqs_meta['faqs_source_title'] = esc_textarea($_POST['faqs_source_title']);

	$faqs_meta['faqs_law_title_01'] = esc_textarea($_POST['faqs_law_title_01']);
	$faqs_meta['faqs_law_url_01'] = esc_textarea($_POST['faqs_law_url_01']);

	$faqs_meta['faqs_law_title_02'] = esc_textarea($_POST['faqs_law_title_02']);
	$faqs_meta['faqs_law_url_02'] = esc_textarea($_POST['faqs_law_url_02']);

	$faqs_meta['faqs_law_title_03'] = esc_textarea($_POST['faqs_law_title_03']);
	$faqs_meta['faqs_law_url_03'] = esc_textarea($_POST['faqs_law_url_03']);

	$faqs_meta['faqs_law_title_04'] = esc_textarea($_POST['faqs_law_title_04']);
	$faqs_meta['faqs_law_url_04'] = esc_textarea($_POST['faqs_law_url_04']);

	$faqs_meta['faqs_law_title_05'] = esc_textarea($_POST['faqs_law_title_05']);
	$faqs_meta['faqs_law_url_05'] = esc_textarea($_POST['faqs_law_url_05']);

	// Cycle through the $faqs_meta array.
	// Note, in this example we just have one item, but this is helpful if you have multiple.
	foreach ($faqs_meta as $key => $value):

		// Don't store custom data twice
		if ('revision' === $post->post_type) {
			return;
		}

		if (get_post_meta($post_id, $key, false)) {
			// If the custom field already has a value, update it.
			update_post_meta($post_id, $key, $value);
		} else {
			// If the custom field doesn't have a value, add it.
			add_post_meta($post_id, $key, $value);
		}

		if (!$value) {
			// Delete the meta key if there's no value
			delete_post_meta($post_id, $key);
		}

	endforeach;
}
add_action('save_post', 'wpt_save_faqs_meta', 1, 2);


/**
 * Adds a metabox to the Page Post Type
 */
function add_page_metaboxes()
{

	add_meta_box(
		'wpt_page_footnotes',
		'Page Footnotes',
		'wpt_page_footnotes',
		'page',
		'normal',
		'high'
	);

	add_meta_box(
		'wpt_page_short_title',
		'Page Short Title',
		'wpt_page_short_title',
		'page',
		'normal',
		'high'
	);
}

add_action('add_meta_boxes', 'add_page_metaboxes');

/**
 * Output the HTML for the metabox.
 */
function wpt_page_footnotes()
{
	global $post;

	// Nonce field to validate form request came from current site
	wp_nonce_field(basename(__FILE__), 'page_fields');

	// Get the faqs_link data if it's already been entered
	$page_footnotes = get_post_meta($post->ID, 'page_footnotes', true);

	// Output the field
	echo '<textarea name="page_footnotes" rows="5" class="widefat">' . esc_textarea($page_footnotes) . '</textarea>';
}

function wpt_page_short_title()
{
	global $post;

	// Nonce field to validate form request came from current site
	wp_nonce_field(basename(__FILE__), 'page_fields');

	// Get the faqs_link data if it's already been entered
	$page_short_title = get_post_meta($post->ID, 'page_short_title', true);

	// Output the field
	echo '<input type="text" name="page_short_title" value="' . esc_textarea($page_short_title) . '" class="widefat">';
}

/**
 * Save the metabox data
 */
function wpt_save_page_meta($post_id, $post)
{

	// Return if the user doesn't have edit permissions.
	if (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}

	// Verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times.
	if (!isset($_POST['page_footnotes']) || !isset($_POST['page_short_title']) || !wp_verify_nonce($_POST['page_fields'], basename(__FILE__))) {
		return $post_id;
	}

	// Now that we're authenticated, time to save the data.
	// This sanitizes the data from the field and saves it into an array $page_meta.
	$page_meta['page_footnotes'] = ($_POST['page_footnotes']);
	$page_meta['page_short_title'] = esc_textarea($_POST['page_short_title']);

	// Cycle through the $page_meta array.
	// Note, in this example we just have one item, but this is helpful if you have multiple.
	foreach ($page_meta as $key => $value):

		// Don't store custom data twice
		if ('revision' === $post->post_type) {
			return;
		}

		if (get_post_meta($post_id, $key, false)) {
			// If the custom field already has a value, update it.
			update_post_meta($post_id, $key, $value);
		} else {
			// If the custom field doesn't have a value, add it.
			add_post_meta($post_id, $key, $value);
		}

		if (!$value) {
			// Delete the meta key if there's no value
			delete_post_meta($post_id, $key);
		}

	endforeach;
}
add_action('save_post', 'wpt_save_page_meta', 1, 2);


/**
 * Adds a metabox to the Market Value Post Type
 */
function add_market_value_metaboxes()
{

	add_meta_box(
		'wpt_market_value_01',
		'Market Value Google Drive ID and Market Value Year',
		'wpt_market_value_01',
		'market-value',
		'normal',
		'high'
	);

}

add_action('add_meta_boxes', 'add_market_value_metaboxes');

/**
 * Output the HTML for the metabox.
 */
function wpt_market_value_01()
{
	global $post;

	// Nonce field to validate form request came from current site
	wp_nonce_field(basename(__FILE__), 'market_value_fields');

	// Get the market-value data if it's already been entered
	$market_value_gdrive_01 = get_post_meta($post->ID, 'market_value_gdrive_01', true);
	$market_value_year_01 = get_post_meta($post->ID, 'market_value_year_01', true);

	$market_value_gdrive_02 = get_post_meta($post->ID, 'market_value_gdrive_02', true);
	$market_value_year_02 = get_post_meta($post->ID, 'market_value_year_02', true);

	$market_value_gdrive_03 = get_post_meta($post->ID, 'market_value_gdrive_03', true);
	$market_value_year_03 = get_post_meta($post->ID, 'market_value_year_03', true);

	$market_value_gdrive_04 = get_post_meta($post->ID, 'market_value_gdrive_04', true);
	$market_value_year_04 = get_post_meta($post->ID, 'market_value_year_04', true);

	$market_value_gdrive_05 = get_post_meta($post->ID, 'market_value_gdrive_05', true);
	$market_value_year_05 = get_post_meta($post->ID, 'market_value_year_05', true);

	// Output the field
	echo '<table class="form-table">
		<tbody>
			<tr>
				<td><input type="text" name="market_value_gdrive_01" value="' . esc_textarea($market_value_gdrive_01) . '" class="widefat"><br><small>Market Value Gdrive 01</small></td>
				<td><input type="text" name="market_value_year_01" value="' . esc_textarea($market_value_year_01) . '" class="widefat"><br><small>Market Value Year 01</small></td>
			</tr>
			<tr>
				<td><input type="text" name="market_value_gdrive_02" value="' . esc_textarea($market_value_gdrive_02) . '" class="widefat"><br><small>Market Value Gdrive 02</small></td>
				<td><input type="text" name="market_value_year_02" value="' . esc_textarea($market_value_year_02) . '" class="widefat"><br><small>Market Value Year 02</small></td>
			</tr>
			<tr>
				<td><input type="text" name="market_value_gdrive_03" value="' . esc_textarea($market_value_gdrive_03) . '" class="widefat"><br><small>Market Value Gdrive 03</small></td>
				<td><input type="text" name="market_value_year_03" value="' . esc_textarea($market_value_year_03) . '" class="widefat"><br><small>Market Value Year 03</small></td>
			</tr>
			<tr>
				<td><input type="text" name="market_value_gdrive_04" value="' . esc_textarea($market_value_gdrive_04) . '" class="widefat"><br><small>Market Value Gdrive 04</small></td>
				<td><input type="text" name="market_value_year_04" value="' . esc_textarea($market_value_year_04) . '" class="widefat"><br><small>Market Value Year 04</small></td>
			</tr>
			<tr>
				<td><input type="text" name="market_value_gdrive_05" value="' . esc_textarea($market_value_gdrive_05) . '" class="widefat"><br><small>Market Value Gdrive 05</small></td>
				<td><input type="text" name="market_value_year_05" value="' . esc_textarea($market_value_year_05) . '" class="widefat"><br><small>Market Value Year 05</small></td>
			</tr>
		</tbody>
	</table>';
}

/**
 * Save the metabox data
 */
function wpt_save_market_value_meta($post_id, $post)
{

	// Return if the user doesn't have edit permissions.
	if (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}

	// Verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times.
	if (
		!isset($_POST['market_value_gdrive_01']) || !isset($_POST['market_value_year_01']) || !isset($_POST['market_value_gdrive_02']) || !isset($_POST['market_value_year_02']) || !isset($_POST['market_value_gdrive_03']) || !isset($_POST['market_value_year_03']) || !isset($_POST['market_value_gdrive_04']) || !isset($_POST['market_value_year_04']) || !isset($_POST['market_value_gdrive_05']) || !isset($_POST['market_value_year_05']) || !isset($_POST['_market_value_structure']) || !wp_verify_nonce($_POST['market_value_fields'], basename(__FILE__))
	) {
		return $post_id;
	}

	// Now that we're authenticated, time to save the data.
	// This sanitizes the data from the field and saves it into an array $market_value_meta.
	$market_value_meta['market_value_gdrive_01'] = esc_textarea($_POST['market_value_gdrive_01']);
	$market_value_meta['market_value_year_01'] = esc_textarea($_POST['market_value_year_01']);

	$market_value_meta['market_value_gdrive_02'] = esc_textarea($_POST['market_value_gdrive_02']);
	$market_value_meta['market_value_year_02'] = esc_textarea($_POST['market_value_year_02']);

	$market_value_meta['market_value_gdrive_03'] = esc_textarea($_POST['market_value_gdrive_03']);
	$market_value_meta['market_value_year_03'] = esc_textarea($_POST['market_value_year_03']);

	$market_value_meta['market_value_gdrive_04'] = esc_textarea($_POST['market_value_gdrive_04']);
	$market_value_meta['market_value_year_04'] = esc_textarea($_POST['market_value_year_04']);

	$market_value_meta['market_value_gdrive_05'] = esc_textarea($_POST['market_value_gdrive_05']);
	$market_value_meta['market_value_year_05'] = esc_textarea($_POST['market_value_year_05']);

	$market_value_meta['_market_value_structure'] = ($_POST['_market_value_structure']);

	// Cycle through the $market_value_meta array.
	// Note, in this example we just have one item, but this is helpful if you have multiple.
	foreach ($market_value_meta as $key => $value):

		// Don't store custom data twice
		if ('revision' === $post->post_type) {
			return;
		}

		if (get_post_meta($post_id, $key, false)) {
			// If the custom field already has a value, update it.
			update_post_meta($post_id, $key, $value);
		} else {
			// If the custom field doesn't have a value, add it.
			add_post_meta($post_id, $key, $value);
		}

		if (!$value) {
			// Delete the meta key if there's no value
			delete_post_meta($post_id, $key);
		}

	endforeach;
}
add_action('save_post', 'wpt_save_market_value_meta', 1, 2);


/**
 * Adds metabox to the Market Value Post Type for Strcuture Value
 */
function market_value_structure_meta()
{
	add_meta_box('market_value_structure', __('Market Value Structure'), 'market_value_structure', 'market-value', 'normal', 'high');
}
add_action('add_meta_boxes', 'market_value_structure_meta');

/**
 * Outputs the content of the meta box
 */
function market_value_structure($post)
{
	wp_nonce_field(basename(__FILE__), 'textarea_nonce');
	$textarea_stored_meta = get_post_meta($post->ID);
	?>
	<p>
		<textarea name="_market_value_structure" id="market_value_structure" style="width: 100%;height: 157px;"><?php if (isset($textarea_stored_meta['_market_value_structure']))
			echo $textarea_stored_meta['_market_value_structure'][0]; ?></textarea>
	</p>
	<?php
}

/**
 * Saves the manual custom meta input
 */
function market_value_structure_meta_save($post_id)
{

	// Checks save status
	$is_autosave = wp_is_post_autosave($post_id);
	$is_revision = wp_is_post_revision($post_id);
	$is_valid_nonce = (isset($_POST['textarea_nonce']) && wp_verify_nonce($_POST['textarea_nonce'], basename(__FILE__))) ? 'true' : 'false';

	// Exits script depending on save status
	if ($is_autosave || $is_revision || !$is_valid_nonce) {
		return;
	}

	// Checks for input and saves if needed
	if (isset($_POST['_market_value_structure'])) {
		update_post_meta($post_id, '_market_value_structure', $_POST['_market_value_structure']);
	}
}
add_action('save_post', 'market_value_structure_meta_save');


/**
 * Adds metabox to the Forms Post Type
 */
function add_forms_metaboxes()
{

	add_meta_box(
		'wpt_forms_01',
		'পুরণকৃত নমুনা PDF ও DOC',
		'wpt_forms_01',
		'forms',
		'normal',
		'high'
	);

}

add_action('add_meta_boxes', 'add_forms_metaboxes');

/**
 * Output the HTML for the metabox.
 */
function wpt_forms_01()
{
	global $post;

	// Nonce field to validate form request came from current site
	wp_nonce_field(basename(__FILE__), 'forms_fields');

	// Get the dolilsheba-forms data if it's already been entered
	
	$forms_title_01 = get_post_meta($post->ID, '_forms_title_01', true);
	$forms_gdrive_pdf_01 = get_post_meta($post->ID, '_forms_gdrive_pdf_01', true);
	$forms_gdrive_doc_01 = get_post_meta($post->ID, '_forms_gdrive_doc_01', true);
	
	$forms_title_02 = get_post_meta($post->ID, '_forms_title_02', true);
	$forms_gdrive_pdf_02 = get_post_meta($post->ID, '_forms_gdrive_pdf_02', true);
	$forms_gdrive_doc_02 = get_post_meta($post->ID, '_forms_gdrive_doc_02', true);
	
	$forms_title_03 = get_post_meta($post->ID, '_forms_title_03', true);
	$forms_gdrive_pdf_03 = get_post_meta($post->ID, '_forms_gdrive_pdf_03', true);
	$forms_gdrive_doc_03 = get_post_meta($post->ID, '_forms_gdrive_doc_03', true);
	
	$forms_title_04 = get_post_meta($post->ID, '_forms_title_04', true);
	$forms_gdrive_pdf_04 = get_post_meta($post->ID, '_forms_gdrive_pdf_04', true);
	$forms_gdrive_doc_04 = get_post_meta($post->ID, '_forms_gdrive_doc_04', true);
	
	$forms_title_05 = get_post_meta($post->ID, '_forms_title_05', true);
	$forms_gdrive_pdf_05 = get_post_meta($post->ID, '_forms_gdrive_pdf_05', true);
	$forms_gdrive_doc_05 = get_post_meta($post->ID, '_forms_gdrive_doc_05', true);
	
	$forms_title_06 = get_post_meta($post->ID, '_forms_title_06', true);
	$forms_gdrive_pdf_06 = get_post_meta($post->ID, '_forms_gdrive_pdf_06', true);
	$forms_gdrive_doc_06 = get_post_meta($post->ID, '_forms_gdrive_doc_06', true);

	// Output the field
	echo '<table class="form-table">
		<tbody>
			<tr>
				<td><input type="text" name="_forms_title_01" value="' . esc_textarea($forms_title_01) . '" class="widefat"><br>
				<small>Forms Title 01</small></td>
				<td><input type="text" name="_forms_gdrive_pdf_01" value="' . esc_textarea($forms_gdrive_pdf_01) . '" class="widefat"><br>
				<small>Google Drive PDF ID</small></td>
				<td><input type="text" name="_forms_gdrive_doc_01" value="' . esc_textarea($forms_gdrive_doc_01) . '" class="widefat"><br>
				<small>Google Drive DOC ID</small></td>
			</tr>
			<tr>
				<td><input type="text" name="_forms_title_02" value="' . esc_textarea($forms_title_02) . '" class="widefat"><br>
				<small>Forms Title 02</small></td>
				<td><input type="text" name="_forms_gdrive_pdf_02" value="' . esc_textarea($forms_gdrive_pdf_02) . '" class="widefat"><br>
				<small>Google Drive PDF ID</small></td>
				<td><input type="text" name="_forms_gdrive_doc_02" value="' . esc_textarea($forms_gdrive_doc_02) . '" class="widefat"><br>
				<small>Google Drive DOC ID</small></td>
			</tr>
			<tr>
				<td><input type="text" name="_forms_title_03" value="' . esc_textarea($forms_title_03) . '" class="widefat"><br>
				<small>Forms Title 03</small></td>
				<td><input type="text" name="_forms_gdrive_pdf_03" value="' . esc_textarea($forms_gdrive_pdf_03) . '" class="widefat"><br>
				<small>Google Drive PDF ID</small></td>
				<td><input type="text" name="_forms_gdrive_doc_03" value="' . esc_textarea($forms_gdrive_doc_03) . '" class="widefat"><br>
				<small>Google Drive DOC ID</small></td>
			</tr>
			<tr>
				<td><input type="text" name="_forms_title_04" value="' . esc_textarea($forms_title_04) . '" class="widefat"><br>
				<small>Forms Title 04</small></td>
				<td><input type="text" name="_forms_gdrive_pdf_04" value="' . esc_textarea($forms_gdrive_pdf_04) . '" class="widefat"><br>
				<small>Google Drive PDF ID</small></td>
				<td><input type="text" name="_forms_gdrive_doc_04" value="' . esc_textarea($forms_gdrive_doc_04) . '" class="widefat"><br>
				<small>Google Drive DOC ID</small></td>
			</tr>
			<tr>
				<td><input type="text" name="_forms_title_05" value="' . esc_textarea($forms_title_05) . '" class="widefat"><br>
				<small>Forms Title 05</small></td>
				<td><input type="text" name="_forms_gdrive_pdf_05" value="' . esc_textarea($forms_gdrive_pdf_05) . '" class="widefat"><br>
				<small>Google Drive PDF ID</small></td>
				<td><input type="text" name="_forms_gdrive_doc_05" value="' . esc_textarea($forms_gdrive_doc_05) . '" class="widefat"><br>
				<small>Google Drive DOC ID</small></td>
			</tr>			
			<tr>
				<td><input type="text" name="_forms_title_06" value="' . esc_textarea($forms_title_06) . '" class="widefat"><br>
				<small>Forms Title 06</small></td>
				<td><input type="text" name="_forms_gdrive_pdf_06" value="' . esc_textarea($forms_gdrive_pdf_06) . '" class="widefat"><br>
				<small>Google Drive PDF ID</small></td>
				<td><input type="text" name="_forms_gdrive_doc_06" value="' . esc_textarea($forms_gdrive_doc_06) . '" class="widefat"><br>
				<small>Google Drive DOC ID</small></td>
			</tr>
		</tbody>
	</table>';
}


/**
 * Save the metabox data
 */
function wpt_save_forms_meta($post_id, $post)
{

	// Return if the user doesn't have edit permissions.
	if (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}

	// Verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times.
	if (!isset($_POST['_forms_title_01']) || !isset($_POST['_forms_gdrive_pdf_01']) || !isset($_POST['_forms_gdrive_doc_01']) || !isset($_POST['_forms_title_02']) || !isset($_POST['_forms_gdrive_pdf_02']) || !isset($_POST['_forms_gdrive_doc_02']) || !isset($_POST['_forms_title_03']) || !isset($_POST['_forms_gdrive_pdf_03']) || !isset($_POST['_forms_gdrive_doc_03']) || !isset($_POST['_forms_title_04']) || !isset($_POST['_forms_gdrive_pdf_04']) || !isset($_POST['_forms_gdrive_doc_04']) || !isset($_POST['_forms_title_05']) || !isset($_POST['_forms_gdrive_pdf_05']) || !isset($_POST['_forms_gdrive_doc_05']) || !isset($_POST['_forms_title_06']) || !isset($_POST['_forms_gdrive_pdf_06']) || !isset($_POST['_forms_gdrive_doc_06']) || !wp_verify_nonce($_POST['forms_fields'], basename(__FILE__))) {
		return $post_id;
	}

	// Now that we're authenticated, time to save the data.
	// This sanitizes the data from the field and saves it into an array $forms_meta.
	$forms_meta['_forms_title_01'] = esc_textarea($_POST['_forms_title_01']);
	$forms_meta['_forms_gdrive_pdf_01'] = esc_textarea($_POST['_forms_gdrive_pdf_01']);
	$forms_meta['_forms_gdrive_doc_01'] = esc_textarea($_POST['_forms_gdrive_doc_01']);
	
	$forms_meta['_forms_title_02'] = esc_textarea($_POST['_forms_title_02']);
	$forms_meta['_forms_gdrive_pdf_02'] = esc_textarea($_POST['_forms_gdrive_pdf_02']);
	$forms_meta['_forms_gdrive_doc_02'] = esc_textarea($_POST['_forms_gdrive_doc_02']);
	
	$forms_meta['_forms_title_03'] = esc_textarea($_POST['_forms_title_03']);
	$forms_meta['_forms_gdrive_pdf_03'] = esc_textarea($_POST['_forms_gdrive_pdf_03']);
	$forms_meta['_forms_gdrive_doc_03'] = esc_textarea($_POST['_forms_gdrive_doc_03']);
	
	$forms_meta['_forms_title_04'] = esc_textarea($_POST['_forms_title_04']);
	$forms_meta['_forms_gdrive_pdf_04'] = esc_textarea($_POST['_forms_gdrive_pdf_04']);
	$forms_meta['_forms_gdrive_doc_04'] = esc_textarea($_POST['_forms_gdrive_doc_04']);
	
	$forms_meta['_forms_title_05'] = esc_textarea($_POST['_forms_title_05']);
	$forms_meta['_forms_gdrive_pdf_05'] = esc_textarea($_POST['_forms_gdrive_pdf_05']);
	$forms_meta['_forms_gdrive_doc_05'] = esc_textarea($_POST['_forms_gdrive_doc_05']);
	
	$forms_meta['_forms_title_06'] = esc_textarea($_POST['_forms_title_06']);
	$forms_meta['_forms_gdrive_pdf_06'] = esc_textarea($_POST['_forms_gdrive_pdf_06']);
	$forms_meta['_forms_gdrive_doc_06'] = esc_textarea($_POST['_forms_gdrive_doc_06']);

	// Cycle through the $forms_meta array.
	// Note, in this example we just have one item, but this is helpful if you have multiple.
	foreach ($forms_meta as $key => $value):

		// Don't store custom data twice
		if ('revision' === $post->post_type) {
			return;
		}

		if (get_post_meta($post_id, $key, false)) {
			// If the custom field already has a value, update it.
			update_post_meta($post_id, $key, $value);
		} else {
			// If the custom field doesn't have a value, add it.
			add_post_meta($post_id, $key, $value);
		}

		if (!$value) {
			// Delete the meta key if there's no value
			delete_post_meta($post_id, $key);
		}

	endforeach;
}
add_action('save_post', 'wpt_save_forms_meta', 1, 2);


/**
 * Adds metabox to the Manual Post Type
 */
function manual_custom_meta()
{
	add_meta_box('manual_footnotes', __('Footnotes'), 'manual_meta_callback', 'manual', 'normal', 'high');
}
add_action('add_meta_boxes', 'manual_custom_meta');

/**
 * Outputs the content of the meta box
 */
function manual_meta_callback($post)
{
	wp_nonce_field(basename(__FILE__), 'textarea_nonce');
	$textarea_stored_meta = get_post_meta($post->ID);
	?>
	<p>
		<textarea name="_manual_footnotes" id="_manual_footnotes" style="width: 100%;height: 157px;"><?php if (isset($textarea_stored_meta['_manual_footnotes']))
			echo $textarea_stored_meta['_manual_footnotes'][0]; ?></textarea>
	</p>
	<?php
}

/**
 * Saves the manual custom meta input
 */
function manual_meta_save($post_id)
{

	// Checks save status
	$is_autosave = wp_is_post_autosave($post_id);
	$is_revision = wp_is_post_revision($post_id);
	$is_valid_nonce = (isset($_POST['textarea_nonce']) && wp_verify_nonce($_POST['textarea_nonce'], basename(__FILE__))) ? 'true' : 'false';

	// Exits script depending on save status
	if ($is_autosave || $is_revision || !$is_valid_nonce) {
		return;
	}

	// Checks for input and saves if needed
	if (isset($_POST['_manual_footnotes'])) {
		update_post_meta($post_id, '_manual_footnotes', $_POST['_manual_footnotes']);
	}
}
add_action('save_post', 'manual_meta_save');


/**
 * Adds a Related Laws metabox to the post types
 */
function add_related_laws_metaboxes()
{

	$post_types = array('faqs', 'market-value', 'forms');
	foreach ($post_types as $post_type) {
		add_meta_box(
			'wpt_related_laws',
			'Related Laws',
			'wpt_related_laws',
			$post_type,
			'normal',
			'high'
		);
	}

}

add_action('add_meta_boxes', 'add_related_laws_metaboxes');


// Output the HTML for the metabox.
function wpt_related_laws()
{
	global $post;

	// Nonce field to validate form request came from current site
	wp_nonce_field(basename(__FILE__), 'related_laws_fields');

	// Get the gezette_link data if it's already been entered
	$related_laws_title_01 = get_post_meta($post->ID, '_related_laws_title_01', true);
	$related_laws_url_01 = get_post_meta($post->ID, '_related_laws_url_01', true);

	$related_laws_title_02 = get_post_meta($post->ID, '_related_laws_title_02', true);
	$related_laws_url_02 = get_post_meta($post->ID, '_related_laws_url_02', true);

	$related_laws_title_03 = get_post_meta($post->ID, '_related_laws_title_03', true);
	$related_laws_url_03 = get_post_meta($post->ID, '_related_laws_url_03', true);

	$related_laws_title_04 = get_post_meta($post->ID, '_related_laws_title_04', true);
	$related_laws_url_04 = get_post_meta($post->ID, '_related_laws_url_04', true);

	$related_laws_title_05 = get_post_meta($post->ID, '_related_laws_title_05', true);
	$related_laws_url_05 = get_post_meta($post->ID, '_related_laws_url_05', true);

	// Output the field
	echo '<table class="form-table">
		<tbody>
			<tr>
				<td><input type="text" name="_related_laws_title_01" value="' . esc_textarea($related_laws_title_01) . '" class="widefat"><br>
				<small>Related Law Title 01</small></td>
				<td><input type="url" name="_related_laws_url_01" value="' . esc_textarea($related_laws_url_01) . '" class="widefat"><br>
				<small>Related Law URL 01</small></td>
			</tr>
			<tr>
				<td><input type="text" name="_related_laws_title_02" value="' . esc_textarea($related_laws_title_02) . '" class="widefat"><br>
				<small>Related Law Title 02</small></td>
				<td><input type="url" name="_related_laws_url_02" value="' . esc_textarea($related_laws_url_02) . '" class="widefat"><br>
				<small>Related Law URL 02</small></td>
			</tr>
			<tr>
				<td><input type="text" name="_related_laws_title_03" value="' . esc_textarea($related_laws_title_03) . '" class="widefat"><br>
				<small>Related Law Title 03</small></td>
				<td><input type="url" name="_related_laws_url_03" value="' . esc_textarea($related_laws_url_03) . '" class="widefat"><br>
				<small>Related Law URL 03</small></td>
			</tr>
			<tr>
				<td><input type="text" name="_related_laws_title_04" value="' . esc_textarea($related_laws_title_04) . '" class="widefat"><br>
				<small>Related Law Title 04</small></td>
				<td><input type="url" name="_related_laws_url_04" value="' . esc_textarea($related_laws_url_04) . '" class="widefat"><br>
				<small>Related Law URL 04</small></td>
			</tr>
			<tr>
				<td><input type="text" name="_related_laws_title_05" value="' . esc_textarea($related_laws_title_05) . '" class="widefat"><br>
				<small>Related Law Title 05</small></td>
				<td><input type="url" name="_related_laws_url_05" value="' . esc_textarea($related_laws_url_05) . '" class="widefat"><br>
				<small>Related Law URL 05</small></td>
			</tr>
		</tbody>
	</table>';
}

// Save the metabox data
function wpt_save_related_laws_meta($post_id, $post)
{

	// Return if the user doesn't have edit permissions.
	if (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}

	// Verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times.
	if (
		!isset($_POST['_related_laws_title_01']) || !isset($_POST['_related_laws_url_01']) || !isset($_POST['_related_laws_title_02']) || !isset($_POST['_related_laws_url_02']) || !isset($_POST['_related_laws_title_03']) || !isset($_POST['_related_laws_url_03']) || !isset($_POST['_related_laws_title_04']) || !isset($_POST['_related_laws_url_04']) || !isset($_POST['_related_laws_title_05']) || !isset($_POST['_related_laws_url_05']) || !wp_verify_nonce($_POST['related_laws_fields'], basename(__FILE__))
	) {
		return $post_id;
	}

	// Now that we're authenticated, time to save the data.
	// This sanitizes the data from the field and saves it into an array $rls_meta.
	$rls_meta['_related_laws_title_01'] = esc_textarea($_POST['_related_laws_title_01']);
	$rls_meta['_related_laws_url_01'] = esc_textarea($_POST['_related_laws_url_01']);

	$rls_meta['_related_laws_title_02'] = esc_textarea($_POST['_related_laws_title_02']);
	$rls_meta['_related_laws_url_02'] = esc_textarea($_POST['_related_laws_url_02']);

	$rls_meta['_related_laws_title_03'] = esc_textarea($_POST['_related_laws_title_03']);
	$rls_meta['_related_laws_url_03'] = esc_textarea($_POST['_related_laws_url_03']);

	$rls_meta['_related_laws_title_04'] = esc_textarea($_POST['_related_laws_title_04']);
	$rls_meta['_related_laws_url_04'] = esc_textarea($_POST['_related_laws_url_04']);

	$rls_meta['_related_laws_title_05'] = esc_textarea($_POST['_related_laws_title_05']);
	$rls_meta['_related_laws_url_05'] = esc_textarea($_POST['_related_laws_url_05']);

	// Cycle through the $rls_meta array.
	// Note, in this example we just have one item, but this is helpful if you have multiple.
	foreach ($rls_meta as $key => $value):

		// Don't store custom data twice
		if ('revision' === $post->post_type) {
			return;
		}

		if (get_post_meta($post_id, $key, false)) {
			// If the custom field already has a value, update it.
			update_post_meta($post_id, $key, $value);
		} else {
			// If the custom field doesn't have a value, add it.
			add_post_meta($post_id, $key, $value);
		}

		if (!$value) {
			// Delete the meta key if there's no value
			delete_post_meta($post_id, $key);
		}

	endforeach;
}
add_action('save_post', 'wpt_save_related_laws_meta', 1, 2);


/**
 * Adds a custom field to gazettes taxonomy
 */
add_action( 'gazette_cat_add_form_fields', 'rudr_add_term_fields' );

function rudr_add_term_fields( $taxonomy ) {
	?>
		<div class="form-field">
			<label for="gc_order_no">Order ID</label>
			<input type="number" name="gc_order_no" id="gc_order_no" />
		</div>
	<?php
}

// Add Fields to the Edit Term Screen 
add_action( 'gazette_cat_edit_form_fields', 'rudr_edit_term_fields', 10, 2 );
function rudr_edit_term_fields( $term, $taxonomy ) {

	// get meta data value
	$text_field = get_term_meta( $term->term_id, 'gc_order_no', true );

	?><tr class="form-field">
		<th><label for="gc_order_no">Order ID</label></th>
		<td>
			<input name="gc_order_no" id="gc_order_no" type="number" value="<?php echo esc_attr( $text_field ) ?>" />
		</td>
	</tr><?php
}

// Save Fields 
add_action( 'created_gazette_cat', 'rudr_save_term_fields' );
add_action( 'edited_gazette_cat', 'rudr_save_term_fields' );
function rudr_save_term_fields( $term_id ) {
	
	update_term_meta(
		$term_id,
		'gc_order_no',
		sanitize_text_field( $_POST[ 'gc_order_no' ] )
	);
	
}
