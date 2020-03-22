<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File: 			footer.inc.php
* @Package:		GetSimple
* @Action:		myCompany theme for GetSimple CMS
*
*****************************************************/
?>
	<div id="footer-container">
		<footer class="wrapper">
      
       <div class="socialicons">
<?php 
# Include the footer template
include('icons.inc.php'); ?>

        </div>
               
       <div class="logofooter">
          <a href="<?php get_site_url(); ?>" title="<?php get_site_name(); ?>"><img src="<?php get_theme_url(); ?>/customize/logo-bottom.png" title="logo"/></a>
       </div>
      
       <div id="navbottom">
         <ul>
           <?php get_navigation(return_page_slug()); ?>
         </ul>
<!-- 
 Theme Credits
 Please consider keeping the links to the developer and GetSimple if you use this theme
-->   
        <?php echo date('Y'); ?> 
        <a href="<?php get_site_url(); ?>" >
        <?php get_site_name(); ?></a>          <br />
        myCompany Theme by   <a href="http://www.pixelofficer.sk" >PixelOfficer</a><br />          
        <?php get_site_credits(); ?>
             
       </div>

       
		</footer>
		<div class="clearfix"></div>
	</div>

<script src="<?php get_theme_url(); ?>/js/script.js"></script>

<?php get_footer(); ?>

</body>
</html>
