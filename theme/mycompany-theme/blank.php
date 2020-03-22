<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File: 			template.php
* @Package:		GetSimple
* @Action:		myCompany theme for GetSimple CMS
*
*****************************************************/

# Include the header template
include('header.inc.php'); 
include('breadcrumbs.inc.php');
?>

	<div id="main-container">
		<div class="inmain">
    <div id="main" class="wrapper clearfix blank">
			
			<article>
        <header>
          <h1><?php get_page_title(); ?></h1>
				</header>
				<section>
				  <?php get_page_content(); ?>  
				</section>

			<p class="date">Published on <time datetime="<?php get_page_date('Y-m-d'); ?>" pubdate><?php get_page_date('F jS, Y'); ?></time></p>

			</article>
	
		</div> <!-- #main -->
		</div>
	</div> <!-- #main-container -->

<?php 
# Include the header template
include('footer.inc.php'); ?>