<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File: 		template.php
* @Package:		GetSimple
* @Action:		yCard theme for GetSimple CMS
*
*****************************************************/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--
Created by: Artur Główczyński :: http://artglow.me
This is a free template released under the Creative Commons Attribution 3.0 license, 
which means you can use it in any way you want provided you keep links to authors intact.
Don't want our links in template? You can pay a link removal fee via PayPal to kontakt.artix@gg.pl
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php get_header(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php get_site_name(); ?> - <?php get_page_clean_title(); ?></title>
<link href="<?php get_theme_url(); ?>/style.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<div id="container">
<!-- header -->
<div id="header">

<div id="slogan"><?php get_component('tagline'); ?></div>

<div id="logo"><?php get_site_name(); ?></a></div>

</div>

<div id="menu">
<ul>
<?php get_navigation(return_page_slug(FALSE)); ?>
</ul>
</div>
<!--end header -->
<!-- main -->
<div id="main">



<div id="text">
<h1><?php get_page_title(); ?></h1>
<?php get_page_content(); ?>
</div>
</div>
<!-- end main -->
<!-- footer -->
<div id="footer">

<div id="footer_left">&copy; 2013 <a href="<?php get_site_url(); ?>"><?php get_site_name(); ?></a> | <?php get_site_credits(); ?> <?php return_site_ver(); ?></div>
<div id="footer_right">
<!-- Please do not remove this link.-->
Design by <a href="http://artglow.me" target="_blank">ArtGlow.me</a>
</div>

</div>
<!-- end footer -->
<?php get_footer(); ?>
</div>
</body>
</html>
