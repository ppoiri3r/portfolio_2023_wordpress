<?php 

/* Add all our JavaScript files here.
We'll let WordPress add them to our templates automatically instead
of writing our own script tags in the header and footer. */

function base_theme_scripts() {

  wp_enqueue_style('styles', get_stylesheet_uri( ), '', 1);

	//Don't use WordPress' local copy of jquery, load our own version from a CDN instead

wp_deregister_script('jquery');

  wp_enqueue_script(
		'jquery',
		"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js",
		false, //dependencies
		null, //version number
		true //load in footer
	);

  // *Uncomment to add flickity.
  // *If using flickity, add 'flickity' to array of dependancies on scripts enqueue line 31. 
  // wp_enqueue_script(
	// 	'flickity',
	// 	"https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js",
	// 	array( 'jquery'), //dependencies
	// 	null, //version number
	// 	true //load in footer
	// );

  wp_enqueue_script(
    'scripts', //handle
    get_template_directory_uri() . '/js/main.min.js', //source
    array( 'jquery' ), //dependencies
    null, // version number
    true //load in footer
  );
}

add_action( 'wp_enqueue_scripts', 'base_theme_scripts' );