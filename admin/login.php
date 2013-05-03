<?php

  require_once('inc/config.php');
  
  session_start();
  
  if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header("Location: login.php?action=loggedOut");
  }
    
  mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
  mysql_select_db(DB_NAME);
  $sessionExpireTime = mysql_fetch_array(mysql_query("SELECT value FROM " . DB_PREFIX . "settings WHERE define = 'sessionExpire'"));
  
  if (isset($_POST['login'])) {
    if (($_POST['username'] != ADMIN_USERNAME) || ($_POST['password'] != ADMIN_PASSWORD)) {
      $error = true;
    } else {
      $_SESSION['authuser'] = ADMIN_USERNAME;
      $_SESSION['sessionStart'] = time();
      $_SESSION['sessionExpire'] = $_SESSION['sessionStart'] + ($sessionExpireTime['value'] * 60);
      if (isset($_SESSION['oldURL'])) {
        header("Location: " . $_SESSION['oldURL']);
      } else {
        header("Location: index.php?action=dashboard");
      }
    }
  }
  include('inc/head.php');
?> 
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
            Wrong Username or Password.
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

<?php include('inc/bottom.php'); ?>