<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<head profile="http://gmpg.org/xfn/11">
<title><?php get_page_clean_title(); ?> - <?php get_site_name(); ?></title>
<?php get_header(); ?>
<link href="<?php get_theme_url(); ?>/style.css?v=<?php echo get_site_version(); ?>" rel="stylesheet">
<!--[if lt IE 7]>
<script defer type="text/javascript" src="scripts/pngfix.js"></script>
<![endif]-->
</head>
<body id="<?php get_page_slug(); ?>">
<!-- TOP MENU -->
<div id="top-nav-container">
<div id="top-nav" class="menu-main-nav-container"><ul id="menu-main-nav" class="menu"><?php get_navigation(get_page_slug(FALSE)); ?>
</ul></div>		<!-- END TOP MENU -->
</div><!-- #top-nav-container -->
<div style="clear: both;"></div>
<div id="header">
<div id="header-top">
<div class="logo">
<h2 id="logo"><a href="<?php get_site_url(); ?>"><?php get_site_name(); ?></a></h2>
<div class="description"><?php get_component('tagline'); ?></div>
</div><!-- .logo -->
<div class="h-l">			
<div class="h-l-1">
<div id="search">
</div></div>
</div><!-- .h-l-2 -->
</div> <!-- #header-top -->
</div> <!-- end of #header -->
<div id="wrapper">
<!-- CUSTOM SECONDARY NAVIGATION -->
<div id="main-nav-container">
<div id="main-nav" class="menu-highlights-container"><ul id="menu-highlights" class="menu">
<li id="menu-item-7420" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-7420"><a href="#">Custom Menu</a></li>
<li id="menu-item-6749" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6749"><a title="contact" href="#">Custom 2</a></li>
<li id="menu-item-7263" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-7263"><a href="#">Custom 3</a></li>
<li id="menu-item-7330" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-7330"><a href="#">Custom 4</a></li>
</ul></div><!-- END CUSTOM SECONDARY NAVIGATION -->
</div> <!-- end of #main-nav-container -->
<div id="main">
<!-- SIDEBAR LEFT -->
<div id="sidebar-l">
<div class="sidebar-wrap">
<div class="sidebar-widget wide-widget"><h3 class="sidebar-widget-title"></h3>
<div class="textwidget">
<?php get_component('sidebar'); ?>
</div></div>
<!-- END SIDEBAR LEFT -->
<div class="sidebar-widget wide-widget"><h3 class="sidebar-widget-title"></h3>
</div>	</div> <!-- .sidebar-wrap -->
</div>  <!-- #sidebar-l --> 
<div id="content">
<div class="spacer"></div>
<div id="post-8806" class="post-8806 post type-post status-publish format-standard hentry category-informational category-linux-distributions post">
 <div class="post-title"><h1><?php get_page_title(); ?></h1>
<?php get_page_content(); ?>
<!-- FOOTER -->
<div class="footer">Powered by <a href="http://get-simple.info/">GetSimple CMS</a> |
Theme by <a href="http://www.tricksdaddy.com">TricksDaddy</a> |
Theme Ported to GetSimple by <a href="http://nwlinux.com" target="_blank">NW Linux</a>
</div>
</div>
<p>&nbsp;</p>
<div class="clear"></div>
<!-- END FOOTER -->
</div> <!-- end of .entry -->
<div class="clear"></div>
</div>
<!-- end of .navigation -->
<h3 class="archivetitle"></h3>
<p class="sorry"></p>
</div> <!-- end of #content -->
<!-- SIDEBAR RIGHT -->
<div id="sidebar">
<div class="sidebar-wrap">
<div class="sidebar-widget wide-widget">		
<h2>Sidebar Right</h2>
Change this text by editing Clean-Simple's template.php, line 86. 
<!-- END SIDEBAR RIGHT -->
</div></div> <!-- .sidebar-wrap -->
<div class="clear"></div>
</div> <!-- #sidebar -->
<div class="clear"></div>
</div>	<!-- end of #main -->
</div> <!-- #copyright -->
</div> <!-- #footer -->
</div><!-- #wrapper -->
</body>
</html>
