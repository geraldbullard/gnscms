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
   require('theme/simplesoft/func.php');
   require('theme/simplesoft/head.php'); 
?>
<body>
  <div class="container">
    
    <header class="header clearfix">
      <div class="logo">.Simpliste</div>
      <div style="float:right;">
        <div id="smoothmenu" class="ddsmoothmenu" style="border-left: 1px solid #778;">
<?php
  echo getMenu();
?>
        </div>
      </div>
    </header>

    <div class="info">
<?php
  // get the needed view type and show the content
  if (isset($view) && $view == 'viewContent') {
    if (file_exists('theme/simplesoft/block/viewContent.php')) {
      include('theme/simplesoft/block/viewContent.php');
    } else {
      include('block/viewContent.php');
    }
  } else {
    if (file_exists('theme/simplesoft/block/notFound.php')) {
      include('theme/simplesoft/block/notFound.php');
    } else {
      include('block/notFound.php');
    }
  }
?>
    </div>
    
    <footer class="footer clearfix">
      <div class="copyright">&copy; 2012 gnsCMS</div>
    </footer>

  </div>
  <?php require('theme/simplesoft/bottom.php'); ?>
</body>
</html>