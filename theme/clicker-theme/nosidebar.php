<?php 
// Exit if accessed directly
if(!defined('IN_GS')){ die('you cannot load this page directly.'); }

/***************************************************************************************************************
*	@File:			base-template.php
*	@Package:		GetSimple
*	@Action:		Clicker Theme | Adapted from: Clicker Template by Reality Software <http://www.realitysoftware.ca/>
*					Released under the Creative Commons Attribution 3.0 License
****************************************************************************************************************/
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php get_page_clean_title(); ?> - <?php get_site_name(); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="<?php get_theme_url(); ?>/style.css" rel="stylesheet" type="text/css" />
	<style>
		#text {	width:100%;	}
		#sidebar { display: none; }
	</style>
	<!--[if lt IE 9]>
		<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]--> 

	<!--[if lt IE 7 ]>
		<script src="<?php get_theme_url(); ?>/js/dd_belatedpng.js"></script>
		<script> DD_belatedPNG.fix('img, .png_bg'); //fix any <img> or .png_bg background-images </script>
	 <![endif]-->

	<?php get_header(); ?>
</head>
<body id="<?php get_page_slug(); ?>" >
	<div id="container">
		<div id="header">
			<div id="logo"><a href="<?php get_site_url(); ?>"><span class="orange"><?php get_site_name(); ?></span></a></div>
				<div id="menu">
				<ul>
					<?php get_navigation(get_page_slug(FALSE)); ?>
				</ul>
			</div>
		</div>
		<div id="main">
			<div id="content">
				<div id="head_image">
					<div id="slogan">
						<?php if (component_exists('tagline')) { get_component('tagline'); }?>
					</div>
					<div id="under_slogan_text">
					<?php if (file_exists(GSDATAPAGESPATH. 'slogan.xml')) { getPageContent('slogan'); }?>
					</div>
				</div>
				<div id="text">
					<h1><?php get_page_title(); ?></h1>
					<p><?php get_page_content(); ?></p>
				</div>
				<div id="sidebar">
					<?php if (component_exists('sidebar')) { get_component('sidebar'); }?>
				</div>
			</div>
		</div>
		<div id="footer">
			<div id="left_footer">
				&copy; Copyright <?php echo date('Y'); ?> <a href="<?php get_site_url(); ?>"><?php get_site_name(); ?></a>
			</div>
			<div id="right_footer">
			<a href="http://get-simple.info/extend/a/luigi" target="_blank">Clicker Theme</a> | Powered by <a href="http://get-simple.info/" target="_blank" >GetSimple</a><br/>
			Design by <a href="http://www.realitysoftware.ca">Reality Software</a> </div>
			
			<?php get_footer(); ?>
		</div>
	</div>
</body>
</html>
