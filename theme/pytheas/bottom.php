<?php
  /**
   * $Id: bottom.php, v 1.0.0 2009/01/07 datazen Exp $ :: updated 2012/06/20 maestro Exp $
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
  <!-- JavaScript at the bottom for fast page loading -->
  <script src="theme/pytheas/js/jquery.form.min.js"></script>
  <script>
    /* <![CDATA[ */
    var _wpcf7 = {"loaderUrl":"theme\/pytheas\/img\/ajax-loader.gif", "sending":"Sending ...", "cached":"1"};
    /* ]]> */
  </script>
  <script src="theme/pytheas/js/scripts.js"></script>
  <script src="theme/pytheas/js/devicepx-jetpack.js"></script>
  <script>
    /* <![CDATA[ */
    var lightboxLocalize = {"theme":"pp_default"};
    /* ]]> */
  </script>
  <script src="theme/pytheas/js/prettyphoto.js"></script>
  <script src="theme/pytheas/js/prettyphoto-init.js"></script>
  <script src="theme/pytheas/js/global.js"></script>
  <script src="theme/pytheas/js/flexslider.js"></script>
  <script>
    /* <![CDATA[ */
    var flexLocalize = {"slideshow":"true", "randomize":"false", "animation":"slide", "direction":"horizontal", "slideshowSpeed":"7000", "animationSpeed":"600"};
    /* ]]> */
  </script>
  <script src="theme/pytheas/js/slider-home.js"></script>
  <script src="theme/pytheas/js/symple_googlemap.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
  <script src="theme/pytheas/js/symple_skillbar.js"></script>
  <script src="theme/pytheas/js/symple_toggle.js"></script>
  <script src="theme/pytheas/js/jquery.ui.core.min.js"></script>
  <script src="theme/pytheas/js/jquery.ui.widget.min.js"></script>
  <script src="theme/pytheas/js/jquery.ui.accordion.min.js"></script>
  <script src="theme/pytheas/js/symple_accordion.js"></script>
  <script src="theme/pytheas/js/jquery.ui.tabs.min.js"></script>
  <script src="theme/pytheas/js/symple_tabs.js"></script>
  <script src="inc/js/fpgallery.js"></script>
  <script src="inc/js/jquery.colorbox-min.js"></script>
  <?php
    echo $gns_RCI->get('templatebottom', 'add');
  ?>