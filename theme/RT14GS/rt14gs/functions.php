<?php 
// Exit if accessed directly
if(!defined('IN_GS')){ die('you cannot load this page directly.'); }

/****************************************************************************************************************************************
*	@File:			functions.php
*	@Package:		GetSimple
*	@Action:		RT14GS Theme | Adapted from: Woman's Laptop by FRT <http://www.free-responsive-templates.com/>
*					Released under the Creative Commons Attribution 3.0 license	
******************************************************************************************************************/

/**************************************************************
* rt14gs Theme Settings
* This defines variables based on the theme plugin's settings
* @return bool
**************************************************************/

function rt14gs_settings() {
	$file = GSDATAOTHERPATH . 'rt14gs_theme_settings.xml';
	if (file_exists($file)) {
		$p = getXML($file);
		if ($p->facebook != '' ) define('FACEBOOK', $p->facebook);
		if ($p->googleplus != '' ) define('GOOGLEPLUS', $p->googleplus);
		return true;
	} else {
		return false;
	}
}

