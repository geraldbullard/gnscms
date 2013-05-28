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
   require('theme/docs/func.php');
   require('theme/docs/head.php'); 
   //echo getMenu();
?>
<body style="position: absolute; left: 260px;">    
  <div id="sidr" style="display: block; left: 0px;">
    <div class="graphite">
      <?php echo getMenu(); ?>
    </div>
    <div class="clear"></div>
  </div>
  <a id="menu-trigger" href="#sidr" title="Open Menu"><img src="theme/docs/img/left-arrow.png" /></a>
  <div id="main-content">
<?php
  // get the needed view type and show the content
  if (isset($view) && $view == 'viewContent') {
    if (file_exists('theme/docs/block/viewContent.php')) {
      include('theme/docs/block/viewContent.php');
    } else {
      include('block/viewContent.php');
    }
  } else {
    if (file_exists('theme/docs/block/notFound.php')) {
      include('theme/docs/block/notFound.php');
    } else {
      include('block/notFound.php');
    }
  }
?>
  </div>
  <?php require('theme/docs/bottom.php'); ?>
</body>
</html>