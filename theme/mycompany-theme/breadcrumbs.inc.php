<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File: 			footer.inc.php
* @Package:		GetSimple
* @Action:		myCompany theme for GetSimple CMS
*
*****************************************************/
?>
<!-- breadcrumbs --> 		     
  <div id="breadcrumbs-container">    
      <div class="breadcrumbs wrapper clearfix" >				   
        <a href="<?php get_site_url(); ?>">Home</a> 
        <img src="<?php get_theme_url(); ?>/img/arrow.png" alt=" - "> 
        <?php Innovation_Parent_Link(get_parent(FALSE)); ?> <b>
          <?php get_page_clean_title(); ?></b>		     
      </div>
  </div>    
<!-- breadcrums end -->