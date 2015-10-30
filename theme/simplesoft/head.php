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
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <title><?php echo (isset($results['content']->title) && $results['content']->title != '') ? htmlspecialchars($results['content']->title) : siteName; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  <link href="favicon.ico" rel="shortcut icon">
  <meta name="description" content="<?php echo (isset($results['content']->metaDescription) && $results['content']->metaDescription != '') ? htmlspecialchars($results['content']->metaDescription) : siteDescription; ?>">
  <meta name="keywords" content="<?php echo (isset($results['content']->metaKeywords) && $results['content']->metaKeywords != '') ? htmlspecialchars($results['content']->metaKeywords) : siteKeywords; ?>">
  <meta name="viewport" content="width=device-width">
  <meta name="application-name" content="<?php echo htmlspecialchars(siteName); ?>" />
  <meta name="robots" content="<?php echo (isset($results['content']->botAction) && $results['content']->botAction != '') ? $results['content']->botAction : 'index, follow'; ?>" />
  <link rel="stylesheet" type="text/css" href="theme/simplesoft/css/style.css" />
  <script src="theme/simplesoft/js/modernizr-2.5.3.min.js"></script>
  <script src="<?php echo (($request_type == 'SSL') ? 'https:' : 'http:'); ?>//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="theme/simplesoft/css/menu.css" />
  <script src="theme/simplesoft/js/menu.js"></script>
  <script>
    if (typeof jQuery == 'undefined') {
      document.write(unescape('%3Cscript src="theme/<?php echo siteTheme; ?>/js/jquery-1.8.3.min.js"%3C/script%3E'));
    }
    $(document).ready(function() {
      // template specific code here
    });
  </script>
</head>
