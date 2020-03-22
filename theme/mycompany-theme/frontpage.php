<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File: 			template.php
* @Package:		GetSimple
* @Action:		myCompany theme for GetSimple CMS
*
*****************************************************/

# Include the header template
include('header.inc.php'); ?>

	<div id="main-container">
		<div class="inmain">
    <div id="main" class="wrapper clearfix frontpage">
			
			<article>
        <header>
          <h1><?php get_page_title(); ?></h1>
				</header>
				<section>
				  <?php get_page_content(); ?>  
				</section>
			</article>
      <aside>
      <img src="<?php get_theme_url(); ?>/customize/titleimage.png" alt="Notebook with screenshot" />
      </aside>
<!---			
			<aside>
				<h3>aside</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero, eget molestie nisl pharetra in. In semper consequat est, eu porta velit mollis nec. Curabitur posuere enim eget turpis feugiat tempor. Etiam ullamcorper lorem dapibus velit suscipit ultrices.</p>
			</aside>
-->			
			
		</div> <!-- #main -->
		</div>
	</div> <!-- #main-container -->

<?php 
# Include the footer template
include('footer.inc.php'); ?>