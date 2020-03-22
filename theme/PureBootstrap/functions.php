<?php if(!defined('IN_GS')){die('You cannot load this page directly!');}
/****************************************************
*
* @File:      functions.php
* @Package:   GetSimple
* @Action:    PureBootstrap theme for GetSimple CMS
* @Author:    John Stray [https://www.johnstray.id.au/]
*
*****************************************************/

/**
 * bootstrap_get_title()
 * 
 * This creates the page title for the <title> tags.
 * This function supports the following plugins:
 *   - Custom Title
 *
 * @return (string) : Echos the page title
 */
function bootstrap_get_title() {
  
  if ( function_exists( 'get_custom_title_tag' ) )
  { # Custom Title plugin
    echo get_custom_title_tag();
  }
  else
  { # Default title format
    get_page_clean_title();
    echo " &raquo ";
    get_site_name();
  }
  
}

/**
 * bootstrap_get_navigation()
 *
 * This creates the menu structure for use with the main navigation
 * This function supports drop down menus when the i18n navigation
 * plugin is installed.
 * 
 * @param $slug (string) : The page 'slug' to get the navigation for
 * @return (string) : String containing HTML <ul> list of menu data
 */
function bootstrap_get_navigation($slug) {

  if ( function_exists( 'get_i18n_navigation' ) )
  { # i18n Navigation plugin installed
    $mdata = return_i18n_menu_data( $slug, 0, 99, I18N_SHOW_MENU );
    foreach ( $mdata as $item ) {
      $url = function_exists('find_i18n_url') ? find_i18n_url($item['url'],$item['parent']) : find_url($item['url'],$item['parent']);
      $title = $item['menu'] ? $item['menu'] : $item['title'];
      $class = $item['url'];
      if ( $item['current'] ) { $class .= ' active'; }
      if ( $item['haschildren'] ) { $class .= ' dropdown'; }
      echo '<li class="'.$class.'">';
      if ( is_array($item['children']) ) {
        echo '<a href="" class="dropdown-toggle" data-toggle="dropdown">'.$title.'<b class="caret"></b></a>';
        echo '<ul class="dropdown-menu">';
        echo '<li><a href="'.$url.'">'.$title.'</a></li><li class="divider"></li>';
        foreach ($item['children'] as $k => $v) {
          $c_url = function_exists('find_i18n_url') ? find_i18n_url($v['url'],$v['parent']) : find_url($v['url'],$v['parent']);
          $c_title = $v['menu'] ? $v['menu'] : $v['title'];
          echo '<li><a href="'.$c_url.'">'.$c_title.'</a></li>';
        }
        echo '</ul>';
        echo '</li>';
      } else {
        echo '<a href="'.$url.'">'.$title.'</a></li>';
      }
    }
  }
  else
  { # GetSimple core navigation
    get_navigation($slug);
  }
  
}

/**
 * bootstrap_get_breadcrumbs()
 *
 * This creates the list for breadcrumbs to the current page. Requires
 * i18n Navigation plugin for full breadcrumbs list else it creates
 * a list with only Home / %parent% / %child%
 * This function support the following plugins:
 *   - i18n Navigation (Supported but doesn't format well unless modified)
 *   - SimpleBreadcrumbs v1.0+ (Preferred)
 * 
 * @return (string) : String containing HTML <ul> list of breadcrumb data
 */
function bootstrap_get_breadcrumbs() {
  
  if ( function_exists( 'get_breadcrumbs' ) )
  { # SimpleBreadcrumbs v1.0+
    get_breadcrumbs(return_page_slug());
  }
  elseif ( !function_exists( 'get_i18n_breadcrumbs' ) )
  { # i18n Navigation plugin
    echo '<li><a href="'.get_site_url(FALSE).'">Home</a></li>';
    echo '<li class="current">';
    get_i18n_breadcrumbs(return_page_slug());
    echo '</li>';
  }
  else
  { # No supported plugins found!
    $parent = (string)get_parent(FALSE);
    echo '<li><a href="'.get_site_url(FALSE).'">Home</a></li>';
    if ( !empty( $parent ) && $parent != 'index' ) {
      $file = GSDATAPAGESPATH . $parent . '.xml';
      if ( file_exists($file) )
      {
        $p = getXML($file);
        $p_title = $p->title;
        $p_slug = $p->slug;
        echo '<li><a href="' . find_url($parent,'') . '">' . $p_title . '</a></li>';
      }
    }
    echo '<li class="active">'.get_page_clean_title(FALSE).'</li>';
  }
  
}

/**
 * bootstrap_get_blog_search()
 * 
 * This creates the HTML mark-up for the Blog Search Widget in the
 * blog template sidebar.
 * This function supports the following plugins:
 *   - GetSimple Blog v1.4 & v3.x
 *   - GetSimple Blog v4.0+
 *   - NewsManager v2.0+
 *
 * @return (string) : Echos the HTML mark-up
 */
function bootstrap_get_blog_search() {
  
  if ( function_exists( 'show_blog_search' ) ) 
  { # GetSimple Blog v1.4 & v3.x
    $Blog = new Blog;
    $url = $Blog->get_blog_url(); ?>
    <form role="form" method="post" action="<?php echo $url; ?>">
      <input type="hidden" name="search_blog" value="true">
      <div class="input-group">
        <input type="text" class="form-control" name="keyphrase">
        <span class="input-group-btn">
          <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
        </span>
      </div>
    </form>
  <?php } 
  elseif ( function_exists( 'gsblog_show_search' ) )
  { # GetSimple Blog v4.0+
    gsblog_search_form();
  }
  elseif ( function_exists( 'nm_search_form' ) )
  { # NewsManager v2.0+
    nm_search_form();
  }
  else 
  { # No supported plugins found ?>
    <fieldset disabled>
      <div class="input-group">
        <input type="text" class="form-control">
        <span class="input-group-btn">
          <button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
        </span>
      </div>
    </fieldset>
  <?php }
  
}

/**
 * bootstrap_get_blog_categories()
 * 
 * This creates the HTML mark-up for the Blog Categories Widget in the
 * blog template sidebar.
 * This function supports the following plugins:
 *   - GetSimple Blog v1.4 & v3.x
 *   - GetSimple Blog v4.0+
 *   - NewsManager v2.0+
 *
 * @return (string) : Echos the HTML mark-up
 */
function bootstrap_get_blog_categories() {
  
  if ( function_exists( 'show_blog_categories' ) )
  { # GetSimple Blog v1.4 & v3.x
    $Blog = new Blog;
    $categories = getXML(BLOGCATEGORYFILE);
    $url = $Blog->get_blog_url('category');
    $main_url = $Blog->get_blog_url();
    if(!empty($categories)) {
      if(count($categories) > 1) {
        $counter = 1;
        $categories = call_user_func_array('array_merge', (array)$categories);
        list( $object1, $object2 ) = array_chunk( $categories, ceil(count($categories) / 2) );
        echo '<div class="row"><div class="col-md-6"><ul class="list-unstyled">';
        foreach ($object1 as $left_obj) {
          echo '<li><a href="'.$url.$left_obj.'">'.$left_obj.'</a></li>';
        }
        echo '</ul></div><div class="col-md-6"><ul class="list-unstyled">';
        foreach ($object2 as $right_obj) {
          echo '<li><a href="'.$url.$right_obj.'">'.$right_obj.'</a></li>';
        }
        echo '</ul></div></div>';
      } else {
        echo '<div class="row"><div class="col-md-12"><ul class="list-unstyled">';
        echo '<li><a href="'.$url.$categories->category.'">'.$categories->category.'</a></li>';
        echo '</ul></div></div>';
      }
    } else {
      echo '<p>No categories found!</p>';
    }
  }
  elseif ( function_exists( 'gsblog_show_categories' ) )
  { # SimpleBlog v4.0+
    gsblog_show_categories();
  }
  elseif ( function_exists( 'nm_blog_categories' ) )
  { # NewsManager v2.0+
    nm_blog_categories();
  }
  else
  { # No supported plugins found
    echo "<p>No categories to display!</p>";
  }
  
}

/**
 * bootstrap_get_blog_archives()
 * 
 * This creates the HTML mark-up for the Blog Archives Widget in the
 * blog template sidebar.
 * This function supports the following plugins:
 *   - GetSimple Blog v1.4 & v3.x
 *   - GetSimple Blog v4.0+
 *   - NewsManager v2.0+
 *
 * @return (string) : Echos the HTML mark-up
 */
function bootstrap_get_blog_archives() {
  
  if ( function_exists( 'show_blog_archives' ) ) 
  { # GetSimple Blog v1.4 & v3.x
    $Blog = new Blog;
    $arch = $Blog->get_blog_archives();
    if (!empty($arch)) {
      foreach ($arch as $key => $item) {
        $url = $Blog->get_blog_url('archive') . $key;
        echo '<li class="list-group-item"><a href="'.$url.'">'.$item['title'].'</a><span class="badge">'.$item['count'].'</span></li>';
      }
    } else {
      echo '<li class="list-group-item">Nothing in the Archive!<span class="badge">0</span></li>';
    }
  } 
  elseif ( function_exists( 'gsblog_show_archives' ) )
  { # SimpleBlog v4.0+
    gsblog_show_archives();
  }
  elseif ( function_exists( 'nm_blog_archives' ) )
  { # NewsManager v2.0+
    nm_blog_archives();
  }
  else 
  { # No supported plugins found ?>
    <li class="list-group-item">
      <span class="badge">0</span>
      No archives to show!
    </li>
  <?php }
  
}
