<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
	The base folder (relative to the template.site_root config setting)
	that all of the assets are stored in. This is used to generate both
	the url and the relative file path.
	
	This should NOT include the trailing slash.
*/
$config['assets.base_folder'] = 'assets';

/*
	The names of the folders for the various assets.
	These default to 'js', 'css', and 'images'. These folders
	are expected to be found directly under the 'assets.base_folder'. 
	
	While searching through themes, these names are also used to
	build alternate folders to look into, under the theme folders.
*/
$config['assets.asset_folders'] = array(
	'css'	=> 'css',
	'js'	=> 'js',
	'image'	=> 'images'
);

/*
	The 'assets.js_opener' and 'assets.js_closer' strings are used
	to wrap all of your inline scripts into. By default, it is
	setup to work with jQuery.
*/
$config['assets.js_opener'] = '$(document).ready(function(){'. "\n";
$config['assets.js_closer'] = '});'. "\n";
$config['debug']            = false;