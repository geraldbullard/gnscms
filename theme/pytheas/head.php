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
  <link href="favicon.ico" rel="shortcut icon">
  <meta name="description" content="<?php echo (isset($results['page']->metaDescription) && $results['page']->metaDescription != '') ? htmlspecialchars($results['page']->metaDescription) : siteDescription; ?>">
  <meta name="keywords" content="<?php echo (isset($results['page']->metaKeywords) && $results['page']->metaKeywords != '') ? htmlspecialchars($results['page']->metaKeywords) : siteKeywords; ?>">
  <meta name="viewport" content="width=device-width">
  <meta name="application-name" content="<?php echo htmlspecialchars(siteName); ?>" />
  <meta name="robots" content="<?php echo (isset($results['page']->botAction) && $results['page']->botAction != '') ? $results['page']->botAction : 'index, follow'; ?>" />
  <?php
    echo $gns_RCI->get('meta', 'add');
  ?>
  <link rel="stylesheet" href="theme/pytheas/css/contact.css" media="all" />
  <link rel="stylesheet" href="theme/pytheas/css/symple.css" media="all" />
  <link rel="stylesheet" href="theme/pytheas/css/style.css" media="all" />
  <link rel="stylesheet" href="theme/pytheas/css/prettyphoto.css" media="all" />
  <link rel="stylesheet" href="theme/pytheas/css/font-awesome.min.css" media="all" />  
  <link rel="stylesheet" href="inc/css/fpgallery.css" media="all" />
  <link rel="stylesheet" href="inc/css/colorbox.css" media="all" />
  <?php
    echo $gns_RCI->get('css', 'add');
  ?>
  <script src="theme/pytheas/js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  <script src='theme/pytheas/js/jquery-1.9.1.min.js'></script>
  <script src='theme/pytheas/js/jquery-migrate-1.2.1.min.js'></script>
  <!--[if lt IE 9]>
  <link rel="stylesheet" href="theme/pytheas/css/ancient-ie.css" />
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
  <![endif]-->
  <!--[if IE 7]>
  <link rel="stylesheet" href="theme/pytheas/css/font-awesome-ie7.min.css" media="screen" />
  <link rel="stylesheet" href="theme/pytheas/css/antient-ie.css" media="screen" />
  <![endif]-->
  <?php
    echo $gns_RCI->get('headbottom', 'add');
  ?>
</head>
