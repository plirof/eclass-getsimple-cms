<?php 
// Exit if accessed directly
if(!defined('IN_GS')){ die('you cannot load this page directly.'); }

/*****************************************************************************************************************
*	@File:			template.php
*	@Package:		GetSimple
*	@Action:		RT14GS Theme | Adapted from: Woman's Laptop by FRT <http://www.free-responsive-templates.com/>
*					Released under the Creative Commons Attribution 3.0 license	
******************************************************************************************************************/

#Get theme's settings 
$theme_settings = rt14gs_settings();

?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php get_page_clean_title(); ?> - <?php get_site_name(); ?></title>
	<link href="<?php get_theme_url(); ?>/css/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php get_theme_url(); ?>/css/structure.css" rel="stylesheet" type="text/css">
	<link href="<?php get_theme_url(); ?>/css/media-queries.css" rel="stylesheet" type="text/css">
	<!-- css3-mediaqueries.js for IE8 or older -->
	<!--[if lt IE 9]>
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!--[if lt IE 7 ]>
		<script src="<?php get_theme_url(); ?>/js/dd_belatedpng.js"></script>
		<script> DD_belatedPNG.fix('img, .png_bg'); //fix any <img> or .png_bg background-images </script>
	 <![endif]-->

	<?php get_header(); ?>

</head>
<body id="<?php get_page_slug(); ?>">
	<!-- begin #container -->
	<div id="container">
		<!-- begin #header -->
		<div id="header">
			<h1><?php get_site_name(); ?></h1>
			<div class="socialIcons">
				<ul>
					<?php if (defined('FACEBOOK')) { ?>
					<li><a href="<?php echo FACEBOOK; ?>"><img src="<?php get_theme_url(); ?>/images/facebook.png" alt="" width="26" height="26"></a></li>
					<?php } ?>
					<?php if (defined('GOOGLEPLUS')) { ?>
					<li><a href="<?php echo GOOGLEPLUS; ?>"><img src="<?php get_theme_url(); ?>/images/googleplus.png" alt="" width="26" height="26"></a></li>
					<?php } ?>
				</ul>
			</div>
			<div id="navcontainer">
				<ul><?php get_navigation(get_page_slug(FALSE)); ?></ul>
			</div>
		</div>
		<!-- end #header -->
		<!-- begin #content -->
		<div id="content">
			<h2><?php get_page_title(); ?></h2>
			<?php get_page_content(); ?>
		</div>
		<!-- end #content -->
		<!-- begin #sidebar -->
		<div id="sidebar">
			<?php get_component('sidebar'); ?>
		</div>
		<!-- end #sidebar -->
		<div class="clearfloat"></div>
		<!-- begin #footer -->
		<div id="footer">
			<p>Copyright &copy; <?php get_site_name(); ?>. All rights reserved. <a class="footerLink" href="http://get-simple.info/extend/a/luigi" target="_blank">RT14GS</a> by <a class="footerLink" href="http://www.free-responsive-templates.com" title="Free Responsive Templates">FRT</a>. Powered by <a class="footerLink" href="http://get-simple.info/" target="_blank" >GetSimple</a></p>
			
			<?php get_footer(); ?>
		</div>
		<!-- end #footer -->
	</div>
	<!-- end #container -->
</body>
</html>
