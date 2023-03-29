<?php 

/*
 * Sets the post excerpt length to 40 characters.
 */
function base_theme_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'base_theme_excerpt_length' );

/*
 * Returns a "Continue Reading" link for excerpts
 */
// function base_theme_continue_reading_link() {
// 	return ' <a href="'. get_permalink() . '">Continue reading <span class="meta-nav">&rarr;</span></a>';
// }

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and base_theme_continue_reading_link().
 */
// function base_theme_auto_excerpt_more( $more ) {
// 	return ' &hellip;' . base_theme_continue_reading_link();
// }
// add_filter( 'excerpt_more', 'base_theme_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 */
// function base_theme_custom_excerpt_more( $output ) {
// 	if ( has_excerpt() && ! is_attachment() ) {
// 		$output .= base_theme_continue_reading_link();
// 	}
// 	return $output;
// }
// add_filter( 'get_the_excerpt', 'base_theme_custom_excerpt_more' );
