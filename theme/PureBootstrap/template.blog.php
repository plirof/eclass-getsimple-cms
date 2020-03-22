<?php if(!defined('IN_GS')){die('You cannot load this page directly!');}
/****************************************************
*
* @File:      template.blog.php
* @Package:   GetSimple
* @Action:    PureBootstrap theme for GetSimple CMS
* @Author:    John Stray [https://www.johnstray.id.au/]
*
*****************************************************/
require('header.inc.php');?>

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
    
    <div class="row">
      <div class="col-lg-8">
      
        <!-- Page Content -->
        <?php get_page_content(); ?>
        
      </div>
      <div class="col-lg-4">
        
        <!-- Blog Search Widget -->
        <div class="well">
          <h4>Blog Search</h4>
          <?php bootstrap_get_blog_search(); ?>
        </div>
        
        <!-- Blog Categories Widget -->
        <div class="well">
          <h4>Blog Categories</h4>
          <?php bootstrap_get_blog_categories(); ?>
        </div>
        
        <!-- Blog Archives Widget -->
        <div class="well">
          <h4>Blog Archives</h4>
          <ul class="list-unstyled">
            <?php bootstrap_get_blog_archives(); ?>
          </ul>
        </div>
        
      </div>
    </div>
    
  </div>
  
<?php require('footer.inc.php'); ?>
