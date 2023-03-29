<?php 

/** Tell WordPress to run theme_setup() when the 'after_setup_theme' hook is run. */

if ( ! function_exists( 'theme_setup' ) ):

function theme_setup() {

	/* This theme uses post thumbnails (aka "featured images")
	*  all images will be cropped to thumbnail size (below), as well as
	*  a square size (also below). You can add more of your own crop
	*  sizes with add_image_size. */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size(120, 90, true);
	add_image_size('square', 150, 150, true);


	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

  	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

}
endif; 

add_action( 'after_setup_theme', 'theme_setup' );


?>