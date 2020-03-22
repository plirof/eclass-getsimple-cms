<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File: 		template.php
* @Package:		GetSimple
* @Action:		Keyboard Theme by Free CSS Templates for GetSimple adapted by Jose Arrona - SS
*
*****************************************************/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Name       : Keyboard 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20120915

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php get_header(); ?>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php get_page_clean_title(); ?> - <?php get_site_name(); ?></title>
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
<link href="<?php get_theme_url(); ?>/style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<div id="wrapper">
	<div id="header-wrapper">
		<div id="header" class="container">
			<div id="logo">
				<h1><a href="<?php get_site_url(); ?>"><?php get_site_name(); ?></a></h1>
			</div>
			<div id="menu">
				<ul>
					<?php get_navigation(return_page_slug()); ?>
				</ul>
			</div>
		</div>
		<div id="banner">
			<div class="content"><img src="<?php get_theme_url(); ?>/images/img02.jpg" width="1000" height="300" alt="" /></div>
		</div>
	</div>
	<!-- end #header -->
	
	<div id="page">
		<div id="content">
			<div class="post">
				<h2 class="title"><a href="#"><?php get_page_title(); ?></a></h2>
				<p class="meta"><span class="date"><?php get_page_date('F jS, Y'); ?></span></p>
				<div style="clear: both;">&nbsp;</div>
				<div class="entry">
					<?php get_page_content(); ?>
				</div>
			</div>
			<div style="clear: both;">&nbsp;</div>
		</div>
		<!-- end #content -->
		<div id="sidebar">
			<?php get_component('sidebar');	?>
		</div>
		<!-- end #sidebar -->
		<div style="clear: both;">&nbsp;</div>
	</div>
	<!-- end #page --> 
</div>
<div id="footer">
	<p>Copyright &copy; <?php echo date('Y'); ?> <?php get_site_name(); ?>. Design by <a href="http://www.freecsstemplates.org">FCT</a>. Photos by <a href="http://fotogrph.com/">Fotogrph</a>. Adapted by <a href="http://get-simplified.com/">SS</a> <?php get_site_credits(); ?></p>
</div>
<!-- end #footer -->
<?php get_footer(); ?>
</body>
</html>
