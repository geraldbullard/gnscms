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
   require('theme/default/func.php');
?>
<?php require('theme/default/head.php'); ?>   
<body>
  <div id="siteWrapper" <?php echo 'style="width:' .  siteWidth . ';' . ((siteWidth != '100%') ? ' margin:0 auto 0 auto;' : ''); ?>">
    <div id="headerWrapper">
      <div id="navMenu">  
        <?php echo getMenu(); ?>
        <div style="clear:both;"></div>
      </div>
    </div>
    <div id="contentWrapper">
<?php
  // get the needed view type and show the content
  if (isset($view) && $view == 'viewContent') {
    require('theme/default/block/viewContent.php');
  } else if (isset($view) && $view == 'viewArticle') {
    require('theme/default/block/viewArticle.php');
  } else if (isset($view) && $view == 'listPages') {
    require('theme/default/block/listPages.php');
  } else if (isset($view) && $view == 'listArticles') {
    require('theme/default/block/listArticles.php');
  } else {
    require('theme/default/block/notFound.php');
  }
?>
    </div>
    <div id="footerWrapper">
    </div>
  </div>
  <?php require('theme/default/bottom.php'); ?>
</body>
</html>