<?php 

function register_blocks() {
	if( ! function_exists('acf_register_block') )
		return;

	//Accordion
	acf_register_block( array(
		'name'			=> 'home-stream',
		'title'			=> __( 'Home Stream' ), 
		'render_template'	=> 'blocks/home-stream.php', 
		'category'		=> 'columns',
		'icon'			=> 'menu-alt3',
		'mode'			=> 'edit',
		'keywords'		=> array('columns', 'stream', 'text') 
	));

	acf_register_block( array(
		'name'			=> 'secondary-stream',
		'title'			=> __( 'Secondary Stream' ), 
		'render_template'	=> 'blocks/secondary-stream.php', 
		'category'		=> 'columns',
		'icon'			=> 'menu-alt3',
		'mode'			=> 'edit',
		'keywords'		=> array('columns', 'stream', 'text') 
	));
}

add_action('acf/init', 'register_blocks' );

?>