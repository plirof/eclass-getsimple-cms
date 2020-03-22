<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File: 		template.php
* @Package:		GetSimple
* @Action:		PureGS - pure css framework for GetSimple CMS
*
*****************************************************/
?>

<!DOCTYPE html>

<html lang="en">

<head>
	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="A layout example that shows off a blog page.">
	<title><?php get_page_clean_title(); ?> &mdash; <?php get_site_name(); ?></title>
	
	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.3.0/pure-min.css">
	<link rel="stylesheet" href="<?php get_theme_url(); ?>/style.css">
	
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<link rel="shortcut icon" href="<?php get_theme_url(); ?>/images/favicon.ico">
	
	<?php get_header(); ?>
</head>

<body id="<?php get_page_slug(); ?>" >

	<!-- Primary Page Layout
	================================================== -->

<div class="pure-g-r" id="layout">
    <div class="sidebar pure-u">
        <header class="header">
            <hgroup>
                <h1 class="brand-title"><?php get_site_name(); ?></h1>
                <h2 class="brand-tagline"><?php get_component('tagline');	?></h2>
            </hgroup>

            <nav class="nav">
                <ul class="nav-list">
					<?php get_navigation(return_page_slug()); ?>
                </ul>
            </nav>
        </header>
    </div>

    <div class="pure-u-1">
        <div class="content">
            <!-- A wrapper for all the blog posts -->
            <div class="posts">
                <h1 class="content-subhead">Pinned Post</h1>

                <!-- A single blog post -->
                <section class="post">
                    <header class="post-header">
                        <img class="post-avatar"
                             alt="Glimmer Twins" src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/91/Jagger-Richards.jpg/268px-Jagger-Richards.jpg"
                             height="48" width="48">

                        <h2 class="post-title">Introducing Pure</h2>

                        <p class="post-meta">
                            By <a href="#" class="post-author">Jagger-Richards</a> under <a class="post-category post-category-design" href="#">CSS</a> <a class="post-category post-category-pure" href="#">Pure</a>
                        </p>
                    </header>

                    <div class="post-description">
                        <p>
                           <?php get_component('sidebar');	?>
                        </p>
                    </div>
                </section>
            </div>

            <div class="posts">
                <h1 class="content-subhead">Recent Posts</h1>

                <section class="post">
                    <header class="post-header">
                        <img class="post-avatar"
                             alt="John Lennon" src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/79/John_Lennon_NY_1964.png/120px-John_Lennon_NY_1964.png"
                             height="48" width="48">

                        <h2 class="post-title"><?php get_page_title(); ?></h2>

                        <p class="post-meta">
                            By <a class="post-author" href="#">Lennon-McCartney</a> under <a class="post-category post-category-js" href="#">JavaScript</a>
                        </p>
                    </header>

                    <div class="post-description">
                        <p>
                           <?php get_page_content(); ?>
                        </p>
                    </div>
                </section>


            </div>

            <footer class="footer">
                <div class="pure-menu pure-menu-horizontal pure-menu-open">
                    <ul>
                        <li><a href="http://purecss.io/">About</a></li>
                        <li><a href="http://twitter.com/yuilibrary/">Twitter</a></li>
                        <li><a href="http://github.com/yui/pure/">Github</a></li>
						<li><?php get_site_credits(); ?></li>
                    </ul>
                </div>
            </footer>
        </div>
    </div>
</div>

<!-- End Document
================================================== -->
<?php get_footer(); ?>
</body>
</html>