<?php
  function makePin($lenth = 24) {
    // makes a random alpha numeric string of a given lenth
    $aZ09 = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
    $out = '';
    for($c = 0; $c < $lenth; $c++) {
       $out .= $aZ09[mt_rand(0, count($aZ09)-1)];
    }
    return $out;
  }  
  $completed = false;
  if ($_POST['submit'] == "Install Now!") {
    define('DB_ENCRYPT_KEY', makePin());
    define('DB_PREFIX', $_POST['database_prefix']);
    $database_host = isset($_POST['database_host']) ? $_POST['database_host'] : "";
    $database_prefix = isset($_POST['database_prefix']) ? $_POST['database_prefix'] : "";
    $database_name = isset($_POST['database_name']) ? $_POST['database_name'] : "";
    $database_username = isset($_POST['database_username']) ? $_POST['database_username'] : "";
    $database_password = isset($_POST['database_password']) ? $_POST['database_password'] : "";
    $username = isset($_POST['username']) ? $_POST['username'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";
    $inputError = false;
    if (empty($username) || empty($password) || empty($database_host) || empty($database_username) || empty($database_password) || empty($database_name)) {
      $inputError = true;
      $inputMessage = 'All fields are required on the installation tab. Please click "Start Instalaation" and try again.';
    } else {
      $f = @fopen("inc/config.php", "w+");
      $database_inf = "<?php
  // DATABASE CONNECTION INFORMATION ///////////////////////////////////////////////////////////
  ini_set('display_errors', true);
  define('DB_DSN', 'mysql:host=" . $database_host . ";dbname=" . $database_name . "' );
  date_default_timezone_set('US/Eastern');                     // http://www.php.net/manual/en/timezones.php later add to install as dropdown option
  define('DB_HOST', '" . $database_host . "');                 // Database host
  define('DB_NAME', '" . $database_name . "');                 // Database name
  define('DB_USERNAME', '" . $database_username . "');         // User name for access to database
  define('DB_PASSWORD', '" . $database_password . "');         // Password for access to database
  define('DB_ENCRYPT_KEY', '" . DB_ENCRYPT_KEY . "');          // Database encryption key
  define('DB_PREFIX', '" . $database_prefix . "');             // Unique prefix of table names
  define('ADMIN_USERNAME', '" . $username . "');               // Admin username until moved to database
  define('ADMIN_PASSWORD', '" . $password . "');               // Admin password until moved to database
  define('INCLUDES_PATH', 'includes');                         // path to includes
?>"; 
      $error = false;
      if (@fwrite($f, $database_inf) > 0) {
        fclose($f);
        chmod('inc/config.php', 0444);
        if (@mysql_connect($database_host, $database_username, $database_password)) {
          if (@mysql_select_db($database_name)) {
            if (@mysql_query("DROP TABLE IF EXISTS " . DB_PREFIX . "pages") !=0 &&
                @mysql_query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "pages (id smallint(5) unsigned NOT NULL AUTO_INCREMENT,
                                                                                 title varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                 slug varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                 menuTitle varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                 override varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                 summary text COLLATE utf8_unicode_ci NOT NULL,
                                                                                 content mediumtext COLLATE utf8_unicode_ci NOT NULL,
                                                                                 metaDescription varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                 metaKeywords varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                 sort smallint(5) unsigned NOT NULL DEFAULT '999',
                                                                                 status tinyint(1) unsigned NOT NULL DEFAULT '1',
                                                                                 categoryId smallint(5) unsigned NOT NULL DEFAULT '0',
                                                                                 siteIndex tinyint(1) unsigned NOT NULL DEFAULT '0',
                                                                                 botAction varchar(22) COLLATE utf8_unicode_ci NOT NULL, 
                                                                                 menu tinyint(1) unsigned NOT NULL DEFAULT '1',
                                                                                 PRIMARY KEY (id)) 
                                                                                 ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4;") !=0 &&
                @mysql_query("DROP TABLE IF EXISTS " . DB_PREFIX . "settings") !=0 &&
                @mysql_query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "settings (id smallint(5) unsigned NOT NULL AUTO_INCREMENT,
                                                                                    define varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                    title varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                    summary text COLLATE utf8_unicode_ci NOT NULL,
                                                                                    value mediumtext COLLATE utf8_unicode_ci NOT NULL,
                                                                                    edit tinyint(1) unsigned NOT NULL DEFAULT '1',
                                                                                    system tinyint(1) unsigned NOT NULL DEFAULT '0',
                                                                                    PRIMARY KEY (id)) 
                                                                                    ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11;") !=0 && 
                @mysql_query("DROP TABLE IF EXISTS " . DB_PREFIX . "categories") !=0 &&
                @mysql_query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "categories (id smallint(5) unsigned NOT NULL AUTO_INCREMENT,
                                                                                      title varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                      slug varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                      menuTitle varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                      override varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                      content mediumtext COLLATE utf8_unicode_ci NOT NULL,
                                                                                      metaDescription varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                      metaKeywords varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                      sort smallint(5) unsigned NOT NULL DEFAULT '999',
                                                                                      status tinyint(1) unsigned NOT NULL DEFAULT '1',
                                                                                      siteIndex tinyint(1) unsigned NOT NULL DEFAULT '0',
                                                                                      botAction varchar(22) COLLATE utf8_unicode_ci NOT NULL, 
                                                                                      menu tinyint(1) unsigned NOT NULL DEFAULT '1',
                                                                                      parent smallint(5) unsigned NOT NULL,
                                                                                      PRIMARY KEY (id)) 
                                                                                      ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2;") !=0 &&
                @mysql_query("INSERT INTO " . DB_PREFIX . "pages (id, title, slug, menuTitle, override, summary, content, metaDescription, metaKeywords, sort, status, categoryId, siteIndex, botAction, menu) VALUES 
                                                                 (0, '404', '404', '', '', '404 Page Missing', '<p>Well this is embarrassing...</p>', '', '', 9999, 1, 0, 0, 'noindex, nofollow', 0), 
                                                                 (1, 'Home', 'home', '', '', 'Welcome to our web site.', '<h2>Lorem Ipsum</h2><p>Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum</p>', 'This is the Home page meta description', 'these, are, key, words', 0, 1, 0, 1, 'index, follow', 1),
                                                                 (2, 'About Us', 'about-us', '', '', 'Information about who we are and what we do', '<h2>Lorem Ipsum</h2><p>Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum</p>', 'This is the About Us page meta description', 'these, are, key, words', 1, 1, 0, 0, 'index, follow', 1),
                                                                 (3, 'Contact Us', 'contact-us', '', '', 'Contact us for more information.', '<h2>Lorem Ipsum</h2><p>Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum</p>', 'This is the Contact Us page meta description', 'these, are, key, words', 2, 1, 0, 0, 'noindex, follow', 1);") &&
                @mysql_query("INSERT INTO " . DB_PREFIX . "settings (id, define, title, summary, value, edit, system) VALUES 
                                                                    (1, 'siteName', 'Site Name', 'The name to be displayed on your site pages.', 'gnsCMS Content Management System', 0, 1),
                                                                    (2, 'siteRoot', 'Site URL', 'The root url for your web site.', 'www.mywebsite.com', 0, 1),
                                                                    (7, 'sessionExpire', 'Admin Session Timeout', 'The time in minutes that your admin session will last before timing out and forcing you to login again.', '30', 0, 1),
                                                                    (3, 'siteTheme', 'Site Theme', 'This is the name of your site theme', 'simplesoft', 0, 1),
                                                                    (8, 'googleAnalytics', 'Google Analytics', 'The ID of your Google Anayltics account', 'UA-XXXXX-X', 0, 1),
                                                                    (4, 'siteWidth', 'Site Width', 'The width of your site', '980px', 0, 1),
                                                                    (5, 'siteDescription', 'Site Description', 'This is a site wide description. It will also get used in the event that you do not enter any meta tag description for any of your pages.', 'This is my site description.', 0, 1),
                                                                    (6, 'siteKeywords', 'Site Keywords', 'These are site wide keywords. They will also get used in the event that you do not enter any meta tag keywords for any of your pages.', 'these, are, my, site, keywords', 0, 1),
                                                                    (9, 'showHelp', 'Show Help Tab', 'Show or hide the help tab in the site admin upper right corner. (yes or no)', 'no', 0, 1),
                                                                    (10, 'testSetting', 'Test Setting', 'Test Summary', 'Test Value', 1, 0);") &&
                @mysql_query("INSERT INTO " . DB_PREFIX . "categories (id, title, slug, menuTitle, override, content, metaDescription, metaKeywords, sort, status, siteIndex, botAction, menu, parent) VALUES (1, 'Site Information', 'site-information', '', '', 'This is the misc information pages of your new site.', 'meta description', 'key,words', 0, 0, 0, 'index, follow', 1, 0)")) 
                {
                $completed = true;
            } else {
              $error = true;
              $errorMessage = 'CODE (110): An error occured while setting up the database! Check the admin/error_log for more information.';
              @unlink("includes/config.php");
            }
          } else {
            $error = true;
            $errorMessage = 'CODE (120): An error occured while selecting the database! Check the admin/error_log for more information.';
            @unlink("includes/config.php");
          }
        } else {
          $error = true;
          $errorMessage = 'CODE (130): An error occured while connecting to database! Check your connection parameters.';
          @unlink("includes/config.php");
        }
      } else {
        $error = true;
        $errorMessage = 'CODE (140): Cannot create/open the file includes/config.php. Please be sure the admin/includes/ folder has the chmod permissions set to 755 or above';
      }
    }
  }
  include('inc/head.php');
?>
<body>

  <div class="container-fluid">
  
    <div class="row">
      <div class="span12" style="text-align:center; margin:0 auto 0 auto; width:100%;">
        <br />
        <?php
          if (!$error) { 
            if ($completed) { 
        ?>
        <?php 
            } else if (file_exists('includes/config.php')) {
        ?>
        <h2>The gnsCMS Content Management System is ready!</h2>
        <?php 
            } else { 
        ?>
        <h2>Welcome to the gnsCMS Content Management System Installation!</h2>
        <?php 
            }
          } else { 
        ?>
        <h2>There was an error!</h2> 
        <?php
          }
        ?>
        <br />
      </div>
    </div>
    
    <?php
      if (!$error) { 
        if ($completed) { 
    ?>
    
    <div class="row" style="width:80%;margin:0 auto 0 auto;">
      <div class="span12 well">
        <div>
          <h1>Thanks for trying the gnsCMS Content Management System!</h1>
          <p>&nbsp;</p>
          <p>Success! You have completed the installation and database setup for your new web site.</p>
          <p>For security purposes, please delete this installation script (admin/install.php) from the server before using your site!</p>
        </div>
      </div><!--/span-->
    </div>
    
    <div class="row" style="width:75%;margin:0 auto 0 auto;">
          
      <div style="float:left;">
        <form action="index.php" method="post" target="_blank"> 
          <input class="btn btn-large btn-primary" type="submit" value="Visit Admin" />
        </form>
      </div>
      
      <div style="float:right;">
        <form action="../" method="post" target="_blank"> 
          <input class="btn btn-large btn-primary" type="submit" value="Visit Site" />
        </form>
      </div>
      
    </div>
    
    <?php 
        } else if (file_exists('inc/config.php')) { 
    ?>
    
    <div class="notification attention png_bg">
      <a href="#" class="close"><img src="images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
      <div>
        The installation seems to have been previously completed for this web site. Please delete this installation script (admin/install.php) from the server.
      </div>
    </div>
    
    <div style="float:left; width:50%; text-align:center;">
      <form action="admin.php" method="post" target="_blank"> 
        <input class="button" type="submit" value="Visit Admin" />
      </form>
    </div>
    
    <div style="float:right; width:50%; text-align:center;">
      <form action="../" method="post" target="_blank"> 
        <input class="button" type="submit" value="Visit Site" />
      </form>
    </div>
    <div class="clear"></div>
    
    <?php 
        } else { 
    ?>
    
    <div class="row-fluid">
      <div class="box span12">
        <div data-original-title="" class="box-header well">
          <h2><i class="icon-edit"></i> Pre-Installation Requirements</h2>
        </div>
        <div class="box-content">
          The Server Requirements are still being tested and determined. Please post any helpful info to our <a href="https://github.com/geraldbullard/gnscms/issues" target="_blank">github issues page</a>
        </div>
      </div>
    </div>
    <br />
    <div class="row-fluid">
      <div class="box span12">
        <div data-original-title="" class="box-header well">
          <h2><i class="icon-edit"></i> Installation Information</h2>
          <div class="box-icon">
            <a class="btn btn-minimize btn-round" href="#"><i class="icon-chevron-down"></i></a>
          </div>
        </div>
        <div class="box-content">
          <form class="form-horizontal" action="install.php" method="post" id="install">
            <fieldset>
              <legend>Please fill out the following information completely<br /><div style="font-weight:bolder; font-size:10px; color:red; margin-top:-10px;">* All Fields Are Required!</div></legend>
              
                <div class="control-group">
                  <label for="" class="control-label">Database Host</label>
                  <div class="controls">
                    <input class="text-input small-input" type="text" id="database_host" name="database_host" value="<?php echo (isset($database_host)) ? $database_host : 'localhost'; ?>" required />
                  </div>
                </div>
                
                <div class="control-group">
                  <label for="" class="control-label">Database Tables Prefix</label>
                  <div class="controls">
                    <input class="text-input small-input" type="text" id="database_prefix" name="database_prefix" value="<?php echo (isset($database_prefix)) ? $database_prefix : 'gnsCMS_'; ?>" />
                  </div>
                </div>
                
                <div class="control-group">
                  <label for="" class="control-label">Database Name</label>
                  <div class="controls">
                    <input class="text-input small-input" type="text" id="database_name" name="database_name" value="<?php echo $database_name; ?>" required />
                  </div>
                </div>
                
                <div class="control-group">
                  <label for="" class="control-label">Database Username</label>
                  <div class="controls">
                    <input class="text-input small-input" type="text" id="database_username" name="database_username" value="<?php echo $database_username; ?>" required />
                  </div>
                </div>
                
                <div class="control-group">
                  <label for="" class="control-label">Database Password</label>
                  <div class="controls">
                    <input class="text-input small-input" type="password" id="database_password" name="database_password" value="<?php echo $database_password; ?>" required />
                  </div>
                </div>
                
                <div class="control-group">
                  <label for="" class="control-label">Admin Username</label>
                  <div class="controls">
                    <input class="text-input small-input" type="text" id="username" name="username" value="<?php echo $username; ?>" required />
                  </div>
                </div>
                
                <div class="control-group">
                  <label for="" class="control-label">Admin Password</label>
                  <div class="controls">
                    <input class="text-input small-input" type="password" id="password" name="password" value="" required autocomplete="off" onkeyup="passwordStrength(this.value)"/>
                  </div>
                </div>
                
                <div class="control-group">
                  <label for="" class="control-label">Confirm Password</label>
                  <div class="controls">
                    <input class="text-input small-input" type="password" id="confirm_password" name="confirm_password" value="" required autocomplete="off" onkeyup="checkPass(); return false;" />&nbsp;<span id="passwordMessage" class="passwordMessage"></span>
                  </div>
                </div>
                
                <div class="control-group">
                  <label for="" class="control-label" for="passwordStrength">Password strength</label>
                  <div class="controls">
                    <div id="passwordDescription">Password not entered</div>
                    <div id="passwordStrength" class="strength0"></div>
                  </div>
                </div>
                
                <div class="control-group">
                  <label for="" class="control-label" for="passwordStrength">Password strength</label>
                  <div class="controls">
                    <input class="btn btn-large btn-primary" type="submit" name="submit" value="Install Now!" />
                  </div>
                </div>
              
            </fieldset>
          </form>
        </div>
      </div>
    </div>
    
    <?php 
        }
      } else {
    ?>
      <p><?php echo $errorMessage; ?></p>
    <?php
      }
    ?>
    
  </div>
  
  <?php include('inc/layout/footer.php'); ?>
  
  <?php include('inc/bottom.php'); ?>
  
  <script type="text/javascript">
    function checkPass() {
      //Store the password field objects into variables ...
      var password = document.getElementById('password');
      var confirm_password = document.getElementById('confirm_password');
      //Store the Confimation Message Object ...
      var passwordMessage = document.getElementById('passwordMessage');
      //Set the colors we will be using ...
      var goodColor = "#66cc66";
      var badColor = "#ff6666";
      //Compare the values in the password field 
      //and the confirmation field
      if(password.value == confirm_password.value) {
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        passwordMessage.style.color = goodColor;
        passwordMessage.innerHTML = "<b>Passwords Match!</b>"
      } else {
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        passwordMessage.style.color = badColor;
        passwordMessage.innerHTML = "<b>Passwords Do Not Match!</b>"
      }
    }
    function passwordStrength(password) {
      var desc = new Array();
      
      desc[0] = "Very Weak";
      desc[1] = "Weak";
      desc[2] = "Better";
      desc[3] = "Medium";
      desc[4] = "Strong";
      desc[5] = "Strongest";

      var score   = 0;

      // if password bigger than 6 give 1 point
      if ( password.length > 6 ) score++;

      // if password has both lower and uppercase characters give 1 point  
      if ( ( password.match(/[a-z]/) ) && ( password.match(/[A-Z]/) ) ) score++;

      // if password has at least one number give 1 point
      if (password.match(/\d+/)) score++;

      // if password has at least one special caracther give 1 point
      if ( password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/) )  score++;

      // if password bigger than 12 give another 1 point
      if ( password.length > 12 ) score++;

      document.getElementById("passwordDescription").innerHTML = desc[score];
      document.getElementById("passwordStrength").className = "strength" + score;
    } 
  </script>        
  
</body>
</html>