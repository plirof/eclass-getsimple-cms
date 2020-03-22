<?php
/***************************************************
Plugin Name: RT14GS Theme Settings
Description: Settings for GetSimple RT14GS Theme
Version: 1.0
Author: Luigi

Based on the work of : Chris Cagle
Author URI: http://www.cagintranet.com/
***************************************************/

#Get correct ID for plugin
$thisfile_gstheme=basename(__FILE__, ".php");
$gstheme_file=GSDATAOTHERPATH .'rt14gs_theme_settings.xml';

#Add in this plugin's language file
i18n_merge($thisfile_gstheme) || i18n_merge($thisfile_gstheme, 'en_US');

#Register plugin
register_plugin(
	$thisfile_gstheme, 								# ID of plugin, should be filename minus php
	i18n_r($thisfile_gstheme.'/GSTHEME_TITLE'), 	# Title of plugin
	'1.0', 											# Version of plugin
	'Luigi',										# Author of plugin
	'http://get-simple.info/extend/a/Luigi', 		# Author URL
	i18n_r($thisfile_gstheme.'/GSTHEME_DESC'), 		# Plugin Description
	'theme', 										# Page type of plugin
	'gstheme_show'  								# Function that displays content
);

#Hooks
#Enable menu at sidebar if this is the active theme or on theme page and activating it, handle plugin exec before global is set
if( 
	( $TEMPLATE == "rt14gs" || 	( get_filename_id() == 'theme' && isset($_POST['template']) && $_POST['template'] == 'rt14gs') ) &&
	!( $TEMPLATE == "rt14gs" && get_filename_id() == 'theme' && isset($_POST['template']) && $_POST['template'] != 'rt14gs') 
) {
	add_action('theme-sidebar','createSideMenu',array($thisfile_gstheme, i18n_r($thisfile_gstheme.'/GSTHEME_TITLE'))); 
}

#Get XML data
if (file_exists($gstheme_file)) {
	$x = getXML($gstheme_file);
	$facebook = $x->facebook;
	$googleplus = $x->googleplus;
} else {
	$facebook = '';
	$googleplus = '';
}

function gstheme_show() {
	global $gstheme_file, $facebook, $googleplus, $thisfile_gstheme;
	$success=null;$error=null;

	//Submitted form
	if (isset($_POST['submit'])) {
		$facebook=null;	$googleplus=null;

		#Validate URLs provided
		if ($_POST['facebook'] != '') {
			if (validate_url($_POST['facebook'])) {
				$facebook = $_POST['facebook'];
			} else {
				$error .= i18n_r($thisfile_gstheme.'/FACEBOOK_ERROR').' ';
			}
		}

		if ($_POST['googleplus'] != '') {
			if (validate_url($_POST['googleplus'])) {
				$googleplus = $_POST['googleplus'];
			} else {
				$error .= i18n_r($thisfile_gstheme.'/GOOGLEPLUS_ERROR').' ';
			}
		}

		#If no errors are found, save data to XML
		if (!$error) {
			$xml = @new SimpleXMLElement('<item></item>');
			$xml->addChild('facebook', $facebook);
			$xml->addChild('googleplus', $googleplus);

			if (! $xml->asXML($gstheme_file)) {
				$error = i18n_r('CHMOD_ERROR');
			} else {
				$x = getXML($gstheme_file);
				$facebook = $x->facebook;
				$googleplus = $x->googleplus;
				$success = i18n_r('SETTINGS_UPDATED');
			}
		}
	}
?>
		
	<!-- Layout for settings page -->
	<h3><?php i18n($thisfile_gstheme.'/GSTHEME_TITLE'); ?></h3>
	<strong>Social Media</strong><br />
	<p>Add your Facebook and Google+ URL's to activate an icon in the theme header.</p>

	<?php 
	if($success) { 
		echo '<p style="color:#669933;"><b>'. $success .'</b></p>';
	} 

	if($error) { 
		echo '<p style="color:#cc0000;"><b>'. $error .'</b></p>';
	}
	?>

	<form method="post" action="<?php	echo $_SERVER ['REQUEST_URI']?>">
		<p><label for="gst_facebook">Facebook URL</label><input id="gst_facebook" name="facebook" class="text" value="<?php echo $facebook; ?>" type="url"/></p>
		<p><label for="gst_googleplus">Google+ URL</label><input id="gst_googleplus" name="googleplus" class="text" value="<?php echo $googleplus; ?>" type="url"/></p>
		<p><input type="submit" id="submit" class="submit" value="<?php i18n('BTN_SAVESETTINGS'); ?>" name="submit" /></p>
	</form>

	<?php

}
