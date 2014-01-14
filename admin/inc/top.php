<?php 
  require_once('inc/config.php');
  require_once('inc/func/general.php');
   
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
  
  require_once('inc/class/rci.php');
  $gns_admin_RCI = new gns_admin_RCI;
  
  // set the language
  if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    $_SESSION['language'] = $_GET['lang']; 
  } else if (isset($_SESSION['language'])) {
    $lang = $_SESSION['language']; 
  } else {
    $lang = 'en';
    $_SESSION['language'] = 'en'; 
  }
  
  $langs_array = array();
  $lang_files = scandir('inc/lang');
  foreach ($lang_files as $file) {
    if (is_dir('inc/lang/' . $file) && $file != "." && $file != "..") {
      $langs_array[] = $file;
    }
    if ($file != '.' && $file != '..' && $file != 'langs.php' && $file != 'de' && $file != 'en' && $file != 'es' && $file != 'fr') {
      $parts = explode(".", $file); 
      $file_lang = $parts[1];
      $langs_array[] = $parts[1];
      if ($lang == $file_lang) {
        $lang_file = $file;
      }
    }
  }
  
  $lang = array();  
  require_once('inc/lang/' . $lang_file);
  
  $_SESSION['langs_array'] = array_unique($langs_array);
  
  require_once('inc/lang/langs.php');
  $_SESSION['all_langs'] = $all_langs;
  
  mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
  mysql_select_db(DB_NAME);
  
  // get the settings and define them for site wide usage
  try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD); 
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $st = $pdo->prepare("SELECT define, value FROM " . DB_PREFIX . "settings");
    $st->execute();
   
    while ($settings = $st->fetch()) {
      define($settings['define'], $settings['value']);
    }
    
    $pdo = null;    
  } catch(PDOException $e) {
    echo "ERROR: " . $e->getMessage();
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
      session_destroy();
      $_SESSION['oldURL'] = isset($_GET['action']) ? 'index.php?action=' . $_GET['action'] : '';
      if (($_SERVER['REQUEST_URI'] != 'login.php') && ($_SERVER['REQUEST_URI'] != $_SESSION['oldURL'])) {
        $_SESSION['oldURL'] = $_SERVER['REQUEST_URI'];    
      }
      header("Location: login.php?action=sessionExpired");
    } else {
      $_SESSION['sessionStart'] = time();
      $_SESSION['sessionExpire'] = $_SESSION['sessionStart'] + (sessionExpire * 60);
    }
  }
  
  // include class files 
  require_once('inc/class/Content.class.php');
  require_once('inc/class/Group.class.php');
  require_once('inc/class/Setting.class.php');
  require_once('inc/class/User.class.php');
  echo $gns_admin_RCI->get('class', 'add', false);
  
  // get user group access and set it into session
  $_SESSION['access'] = Group::getById(User::getGroupID($_SESSION['authuser']));
  
  if (!strpos($_SERVER['REQUEST_URI'], 'index.php') && !strpos($_SERVER['REQUEST_URI'], 'search.php')) header("Location: index.php?action=dashboard");
  
  // get action 
  $action = isset($_GET['action']) ? $_GET['action'] : '';
  
  $page_title = '';
  
  echo $gns_admin_RCI->get('top', 'add', false);
?>