<?php
/*
Plugin Name: Include file
Description: Include a file in the content
Version: 1.0
Author: Claudio Azzolari
Author URI: http://www.testudoweb.it
Jon Comment :
{gsinclude nameofyourfile.ext}

*/

# get correct id for plugin
$thisfile_includefile=basename(__FILE__, ".php");
$includefile_file = GSDATAOTHERPATH .'IncludefileSettings.xml';

# register plugin
register_plugin(
	$thisfile_includefile, //Plugin id
	'Include file', 	//Plugin name
	'1.0', 		//Plugin version
	'Claudio Azzolari',  //Plugin author
	'http://www.testudoweb.it/', //author website
	'Include a file in the content using the syntax {gsinclude nameofthefile.ext}', //Plugin description
	'plugin', //page type - on which admin tab to display
	'admin_form'  //main function (administration)
);

# activate hooks
add_action('plugins-sidebar','createSideMenu',array($thisfile_includefile,'Include file')); 

# activate filter 
add_filter('content','parseContent'); 

# functions
function hello_world() {
	echo '<p>Hello World</p>';
}

# get XML data
if (file_exists($includefile_file)) {
	$includefile_data = getXML($includefile_file);
}

function admin_form() {
	global $thisfile_includefile, $includefile_file, $includefile_data;
	$success=$error=null;
	if (isset($_POST['submit'])) {		
		if($_POST['includefile_path'] != '') $resp['includefile_path'] = $_POST['includefile_path'];
		else $error .= 'Please create a folder and put here the path to that';
		
		# if there are no errors, save data
		if (!$error) {
			$xml = @new SimpleXMLElement('<item></item>');
			$xml->addChild('includefile_path', $resp['includefile_path']);
							
			if (! $xml->asXML($includefile_file)) {
				$error = i18n_r('CHMOD_ERROR');
			} else {
				$includefile_data = getXML($includefile_file);
				$success = i18n_r('SETTINGS_UPDATED');
			}
		}
	}

	echo '<h3>Include file in content</h3>';
	if($success) { 
		echo '<p style="color:#669933;"><b>'. $success .'</b></p>';
	} 
	if($error) { 
		echo '<p style="color:#cc0000;"><b>'. $error .'</b></p>';
	}
	$value = '';
	if(isset($includefile_data->includefile_path)) $value = $includefile_data->includefile_path;

	echo '<p>Include a file in the content using the syntax {gsinclude nameofthefile.ext}</p>';

	echo '	<form method="post" id="includefile_data" action="'.$_SERVER ['REQUEST_URI'].'">
			<table>
				<tr>
					<td>
						<label for="includefile_path">Path to files folder</label>
					</td>
					<td>
						'.GSROOTPATH.'<input class="text" type="text" name="includefile_path" id="includefile_path" value="'.$value.'" style="width: 150px" />
					</td>
				</tr>
				<tr>
					<td></td>
					<td><input class="submit" type="submit" value="save" name="submit" /></td>
				</tr>
			</table>
			</form>';
}

function parseContent($content){
	global $thisfile_includefile, $includefile_file, $includefile_data;

	$include_dir = GSROOTPATH;
	if(isset($includefile_data->includefile_path)) $include_dir .= rtrim($includefile_data->includefile_path,'/').'/';

	$regex = '/{gsinclude\s+(.*?)}/i';

	$matches 	= array();
	preg_match_all( $regex, $content, $matches, PREG_SET_ORDER );

 	$i = 0;
 	if ($matches) {
		foreach ($matches as $match)
		{
			$file = trim($match[1]);
			$out = '';
			if(file_exists($include_dir.$file)){
				ob_start();
				include($include_dir.$file);
				$out = ob_get_contents();
				ob_end_clean();
			}
			$content = str_replace('{gsinclude '.$file.'}',$out, $content);
		}
	}
	return $content;
}
?>