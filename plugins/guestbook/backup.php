<?php
  global $SITEURL;
  $ruta = GSDATAOTHERPATH.'logs/guestbook_bak/';

  if (@$_GET['createbak'] == 'y') {   
     //first-> backup: guestbook_bak/guestbook.log+date+time+.bak
     copy ($log_file, $ruta.$log_name.'_'.date('dmy_His').'.bak');    
     echo '<h2>'.i18n_r('guestbook/backup_cd').'.</h2>';
  }


  if (@$_GET['delbak'] != '') {   
     unlink($ruta.@$_GET['delbak']);
     echo '<h2>"'.@$_GET['delbak'].'": '.i18n_r('guestbook/deltd_log').'</h2>';
  }
  
  if (@$_GET['recbak'] != '') {   
     //first-> backup: guestbook_bak/guestbook.log+date+time+.bak
     copy ($log_file, $ruta.$log_name.'_'.date('dmy_His').'.bak'); 
     copy ($ruta.@$_GET['recbak'], $log_file);    
     echo '<h2>"'.@$_GET['recbak'].'": '.i18n_r('guestbook/recpd_log').'.</h2>';
  }


  if (is_dir($ruta)) {
      if ($dh = opendir($ruta)){
         echo '<h2>'.i18n_r('guestbook/backup').'</h2><span style="float: right; margin-top: -35px;"><a style="background-color: rgb(65, 90, 102); border-radius: 5px 5px 5px 5px; color: #EEE; padding: 3px 5px; text-decoration: none;" href="load.php?id=guestbook&action=backup&createbak=y">'.i18n_r('guestbook/backup_c').'</a></span> ';
         echo '<ol class="more" >';
         while (($file = readdir($dh)) !== false){
         	if($file!="." AND $file!=".." AND $file!=".htaccess" AND is_dir($ruta . $file)== false AND strtolower(substr($file,-4))=='.bak'){
   	             echo '<li>';      
                     echo $file;
                     echo '<span style="margin-left: 20px;"><a title="'.i18n_r('guestbook/rec_log').'" href="load.php?id=guestbook&action=backup&recbak='.$file.'">'.i18n_r('guestbook/rec_log').'</a></span>';
                     echo '<span style="margin-left: 20px;"><a title="'.i18n_r('guestbook/ndelf').'" href="load.php?id=guestbook&action=backup" onClick="return confirmar(this,&quot;'.$file.'&quot;,&quot;'.i18n_r('guestbook/ndelfc').$file.'. '.i18n_r('guestbook/delsure').'&quot;,&quot;back&quot;)"><b>X</b></a></span>'; 
                     echo '</li>';
                }
         }
         closedir($dh);
      }
  } 


?>
