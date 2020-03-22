<?php
/*
Plugin Name: Plugin Lock
Description: This plugin allows to block access to specified plugins or plugin area parts for admin panel selected users.
Version: 1.0
Author: Michał Gańko
Author URI: http://flexphperia.net
*/

# get correct id for plugin
$thisfile=basename(__FILE__, ".php");

# register plugin
register_plugin(
	$thisfile, 
	'Plugin Lock', 	
	'1.0jonmod005', 		
	'Michał Gańko',
	'http://flexphperia.net', 
	'This plugin allows to block access to specified plugins or plugin area parts for admin panel selected users.',
	'plugins',
	'plugin_lock_admin_tab'  
);

// Add a custom link to edit this teachers page
function edit_teacher_page($tmima) {
	//$tmima=substr($USR,8);
	echo '<li id="sb_'.$tmima.'" class="plugin_sb"><a href="edit.php?id='.$tmima.'" >' .$tmima.' - ΣΕΛΙΔΑ ΜΑΘΗΜΑΤΟΣ </a></li>';
}


if (!is_frontend()) { //only on backend
	i18n_merge($thisfile, substr($LANG,0,2)) || i18n_merge($thisfile,'en');

	add_action('header','plugin_lock_on_header'); 
    add_action('plugins-sidebar', 'createSideMenu', array($thisfile, i18n_r('PluginLock/CONF_SIDEBAR')));

    // ADD sidebar for teachers
    $tmima=substr($USR,8);
    //add_action('pages-sidebar','createSideMenu',array('edit.php?id='.$tmima,$tmima.' - ΣΕΛΙΔΑ ΜΑΘΗΜΑΤΟΣ '));
    add_action('pages-sidebar','edit_teacher_page',array($tmima));
    add_action('pages-sidebar','createSideMenu',array('pages_comments&action=pc_viewcom&pc_url='.$tmima.'.xml',$tmima.' - ΑΠΑΝΤΗΣΕΙΣ - ΕΛΕΓΧΟΣ'));
    //add_action('rightnav','edit_teacher_page',array($tmima));
    //add_action('rightnav','createSideMenu',array('pages_comments&action=pc_viewcom&pc_url='.$tmima.'.xml',$tmima.' - ΑΠΑΝΤΗΣΕΙΣ - ΕΛΕΓΧΟΣ'));


	
	$pluginLock_currFile = strtolower(basename($_SERVER['PHP_SELF'])); //currently loadded file
    
    //apply security
    if (($pluginLock_currFile == 'load.php' || $pluginLock_currFile == 'edit.php' || $pluginLock_currFile == 'menu-manager.php') && $USR != 'admin'){
        plugin_lock_check_rules();
    }
}


function plugin_lock_check_rules(){
	global $USR, $thisfile;
	
	//echo "<BR>33 DEBUG-------- ------USR=$USR -------- _GETid = ".$_REQUEST['id'];

	$settings = plugin_lock_get_settings();
	$id = strtolower($_GET['id']);
	$queries = array_map('strtolower', $settings->queries); //make all values lowercase
	
	/*
	if (!in_array($USR, $settings->usernames)){
		return;
	}
	*/



	//if username contains word teacher
	if (strpos($USR, 'teacher')!== false || $USR == 'teacher-a1') {
			$tmima=substr($USR,8);
			//echo "<BR>71 DEBUG--------TMHMA=$tmima -------------- _GETid = ".$_REQUEST['id'];
			//print_r($_REQUEST);	
			// allow only users TMIMA to load			
			@$request_pc_url=$_REQUEST['pc_url'];
			if($request_pc_url===null) $request_pc_url="aaaa";

			if ((strpos($_REQUEST['id'], $tmima)!== false) 
				|| ((strpos($_REQUEST['id'], 'pages_comments')!== false) && (strpos($_REQUEST['action'], 'pc_viewpages')!== false) )// allow seeing global comments page		 
				|| ((strpos($_REQUEST['id'], 'pages_comments')!== false) && (strpos($request_pc_url, $tmima)!== false) )
				|| (strpos($_REQUEST['id'], 'test-user22page')!== false )
			) {

				//echo "<BR>74 DEBUG------------(=='test-user22page'---------- "; 
			}else {
				//echo i18n_r('PluginLock/ON_DENIED');
				die(i18n_r('PluginLock/ON_DENIED'));
			}
	}

	if ($USR == 'user22'){
			//echo "<BR>56 DEBUG-------- -------------- _GETid = ".$_REQUEST['id'];
			print_r($_REQUEST);	
			if (strpos($_REQUEST['id'], 'test-user22page')!== false) {

				echo "<BR>58 DEBUG------------(=='test-user22page'---------- "; 
			}else {
				echo i18n_r('PluginLock/ON_DENIED');
				//die(i18n_r('PluginLock/ON_DENIED'));
			}
	}


	if ($settings->rule == 'deny'){
		
		for ($i = 0; $i < count($queries); $i++) {
			parse_str($queries[$i], $parsed); //parese string into array from query
			
			foreach ($_GET as $key => $value){
				$key = strtolower($key);
				$value = strtolower($value);
							
				if (isset($parsed[$key]) && $parsed[$key] == $value){ //key exists in rule and it'matches its value 
					unset($parsed[$key]);
				}
			}
			
			if (!count($parsed))
				die(i18n_r('PluginLock/ON_DENIED'));
		}
	
	}	
	
	if ($settings->rule == 'allow'){
		for ($i = 0; $i < count($queries); $i++) {
			echo "74 DEBUG---------------------- ";
			printr($queries);
			parse_str($queries[$i], $parsed); //parese string into array from query
			
			foreach ($_GET as $key => $value){
				$key = strtolower($key);
				$value = strtolower($value);
							
				if (isset($parsed[$key]) && $parsed[$key] == $value){ //key exists in rule and it'matches its value 
					unset($parsed[$key]);
				}
			}

			if (!count($parsed)) //all requirements matched
				return;
		}
	
		die(i18n_r('PluginLock/NOT_ALLOWED'));
	}
}


function plugin_lock_admin_tab() {
	if (isset($_POST['save'])){ //is post	
		$rule = $_POST['rule'] == 'allow' ? 'allow' : 'deny';
	
		$success = plugin_lock_save_settings( $_POST['usernames'], $rule,  $_POST['queries'] );
	}

	$settings = plugin_lock_get_settings();
	
	require_once('PluginLock/views/configuration.html');
}

//removes private button from i18n_navigation Edit Navigation Structure option
function plugin_lock_on_header(){
    global $pluginLock_currFile, $thisfile;
	
	if ($pluginLock_currFile == 'load.php' && @$_GET['id'] == 'PluginLock'){
		?>
            <link rel="stylesheet" href="../plugins/PluginLock/css/configuration.css" />	
			<script>
				<?php require_once('PluginLock/views/configurationJS.php'); ?>
			</script>
		<?php
	}
}

//retrieves settings from xml
function plugin_lock_get_settings() {
    $file = GSDATAOTHERPATH . 'pluginlock.xml';
	
	if (!file_exists($file)) {
		plugin_lock_save_settings(); //create empty one
	}
	
	$data = getXML($file);
	
	$settings = new stdClass();

	$settings->rule = (string)$data->rule;
	$settings->usernames = (string)$data->usernames ? explode(',',(string)$data->usernames) : array();
	$settings->queries = (string)$data->queries ? explode('||',(string)$data->queries) : array();
	
	return $settings;
}

//saves settings to xml
function plugin_lock_save_settings(	$usernames = '', $rule = 'deny', $queries = '') {
    $file = GSDATAOTHERPATH . 'pluginlock.xml';
	
	$xml = new SimpleXMLExtended('<?xml version="1.0" encoding="UTF-8"?><settings></settings>');
	
	$xml->addChild('rule', $rule);
	
	$obj = $xml->addChild('usernames');
	$obj->addCData($usernames);	
	
	$obj = $xml->addChild('queries');
	$obj->addCData($queries);
	
	  # write data to file
	return XMLsave($xml, $file) === true ? true : false;
}