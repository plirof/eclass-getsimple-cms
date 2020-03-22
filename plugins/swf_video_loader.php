<?php
/*
Based on: Youtube Video Loader
Author: Raul Dominguez - Luar
Author URL:rauldominguez.host22.com
Original Plugin description: Add a Youtube Video on the page from the youtube video ID.
*/
/*
Plugin Name: Youtube Video Loader
Description: Replace Youtube embraced URLs with tags to responsive or customized size video embedding 
Version: 0.1
Rewriten by: Glaucius Zacher
*/

# get correct id for plugin
$thisfile=basename(__FILE__, ".php");
$iWidth="600px";
$iHeight="600px";
// register plugin
register_plugin(
	$thisfile,	// ID of plugin, should be filename minus php
	'Flash Loader',	# Title of plugin
	'0.01',	// Version of plugin
	'Glaucius Zacher',	// Author of plugin
	'https://uy.linkedin.com/in/glauciuszacher',	// Original Author URL
	'{%flash= ... %} Replace swf URLs with embeded flash.',	// Plugin Description
	'plugin',	// Page type of plugin
	'youtube_video_load'	// Function that displays content
);

# activate filter
add_filter('content','youtube_video_load');

/**
 * Parses the content on a page and matches it to valid embraced youtube URL.
 *
 * @param string $content - Content of Page
 * @return string;
 */

function youtube_video_load($content){
	global $iWidth,$iHeight;
	//$found = preg_match_all('/\{%(.|&nbsp;)https\:\/\/www\.youtube\.com\/watch\?v=.+(.|&nbsp;)%\}/', $content, $match); //prig
	//$found = preg_match_all('/\{%flash=(.|&nbsp;)https\:\/\/www\.youtube\.com\/watch\?v=.+(.|&nbsp;)%\}/', $content, $match);//test001
	//$found = preg_match_all('/\{%flash=(.|&nbsp;)https\:\/\/www\.youtube\.com\/watch\?v=.+(.|&nbsp;)%\}/', $content, $match);
	$found =preg_match_all('/{%flash=(.*?)%\}/si', $content, $match);
	//HTML array in $matches[1]
	//print_r($match[1]);
	//echo "<h2>found=$found</h2>";
	
	for ($i=0; $i<=$found; $i++){
		$sVideo = '';

		if ($match[1]>1) {
			$video = flash_video_embed($match[1],$iWidth,$iHeight);
			//$pattern_vid = (isset($aVideoParams[2])) ? $aVideoParams[1].'='.$aVideoParams[2].'='.$aVideoParams[3] : $eVid;
			//echo"<javascript>alert($pattern_vid)</javascript>";
			$patt = '/{%flash=(.*?)%\}/si';
			$content = preg_replace($patt, $video, $content);
		}
	}
	
	return $content;
}
/**
 * function flash_video_embed
 * @param strings $id - video id, $w - width(and padding), $h - height(and padding)
 * @return html content for video embed
 */
function flash_video_embed($id,$w,$h){
$id=trim($id[0]);
return "
<div style='position: relative;
  top: 0;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border: 0;'>
<object width=$w height=$h>
<param name='game' value=$id>
	<embed src=$id width=$w height=$h>
</embed>
</object>
</div>
";

}
/*
<object width="300" height="300">
<param name="movie" value="flashmovie.swf">
<embed src="flashmovie.swf" width="300" height="300">
</embed>
</object>
*/

function rem_brace(&$var){
	$neddle = array(' %}','&nbsp;%}');
  $var = str_replace($neddle, '', $var);
}
?>