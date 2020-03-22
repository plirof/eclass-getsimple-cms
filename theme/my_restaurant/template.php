<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File: 			template.php
* @Package:		GetSimple
* @Action:		Our Shop theme for GetSimple CMS
*
*****************************************************/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<!-- Site Title -->
	<title><?php get_page_clean_title(); ?> &lt; <?php get_site_name(); ?></title>
	<?php get_header(); ?>
	<meta name="robots" content="index, follow" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<style media="all" type="text/css">@import "<?php get_theme_url(); ?>/css/all.css";</style>
	<!--[if lt IE 7]><style media="screen" type="text/css">@import "<?php get_theme_url(); ?>/css/ie6.css";</style><![endif]-->
    <script defer type="text/javascript" src="<?php get_theme_url(); ?>/pngfix.js"></script>
</head>
<body id="<?php get_page_slug(); ?>" >
	<div id="page">
		<div id="header">
			<div class="background">
				<h1><a href="<?php get_site_url(); ?>"><?php get_site_name(); ?></a></h1>
				<ul>
					<?php get_navigation(return_page_slug()); ?>
				</ul>
			</div>
		</div>
        
		<div id="content">
			<div id="leftcol">
				<div class="block">
					<div class="block-top"></div>
					<div class="block-content">
						<h2><?php get_page_title(); ?></h2>
							<p>
								<?php get_page_content(); ?>
                                </p>
					</div>
					<div class="block-bottom"> </div>
				</div>
			</div>
			<div id="rightcol">
				<div class="block">
					<div class="block-top"></div>
					<div class="block-content">
					<?php get_component('sidebar');	?>
					</div>
					<div class="block-bottom"></div>
				</div>
		
	
    
			</div>
		</div>
		<div id="footer">
			<p>©<?php echo date('Y'); ?> - <strong><?php get_site_name(); ?></strong>. Designed by <a href="http://www.computerplanetindia.com">ComputerPlanetIndia.com</a></p>
			<ul>
				<?php get_navigation(return_page_slug()); ?>
			</ul>
		</div>
	</div>
</body>
</html>