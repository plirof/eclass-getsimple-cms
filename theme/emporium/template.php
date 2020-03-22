<?php
/****************************************************
*
* @File: 			template.php
* @Package:		GetSimple
* @Action:		Emporium theme for the GetSimple CMS
*
*		Design by Free CSS Templates
*		http://www.freecsstemplates.org
*		Released for free under a Creative Commons Attribution 2.5 License
*
*****************************************************/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php get_page_clean_title(); ?> | <?php get_site_name(); ?></title>
	<?php get_header(); ?>
	<meta name="robots" content="index, follow" />
	<link rel="stylesheet" type="text/css" href="<?php get_theme_url(); ?>/default.css" media="all" />
</head>
<body id="<?php get_page_slug(); ?>" >
<div id="wrapper">
<!-- start header -->
<div id="logo">
	<h1><a href="<?php get_site_url(); ?>"><?php get_site_name(); ?></a></h1>
</div>
<div id="header">
	<div id="menu">
		<ul>
			<?php get_navigation(return_page_slug()); ?>
		</ul>
	</div>
</div>
<!-- end header -->
</div>
<!-- start page -->
<div id="page">
	<!-- start content -->
	<div id="content">
		<div class="post">
			<h1 class="title"><?php get_page_title(); ?></h1>
			<div class="entry">
				<?php get_page_content(); ?>			
			</div>
			<div class="meta">
				<!-- p class="links">Published on <?php get_page_date('F jS, Y'); ?></p -->
			</div>
		</div>
	</div>
	<!-- end content -->
	<!-- start sidebar -->
	<div id="sidebar">
		<ul>
			<li>
				<?php get_component('sidebar');	?>
			</li>

		</ul>
	</div>
	<!-- end sidebar -->
	<div style="clear: both;">&nbsp;</div>
</div>
<!-- end page -->
<!-- start footer -->
<div id="footer">
	<p id="legal">
		&copy; <?php echo date('Y'); ?> <strong><?php get_site_name(); ?></strong> - All Rights Reserved<br />
		<?php get_site_credits(); ?> - Emporium theme by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a> and <a href="http://www.cagintranet.com">Cagintranet</a>
	</p>
</div>
<!-- end footer -->
</body>
</html>
