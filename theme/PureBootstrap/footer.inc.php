<?php if(!defined('IN_GS')){die('You cannot load this page directly!');}
/****************************************************
*
* @File:      footer.inc.php
* @Package:   GetSimple
* @Action:    PureBootstrap theme for GetSimple CMS
* @Author:    John Stray [https://www.johnstray.id.au/]
*
*****************************************************/
?>

  <footer>
    <div class="container">
      <hr>
      <div class="row">
        <div class="col-lg-12">
          
          <p>Copyright <?php echo date('Y'); ?> &copy; <a href="<?php get_site_url(); ?>" title="<?php get_site_name(); ?>"><?php get_site_name(); ?></a> - All Rights Reserved</p>
          <p>Powered by: <a href="http://get-simple.info/" target="_new">GetSimple CMS</a>
          
        </div>
      </div>
    </div>
  </footer>
  
  <!-- Include the JavaScripts -->
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script><!-- jQuery Core -->
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script><!-- Bootstrap Core -->
  <script src="<?php get_theme_url(); ?>/assets/js/reina.min.js"></script><!-- RetinaJS by Imulus -->
  <script src="<?php get_theme_url(); ?>/assets/js/bootstrapValidator.min.js"></script><!-- jQuery Validation -->
  <?php if(get_page_slug(FALSE) == 'index') { ?>
  <script src="<?php get_theme_url(); ?>/assets/js/validationRules.js"></script><!-- Validation Rules -->
  <?php } ?>
  
</body>

</html>
