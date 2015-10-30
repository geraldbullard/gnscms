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
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="description" content="<?php echo (isset($results['page']->metaDescription) && $results['page']->metaDescription != '') ? htmlspecialchars($results['page']->metaDescription) : siteDescription; ?>">
  <meta name="keywords" content="<?php echo (isset($results['page']->metaKeywords) && $results['page']->metaKeywords != '') ? htmlspecialchars($results['page']->metaKeywords) : siteKeywords; ?>">
  <meta name="application-name" content="<?php echo htmlspecialchars(siteName); ?>" />
  <meta name="robots" content="<?php echo (isset($results['page']->botAction) && $results['page']->botAction != '') ? $results['page']->botAction : 'index, follow'; ?>" />
  <?php
    echo $gns_RCI->get('meta', 'add');
  ?>
  <link href="theme/bootstrap3/css/bootstrap.css" rel="stylesheet">
  <link href="theme/bootstrap3/css/modern-business.css" rel="stylesheet">
  <link href="theme/bootstrap3/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <?php
    echo $gns_RCI->get('stylesheet', 'add');
    echo $gns_RCI->get('headbottom', 'add');
  ?>
</head>
