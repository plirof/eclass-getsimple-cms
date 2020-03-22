<?php if(!defined('IN_GS')){die('You cannot load this page directly!');}
/****************************************************
*
* @File:      template.sidebar-r.php
* @Package:   GetSimple
* @Action:    PureBootstrap theme for GetSimple CMS
* @Author:    John Stray [https://www.johnstray.id.au/]
*
*****************************************************/
require('header.inc.php'); ?>

  <div class="container">
    <div class="row">
      <div class="col-md-9 col-sm-8">
        
        <!-- Page Title -->
        <h1 class="page-header"><?php get_page_title(); ?></h1>
        
        <!-- Breadcrumbs : Defined in functions.php -->
        <ol class="breadcrumb">
          <?php bootstrap_get_breadcrumbs(); ?>
        </ol>
        
        <!-- Page Content -->
        <?php get_page_content(); ?>
        
      </div>
      <div class="col-md-3 col-sm-4 sidebar">
      
        <!-- Get the Sidebar -->
        <?php include('sidebar.inc.php'); ?>
      
      </div>
    </div>
  </div>
  
<?php require('footer.inc.php'); ?>
