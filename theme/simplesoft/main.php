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
  foreach ($topResults['results'] as $content) {
    if ( $content->status == 1 && $content->title != '404') {
      $contentURL = '<a href="' . gen_seo_friendly_titles($content->slug) . '.html">' . htmlspecialchars($content->title) . '</a>';
?>
          <li><?php echo $contentURL; ?></li>
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
  if (isset($view) && $view == 'viewContent') {
    if (file_exists('theme/' . siteTheme . '/inc/block/viewContent.php')) {
      include('theme/' . siteTheme . '/inc/block/viewContent.php');
    } else {
      include('block/viewContent.php');
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
  foreach ($topResults['results'] as $content) {
    if ( $content->status == 1 && $content->title != '404') {
      $contentURL = '<a href="' . gen_seo_friendly_titles($content->slug) . '.html">' . htmlspecialchars($content->title) . '</a>';
?>
          <li><?php echo $contentURL; ?></li>
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