<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File: 		template.php
* @Package:		GetSimple
* @Action:		BrownBook theme for GetSimple CMS
*
*****************************************************/


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php get_page_clean_title(); ?> | <?php get_site_name(); ?></title>
<link href="<?php get_theme_url(); ?>/style.css" rel="stylesheet" type="text/css" media="screen" />
<?php get_header(); ?>
</head>
<body>
<div id="wrapper">
	<div id="header-wrapper">
	<div id="header">
		<div id="logo">
			<h1><a href="<?php get_site_url(); ?>/"><?php get_site_name(); ?></a></h1>
			<p><?php get_component( 'tagline' ); ?></p>
		</div>
	</div>
	</div>
	<!-- end #header -->
	<div id="page">
	<div id="page-bgtop">
	<div id="page-bgbtm">
		<div id="content">
			<div class="post">
				<h2 class="title"><?php get_page_title(); ?></h2>
				<p class="meta"><span class="date"><?php get_page_date('F jS, Y'); ?></span><!-- //TRY TO USE IT IF YOU HAVE NEWS MANAGER INSTALLED "<span class="posted">Posted by <a href="#">Someone</a></span></p>" -->
				<div style="clear: both;">&nbsp;</div>
				<div class="entry">
					<?php get_page_content(); ?>
				</div>
			</div>
		<div style="clear: both;">&nbsp;</div>
		</div>
		<!-- end #content -->
		<div id="sidebar">
			<ul>
				<li>
					<div style="clear: both;">&nbsp;</div>
				</li>
				<li>
					<?php get_component( 'sidebar' ); ?>
				</li>
			</ul>
		</div>
		<!-- end #sidebar -->
		<div style="clear: both;">&nbsp;</div>
	</div>
	</div>
	</div>
	<!-- end #page -->
</div>
	<div id="footer">
		<p>&copy; 2014 <?php get_site_name(); ?> All rights reserved &bull; <?php get_site_credits( $text='Proudly powered by ' ); ?> <?php return_site_ver(); ?> &bull; <!-- Please do not remove this --> Design by <a href="http://artglow.me" target="_blank">ArtGlow.me</a></p>
	</div>
	<!-- end #footer -->
</body>
</html>
