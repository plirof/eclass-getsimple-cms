<?php if(!defined('IN_GS')){die('You cannot load this page directly!');}
/****************************************************
*
* @File:      template.php
* @Package:   GetSimple
* @Action:    PureBootstrap theme for GetSimple CMS
* @Author:    John Stray [https://www.johnstray.id.au/]
*
*****************************************************/
require('header.inc.php'); ?>

  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        
        <!-- Page Title -->
        <h1 class="page-header"><?php get_page_title(); ?></h1>
        
        <!-- Breadcrumbs : Defined in functions.php -->
        <ol class="breadcrumb">
          <?php bootstrap_get_breadcrumbs(); ?>
        </ol>
        
      </div>
    </div>
    
    <!-- Page Content -->
    <?php get_page_content(); ?>
    
  </div>
  
<?php require('footer.inc.php'); ?>
