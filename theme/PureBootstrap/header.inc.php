<?php if(!defined('IN_GS')){die('You cannot load this page directly!');}
/****************************************************
*
* @File:      header.inc.php
* @Package:   GetSimple
* @Action:    PureBootstrap theme for GetSimple CMS
* @Author:    John Stray [https://www.johnstray.id.au/]
*
*****************************************************/
?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Get page title : Defined in functions.php -->
  <title><?php bootstrap_get_title(); ?></title>
  
  <!-- Bootstrap Core CSS -->
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"><!-- Bootstrap -->
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"><!-- FontAwesome -->
  
  <!-- Add custom CSS here -->
  <link href="<?php get_theme_url(); ?>/assets/css/custom.css" rel="stylesheet">
  
  <!-- Bootswatch Theme : Change this to your choice of theme -->
  <!-- Visit http://bootswatch.com/ to preview the themes available -->
  <link href="//netdna.bootstrapcdn.com/bootswatch/3.1.1/flatly/bootstrap.min.css" rel="stylesheet">
  
  <!-- HTML5 Compatibility for Internet Explorer < 9 -->
  <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]--> 
	
  <!-- PNG Transparency Fix for Internet Explorer < 7 -->
	<!--[if lt IE 7 ]>
    <script src="<?php get_theme_url(); ?>/assets/js/dd_belatedpng.js"></script>
    <script> DD_belatedPNG.fix('img, .png_bg'); //fix any <img> or .png_bg background-images </script>
  <![endif]-->
  
  <!-- HEADER Plugin Hook -->
  <?php get_header(); ?>
  
</head>

<body id="<?php get_page_slug(); ?>">

  <!-- START Navigation -->
  <div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle Navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        
        <!-- Website Name -->
        <a class="navbar-brand" href="<?php get_site_url(); ?>" title="<?php get_site_name(); ?>"><?php get_site_name(); ?></a>
      
      </div>
      
      <!-- Get navigation items : Defined in functions.php -->
      <div class="navbar-collapse collapse navbar-responsive-collapse">
        <ul class="nav navbar-nav">
          <?php bootstrap_get_navigation(get_page_slug(FALSE)); ?>
        </ul>
      </div>
      
    </div>
  </div>
  <!-- END Navigation -->
