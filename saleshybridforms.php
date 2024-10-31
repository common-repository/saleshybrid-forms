<?php
/*
Plugin Name: Saleshybrid Forms
Plugin URI:
Description: Let your customers fill official Saleshybrid web forms without ever leaving your site.
Version: 1.0
Author: Saleshybrid Oy
Author URI: https://saleshybrid.fi
License: GPLv2
*/

// NOTE! Purpose of this plugin is to process links that point to saleshybridforms.fi domain so
// that those links are opened inside featherlight lightbox. This way end-user can fill a Saleshybrid 
// web form without leaving Wordpress site. This plugin does not add new links.
// 

// NOTE 2! This plugin does not use database. This plugin does not download external scripts.
// 

// NOTE 3! This plugin depends only of jQuery and Featherlight library. Featherlight is MIT licensed lightbox plugin.

/*
	CSS LOADING PART

	We load CSS for featherlight library that the plugin uses to achieve lightbox effect.
 */
//add_action('wp_head', 'saleshybridforms_plugin_css' );


/*
function saleshybridforms_plugin_css() { ?>
	<link href="<?php echo plugins_url('featherlight/featherlight.css', __FILE__);?>" type="text/css" rel="stylesheet" />
<?php }
*/
/*
	SCRIPT LOADING PART

	We load jQuery for featherlight library to work.

function saleshybridforms_require_scripts_old() {
	// Featherlight requires jQuery.
	wp_enqueue_script('jquery');
	wp_enqueue_script()
}
 */

function saleshybridforms_require_styles_scripts() {
	
	// Register scripts and styles
	// 
	wp_register_style(
	    'featherlight-style', // handle name
	    plugins_url('featherlight/featherlight.css', __FILE__),
	    array(),
	    '1.0', // version number
	    null // CSS media type
	);

	wp_register_script('featherlight', 
		plugins_url('featherlight/featherlight.js', __FILE__), 
		array('jquery'),
		'1.0', 
		true
	);

	wp_register_script('saleshybridforms-handler', 
		plugins_url('handler.js', __FILE__), 
		array('jquery', 'featherlight'),
		'1.0', 
		true
	);

	// Enqueue Featherlight library CSS
	wp_enqueue_style('featherlight-style');
 	// Enqueue Featherlight library.
	wp_enqueue_script('featherlight');
	// Enqueue business code that procudes Lightbox effect.
	wp_enqueue_script('saleshybridforms-handler');
}
  
add_action( 'wp_enqueue_scripts', 'saleshybridforms_require_styles_scripts' );



