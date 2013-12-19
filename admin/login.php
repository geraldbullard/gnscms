<?php
  require_once('inc/config.php');
  
  session_start();
  
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
      $sessionExpireTime = $settings['value'];
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
    
    if (($_POST['username'] != $adminDetails['username']) || (md5($_POST['password']) != $adminDetails['password']) || ($adminDetails['status'] != 1)) {
      $error = true;
    } else {
      $_SESSION['authuser'] = $adminDetails['username'];
      $_SESSION['sessionStart'] = time();
      $_SESSION['sessionExpire'] = $_SESSION['sessionStart'] + ($sessionExpireTime['value'] * 60);
      if (isset($_SESSION['oldURL'])) {
        header("Location: " . $_SESSION['oldURL']);
      } else {
        header("Location: index.php?action=dashboard");
      }
    }
  }
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <title><?php echo $lang['gnscms']; ?> Admin | </title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="description" content="gnsCMS Admin by maestro">
  <meta name="keywords" content="these, are, my, site, keywords">
  <meta name="application-name" content="gnsCMS Admin">
  <meta name="robots" content="index, follow">
  <link rel="shortcut icon" href="favicon.ico">
  <!-- Styles -->
  <link href="css/bootstrap-cerulean.css" rel="stylesheet">
  <link href="css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
  <link href="css/fullcalendar.css" rel='stylesheet'>
  <link href="css/fullcalendar.print.css" rel="stylesheet"  media='print'>
  <link href="css/chosen.css" rel="stylesheet">
  <link href="css/uniform.default.css" rel="stylesheet">
  <link href="css/colorbox.css" rel="stylesheet">
  <link href="css/jquery.cleditor.css" rel="stylesheet">
  <link href="css/jquery.noty.css" rel="stylesheet">
  <link href="css/noty_theme_default.css" rel="stylesheet">
  <link href="css/elfinder.min.css" rel="stylesheet">
  <link href="css/elfinder.theme.css" rel="stylesheet">
  <link href="css/jquery.iphone.toggle.css" rel="stylesheet">
  <link href="css/opa-icons.css" rel="stylesheet">
  <link href="css/uploadify.css" rel="stylesheet">
  <link href="css/jquery.wysiwyg.css" rel="stylesheet" media="screen" />
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
            Please remove install.php immediately!.
          </p>
        </div>
<?php
  } 
  if ($error) {
?>
        <div id="wrongInformation" class="warning alert alert-info center">
          <p>
            Wrong Username, Password or Status.<br />Please contact the site administrator.
          </p>
        </div>
<?php
  }
  if ($_GET['action'] == 'loggedOut') { 
?>
        <div id="logout" class="success alert alert-info center">
          <p>
            You Have Successfully Logged Out.
          </p>
        </div>
<?php 
  }
  if ($_GET['action'] == 'notLogged') { 
?>
        <div id="notLogged" class="warning alert alert-info center">
          <p>
            You Are Not Logged In.
          </p>
        </div>
<?php 
  }
  if ($_GET['action'] == 'sessionExpired') { 
?>
        <div id="sessionExpired" class="warning alert alert-info center">
          <p>
            Your Session Has Ended. Login Again.
          </p>
        </div>
<?php 
  }
  if ($_GET['action'] == 'firstLogin') { 
?>
        <div id="firstLogin" class="success alert alert-info center">
          <p>
            Thanks For Trying gnsCMS!
          </p>
        </div>
<?php 
  }
  if ($_GET['action'] == 'noDirectAccess') { 
?>
        <div id="noDirectAccess" class="error alert alert-info center">
          <p>
            No direct access to that file!
          </p>
        </div>
<?php 
  }
?>
        <div id="defaultLoginMsg" class="error alert alert-info center" <?php if ($_GET['action']) { echo 'style="display:none;"'; } ?>>
          <p>
            Enter your username and password to login.
          </p>
        </div>
        <form class="form-horizontal" action="login.php" method="post">
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
            <button type="submit" name="login" class="btn btn-primary login-button">Login</button>
            </p>
          </fieldset>
        </form>
      </div><!--/span-->
      <div class="span3 center">
        <p>
          Copyright &copy; <?php echo date('Y') ?> <a href="http://www.gnscms.com/" target="_blank" title="The Best in Web Development!">gnsCMS</a><br />
          Core Code Based on: <a href="http://www.elated.com/articles/cms-in-an-afternoon-php-mysql/" target="_blank" title='Core code based on "Build a CMS in an Afternoon with PHP and MySQL" by Matt Doyle'>Afternoon CMS</a><br />
          Admin Powered by: <a href="http://usman.it/free-responsive-admin-template" title="Charisma - Open Source, Mutiple Skin, Fully Responsive Admin Template">Charisma</a><br />
        </p>
      </div>
    </div><!--/row-->
  </div><!--/.fluid-container-->
</body>
</html>