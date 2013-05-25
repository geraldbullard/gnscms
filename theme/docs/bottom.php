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
  <script>
    $(document).ready(function() {
      var newWidth = $(window).width()-260;
      $("body").css("width", newWidth);
      $('#drilldown').dcDrilldown();
      $('#menu-trigger').sidr();
      $('#menu-trigger').click(function(){
        $("body").css("width", newWidth);
        var triggerSrc = ($('#menu-trigger img').attr('src') === 'theme/docs/img/right-arrow.png') ? 'theme/docs/img/left-arrow.png' : 'theme/docs/img/right-arrow.png';
        $('#menu-trigger img').attr('src', triggerSrc);
      });
    });    
    <?php if (googleAnalytics > 'UA-') { ?>// Google Analytics
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', '<?php echo googleAnalytics; ?>']);
    _gaq.push(['_trackPageview']);     
    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
    <?php } ?> 
  </script>
