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

  <!-- Scripts -->
  <script type="text/javascript" src="<?php echo (($request_type == 'SSL') ? 'https:' : 'http:'); ?>//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script type="text/javascript">
    if (typeof jQuery == 'undefined') {
      document.write(unescape('%3Cscript src="theme/<?php echo siteTheme; ?>/js/jquery-1.8.3.min.js"%3C/script%3E'));
    }
    $(document).ready(function() {
      // template specific code here
    });
  </script>
