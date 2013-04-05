<?php
  /**
   * $Id: main.php, v 1.0.0 2009/01/07 datazen Exp $ :: updated 2012/06/20 maestro Exp $
   *
   * gnsPLANET.com - The Foundation of Development & Research for the New Millenium
   * http://www.gnsplanet.com/
   * 
   * 3G Development - The Ultimate in Design, Functionality and Service
   * http://www.3g-dev.com/
   * 
   * Copyright © 2010 gnsPLANET, LLC. All rights reserved.
   * Copyright © 2012 3G Development. All rights reserved.
   * 
   */
?>
<?php require('theme/' . siteTheme . '/head.php'); ?>   
<body>
  <div class="container">

    <header class="header clearfix">
      <div class="logo">.Simpliste</div>

      <nav class="menu_main">
        <ul>
<?php
  /*foreach ($categoryListResults['results'] as $categories) {
    if ( $categories->status == 1 && $categories->title != '404') {
      $categoriesURL = '<a href="' . gen_seo_friendly_titles($categories->slug) . '.html">' . htmlspecialchars($categories->title) . '</a>';
?>
          <li><?php echo $categoriesURL; ?></li>
<?php
    }
  }*/
?>
<?php
  foreach ($pageListResults['results'] as $pages) {
    if ( $pages->status == 1 && $pages->title != '404') {
      $pagesURL = '<a href="' . gen_seo_friendly_titles($pages->slug) . '.html">' . htmlspecialchars($pages->title) . '</a>';
?>
          <li><?php echo $pagesURL; ?></li>
<?php
    }
  }
?>
        </ul>
      </nav>
    </header>

    <div class="info">
<?php
  // get the needed view type and show the content
  if (isset($view) && $view == 'viewCategory') {
    if (file_exists('theme/' . siteTheme . '/inc/block/viewCategory.php')) {
      include('theme/' . siteTheme . '/inc/block/viewCategory.php');
    } else {
      include('block/viewCategory.php');
    }
  } else if (isset($view) && $view == 'viewPage') {
    if (file_exists('theme/' . siteTheme . '/inc/block/viewPage.php')) {
      include('theme/' . siteTheme . '/inc/block/viewPage.php');
    } else {
      include('block/viewPage.php');
    }
  } else if (isset($view) && $view == 'viewArticle') {
    if (file_exists('theme/' . siteTheme . '/inc/block/viewArticle.php')) {
      include('theme/' . siteTheme . '/inc/block/viewArticle.php');
    } else {
      include('block/viewArticle.php');
    }
  } else if (isset($view) && $view == 'listPages') {
    if (file_exists('theme/' . siteTheme . '/inc/block/listPages.php')) {
      include('theme/' . siteTheme . '/inc/block/listPages.php');
    } else {
      include('block/listPages.php');
    }
  } else if (isset($view) && $view == 'listArticles') {
    if (file_exists('theme/' . siteTheme . '/inc/block/listArticles.php')) {
      include('theme/' . siteTheme . '/inc/block/listArticles.php');
    } else {
      include('block/listArticles.php');
    }
  } else {
    if (file_exists('theme/' . siteTheme . '/inc/block/notFound.php')) {
      include('theme/' . siteTheme . '/inc/block/notFound.php');
    } else {
      include('block/notFound.php');
    }
  }
?>
    </div>
    
    <footer class="footer clearfix">
      <div class="copyright">&copy; 2012 gnsCMS</div>

      <nav class="menu_bottom">
        <ul>
<?php
  /*foreach ($categoryListResults['results'] as $categories) {
    if ( $categories->status == 1 && $categories->title != '404') {
      $categoriesURL = '<a href="' . gen_seo_friendly_titles($categories->slug) . '.html">' . htmlspecialchars($categories->title) . '</a>';
?>
          <li><?php echo $categoriesURL; ?></li>
<?php
    }
  }*/
?>
<?php
  foreach ($pageListResults['results'] as $pages) {
    if ( $pages->status == 1 && $pages->title != '404') {
      $pagesURL = '<a href="' . gen_seo_friendly_titles($pages->slug) . '.html">' . htmlspecialchars($pages->title) . '</a>';
?>
          <li><?php echo $pagesURL; ?></li>
<?php
    }
  }
?>
        </ul>
      </nav>
    </footer>

  </div>
  <?php require('theme/' . siteTheme . '/bottom.php'); ?>
</body>
</html>