<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File: 		template.php
* @Package:		GetSimple
* @Action:		Pure Side-Menu theme for GetSimple CMS
*
*****************************************************/
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A layout example with a side menu that hides on mobile, just like the Pure website.">

    <title>
		<?php if (function_exists('get_custom_title_tag'))
		{echo(get_custom_title_tag());}
		else { get_page_clean_title(); echo"&nbsp;&ndash;&nbsp;"; get_site_name(); }  ?>
	</title>
	
	<?php get_header(); ?>
    
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.3.0/pure-min.css">
	<link rel="stylesheet" href="<?php get_theme_url(); ?>/css/layouts/side-menu.css">    
	
	<link rel="shortcut icon" href="<?php get_theme_url(); ?>/images/favicon.ico">

</head>

<body id="<?php get_page_slug(); ?>" >

<div id="layout">
    <!-- Menu toggle -->
    <a href="#menu" id="menuLink" class="pure-menu-link">
        <!-- Hamburger icon -->
        <span></span>
    </a>

    <div id="menu">
        <div class="pure-menu pure-menu-open">
            <a class="pure-menu-heading" href="<?php get_site_url(); ?>">
				<?php if (component_exists('menu-heading'))
							{get_component('menu-heading');}
							else {get_site_name();} ?>
			</a>
            <ul>
                <?php get_navigation(return_page_slug()); ?>
				<li class="menu-item-divided">
					<?php  if (component_exists('extended-menu'))
								{get_component('extended-menu');}
							else {echo 
					"<a href=\"http://www.get-simple.info\">GetSimple</a>
					<a href=\"http://purecss.io/\">Pure CSS</a>"
					;}	?>
                </li>
            </ul>
        </div>
    </div>

    <div id="main">
        <div class="header">
            <h1><?php get_page_title(); ?></h1>
            <h2><?php	if (component_exists('tagline-'.get_page_slug(false)))
							{get_component('tagline-'.get_page_slug(false));}
						else {get_component('tagline');}	?>
			</h2>
        </div>

        <div class="content">
            <?php get_page_content(); ?>
        </div>
		
    </div>
</div>


<?php get_footer(); ?>


<script src="<?php get_theme_url(); ?>/js/ui.js"></script>


</body>
</html>
