<?php
  /**
   * $Id: top.php, v 1.0.0 2009/01/07 datazen Exp $ :: updated 2012/06/20 maestro Exp $
   *
   * gnsPLANET.com - The Foundation of Development & Research for the New Millenium
   * http://www.gnsplanet.com/
   * 
   * 3G Development - The Ultimate in Design, Functionality and Service
   * http://www.3g-dev.com/
   * 
   * Copyright � 2010 gnsPLANET, LLC. All rights reserved.
   * Copyright � 2012 3G Development. All rights reserved.
   * 
   */
   
  // get all the needed core code
  if (is_file('admin/inc/config.php')) {
    require('admin/inc/config.php');  
  } else {
    header('Location: admin/install.php');
  }
  require('admin/inc/func/general.php');  
  require('admin/inc/class/Content.class.php');
  require('admin/inc/class/Setting.class.php');
  
  // set php_self in the local scope
  $PHP_SELF = $_SERVER['SCRIPT_NAME'];
  
  // do the session stuff
  session_start();
  set_exception_handler('handleException');
  ob_start();
  
  // get the settings and define them for site wide usage
  mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
  mysql_select_db(DB_NAME);
  $indexPage = mysql_fetch_array(mysql_query("SELECT slug FROM " . DB_PREFIX . "content WHERE siteIndex = 1"));
  $settingsQuery = mysql_query("SELECT define, value FROM " . DB_PREFIX . "settings");
  while ($settings = mysql_fetch_array($settingsQuery)) {
    define($settings['define'], $settings['value']);
  }
  
  // always get the full content results for the menu and infobox blocks etc
  $fullResults = array();
  $fullResults = Content::getFullList();
  
  // get the needed data results from the database and show the content
  if (isset($_GET['locationName']) && $_GET['locationName'] != '') {
    $contentResults = array();
    $contentResults = Content::getBySlug( $_GET['locationName'] );
    if ( $contentResults->status != 1 ) {
      header('Location: 404.html');
    }
    $view = 'viewContent';
  } else {
    $contentResults = array();
    $contentResults = Content::getBySlug( $indexPage['slug'] );
    $view = 'viewContent';
    header('Location: ' . $indexPage['slug'] . '.html');
  }
  
  // get the side blocks for the page
  try {
    $leftBlocks = array();
    $rightBlocks = array();
    
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD); 
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    
    $stl = $pdo->prepare("SELECT title, filename, sort FROM " . DB_PREFIX . "blocks where contentId = :contentId and side = 'l' order by sort asc");
    $stl->bindValue(":contentId", $contentResults->id, PDO::PARAM_INT);
    $stl->execute();
    
    $leftBlocks = $stl->fetchAll();
    $stl->closeCursor();
  
    $str = $pdo->prepare("SELECT title, filename, sort FROM " . DB_PREFIX . "blocks where contentId = :contentId and side = 'r' order by sort asc");
    $str->bindValue(":contentId", $contentResults->id, PDO::PARAM_INT);
    $str->execute();
    
    $rightBlocks = $str->fetchAll();
    $str->closeCursor();
    
    if ($leftBlocks != null) {
      $hasLeft = true;
    } 
    if ($rightBlocks != null) {
      $hasRight = true;
    }
    
    $pdo = null;    
  } catch(PDOException $e) {
    echo "ERROR: " . $e->getMessage();
  }
  
  require('inc/class/rci.php');
  $gns_RCI = new gns_RCI;
  
  echo $gns_RCI->get('top', 'add', false);
?>