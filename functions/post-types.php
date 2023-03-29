<?php $post_types = array(
	// 'credit-cards' => array(
	// 	'singular_name' => 'Credit Card',
	// 	'name' => 'Credit Cards',
	//  'args' => array(
			// 	'has_archive' => false,
			// 	'supports' => array( 'thumbnail', 'title' )
			// )
		// )
	// )
	// Add Icon Library CPT
		'projects' => array(
		'singular_name' => 'Project',
		'slug' => 'projects',
		'name' => 'Projects',
		'publicly_queryable' => true,
		'args' => array(
			'public' => true,
			'has_archive' => true,
			'menu_icon' => 'dashicons-megaphone',
			'supports' => array('thumbnail', 'title', 'excerpt', 'editor'),
			'exclude_from_search' => false,
			'show_ui' => true,
			// 'rewrite' => array(
			// 			'with_front' => false
			// )
		)
		)
);

$theme = get_template( );

function add_custom_post_types() {
	global $post_types, $theme;

	if(empty($post_types)) {
		return;
	}

	foreach($post_types as $slug => $type) {
		// define name as lower case
		$name_lowercase = strtolower($type['name']);

		$labels = array(
				"name" => __($type['name'], $theme),
				'singular_name' => __($type['singular_name'], $theme),
				'all_items' => __('All ' .$type['name'], $theme),
				'archives' => __($type['singular_name'].' Archives', $theme),
				'attributes' => __($type['singular_name'].' Attributes', $theme),
				'insert_into_item' => __('Insert into '. $slug, $theme),
				'uploaded_to_this_item' => __('Uploaded to '.$slug, $theme),
				'featured_image' => _x('Featured Image', $slug, $theme),
				'set_featured_image' => _x('Set featured image', $slug, $theme),
				'remove_featured_image' => _x('Remove featured image', $slug, $theme),
				'use_featured_image' => _x('Use as featured image', $slug, $theme),
				'filter_items_list' => __('Filter '.$name_lowercase.' list', $theme),
				'items_list_navigation' => __($type['name'].' list navigation', $theme),
				'items_list' => __($type['name'].' list', $theme),
				'new_item' => __('New '.$type['singular_name'], $theme),
				'add_new' => __('Add New', $theme),
				'add_new_item' => __('Add New '.$type['singular_name'], $theme),
				'edit_item' => __('Edit '.$type['singular_name'], $theme),
				'view_item' => __('View '.$type['singular_name'], $theme),
				'view_items' => __('View '.$type['name'], $theme),
				'search_items' => __('Search '.$name_lowercase, $theme),
				'not_found' => __('No '.$name_lowercase.' found', $theme),
				'not_found_in_trash' => __('No '.$name_lowercase.' found in trash', $theme),
				'parent_item_colon' => __('Parent '.$type['singular_name'].':', $theme),
				'menu_name' => __($type['name'], $theme)
		);

		$default_args = array(
			'labels' => $labels,
			'public' => true,
			'show_in_rest' => true
		);

		$args = wp_parse_args( $type['args'], $default_args);

		register_post_type($slug, $args);
	}
}

add_action('init', 'add_custom_post_types');

function custom_post_updated_messages($messages) {

	global $post, $post_types, $theme;

	// if posts types exist
	if(!empty($post_types)) {

		// define permalink
		$permalink = get_permalink($post);

		// for each post type
		foreach($post_types as $slug => $type) {

			// define post type messages
			$messages[$slug] = [
				0  => '',
				1  => sprintf(__($type['singular_name'].' updated. <a target="_blank" href="%s">View '.$slug.'</a>', $theme), esc_url( $permalink )),
				2  => __('Custom field updated.', $theme),
				3  => __('Custom field deleted.', $theme),
				4  => __($type['singular_name'].' updated.', $theme),
				5  => isset( $_GET['revision'] ) ? sprintf(__($type['singular_name'].' restored to revision from %s', $theme), wp_post_revision_title( (int) $_GET['revision'], false)) : false,
				6  => sprintf(__($type['singular_name'].' published. <a href="%s">View '.$slug.'</a>', $theme), esc_url($permalink)),
				7  => __($type['singular_name'].' saved.', $theme),
				8  => sprintf(__($type['singular_name'].' submitted. <a target="_blank" href="%s">Preview '.$slug.'</a>', $theme), esc_url(add_query_arg('preview', 'true', $permalink))),
				9  => sprintf(__($type['singular_name'].' scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview '.$slug.'</a>', $theme),
				date_i18n(__('M j, Y @ G:i'), strtotime( $post->post_date )), esc_url($permalink)),
				10 => sprintf(__($type['singular_name'].' draft updated. <a target="_blank" href="%s">Preview '.$slug.'</a>', $theme), esc_url( add_query_arg('preview', 'true', $permalink))),
			];
		}
	}

	return $messages;
}
add_filter('post_updated_messages', 'custom_post_updated_messages');