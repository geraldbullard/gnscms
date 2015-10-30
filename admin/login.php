<?php
  require_once('inc/config.php');
  
  session_start();
  
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
    if (is_dir('inc/lang/' . $file) && $file != "." && $file != ".." && $file != 'langs.php') {
      $langs_array[] = $file;
    }
    if ($file != '.' && $file != '..' && $file != 'langs.php' && $file != 'de' && $file != 'en' && $file != 'es' && $file != 'fr') {
      $parts = explode(".", $file); 
      $file_lang = $parts[1];
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
  
  if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    session_write_close();
    header("Location: login.php?action=loggedOut");
  }
  
  try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD); 
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $st = $pdo->prepare("SELECT value FROM " . DB_PREFIX . "settings WHERE define = 'sessionExpire'");
    $st->execute();
   
    while ($settings = $st->fetch()) {
      $sessionExpireTime = array('value' => $settings['value']);
    }
    
    $pdo = null;    
  } catch(PDOException $e) {
    echo "ERROR: " . $e->getMessage();
  }
    
  if (isset($_POST['login'])) {  
    try {
      $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD); 
      $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
      $st = $pdo->prepare("SELECT username, password, status FROM " . DB_PREFIX . "users WHERE username = '" . $_POST['username'] . "'");
      $st->execute();
     
      $adminDetails = $st->fetch();
      
      $pdo = null;    
    } catch(PDOException $e) {
      echo "ERROR: " . $e->getMessage();
    }
    
    if (($_POST['username'] == $adminDetails['username']) && (md5($_POST['password']) == $adminDetails['password']) && ($adminDetails['status'] == '1')) {
      $_SESSION['authuser'] = $adminDetails['username'];
      $_SESSION['sessionStart'] = time();
      $_SESSION['sessionExpire'] = $_SESSION['sessionStart'] + ($sessionExpireTime['value'] * 60);
      if (isset($_SESSION['oldURL']) && $_SESSION['oldURL'] != '' && strpos($_SESSION['oldURL'], 'login') === false) {
        header("Location: " . $_SESSION['oldURL']);
      } else {
        header("Location: index.php?action=dashboard");
      }
    } else {
      $error = true;
    }
  }
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <title><?php echo $lang['login_title']; ?></title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="description" content="<?php echo $lang['login_meta_description']; ?>">
  <meta name="robots" content="index, nofollow">
  <link rel="shortcut icon" href="favicon.ico">
  <!-- Styles -->
  <link href="css/bootstrap-cerulean.css" rel="stylesheet">
  <link href="css/bootstrap-responsive.css" rel="stylesheet">
  <link href="css/charisma-app.css" rel="stylesheet">  
  <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <!-- jQuery -->
  <script src="js/jquery-1.8.3.min.js"></script>
</head> 
<body>
  <div class="container-fluid">
    <div class="row-fluid" style="background:none;">
      <center><img src="img/logo-400.png" id="login-logo" align="center" vspace="10" /></center>
      <div class="well span4 center login-box">
<?php 
  if (file_exists('install.php')) {
?>
        <div id="installFileExists" class="error alert alert-info center">
          <p>
            <?php echo $lang['login_remove_install']; ?>
          </p>
        </div>
<?php
  } 
  if ($error) {
?>
        <div id="wrongInformation" class="warning alert alert-info center">
          <p>
            <?php echo $lang['login_wrong_username']; ?>
          </p>
        </div>
<?php
  }
  if ($_GET['action'] == 'loggedOut') { 
?>
        <div id="logout" class="success alert alert-info center">
          <p>
            <?php echo $lang['login_logged_out']; ?>
          </p>
        </div>
<?php 
  }
  if ($_GET['action'] == 'notLogged') { 
?>
        <div id="notLogged" class="warning alert alert-info center">
          <p>
            <?php echo $lang['login_not_logged_in']; ?>
          </p>
        </div>
<?php 
  }
  if ($_GET['action'] == 'sessionExpired') { 
?>
        <div id="sessionExpired" class="warning alert alert-info center">
          <p>
            <?php echo $lang['login_session_ended']; ?>
          </p>
        </div>
<?php 
  }
  if ($_GET['action'] == 'firstLogin') { 
?>
        <div id="firstLogin" class="success alert alert-info center">
          <p>
            <?php echo $lang['login_thanks_for_trying']; ?>
          </p>
        </div>
<?php 
  }
  if ($_GET['action'] == 'noDirectAccess') { 
?>
        <div id="noDirectAccess" class="error alert alert-info center">
          <p>
            <?php echo $lang['login_no_direct_access']; ?>
          </p>
        </div>
<?php 
  }
?>
        <div id="defaultLoginMsg" class="error alert alert-info center" <?php if ($_GET['action']) { echo 'style="display:none;"'; } ?>>
          <p>
            <?php echo $lang['login_enter_user_pass']; ?>
          </p>
        </div>
        <form id="login" class="form-horizontal" action="login.php" method="post">
          <br />
          <fieldset>
            <div class="input-prepend" title="Username">
              <span class="add-on"><i class="icon-user"></i></span><input type="text" autofocus class="input-large span10" name="username" id="username" value="" />
            </div>
            <div class="clearfix"></div>

            <div class="input-prepend" title="Password">
              <span class="add-on"><i class="icon-lock"></i></span><input type="password" class="input-large span10" name="password" id="password" value="" />
            </div>
            <div class="clearfix"></div>

            <p class="center">
            <button type="submit" name="login" id="login" class="btn btn-primary login-button"><?php echo $lang['login']; ?></button>
            </p>
          </fieldset>
        </form>
      </div><!--/span-->
      <div class="span3 center">
        <p>
          <?php echo $lang['copyright']; ?> &copy; <?php echo date('Y') ?> <a href="http://www.gnscms.com/" target="_blank" title="<?php echo $lang['copyright_title']; ?>"><?php echo $lang['gnscms']; ?></a><br />
          <?php echo $lang['core_code']; ?>: <a href="http://www.elated.com/articles/cms-in-an-afternoon-php-mysql/" target="_blank" title='<?php echo $lang['core_code_title']; ?>'><?php echo $lang['afternoon_cms']; ?></a><br />
          <?php echo $lang['powered_by']; ?>: <a href="http://usman.it/free-responsive-admin-template" title="<?php echo $lang['powered_by_title']; ?>"><?php echo $lang['charisma']; ?></a><br />
        </p>
      </div>
    </div><!--/row-->
  </div><!--/.fluid-container-->
</body>
</html>