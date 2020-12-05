<?php
/*
Plugin Name: Include Page (by slug)
Description: Replace place holders in pages with content from other page : {% slug %}
Version: 1.0 - 20140613
Author: Vitalii Blagodir
*/

# get correct id for plugin
$thisfile = basename(__FILE__, ".php");

# register plugin
register_plugin(
	$thisfile, 
	'Include Page By Slug', 	
	'1.0', 		
	'Vitalii Blagodir',
	'https://github.com/VitaliiBlagodir', 
	'Replace place holders in pages with content from other page : {% slug %}',
	'',
	''  
);

# activate filter
add_filter('content','include_page_replace');

function include_page_replace($content) {
	return preg_replace_callback(
		"/{%\s*([a-zA-Z0-9_-]+)?\s*%}/", 
		'include_page_replace_match', 
		$content
	);
}

function include_page_replace_match($match) {
	$slug = $match[1];
	return returnPageContent($slug);
}