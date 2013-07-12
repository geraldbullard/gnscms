<?php
  require('inc/config.php');
  require('inc/functions/general.php');
  require('inc/classes/Content.class.php');
  require('inc/classes/Group.class.php');
  require('inc/classes/Setting.class.php');
  require('inc/classes/User.class.php');
  
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
  ob_start();
  
  // set the language
  if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    $_SESSION['lang'] = $lang;
    setcookie('lang', $lang, time() + (3600 * 24 * 30));
  } else if (isset($_SESSION['lang'])) {
    $lang = $_SESSION['lang'];
  } else if (isset($_COOKIE['lang'])) {
    $lang = $_COOKIE['lang'];
    $_SESSION['lang'] = $lang;
  } else {
    $lang = 'en';
    $_SESSION['lang'] = $lang;
  }
  $lang_files = scandir('inc/lang');
  foreach ($lang_files as $file) {
    if ($file != '.' && $file != '..' && $file != 'langs.php') {
      $parts = explode(".", $file); 
      $file_lang = $parts[1];
      $langs_array[] = $parts[1];
      if ($lang == $file_lang) {
        $lang_file = $file;
      }
    }
  }
  include_once 'inc/lang/' . $lang_file;
  $_SESSION['langs_array'] = $langs_array;
  include_once 'inc/lang/langs.php';
  $_SESSION['all_langs'] = $all_langs; 
  
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
  
  // get user group access and set it into session
  $_SESSION['access'] = Group::getById(User::getGroupID($_SESSION['authuser']));
  
  // get action 
  $action = isset($_GET['action']) ? $_GET['action'] : '';
?>