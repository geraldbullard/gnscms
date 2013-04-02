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
  <title><?php echo (isset($results['page']->title) && $results['page']->title != '') ? htmlspecialchars($results['page']->title) : siteName; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  <link href="favicon.ico" rel="shortcut icon">
  <meta name="description" content="<?php echo (isset($results['page']->metaDescription) && $results['page']->metaDescription != '') ? htmlspecialchars($results['page']->metaDescription) : siteDescription; ?>">
  <meta name="keywords" content="<?php echo (isset($results['page']->metaKeywords) && $results['page']->metaKeywords != '') ? htmlspecialchars($results['page']->metaKeywords) : siteKeywords; ?>">
  <meta name="viewport" content="width=device-width">
  <meta name="application-name" content="<?php echo htmlspecialchars(siteName); ?>" />
  <meta name="robots" content="<?php echo (isset($results['page']->botAction) && $results['page']->botAction != '') ? $results['page']->botAction : 'index, follow'; ?>" />
  <link rel="stylesheet" type="text/css" href="theme/<?php echo siteTheme; ?>/css/style.css" />
<?php
  /*$cssPluginDir = 'inc/css/plugins/';
  $files = scandir($cssPluginDir);
  foreach ($files as $file) {
    if ($file != "." && $file != "..") {
      if (!is_dir($cssPluginDir . $file) === true) {
        echo '  <link rel="stylesheet" type="text/css" href="' . $cssPluginDir . $file . '" />' . "\n";
      }
    }
  }*/
?>
  <script src="theme/<?php echo siteTheme; ?>/js/modernizr-2.5.3.min.js"></script>
</head>
