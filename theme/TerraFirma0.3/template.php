<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php get_header(); ?>  
<!-- Terra Firma version 0.3 -->
<title><?php get_page_clean_title(); ?> - <?php get_site_name(); ?></title>
<link href="<?php get_theme_url(); ?>/main.css?v=<?php echo get_site_version(); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php get_theme_url(); ?>/typography.css?v=<?php echo get_site_version(); ?>" rel="stylesheet" type="text/css"/>
</head>
<body id="<?php get_page_slug(); ?>">
<div id="wrapper">
<div id="header" class="container">
<div id="logo">
<h1><a href="<?php get_site_url(); ?>"><?php get_site_name(); ?></a></h1>
</div>
<div id="banner">
<img src="<?php get_site_url(); ?>/theme/TerraFirma/bg/img01.jpg" width="667" height="118" alt="" />
</div>
</div>
<div id="menu" class="container">
<ul class="nav-header"><?php get_navigation(get_page_slug(FALSE)); ?></ul><div class="ccm-spacer">&nbsp;</div>	</div>
<div id="page" class="container">
<div id="content">
<br />
<div class="entry">
<div id="HTMLBlock297" class="HTMLBlock">
</div></div><div class="entry">
<h3><?php get_page_clean_title(); ?></h3>
<?php get_page_content(); ?></div>		</div>
<div id="sidebar">
<?php get_component('sidebar'); ?>		
</div>
<div class="clearfix">&nbsp;</div>
</div><!-- end #page -->
</div><!-- end #wrapper -->
<div id="footer" class="container">
<p>&copy; 2011 <a href="<?php get_site_url(); ?>"><?php get_site_name(); ?></a>. 
</div>
</body>
</html>
