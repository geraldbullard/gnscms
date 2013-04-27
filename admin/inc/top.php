<?php
  require('inc/config.php');
  require('inc/functions/general.php');
  require('inc/classes/Content.php');
  require('inc/classes/Setting.php');
  
  // set the type of request (secure or not) // save for later - maestro
  $request_type = (getenv('HTTPS') == 'on') ? 'SSL' : 'NONSSL';
  if ($request_type == 'NONSSL') {
    define('DIR_WS_MAIN', HTTP_SERVER . DIR_WS_CONTENT);
  } else {
    define('DIR_WS_MAIN', HTTPS_SERVER . DIR_WS_CONTENT);
  }
  
  // set php_self in the local scope
  $PHP_SELF = $_SERVER['SCRIPT_NAME'];
  
  session_start();
  set_exception_handler('handleException');
  
  // get the settings and define them for site wide usage
  mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
  mysql_select_db(DB_NAME);
  
  $settingsQuery = mysql_query("SELECT define, value FROM " . DB_PREFIX . "settings");
  while ($settings = mysql_fetch_array($settingsQuery)) {
    define($settings['define'], $settings['value']);
  }
  
  if (($_SERVER['REQUEST_URI'] != 'login.php') && ($_SERVER['REQUEST_URI'] != $_SESSION['oldURL'])) {
    $_SESSION['oldURL'] = $_SERVER['REQUEST_URI'];    
  }
  
  if (!isset($_SESSION['authuser'])) {
    if (stristr($_SERVER['HTTP_REFERER'], 'install.php')) {
      header("Location: login.php?action=firstLogin");
    } else {
      header("Location: login.php?action=notLogged");
    }
  } else {
    $now = time(); // checking the time now when home page starts 
    if ($now > $_SESSION['sessionExpire']) {
      $_SESSION['oldURL'] = isset($_GET['action']) ? 'index.php?action=' . $_GET['action'] : '';
      session_destroy();
      if (($_SERVER['REQUEST_URI'] != 'login.php') && ($_SERVER['REQUEST_URI'] != $_SESSION['oldURL'])) {
        $_SESSION['oldURL'] = $_SERVER['REQUEST_URI'];    
      }
      header("Location: login.php?action=sessionExpired");
    } else {
      $_SESSION['sessionStart'] = time();
      $_SESSION['sessionExpire'] = $_SESSION['sessionStart'] + (sessionExpire * 60);
    }
  }
  
  $action = isset($_GET['action']) ? $_GET['action'] : '';
?>