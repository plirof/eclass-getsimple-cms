<!DOCTYPE html>
<html dir="ltr" lang="en-US">	
	<head>		
		<meta charset="utf-8">
		<?php get_header(); ?>		
		<title><?php get_page_title(); ?></title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
                <link rel="stylesheet" href="<?php get_theme_url(); ?>/style.css" />
		<link rel='canonical' href='<?php get_page_url(); ?>' />
	</head>
	
<body>
	
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		
<div id="wrap">
<div id="header">
	<table><tr><td><a href="<?php get_site_url(); ?>" title="<?php get_site_name(); ?>"><h1><?php get_site_name(); ?></h1></a></td>
	<td><div id="menu">
	<ol>
	<ul><?php get_navigation(return_page_slug()); ?></ul>
	</ol>
</div><!-- end menu div -->
</td></tr></table>
</div><!--end header-->
<div id="main">    
<div id="content">
<div class="post">
	<h3><?php get_page_title(); ?></h3>
	<div class="current"><small><strong>Published <?php get_page_date('F jS, Y'); ?></strong>
	<br>
	keywords include: <?php get_page_meta_keywords(); ?></small></current>
	<p><?php get_page_content(); ?></p>
	<table><tr><td><a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php get_page_url(); ?>" data-count="horizontal" data-via="get_simple">Tweet</a>
	<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
	<td><div class="fb-like" data-href="<?php get_page_url(); ?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div></td></tr></table>
	<!--</p>-->
	<!--<p>--> <a class="twitter-post-link" href="https://twitter.com/#!/get_simple" title="Follow GetSimple On Twitter">Follow GetSimple on Twitter &rarr;</a></p>
</div><!--end post-->
</div><!--end content-->
</div>
<div id="sidebar">
	<?php get_component('sidebar'); ?>
<div class="line"></div>
</div><!--end sidebar-->    
</div><!--end main-->
<div id="footer">
	<!-- Uncomment and add function in admin > theme > components to enable admin footer content -->
	<!-- <?php get_component('footer'); ?> -->
	<p class="copyright">Copyright &copy; 2012 &middot; <?php get_site_name(); ?></p>
<div><!--end footer-->
</div> <!--end wrap-->
</body>
</html>
