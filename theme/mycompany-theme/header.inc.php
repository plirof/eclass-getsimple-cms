<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File: 		header.inc.php
* @Package:		GetSimple
* @Action:		myCompany theme for GetSimple CMS
*
*****************************************************/
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <?php get_header(); ?>	
  <link rel="shortcut icon" href="<?php get_theme_url(); ?>/favicon.ico">
  <link rel="apple-touch-icon" href="<?php get_theme_url(); ?>/apple-touch-icon.png">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>
     <?php get_page_clean_title(); ?> | 
      <?php get_site_name(); ?>
  </title>
	<meta name="author" content="www.pixelofficer.sk">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="<?php get_theme_url(); ?>/style.css">

	<script src="<?php get_theme_url(); ?>/js/libs/modernizr-2.5.3-respond-1.1.0.min.js"></script>
</head>
<body>
	<div id="header-container">
		<div class="inheader">
    <header class="wrapper clearfix">
			<span id="title"><a href="<?php get_site_url(); ?>" title="<?php get_site_name(); ?>"><img src="<?php get_theme_url(); ?>/customize/logo.png" title="logo" /></a></span>
			<nav>
				<ul>
          <?php get_navigation(return_page_slug()); ?>   
				</ul>
			</nav>
		</header>
		</div>
	</div>
