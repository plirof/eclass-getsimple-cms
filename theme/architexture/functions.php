<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File: 		functions.php
* @Package:		GetSimple
* @Action:		architexture theme for the GetSimple 3.1
*
*****************************************************/


 
function my_get_header($full=true) {
	global $metad;
	global $title;
	global $content;
	include(GSADMININCPATH.'configuration.php');
	
	if (function_exists('mb_substr')) { 
		$description = trim(mb_substr(strip_tags(strip_decode($content)), 0, 160));
	} else {
		$description = trim(substr(strip_tags(strip_decode($content)), 0, 160));
	}
	
	if ($metad != '') {
		$description = get_page_meta_desc(FALSE);
	} else {
		$description = str_replace('"','', $description);
		$description = str_replace("'",'', $description);
		$description = preg_replace('/\n/', " ", $description);
		$description = preg_replace('/\r/', " ", $description);
		$description = preg_replace('/\t/', " ", $description);
		$description = preg_replace('/ +/', " ", $description);
	}
	
	$keywords = get_page_meta_keywords(FALSE);
	
	echo '<meta name="description" content="'.get_page_meta_desc(false).'" />'."\n\t";
	echo '<meta name="keywords" content="'.get_page_meta_keywords(false).'" />'."\n\t";
	if ($full) {
		echo '<meta name="generator" content="'. $site_full_name .'" />'."\n\t";
		echo '<link rel="canonical" href="'. get_page_url(true) .'" />'."\n";
	}
	get_scripts_frontend();
	exec_action('theme-header');
}
