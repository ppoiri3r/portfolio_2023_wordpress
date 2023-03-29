<?php

// define taxonomies
$taxonomies = [
	[
		'slug' => 'project-type',
		'name' => 'Project Type',
		'show_in_rest' => true,
		'show_admin_column' => true,
		'public'=> true,
      'post_types' => ['projects']
	],
];

// define theme
$theme = get_template();

function init_taxonomies() {

	global $taxonomies, $theme;

	// if taxonomies exist
	if(!empty($taxonomies)) {

		// for each taxonomy
		foreach($taxonomies as $taxonomy) {

			// capitalize first letter of slug
			$name_capitalized = ucfirst($taxonomy['slug']);
			$name_lower = strtolower($taxonomy['name']);

			$default_capabilities = [
				'manage_terms' => 'edit_posts',
				'edit_terms' => 'edit_posts',
				'delete_terms' => 'edit_posts',
				'assign_terms' => 'edit_posts',
			];

			// register taxonomy
			register_taxonomy($taxonomy['slug'], $taxonomy['post_types'], [
				'hierarchical' => (!empty($taxonomy['hierarchical'])) ? $taxonomy['hierarchical'] : false,
				'public' => (!empty($taxonomy['public'])) ? $taxonomy['public'] : true,
				'show_in_nav_menus' => (!empty($taxonomy['show_in_nav_menus'])) ? $taxonomy['show_in_nav_menus'] : true,
				'show_ui'  => (!empty($taxonomy['show_ui'])) ? $taxonomy['show_ui'] : true,
				'show_admin_column' => (!empty($taxonomy['show_admin_column'])) ? $taxonomy['show_admin_column'] : false,
				'query_var' => (!empty($taxonomy['query_var'])) ? $taxonomy['query_var'] : true,
				'rewrite' => (!empty($taxonomy['rewrite'])) ? $taxonomy['rewrite'] : true,
				'capabilities' => (!empty($taxonomy['capabilities'])) ? $taxonomy['capabilities'] : $default_capabilities,
				'labels' => [
					'name' => __($taxonomy['name'], $theme),
					'singular_name' => _x($name_capitalized, 'taxonomy general name', $theme),
					'search_items' => __('Search '.$taxonomy['name'], $theme),
					'popular_items' => __('Popular '.$taxonomy['name'], $theme),
					'all_items' => __('All '.$taxonomy['name'], $theme),
					'parent_item' => __('Parent '.$name_capitalized, $theme),
					'parent_item_colon' => __('Parent '.$name_capitalized.':', $theme),
					'edit_item' => __('Edit '.$name_capitalized, $theme),
					'update_item' => __('Update '.$name_capitalized, $theme),
					'view_item' => __('View '.$name_capitalized, $theme),
					'add_new_item' => __('New '.$name_capitalized, $theme),
					'new_item_name' => __('New '.$name_capitalized, $theme),
					'separate_items_with_commas' => __('Separate '.$name_lower.' with commas', $theme),
					'add_or_remove_items' => __('Add or remove '.$name_lower, $theme),
					'choose_from_most_used' => __('Choose from the most used '.$name_lower, $theme),
					'not_found' => __('No '.$name_lower.' found.', $theme),
					'no_terms' => __('No '.$name_lower, $theme),
					'menu_name' => __($taxonomy['name'], $theme),
					'items_list_navigation' => __($taxonomy['name'].' list navigation', $theme),
					'items_list' => __($taxonomy['name'].' list', $theme),
					'most_used' => _x('Most Used', $taxonomy['slug'], $theme),
					'back_to_items' => __('&larr; Back to '.$taxonomy['name'], $theme),
				],
				'show_in_rest' => (!empty($taxonomy['show_in_rest'])) ? $taxonomy['show_in_rest'] : true,
				'rest_base' => (!empty($taxonomy['rest_base'])) ? $taxonomy['rest_base'] : $taxonomy['slug'],
				'rest_controller_class' => (!empty($taxonomy['rest_controller_class'])) ? $taxonomy['rest_controller_class'] : 'WP_REST_Terms_Controller'
			]);
		}
	}
}
add_action('init', 'init_taxonomies');

function custom_term_updated_messages($messages) {

	global $taxonomies, $theme;

	// if taxonomies exist
	if(!empty($taxonomies)) {

		// for each taxonomy
		foreach($taxonomies as $taxonomy) {

			// capitalize first letter of slug
			$name_capitalized = ucfirst($taxonomy['slug']);

			// define taxonomy messages
			$messages[$taxonomy['slug']] = [
				0 => '',
				1 => __($name_capitalized.' added.', $theme),
				2 => __($name_capitalized.' deleted.', $theme),
				3 => __($name_capitalized.' updated.', $theme),
				4 => __($name_capitalized.' not added.', $theme),
				5 => __($name_capitalized.' not updated.', $theme),
				6 => __($taxonomy['name'].' deleted.', $theme),
			];
		}
	}

	return $messages;
}
add_filter('term_updated_messages', 'custom_term_updated_messages');
