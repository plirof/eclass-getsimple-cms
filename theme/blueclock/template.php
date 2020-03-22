<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
  <title><?php get_page_clean_title(); ?> - <?php get_site_name(); ?></title>
  <?php get_header(); ?>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="<?php get_theme_url(); ?>/style/style.css" />
  <link rel="stylesheet" type="text/css" href="<?php get_theme_url(); ?>/style/blue.css" />

</head>

<body>
  <div id="main">
    <div id="links">
      <a href="#">another link</a> | <a href="#">another link</a> | <a href="#">another link</a> | <a href="#">another link</a>
    </div>
    <div id="logo"><h1><?php get_site_name(); ?></h1><h2><?php get_component('tagline'); ?></h2></div>
    <div id="menu">
      <ul>
       <?php get_navigation(return_page_slug(FALSE)); ?>
      </ul>
    </div>
    <div id="content">
      <div id="column1">
        <div class="sidebaritem">
          <?php get_component('sidebar'); ?>
        </div>
      </div>
      <div id="column2">
        <h1><?php get_page_title(); ?></h1>
        <p>
          <?php get_page_content(); ?>
        </p>
      </div>
    </div>
    <div id="footer">
      Copyright &copy; 2013 <a href="<?php get_site_url(); ?>"><?php get_site_name(); ?></a> | <?php get_site_credits(); ?> | Design by <a href="http://artglow.me" target="_blank">ArtGlow.me</a>
    </div>
  </div>
  <?php get_footer(); ?>
</body>
</html>
