<?php
  /**
   * $Id: head.php, v 1.0.0 2009/01/07 datazen Exp $ :: updated 2012/06/20 maestro Exp $
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
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo (isset($results['page']->title) && $results['page']->title != '') ? htmlspecialchars($results['page']->title) : siteName; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="description" content="<?php echo (isset($results['page']->metaDescription) && $results['page']->metaDescription != '') ? htmlspecialchars($results['page']->metaDescription) : siteDescription; ?>">
  <meta name="keywords" content="<?php echo (isset($results['page']->metaKeywords) && $results['page']->metaKeywords != '') ? htmlspecialchars($results['page']->metaKeywords) : siteKeywords; ?>">
  <meta name="viewport" content="width=device-width">
  <meta name="application-name" content="<?php echo htmlspecialchars(siteName); ?>" />
  <meta name="robots" content="<?php echo (isset($results['page']->botAction) && $results['page']->botAction != '') ? $results['page']->botAction : 'index, follow'; ?>" />
  <?php
    echo $gns_RCI->get('meta', 'add');
  ?>
  <link rel="stylesheet" href="theme/rockband/css/reset.css">
  <link rel="stylesheet" href="theme/rockband/css/style.css">
  <link rel="stylesheet" href="theme/rockband/css/prettyPhoto.css">   
  <link rel="stylesheet" href="theme/rockband/css/zerogrid.css">
  <link rel="stylesheet" href="theme/rockband/css/responsive.css">
  <link rel="stylesheet" href="theme/rockband/css/responsiveslides.css">
  <script src="theme/rockband/js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  <script src="theme/rockband/js/jquery-1.9.1.min.js"></script>
  <script src="theme/rockband/js/jquery-migrate-1.2.1.min.js"></script>  
  <script src="theme/rockband/js/cufon-yui.js"></script>
  <script src="theme/rockband/js/cufon-replace.js"></script>
  <script src="theme/rockband/js/Vegur_700.font.js"></script>
  <script src="theme/rockband/js/Vegur_400.font.js"></script> 
  <script src="theme/rockband/js/FF-cash.js"></script> 
  <script src="theme/rockband/js/script.js"></script>
  <script src="theme/rockband/js/easyTooltip.js"></script>
  <script src="theme/rockband/js/jquery.easing.1.3.js"></script>
  <script src="theme/rockband/js/hover-image.js"></script>
  <script src="theme/rockband/js/jquery.prettyPhoto.js"></script>
  <script src="theme/rockband/js/jquery.easing.1.3.js"></script>
  <script src="theme/rockband/js/tms-0.3.js"></script>
  <script src="theme/rockband/js/tms_presets.js"></script>     
  <script src="theme/rockband/js/responsiveslides.js"></script>
  <script>
    $(function () {
      $("#slider").responsiveSlides({
      auto: true,
      pager: false,
      nav: true,
      speed: 500,
      maxwidth: 960,
      namespace: "centered-btns"
      });
    });
  </script>  
  <!--[if lt IE 7]>
    <div style="clear: both; text-align:center; position: relative;">
      <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
        <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today.">
      </a>
    </div>
  <![endif]-->
  <!--[if lt IE 9]>
    <link rel="stylesheet" href="theme/rockband/css/ie.css">
    <script src="theme/rockband/js/html5.js"></script>
    <script src="theme/rockband/css3-mediaqueries.js"></script>
  <![endif]-->
  <?php
    echo $gns_RCI->get('headbottom', 'add');
  ?>
</head>