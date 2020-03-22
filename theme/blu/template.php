<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="Content-Language" content="en" />
  <?php get_header(); ?>
  <link rel="stylesheet" href="<?php get_theme_url(); ?>/style.css" type="text/css" />
  <title><?php get_page_clean_title(); ?> - <?php get_site_name(); ?></title>
</head>

<body>
<div id="tlo">
	<div id="kontener">
    
		<div id="naglowek"><h1><?php get_site_name(); ?></h1></div>
	
		<div id="menu">
  			<ul>
  				<?php get_navigation(return_page_slug()); ?>
  			</ul>
		</div>
	
		<div id="lewy">
        	<?php get_component('sidebar'); ?>
			<div id="bottom"></div>
		</div>

		<div id="srodek">
      		
            <h2><?php get_page_title(); ?></h2>
			<p><?php get_page_content(); ?></p>

		</div>	

		<div id="stopka">
		<!-- Please do not delete copyright below. Of course you can edit it, but leaving a link to author is a good thing. :) -->
			<div id="copyright">Copyright &copy; 2013 <a href="<?php get_site_url(); ?>"><?php get_site_name(); ?></a></div>
			<div id="design">Design by <a href="http://artglow.me" title="ArtGlow.me">ArtGlow.me</a></div>
		</div>
 
	</div>    
</div>
    <?php get_footer(); ?>
</body>
</html>