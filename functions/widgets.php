<?php /*
 * Register a single widget area.
 * You can register additional widget areas by using register_sidebar again
 * within base_theme_widgets_init.
 * Display in your template with dynamic_sidebar()
 */

function base_theme_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => 'Primary Widget Area',
		'id' => 'primary-widget-area',
		'description' => 'The primary widget area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}

add_action( 'widgets_init', 'base_theme_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 */
function base_theme_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'base_theme_remove_recent_comments_style' );