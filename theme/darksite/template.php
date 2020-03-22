<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="Content-Language" content="en" />
<?php get_header(); ?>
  <link rel="stylesheet" href="<?php get_theme_url(); ?>/style.css" type="text/css" />
  <title><?php get_site_name(); ?> - <?php get_page_clean_title(); ?></title>
</head>

<body>

	<div id="logo"><h1><?php get_site_name(); ?></h1></div>

	<div id="kontener">
		
        <ul id="menu1">
			<li><a href="<?php get_site_url(); ?>">Home</a> - <?php get_page_title(); ?></li>
		</ul>
		
        <ul id="menu2">
  			<?php get_navigation(return_page_slug(FALSE)); ?>
  		</ul>
        
<div class="tresc">

		<h2><?php get_page_title(); ?></h2>
        <span>Published on <time datetime="<?php get_page_date('Y-m-d'); ?>" pubdate><?php get_page_date('F jS, Y'); ?></time></span>
  	<p><?php get_page_content(); ?></p>

</div>

<div class="menup">
<?php get_component('sidebar'); ?>
</div>        
 
</div>
<div id="stopka">
	<div id="copyright">Design: <a href="http://artglow.me" target="_blank">ArtGlow.me</a>.</div>
</div>
<?php get_footer(); ?>
</body>
</html>
