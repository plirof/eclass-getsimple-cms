<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File: 		nosidebar.php
* @Package:		GetSimple theme Seascape V1.2
* @Action:		GSkeleton Boilerplate for GetSimple CMS
*
*****************************************************/
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<link href='http://fonts.googleapis.com/css?family=Cinzel' rel='stylesheet' type='text/css'>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>
		<?php if (function_exists('get_custom_title_tag'))
		{echo(get_custom_title_tag());}
		else { get_page_clean_title();echo'&nbsp;&mdash;&nbsp;';get_site_name();}   ?>
	</title>
	
	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="<?php get_theme_url(); ?>/stylesheets/base.css">
	<link rel="stylesheet" href="<?php get_theme_url(); ?>/stylesheets/skeleton.css">
	<link rel="stylesheet" href="<?php get_theme_url(); ?>/stylesheets/layout.css">

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="<?php get_theme_url(); ?>/images/favicon.ico">
		
	<?php get_header(); ?>
</head>

<body id="<?php get_page_slug(); ?>" >

	<!-- Page Layout
	================================================== -->

	<div id="page" class="container add-bottom">
	
		<div id="titleblock" class="sixteen columns">
			<h2 class="remove-bottom"><a href="<?php get_site_url(); ?>" style="text-decoration:none;"><?php get_site_name(); ?></a></h2>
				<h5><?php get_component('tagline');	?></h5>
		</div>
		
		<nav class="sixteen columns">
			<hr />
			<ul><?php get_navigation(return_page_slug()); ?></ul>
			<hr />
		</nav>
		
		<div id="imgholder" class="sixteen columns half-bottom">
			<?php  if (component_exists('header-'.get_page_slug(false)))
								{get_component('header-'.get_page_slug(false));}
						else {get_component('header');}	?>
			<h1><?php get_page_title(); ?></h1>
		</div>
		
		<div id="maincontent" class="sixteen columns">			
			<?php get_page_content(); ?>
		</div>
				
		<footer class="sixteen columns">
			<hr />
			<div class ="eight columns alpha">
				<?php get_site_name(); ?> &copy; <?php echo date('Y'); ?>
			</div>
			<div class ="eight columns omega">
				<?php  if (component_exists('footer'))
							{get_component('footer');}
					else {echo'<a href="http://www.cyberpress.biz">Theme</a>&nbsp;|&nbsp;';get_site_credits();} ?>
			</div>
			<?php get_footer(); ?>
		</footer>
	</div><!-- container -->


<!-- End Document
================================================== -->
</body>
</html>