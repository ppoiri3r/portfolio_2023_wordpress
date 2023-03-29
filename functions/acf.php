<?php 
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme Options',
		'menu_title' 	=> 'Theme Options'
	));

}


// Filter to add icon html to icon block selections
add_filter('acf/load_field/name=select_icon', 'acf_load_icons');

function acf_load_icons($field) {
	$icons = get_posts(array('post_type' => 'icons', 'fields' => 'ids', 'posts_per_page' => -1));
	foreach ($icons as $icon) {
		$field['choices'][$icon] = get_the_content( '', false, $icon);
	}
	return $field;
}


// Filter to add public post types to posts block for selection
add_filter('acf/load_field/name=post_type', 'acf_load_post_types');

function acf_load_post_types($field) {
	foreach (get_post_types( array('show_in_nav_menus' => true), 'objects') as $post_type) {
		$field['choices'][$post_type->name] = $post_type->labels->singular_name;
	}
	return $field;
}

?>