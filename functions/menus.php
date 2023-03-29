<?php 

/*
  Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function base_theme_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'base_theme_page_menu_args' );


function init_menus() {
  register_nav_menus( array(
      'primary' => 'Primary Navigation',
      'footer'=> 'Footer Navigation'
    ) );
}

add_action('init', 'init_menus');