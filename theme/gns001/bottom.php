<?php
  /**
   * $Id: script.php, v 1.0.0 2009/01/07 datazen Exp $ :: updated 2012/06/20 maestro Exp $
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
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="inc/js/jquery-1.8.3.min.js"><\/script>')</script>
<?php
  $jsScriptDir = 'theme/' . siteTheme . '/js/';
  $files = scandir($jsScriptDir);
  foreach ($files as $file) {
    if ($file != "." && $file != "..") {
      if (!is_dir($jsScriptDir . $file) === true) {
        echo '  <script src="' . $jsScriptDir . $file . '" /></script>' . "\n";
      }
    }
  }
  if (googleAnalytics != '' && googleAnalytics != 'UA-XXXXX-X') { 
?>
  <script>
    var _gaq=[['_setAccount', '<?php echo googleAnalytics; ?>'],['_trackPageview']];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));
  </script>
<?php 
  } 
?>
