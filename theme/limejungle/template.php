<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File: 			template.php
* @Package:		GetSimple
* @Action:		LimeJungle theme for the GetSimple 3.0
*
*****************************************************/
?>


<!DOCTYPE html>
<html>
<head>
<title><?php get_site_name(); ?> | <?php get_page_title(); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <?php get_header(); ?>


<link href="<?php get_theme_url(); ?>/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php get_theme_url(); ?>/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="<?php get_theme_url(); ?>/js/radius.js"></script> <!--Seems to be used for displaying the radius by the original author-->
</head>
<body>
<!-- START PAGE SOURCE -->
<div class="main">
  <div class="header">
    <div class="header_resize">
      <div class="logo">
        <h1><a href="<?php get_site_url(); ?>"><?php get_site_name(); ?> <small><?php get_component('tagline'); ?></small></a></h1>
      </div>
      <div class="clr"></div>
      <div class="menu_nav">
        <ul>
          <?php get_navigation(return_page_slug()); ?>
        </ul>
        
      </div>
	  
	  
      <div class="clr"></div>
      <img src="<?php get_theme_url(); ?>/images/hbg_img.jpg" width="970" height="260" alt="" />  <!-- <--Replace ME with your headerimage--> </div>
  </div>
  <div class="content">
    <div class="content_resize">
      <div class="mainbar">
        <div class="article">
          <h2><?php get_page_title(); ?></h2>
          <div class="clr"></div>
				<?php get_page_content(); ?>



		  </div>
        
      </div>
      <div class="sidebar">
        <div class="gadget">
          <?php get_component('sidebar'); ?>
        </div>
        <div class="gadget">
          <?php get_component('sidebar2'); ?>
        </div>
      </div>
	  
	  <!--- End Sidebar-->
      <div class="clr"></div>
    </div>
  </div>
  
  
  <!--  End Content-->
  <div class="fbg">
  <!--
  
  
  //Optional Componets at the bottom
  
    <div class="fbg_resize">
      <div class="col c1">
        <?php get_component('infotext'); ?>
      <div class="col c2">
        <?php get_component('infotext2'); ?>
      </div>
      <div class="col c3">
        <?php get_component('contact_details'); ?>
      </div>
      <div class="clr"></div>
    </div>
  </div>-->
  <div class="footer">
    <div class="footer_resize">
      <p class="lf">Copyright &copy; 2010 <a href="#"><?php get_site_name(); ?></a> - </p>
      <p class="rf"><a href="http://www.free-css.com/">Free CSS Templates</a> by <a href="http://www.freewebsitetemplatez.com/">Free Website TemplateZ</a>  <?php get_site_credits(); ?></p>
      <div class="clr"></div>
    </div>
  </div>
</div>
<!-- END PAGE SOURCE -->
</body>
</html>
