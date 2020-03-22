<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File: 		template.php
* @Package:		GetSimple
* @Action:		Theme by Free CSS Templates adapted for GetSimple by Jose Arrona - SS
*
*****************************************************/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Name       : Emerald 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20120902

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php get_header(); ?>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php get_page_clean_title(); ?> - <?php get_site_name(); ?></title>
<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
<link href="<?php get_theme_url(); ?>/style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<div id="wrapper">
	<div id="header-wrapper" class="container">
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
	<div><img src="<?php get_theme_url(); ?>/images/img03.png" width="1000" height="40" alt="" /></div>
	</div>
	<!-- end #header -->
	<div id="page">
		<div id="content">
			<div class="post">
				<h2 class="title"><?php get_page_title(); ?></h2>
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
	<div class="container"><img src="<?php get_theme_url(); ?>/images/img03.png" width="1000" height="40" alt="" /></div>
	<!-- end #page -->
</div>
<div id="footer-content"></div>
<div id="footer">
	<p>&copy; <?php echo date('Y'); ?> <?php get_site_name(); ?>. Design by <a href="http://www.freecsstemplates.org">FCT</a>. Adapted by <a href="http://get-simplified.com/">SS</a>. <?php get_site_credits(); ?>.</p>
</div>
<!-- end #footer -->
<?php get_footer(); ?>
</body>
</html>
