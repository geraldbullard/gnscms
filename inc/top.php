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
   * Copyright © 2010 gnsPLANET, LLC. All rights reserved.
   * Copyright © 2012 3G Development. All rights reserved.
   * 
   */
   
  // get all the needed core code
  if (is_file('admin/inc/config.php')) {
    require('admin/inc/config.php');  
  } else {
    header('Location: admin/install.php');
  }
  require('admin/inc/functions/general.php');  
  require('admin/inc/classes/Category.php');
  require('admin/inc/classes/Page.php');
  require('admin/inc/classes/Setting.php');
  
  // set php_self in the local scope
  $PHP_SELF = $_SERVER['SCRIPT_NAME'];
  
  // do the session stuff
  set_exception_handler('handleException');
  session_start();
  
  // get the settings and define them for site wide usage
  mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
  mysql_select_db(DB_NAME);
  $indexPage = mysql_fetch_array(mysql_query("SELECT slug FROM " . DB_PREFIX . "pages WHERE siteIndex = 1"));
  $settingsQuery = mysql_query("SELECT define, value FROM " . DB_PREFIX . "settings");
  while ($settings = mysql_fetch_array($settingsQuery)) {
    define($settings['define'], $settings['value']);
  }
  
  // always get the categories list results for the menu and infobox blocks etc
  $categoryListResults = array();
  $categoryListResults = Category::getCategoryList();
  
  // always get the pages list results for the menu and infobox blocks etc
  $pageListResults = array();
  $pageListResults = Page::getPageList();
  
  // get the needed data results from the database and show the content
  if (isset($_GET['locationName']) && $_GET['locationName'] != '') {
    $categoryResults = array();
    $categoryResults = Category::getByCategorySlug( $_GET['locationName'] );
    $pageResults = array();
    $pageResults = Page::getByPageSlug( $_GET['locationName'] );
    if ($categoryResults->slug == $_GET['locationName']) {
      if ( $categoryResults->status != 1 ) {
        header('Location: 404.html');
      }
      $view = 'viewCategory';
      $subCategoryResults = array();
      $subCategoryResults = Category::getByCategoryList( $categoryResults->id );
    } else if ($pageResults->slug == $_GET['locationName']) {
      if ( $pageResults->status != 1 ) {
        header('Location: 404.html');
      }
      $view = 'viewPage';
    }
  } else {
    $pageResults = array();
    $pageResults = Page::getByPageSlug( $indexPage['slug'] );
    $view = 'viewPage';
  }
?>