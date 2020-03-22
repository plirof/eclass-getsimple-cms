<?php
/*
//////////////////////////////////////////////////////////
Developer for:  GETSIMPLE CMS
Plugin Name: Guestbook
Description: records and displays comments of visitors.'
Version: 4.5.6
Author: cumbe (Miguel Embuena Lance)
//////////////////////////////////////////////////////////
*/

// Relative
$relative = '../';
$path = $relative. 'data/other/';

# get correct id for plugin
$thisfile=basename(__FILE__, ".php");


# register plugin
register_plugin(
	$thisfile,
	'Cumbe_guestbook',
	'4.5.6',
	'Cumbe',
	'http://www.cumbe.es/guestbook/',
	'Description: records and displays comments of visitors.',
	'plugins', //page type
	'gbook'
);

//set internationalization

if (basename($_SERVER['PHP_SELF']) != 'index.php') { // back end only
  i18n_merge('guestbook', $LANG);
  i18n_merge('guestbook', 'en_US');
}

//add a sidebar of plugins
add_action('plugins-sidebar','createSideMenu',array('guestbook',i18n_r('guestbook/GBOOK')));

//check $_SESSION
add_action('index-pretemplate', 'gbsession');

//add css to head
add_action('theme-header','inc_css');

//filter $content
add_filter('content','guestbook_content');

function gbsession(){
   if( !isset($_SESSION)){
         session_start();
   }
}

function inc_css(){
   global $SITEURL;
   echo '<link href="'.$SITEURL.'plugins/guestbook/css/guestbook.css" rel="stylesheet">';
}

///////////////////////////////////////////////
//////   BACK END - ADMIN - PLUGINS  //////////
///////////////////////////////////////////////

function gbook(){
	global $i18n, $LANG;

	$log_name = 'guestbook.log';
	$log_path = GSDATAOTHERPATH.'logs/';
	$log_file = $log_path . $log_name;

	//create dir backup
	if (!is_dir($log_path.'guestbook_bak')){
		mkdir( $log_path.'guestbook_bak');
	}

	//i18n
	i18n_merge('guestbook', $LANG) || i18n_merge('guestbook','en_US');

	echo '<h3 class="floated">'.strtoupper(i18n_r('guestbook/GBOOK')).'</h3>';
	echo '<div class="edit-nav" >';
		echo '<a href="load.php?id=guestbook" title="'.i18n_r('guestbook/GBOOK').'">'.i18n_r('guestbook/GBOOK').'</a>';        
		echo '<a href="load.php?id=guestbook&action=backup" accesskey="b" title="'.i18n_r('guestbook/backup').'">'.i18n_r('guestbook/backup').'</a>';
		if (is_file($log_file)){
			echo '<a href="load.php?id=guestbook&action=delete" accesskey="c" title="'.$i18n['CLEAR_ALL_DATA'].' '.$log_name.'" onClick="return confirmar(this,&quot;n&quot;,&quot;'.$i18n['CLEAR_ALL_DATA'].' '.$log_file.'. '.i18n_r('guestbook/delsure').'&quot;,&quot;log&quot;)" />'.$i18n['CLEAR_THIS_LOG'].'</a>';
		}
	echo '</div>';
	echo '<div class="clear"></div>';

	if(file_exists($log_file)) {
?>
		<script type="text/javascript">
		<!--
		function confirmar(formObj,count,msge,bck) {
			if(!confirm(msge)) { 
				return false; 
			} else {
				if (bck == 'log'){
					if (count =='n'){
						window.location="load.php?id=guestbook&action=delete";
					} else {   
						window.location="load.php?id=guestbook&n_del=" + count + "";
					}
				} 
				if (bck == 'back'){
					window.location="load.php?id=guestbook&action=backup&delbak=" + count + "";
				} 
				return false;
			}    
		}

		-->
		</script> 
<?php

		//backups     
		if (@$_GET['action'] == 'backup') {
			include 'guestbook/backup.php';
		}
	
		if (@$_GET['action'] == 'delete' && strlen($log_name)>0) {
			//first-> backup: guestbook.log+date+time+.bak
			copy ($log_file, $log_path.'guestbook_bak/'.$log_name.'_'.date('dmy_His').'.bak'); 
			unlink($log_file);
			exec_action('logfile_delete');
?>	
			<label>Log <?php echo $log_name;?> <?php echo $i18n['MSG_HAS_BEEN_CLR']; ?>
			</div>
			</div>
			<div id="sidebar" >
				<?php include('template/sidebar-plugins.php'); ?>
			</div>
			<div class="clear"></div>
			</div>
			<?php get_template('footer'); ?>
<?php
			exit;
		}

		//Remove a register:entry
		if (@$_GET['n_del'] != ''){
			//first-> backup: guestbook_bak/guestbook.log+date+time+.bak
			copy ($log_file, $log_path.'guestbook_bak/'.$log_name.'_'.date('dmy_His').'.bak'); 
			$domDocument = new DomDocument();
			$domDocument->preserveWhiteSpace = FALSE; 
			$domDocument->load($log_file);
			$domNodeList = $domDocument->documentElement;
			$domNodeList = $domDocument->getElementsByTagname('entry');
			$ndel = @$_GET['n_del'];
			$ndL = $domNodeList ->item($ndel)->parentNode;
			$ndL -> removeChild($domNodeList ->item($ndel));
	
			//grabo de nuevo el documento modificado.
			$domDocument->save($log_file);
		}     
	
		//load data of xml
		$log_data = getXML($log_file);
		//end remove register

		if (@$_GET['action'] =='') {
			echo '<h2>'.$i18n['VIEWING'].'&nbsp;'.$i18n['LOG_FILE'].':&lsquo;<em>'.@$log_name.'</em>&rsquo;</h2>';
			echo '<ol class="more" >';
			$count = 0;
			foreach ($log_data as $log) {
				echo '<li><p style="font-size:11px;line-height:15px;" ><b style="line-height:20px;" >'.$i18n['LOG_FILE_ENTRY'].':'.$count.'</b><a style="padding-left: 50px;" title="'.i18n_r('guestbook/ndel').'" href="load.php?id=guestbook" onClick="return confirmar(this,&quot;'.$count.'&quot;,&quot;'.i18n_r('guestbook/ndelc').$count.'. '.i18n_r('guestbook/delsure').'&quot;,&quot;log&quot;)"><b>X</b></a><br />';

				$atrib = $log->attributes();
				echo 'Atributo Id:'.$atrib['id'].'<br />';	
				foreach($log->children() as $child) {
					$name = $child->getName();
					if ($name == 'Nb' or $name == 'Cm' or $name == 'Sub' or $name == 'Ct' or $name == 'Em' ){
						echo '<b>'. i18n_r('guestbook/'.$name) .'</b>:';
					} else {
						echo '<b>'. stripslashes(ucwords($name)) .'</b>:';
					}
					$d = $log->$name;
					$n = strtolower($child->getName());
					$ip_regex = '/^(?:25[0-5]|2[0-4]d|1dd|[1-9]d|d)(?:[.](?:25[0-5]|2[0-4]d|1dd|[1-9]d|d)){3}$/';
					$url_regex = @"((https?|ftp|gopher|telnet|file|notes|ms-help):((//)|())+[wd:#@%/;$()~_?+-=.&]*)";

					//check if its an url address
					/*if (do_reg($d, $url_regex)) {
						$d = '<a href="'. $d .'" target="_blank" >'.$d.'</a>';
					}*/

					//check if its an ip address
					if (substr($name, 0 , 2) == 'ip') {
						if ($d == $_SERVER['REMOTE_ADDR']) {
							$d = $i18n['THIS_COMPUTER'].' (<a href="http://www.geobytes.com/IpLocator.htm?GetLocation&IpAddress='. $d.'" target="_blank" >'.$d.'</a>)';
						} else {
							$d = '(<a href="http://www.geobytes.com/IpLocator.htm?GetLocation&IpAddress='. $d.'" target="_blank" >'.$d.'</a>)';
						}
					} else
					//check if its an email address
					if (check_email_address($d)) {
						$d = '<a href="mailto:'.$d.'">'.$d.'</a>';
					} else
					//check if its a date
					if ($n === 'date') {
						$d = substr($d,0,strpos($d,'+')-1);
						$d = lngDate($d);
					} else {
						$d = filtrog(stripslashes(html_entity_decode($d, ENT_QUOTES, 'UTF-8')));
					}
					$d = str_replace(htmlentities('<br />', ENT_QUOTES, "UTF-8"), '<br />', $d);
					echo $d;
					echo ' <br />';
				} //end foreach log children
				echo "</p></li>";
				$count++;
			}
			echo '</ol>';

		} //end if action=''
	} //end if file exists
	else
	{   //If file does not exist
		echo '<label>'.$i18n['MISSING_FILE'].':&lsquo;<em><?php echo @$log_name; ?></em>&rsquo;</label>';
	}
}


///////////////////////////////////////////////
//////        FRONT END system        /////////
///////////////////////////////////////////////

function guestbook_content($content){
  ////////////////////////////////////////////////////////////////////  
  //         filter content of page searching $guestbook 
  ////////////////////////////////////////////////////////////////////  

  if ( preg_match("/\(%\s*(guestbook)(\s+(?:%[^%\)]|[^%])+)?\s*%\)/", $content, $coinc)){
       $array_coinc = explode(',', $coinc[2]);
       $content_guestbook = sv_book (trim($array_coinc[0]), trim($array_coinc[1]), trim($array_coinc[2]), trim($array_coinc[3]), trim($array_coinc[4]), false);
       $content = str_replace($coinc[0], $content_guestbook, $content);
  } 

  return $content;
}

  ///////////////////////////////////////
  //         MAIN FUNCTION
  ///////////////////////////////////////
function sv_book($usu, $cada, $eleg, $capt, $vemot, $echoguest=true){
    global $EMAIL;
    global $SITEURL;
    global $i18n;
    global $LANG;
    global $PRETTYURLS;
    global $paginator;
    global $entries; 
	global $language; 

	//Include GSCONFIG
	if (file_exists('gsconfig.php')) {
		include_once('gsconfig.php');
	}
	// Debugging
	if (defined('GSDEBUG')){
		error_reporting(E_ALL | E_STRICT);
		ini_set('display_errors', 1);
	} else {
		error_reporting(0);
		@ini_set('display_errors', 0);
	}

	//Data of user
    if (file_exists(GSDATAPATH.'users/'.$usu.'.xml')) {
        $data = getXML(GSDATAPATH.'users/'.$usu.'.xml');
		$EMAIL = $data->EMAIL;
        $LANG = $data->LANG;
    }

    //i18n compatible - i18n language
    if (isset($_GET['setlang'])){
        $LANG = $_GET['setlang']. '_'.strtoupper($_GET['setlang']);
    }
	if (isset($language)){
		$LANG = $language. '_'.strtoupper($language);
	}
	i18n_merge('guestbook', $LANG) || i18n_merge('guestbook','en_US');  
	
	//Variables	
    $err = '';
    $log_name = 'guestbook.log';
    $log_path = GSDATAOTHERPATH.'logs/';
    $log_file = $log_path . $log_name;
	//Read data of guestbook.log
    if(file_exists($log_file)) {
	    $log_data = getXML($log_file);
    }

//----------------------------------------------------------
//
//           include javascripts
    include ("guestbook/inc/guestbook.js");
//
//----------------------------------------------------------

    //check url by prettyurls
	global $idpret;
    $fich = return_page_slug();
	$idpret = find_url($fich,'');
	if ($PRETTYURLS =='') {
		if ($fich == 'index'){
			$idpret = $idpret.'?';
		}
	} else {
			$idpret = $idpret.'?';		
	}

	////////////////////////////////////////////////////////////////////////////////// 
	//	check if submit form
	//	$mi_array =  data passed in form if exists error in captcha or empty fields
	//	$mi_arrayp = if !error in captcha writes correspondient form with data =""
	//////////////////////////////////////////////////////////////////////////////////

	global $mi_array;
	$mi_array = array();
	$idf = 0;
	if (isset($_POST['guest-submit'])) {
		include ("guestbook/check.php");
	}

	global $mi_arrayp;
	$mi_arrayp= array(
		"nombre" =>  '',
		"tema" =>  '',
		"email" =>  '',
		"city" =>  '',
		"comentario" =>  '',
	);

	//array emoticons and variables entry
	$array_emot = emot('array','id');
	$myfile='';
	$count = 1;
	$at = 0;
	$mi='';
	$id=1;
	$pagi=1;
	$dnlLen=0;
	$paginator = '';  
	$entries = '';  

	if(file_exists($log_file)){
		$domDocument = new DomDocument();
		$domDocument->load($log_file);

		//DOMXPath for filter answ=n
		$xpath = new DOMXPath($domDocument);
		$verN = $xpath->query("entry[answ='n']");			
		$num = 	$verN->length;
		//search $id, es el parámetro que nos define el nº de comentario nuevo(answ='n') que se graba en el log.	
		if ($num >0) {
			$verNodeU = $xpath->query("entry/Id[../answ='n']");
			$dnlLen=$verNodeU->length;
			$id= ($verNodeU->item($num - 1)->nodeValue) + 1;
			$verNodeU = $xpath->query("entry");
			$dnlLen= $verNodeU->length;
		}
	
		//pagination
		include ("guestbook/guestpagination.php");

		//order
		if ($eleg != 'I' && $eleg != 'D'){$eleg = 'I'; }
		if ($eleg == 'I'){
			$num = 0;
		} elseif ($eleg =='D') {
			$num= $dnlLen;
		}			
		$entries ='';     
		for ($q= 0; $q< $dnlLen+1; $q++){
			$verNodeU =$xpath->query("entry[answ='n' and position()=".$num."]");
			foreach($verNodeU as $node) {
				if ($count <= ($cada * $pagi) && $count > ($cada * ($pagi-1))) {

					$entries .= '<!-- guestbook entries  --><div class="gbentries">'."\n";
					$dNdList = $node->getElementsByTagName( "*" );
					$at = $node->getAttribute('id');
					foreach($dNdList as $node) {
						$name= $node->nodeName;
						$d =$node->nodeValue;
						$d = filtrog(stripslashes(html_entity_decode($d, ENT_QUOTES, 'UTF-8')));
						$n = strtolower($name);

						//check if its an email address
						if (check_email_address($d)) {
							$d = '<a href="mailto:'.$d.'">'. $d.'</a>';
						}

						//check first line
						if ($n == 'nb') {
							$lin = '<div class="gblist"><div class="entry"><span class="number">'.$count.htmlentities('', ENT_QUOTES, "UTF-8").''.i18n_r('guestbook/bkt').'</span> <span class="name"> '.$d;
						}
						else if ($n == 'date'){
							$d = substr($d,0,strpos($d,'+')-1);
							$d = lngDate($d);
							$lin .= '</span> <span class="data">'.htmlentities(i18n_r('guestbook/Ps'), ENT_QUOTES, "UTF-8").' '.stripslashes($d).'</span></div>';
							$entries .= $lin."\n";
						}
						else if ($n == 'cm') {
							$d = BBcodeG($d);
							$d = str_replace(htmlentities('<br />', ENT_QUOTES, "UTF-8"), '<br />', $d);
							$entries .= '<div class="gbleft">'. i18n_r('guestbook/'.$name) .':</div>'."\n";
							foreach ($array_emot as $key => $val) {$d=str_replace($array_emot[$key], '<img src="'.$SITEURL.'plugins/guestbook/images/img_emot/'.substr($array_emot[$key],1, strlen($array_emot[$key])-2).'.gif" alt="'.$array_emot[$key].'" />', $d);}
							$entries .= '<div class="gbright">'.stripslashes($d).'</div>'."\n";
						}

						else if ($n == 'captcha'){}
						//If you want that shows email comment the next line.
						else if ($n === 'em'){}
						else if ($n == 'ip_address'){}
						else if ($n == 'answ'){}
						else if ($n == 'id' || $n == 'subid'){}
						else {
							if (trim($d) != '' && $d != i18n_r('guestbook/guest_FORM_SUB')){
								$entries .= '<div class="gbleft">'. i18n_r('guestbook/'.$name) .':</div>';
								$entries .= '<div class="gbright">'.stripslashes($d).'</div>'."\n";
							}

						}

					} //end second foreach
					$entries .= '</div> '."\n";

//////////////////          //insert replies
					$verNodeU_r = $xpath->query("entry[Id=$at and answ='y']");
					$dnlLen_r=$verNodeU_r->length;
					$countr=1;
					foreach($verNodeU_r as $node) {
						$entries .='<div class="response">'."\n";
						$dNdList = $node->getElementsByTagName( "*" );
						$at = $node->getAttribute('id');
						foreach($dNdList as $node) {
							$name= $node->nodeName;
							$n = strtolower($name);
							$d =$node->nodeValue;

							//check if its an email address
							if (check_email_address($d)) {
								$d = '<a href="mailto:'.$d.'">'. $d.'</a>';
							}

							$d = filtrog(stripslashes(html_entity_decode($d, ENT_QUOTES, 'UTF-8')));
							//check first line
							if ($n == 'nb') {
								$lin = '<div class="gblist"><div class="entry"><span class="number">'.i18n_r('guestbook/Rep').': '.i18n_r('guestbook/bkti').'</span> <span class="name"> '.$d."\n";
							}
							else if ($n == 'date'){
								$d = substr($d,0,strpos($d,'+')-1);
								$d = lngDate($d);
								$lin .= '</span> <span class="data">'.htmlentities(i18n_r('guestbook/Ps'), ENT_QUOTES, "UTF-8").' '.stripslashes($d).'</span></div>';
								$entries .= $lin."\n";
							}
							else if ($n == 'cm') {
								$d = BBcodeG($d);
								$d = str_replace(htmlentities('<br />', ENT_QUOTES, "UTF-8"), '<br />', $d);
								$entries .= '<div class="gbleft">'. i18n_r('guestbook/'.$name) .':</div>';
								foreach ($array_emot as $key => $val) { 
									$d=str_replace($array_emot[$key], '<img src="'.$SITEURL.'plugins/guestbook/images/img_emot/'.substr($array_emot[$key],1, strlen($array_emot[$key])-2).'.gif" alt="'.$array_emot[$key].'" />', stripslashes($d));
								}	
								$entries .= '<div class="gbright">'.$d.'</div>'."\n";
								$entries .= '</div> '."\n";
							}

							else if ($n == 'captcha'){}
							//If you want that shows email comment the next line.
							else if ($n == 'em'){}
							else if ($n == 'ip_address'){}
							else if ($n == 'answ'){}	
							else if ($n == 'id' || $n == 'subid'){}
							else {
								if (trim($d) != '' && $d != i18n_r('guestbook/guest_FORM_SUB')){	
									$entries .= '<div class="gbleft">'. i18n_r('guestbook/'.$name) .':</div>'."\n"; 
									$entries .= '<div class="gbright">'.($d).'</div>'."\n";
								}
							}	

						} //end second foreach of replies
						$entries .= '</div>';  //end table replies
						$countr++;
					} //end first foreach of replies
//////////////////
					$entries .= '<div class="none">';
					if ($echoguest === true) {
						myform('none', 'y', $log_file, $EMAIL, $count, $at, $capt, $vemot, $echoguest);
					} else {
						$entries .= myform('none', 'y', $log_file, $EMAIL, $count, $at, $capt, $vemot, $echoguest);
					}

					$entries .= '</div>'."\n"; 
					$entries .= '<p class="responselink"><a href="javascript:Insertcom(&quot;form'.$count.'&quot;)"> '.i18n_r('guestbook/mf').' </a></p>'."\n";
					$entries .= '</div> <!-- end guestbookentries -->'."\n";  //end table main comment
				}			
				$count++;
			
			} //end first foreach of main comment

			//plus or minor if is order in advance or decrease
			if ($eleg == 'I'){
				$num++;
			} else {
				$num--;
			}
		}  //end for ($q= 0; $q< $dnlLen; $q++)

	}//end if exist log

	//show form to end
	if ($echoguest === true) {
		echo '<div id="gb">';
			echo $paginator.$entries."\n";
			myform('block','n', $log_file,$EMAIL, $id, $id, $capt, $vemot, $echoguest);
		echo '</div>'; 
	} else {
		$contentf = myform('block','n', $log_file,$EMAIL, $id, $id, $capt, $vemot, $echoguest);
		return '<div id="gb">'.$paginator.$entries.$contentf.'</div>'."\n";
	}

} //end main function sv_book

///////////////////////////////////////////////////////////////////////////////////////////
//            Form of guestbook
///////////////////////////////////////////////////////////////////////////////////////////
function myform($dpl, $nn, $myfile, $email, $count, $at, $capt, $vemot, $echoguest) {
		global $SITEURL;
		global $LANG;
		global $mi_arrayp;
		global $mi_array;
		global $idpret;

		//control last captcha 
		$imfin = $count;
		if ($dpl =='block'){
			$imfin='f';
		}

		$legend = i18n_r('guestbook/GBOOK');
		if ($nn == 'y') {
			$legend = i18n_r('guestbook/GBOOK').'&nbsp;'.i18n_r('guestbook/Rep');
		}

		//if error in captcha, or..., show entries write in form
		$mi_arrayq = $mi_arrayp;
		if (array_key_exists('q_count', $mi_array)){
			if ($mi_array['q_count'] == $count){
				$mi_arrayq = $mi_array;
				$dpl ='block';
			}
			if ($mi_array['email'] ==''){
				$mi_arrayq['email'] = i18n_r('guestbook/em_text');
			}
		}

		if (!isset($_GET['pag'])) {
			$pagi= '';
		} else {
			$pagi= "&amp;pag=".@$_GET['pag'];
		}

		//control uri, very long due to miarray
		$request_uri = getenv ("REQUEST_URI");       // Requested URI
   
		$mGSPLUGINPATH = str_replace("\\", "/", GSPLUGINPATH);
		$mGSPLUGINPATH = substr($mGSPLUGINPATH, 0, -1);
    
		//charge emoticonos
		$s_emot = emot("img","form".$count);

		$myform = '<form style="display:'.$dpl.';" name="formulario" id="form'.$count.'" action="'.$idpret.$pagi.'" method="post">'."\n";
			$myform .= '<div class="gbform">'."\n";
			$myform .= '<fieldset><legend>&nbsp;'.$legend.'&nbsp;</legend>'."\n";
				$myform .= '<label><b>'.i18n_r('guestbook/*').'</b> '.i18n_r('guestbook/Nb').'</label>'."\n";
				$myform .= '<input type="text" name="guest[nombre]" value="'.$mi_arrayq["nombre"].'" /><br />'."\n";
				$myform .= '<label>'.i18n_r('guestbook/Sub').'</label>'."\n";
				$myform .= '<input type="text" name="guest[tema]" value="'.$mi_arrayq["tema"].'" /><br />'."\n";
				$myform .= '<label>'.i18n_r('guestbook/Em').'</label>'."\n";
				$myform .= '<input type="text" name="guest[email]" value="'.$mi_arrayq["email"].'" /><br />'."\n";
				$myform .= '<label>'.i18n_r('guestbook/Ct').'</label>'."\n";
				$myform .= '<input type="text" class="text" name="guest[city]" value="'.$mi_arrayq["city"].'" /><br />'."\n";
				$myform .= '<label><b>'.i18n_r('guestbook/*').'</b> '.i18n_r('guestbook/Cm').'</label>'."\n";
				$myform .= '<div class ="bbcode">'."\n";
					//insert bbcode
					include ('guestbook/inc/bbcode.php');
				$myform .= '</div>'."\n";                
				$myform .= '<textarea id="textarea'.$count.'" name="comentario">'.$mi_arrayq["comentario"].'</textarea><br />'."\n";
				if ($vemot =='Y'){	                
					$myform .= '<div class="smail">'.$s_emot.'</div>'."\n";
				}                 
				if ($capt =='Y'){
					$myform .= '<div><img alt="captcha'.$count.'" class="captchaimg" id="captcha'.$count.'" src="'.$SITEURL.'plugins/guestbook/img_cpt.php?url='.GSPLUGINPATH.'guestbook/" />'."\n";
					$myform .= '<input class="btn" type="button" value="'.i18n_r('guestbook/reload').'" onClick="javascript:rec_cpt(&quot;captcha'.$count.'&quot;,&quot;'.$SITEURL.'plugins/guestbook/img_cpt.php?url='.$mGSPLUGINPATH.'&quot;)" />'."\n";
					$myform .= '</div>'."\n";
					$myform .= '<div>'."\n";
						$myform .= '<input type="text" class="captchainput" value="" name="guest[pot]" />'."\n";
						$myform .= '<div class="labelbbcode">'."\n";
							$myform .= '<span class="three smallfont reload">'.i18n_r('guestbook/rl').'</span>'."\n";
							$myform .= '<br >'."\n";
							$myform .= '<span class="three smallfont"><b>'.i18n_r('guestbook/*').'</b> '.i18n_r('guestbook/Cpt').'</span>'."\n";
						$myform .= '</div>'."\n";
						$myform .= '<div class="clear"> </div>'."\n";
					$myform .= '</div>'."\n";
				}
				$myform .= '<div><input class="btn" type="submit" value="'.i18n_r('guestbook/Ev').'" name="guest-submit" /><span class="rf"><b>'.i18n_r('guestbook/*').'</b> '.i18n_r('guestbook/Rf').'</span></div>'."\n";
					$myform .= '<input type="hidden" name="guest[q_file]" value="'.$myfile.'" />'."\n";
					$myform .= '<input type="hidden" name="guest[q_uri]" value="'.$request_uri.'" />'."\n";
					$myform .= '<input type="hidden" name="guest[q_count]" value="'.$count.'" />'."\n";
					$myform .= '<input type="hidden" name="guest[q_tp]" value="guest" />'."\n"; 
					$myform .= '<input type="hidden" name="guest[q_ans]" value="'.$nn.'" />'."\n"; 
					$myform .= '<input type="hidden" name="guest[q_idf]" value="'.$at.'" />'."\n"; 
					$_SESSION["pc_Token".$count]  = sha1(microtime() + 'cumbe20122013');
					$myform .= '<input type="hidden" name="guest[q_token'.$count.']" value="'.$_SESSION["pc_Token".$count].'">'."\n";
			$myform .= '</fieldset></div></form>'."\n";
 
		if ($echoguest === true){
			echo $myform;
		} else {
			return $myform;
		}} //enf function myform


function emot($opcion, $id){
	global $SITEURL;
	$ruta = GSPLUGINPATH.'guestbook/images/img_emot/';
	$array_emot= array();
	$s_emot = '';
	if (is_dir($ruta)) {
		if ($dh = opendir($ruta)){
			while (($file = readdir($dh)) !== false){
				if($file!="." AND $file!=".." AND $file!=".htaccess" AND is_dir($ruta . $file)== false AND strtolower(substr($file,-4))=='.gif'){
					$array_emot[substr($file, 0, strlen($file)-4)] = '['.substr($file, 0, strlen($file)-4).']';
					$s_emot = $s_emot.' <a href="javascript:Smile(&quot;'.$id.'&quot;,&quot;['.substr($file, 0, strlen($file)-4).']&quot;)"><img src="'.$SITEURL.'plugins/guestbook/images/img_emot/'.substr($file, 0, strlen($file)-4).'.gif" alt="" /></a>';
				}
			}
			closedir($dh);
		}
	}         
	if ($opcion == 'array'){
		return $array_emot;
	}
	elseif ($opcion == 'img') {
		return $s_emot;  
	}
}

function filtrog ($texto) {
    $html = array("<", ">");
    $filtrado = array("&lt;", "&gt;");
    $final = str_replace($html, $filtrado, $texto);

    return $final;
}

function BBcodeG($texton){ 
    $BBcodeN = array(	 
       "/\<(.*?)>/is",
       "/\[i\](.*?)\[\/i\]/is",
       "/\[b\](.*?)\[\/b\]/is",
       "/\[u\](.*?)\[\/u\]/is",
       "/\[img\](.*?)\[\/img\]/is",
       "/\[url=(.*?)\](.*?)\[\/url\]/is",
       "/\[color=(.*?)\](.*?)\[\/color\]/is"
   );

   $html = array(
	 
	"<$1>",
	"<i>$1</i>",
	"<b>$1</b>",
	"<u>$1</u>",
	"<img src=\"$1\" />",
	"<a href=\"$1\" target=\"_blank\">$2</a>",
	"<span style=\"color:$1\">$2</span>"
   );

    $BBcodeNn = array(	 
       "/\[url\](.*?)\[\/url\]/is",
   );

   $htmln = array(
	"<a href=\"$1\" target=\"_blank\">$1</a>",
   );

	$texton = preg_replace($BBcodeN, $html, $texton);
	$texton = preg_replace($BBcodeNn, $htmln, $texton);
	return $texton;
}
?>
