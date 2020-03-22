<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File: 		template.php
* @Package:		GetSimple
* @Action:		architexture theme for the GetSimple 3.1
*
*****************************************************/
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title><?php get_page_clean_title(); ?> | <?php get_site_name(); ?></title>
	<link rel="stylesheet" href="<?php get_theme_url(); ?>/styles.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php get_theme_url(); ?>/print.css" type="text/css" media="print" />
	<?php my_get_header(); ?>
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body id="<?php get_page_slug(); ?>" >
<div id="wrapper"><!-- #wrapper -->

	<nav><!-- top nav -->
		<div class="menu">
			<ul>
			<?php get_navigation(return_page_slug()); ?>
			</ul>
		</div>
	</nav><!-- end of top nav -->
	
	<header><!-- header -->
		<div id="plandesign"><img src="<?php get_theme_url(); ?>/images/plans.png" alt="" /></div>
		<h1><a href="<?php get_site_url(); ?>" id="logo" ><?php get_site_name(); ?></a></h1>
		<p><?php get_component('tagline'); ?></p>
	</header><!-- end of header -->
	
	<section id="main"><!-- #main content and sidebar area -->
			<section id="content_full"><!-- #content -->		
        		<article>
					<h1><?php get_page_title(); ?></h1>
						<?php get_page_content(); ?>	
				</article>		
			</section><!-- end of #content -->

	</section><!-- end of #main content and sidebar-->
	
		<footer>
		<section id="footer-area">

			<section id="footer-outer-block">
				<?php get_component('footer-block'); ?>
			</section><!-- end of footer-outer-block -->

		</section><!-- end of footer-area -->
	</footer>
	
</div><!-- #wrapper -->
<!-- Free template created by http://freehtml5templates.com -->
</body>
</html>
