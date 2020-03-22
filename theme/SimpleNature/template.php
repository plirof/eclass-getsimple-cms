<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/********************************************************************************************************************
*
* @File: 		template.php
* @Package:		Christophe AUBRY, http://www.netplume.net
* @Action:		SimpleNature theme, based on Domestic template : http://www.freecsstemplates.org/preview/domestic/
*
********************************************************************************************************************/
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php get_page_clean_title(); ?> | <?php get_site_name(); ?></title>
	<?php get_header(); ?>
	<meta name="robots" content="index, follow" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="<?php get_theme_url(); ?>/style.css" media="all" />
	<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
</head>
<body id="<?php get_page_slug(); ?>" >
<div id="menubar">
	<div id="menu">
		<ul>
			<?php get_navigation(return_page_slug()); ?>
		</ul>
	</div>
</div>
<!-- Site name & slogan -->
<div id="banner">
	<h1><a href="<?php get_site_url(); ?>"><?php get_site_name(); ?></a></h1>
	<?php get_component('tagline'); ?>
</div>
<!-- Page content -->
<div id="page" class="container">
	<!-- Content -->
	<div id="content">
		<h1 class="title"><?php get_page_title(); ?></h1>
		<div class="entry">
			<?php get_page_content(); ?>
			<p class="meta">&middot;&nbsp;Published on <?php get_page_date('F jS, Y'); ?></p>
		</div>
	</div>
	<!-- Sidebar Component -->
	<div id="sidebar">
		<?php get_component('sidebar');	?>
	</div>
</div>
<!-- Three columns Component -->
<div id="three-columns">
	<div id="three-columns-content" class="container">
		<div id="column1">
			<?php get_component('column-one'); ?>
		</div>
		<div id="column2">
			<?php get_component('column-two'); ?>
		</div>
		<div id="column3">
			<?php get_component('column-three'); ?>
		</div>
	</div>
</div>
<!-- Footer -->
<div id="footer">
	<?php get_footer(); ?>
	<div id="foot" class="container">
		<div class="left">
			<p><?php echo date('Y'); ?> <a href="<?php get_site_url(); ?>" ><?php get_site_name(); ?></a></p>
		</div>
		<div class="right">
			<p>Theme by <a href="http://www.netplume.net/" target="_blank">netPlume</a>&nbsp;&middot;&nbsp;<?php get_site_credits(); ?></p>
		</div>
	</div>
</div>
</body>
</html>