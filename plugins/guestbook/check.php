<?php

//-----------------------------------------------------------------//
//-----------------------------------------------------------------//
//-----------------------------------------------------------------//

//$numberofchars = 0 , has not limit
//$numberofchars = 150 , has limit 150 characters.
	$numberofchars = 0; 

	$err='';
	if (!isset($_SESSION)){ 
		session_start();
	}
	$temp = $_POST['guest'];
	$temp['comentario'] = $_POST['comentario']; 
	$tp =  $temp['q_tp'];

	if (!isset($_SESSION["imagencadena"]) && $capt =='Y'){
		$mi_array = $temp;
		$tp = 'noenter';
		$msgshw = '*** '.strtoupper(i18n_r('guestbook/MSG_pcERR')).' ***'; 
	} elseif ($capt =='Y') {
		$imagenCadena = $_SESSION["imagencadena"]; 
		$pot = trim(strtolower($imagenCadena));
	}

	//check Token  
	if ($_POST['guest']["q_token".$_POST['guest']['q_count']]  != $_SESSION["pc_Token".$_POST['guest']['q_count']]){
		//if don't come from form
		$tp = 'noenter';
		$msgshw = strtoupper(i18n_r('guestbook/MSG_guestERR'));	}
     
//-----------------------------------------------------
//             START Guestbook
//-----------------------------------------------------
	if ($tp == 'guest') {
		if (isset($_POST['guest-submit'])) {
			$id = $_POST['guest']['q_idf'] ;
			$idf = $id;
			$answ = $_POST['guest']['q_ans'] ;
			$log_file= $_POST['guest']['q_file'];
			$MIURL= $_POST['guest']['q_uri'];
			$MICOUNT= $_POST['guest']['q_count'] - 1;

			//captcha
			$captcha = '';
			if ($capt == 'Y') {
				if ( $pot == trim(strtolower($_POST['guest']['pot']))) {
					$captcha = strtolower($_POST['guest']['pot']);
				} else {
					$err = i18n_r('guestbook/MSG_CAPTCHA_FAILED');
				}
			}

			//email
			$from = '';
			if ( $_POST['guest']['email'] != '' ) {
				if ($_POST['guest']['email'] != i18n_r('guestbook/em_text')){
					$from = $_POST['guest']['email'];
				} else {
					$_POST['guest']['email'] = '';
				}
			}

			//subjet
			if ( $_POST['guest']['tema'] != '') {
				$tema = $_POST['guest']['tema'];
			} else {
				$tema = '';
			}

			//check numbers of characters of comments 
			if ($numberofchars > 0){
				if ($numberofchars < strlen($_POST['comentario'])){
					$err = i18n_r('guestbook/MSG_charERR');             
				} 
			}

    	    //check word blacklist
	



    	    //release variables
			unset($temp['pot']);
			unset($temp['guest-submit']);
			unset($temp['submit']);

			if ($err == '' && trim($_POST['guest']['nombre']) !='' && trim($_POST['comentario']) !='') {
	
				$server_name = getenv ("SERVER_NAME");       // Server Name
				$request_uri = getenv ("REQUEST_URI");       // Requested URI
	
				$headers = "From: ".$from."\r\n";
				$headers .= "Return-Path: ".$from."\r\n";
				$headers .= "Content-type: text/html; charset=UTF-8 \r\n";
    	                   
				$body = '';
				$body .= i18n_r('guestbook/guest_FORM_SUB').' '.i18n_r('guestbook/WHO').': <a href=http://"'.$server_name.$MIURL.'">'.$server_name.$MIURL.'</a> <br />';
				$body .= "-----------------------------------<br /><br />";


				if ( ! file_exists($log_file) ) {
					$xml = new SimpleXMLExtended('<?xml version="1.0" encoding="UTF-8"?><channel></channel>');
					$count = 0;
					$sid = 0;
				} else {
					$xmldata = file_get_contents($log_file);
					$xml = new SimpleXMLExtended($xmldata);
					//search SubId
					$domDocument = new DomDocument();
					$domDocument->load($log_file);
					// (2)DOMXPath to filter with query
					$xpath = new DOMXPath($domDocument);
					//check id when is a new comment(ans == n)
					if ($answ == 'n'){
						//filtramos por valor del nodo entry/Id= $id
						$verNode = $xpath->query("entry/Id[../answ='n']");
						$L_vn= $verNode->length;
						if ($L_vn == 0){
							$id = 0;
						} else {
							$id = ($verNode->item($L_vn -1)->nodeValue) + 1;
						}
					}
					//para saber el valor del SubId y sumarle 1 si es necesario.
					$verNode = $xpath->query("entry/SubId[../Id=$id]");
					$L_vn= $verNode->length;
					if ($L_vn == 0){
						$sid = 0;
					} else {
						$sid = ($verNode->item($L_vn -1)->nodeValue) + 1;
					}
				}

				//record of data
				$thislog = $xml->addChild('entry');
					$thislog->addAttribute('id', $id);
				$cdata = $thislog->addChild('Id');
					$cdata->addCData($id);
				$cdata = $thislog->addChild('SubId');
					$cdata->addCData($sid);
 				$cdata = $thislog->addChild('Nb');
					$cdata->addCData(htmlentities($temp['nombre'], ENT_QUOTES, 'UTF-8'));
				$thislog->addChild('date', date('r'));
				$cdata = $thislog->addChild('Sub');
					$cdata->addCData(htmlentities($tema, ENT_QUOTES, 'UTF-8'));
				$cdata = $thislog->addChild('Em');
					$cdata->addCData(htmlentities($temp['email'], ENT_QUOTES, 'UTF-8'));
				$cdata = $thislog->addChild('Ct');
					$cdata->addCData(htmlentities($temp['city'], ENT_QUOTES, 'UTF-8'));
				$cdata = $thislog->addChild('Cm');
					$comentario= nl2br($temp['comentario']);
					$cdata->addCData(htmlentities($comentario, ENT_QUOTES, 'UTF-8'));
				$cdata = $thislog->addChild('captcha');
					$cdata->addCData($captcha);
				$cdata = $thislog->addChild('ip_address');
					$ip = getenv("REMOTE_ADDR");
					$cdata->addCData(htmlentities($ip));
				$cdata = $thislog->addChild('answ');
					$cdata->addCData($answ);
	
				foreach ( $temp as $key => $value ) {
					if (substr($key, 0, 2) != 'q_') {
						$body .= ucfirst(i18n_r('guestbook/'.$key)) .": ". stripslashes(html_entity_decode($value, ENT_QUOTES, 'UTF-8')) ."<br />";
					}
				}
				
				XMLsave($xml, $log_file);

				//Send email
				$result = mail($EMAIL,i18n_r('guestbook/guest_FORM_SUB'),$body,$headers);
				//$seg = 2;
				$msgshw = '';
				if ($result=='1') {
					$msgshw = i18n_r('guestbook/MSG_guestSUC');
				} else {
                                   //
				}
			}	//end if err=''
			else
			{	//if there is some error in captcha or empty fields.

				//release variables
				foreach ( $temp as $key => $value ) {
					if (substr($key, 0, 2) == 'q_' and $key != 'q_count') {
						unset($temp[$key]);
					}
				}
				$mi_array = array();
				foreach($temp as $key=>$value){
					$mi_array[$key] = stripslashes(html_entity_decode($value));
				}
				
				if (trim($err) !=''){
					$msgshw = '*** '.strtoupper($err).' ***\n';
					if ($err == i18n_r('guestbook/MSG_CAPTCHA_FAILED')){
						$msgshw .= strtoupper(i18n_r('guestbook/Cap')).': '.$pot.'\n'.strtoupper(i18n_r('guestbook/Code')).': '.$_POST['guest']['pot'].'\n';
					}
				} else {
					$msgshw = '*** '.strtoupper(i18n_r('guestbook/Co')).' ***';
				}
			}
		} //finish guest-submit
			}   //FINISH $tp = guest

////////////////////////////////////////////////////////////////
//
//     html page or alert of javascript
//
////////////////////////////////////////////////////////////////
?>
	<script type="text/javascript">
<!--
		alert ("<?php echo $msgshw; ?>");
-->
	</script>
