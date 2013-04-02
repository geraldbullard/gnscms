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
  <div id="siteWrapper" style="width:<?php echo siteWidth . ';' . ((siteWidth != '100%') ? ' margin:0 auto 0 auto;' : ''); ?>">
    <div id="headerWrapper">
      <div id="navMenu">  
        <ul>
<?php
  foreach ($pageListResults['results'] as $pages) {
    if ( $pages->status == 1 && $pages->title != '404' ) {
      $pagesURL = '<a href="' . gen_seo_friendly_titles($pages->title) . '.html">' . htmlspecialchars($pages->title) . '</a>';
?>
          <li><?php echo $pagesURL; ?></li>
<?php
    }
  }
?>
        </ul>
        <div style="clear: both;"></div>
      </div>
    </div>
    <div id="contentWrapper">
<?php
  // get the needed view type and show the content
  if (isset($view) && $view == 'viewPage') {
    require('block/viewPage.php');
  } else if (isset($view) && $view == 'viewArticle') {
    require('block/viewArticle.php');
  } else if (isset($view) && $view == 'listPages') {
    require('block/listPages.php');
  } else if (isset($view) && $view == 'listArticles') {
    require('block/listArticles.php');
  } else {
    require('block/notFound.php');
  }
?>
    </div>
    <div id="footerWrapper">
    </div>
  </div>
  <?php require('theme/' . siteTheme . '/bottom.php'); ?>
</body>
</html>