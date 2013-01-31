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
      $f = @fopen("includes/config.php", "w+");
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
        chmod('includes/config.php', 0444);
        if (@mysql_connect($database_host, $database_username, $database_password)) {
          if (@mysql_select_db($database_name)) {
            if (@mysql_query("DROP TABLE IF EXISTS " . DB_PREFIX . "pages") !=0 &&
                @mysql_query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "pages (id smallint(5) unsigned NOT NULL AUTO_INCREMENT,
                                                                                 title varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                 slug varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                 summary text COLLATE utf8_unicode_ci NOT NULL,
                                                                                 content mediumtext COLLATE utf8_unicode_ci NOT NULL,
                                                                                 metaDescription varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                 metaKeywords varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                 sort smallint(3) unsigned NOT NULL DEFAULT '9999',
                                                                                 status tinyint(1) unsigned NOT NULL DEFAULT '1',
                                                                                 parent smallint(3) unsigned NOT NULL DEFAULT '0',
                                                                                 siteIndex tinyint(1) unsigned NOT NULL DEFAULT '0',
                                                                                 botAction varchar(22) COLLATE utf8_unicode_ci NOT NULL, 
                                                                                 PRIMARY KEY (id)) 
                                                                                 ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15;") !=0 &&
                @mysql_query("DROP TABLE IF EXISTS " . DB_PREFIX . "settings") !=0 &&
                @mysql_query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "settings (id smallint(5) unsigned NOT NULL AUTO_INCREMENT,
                                                                                    define varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                    title varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                    summary text COLLATE utf8_unicode_ci NOT NULL,
                                                                                    value mediumtext COLLATE utf8_unicode_ci NOT NULL,
                                                                                    edit tinyint(1) unsigned NOT NULL DEFAULT '1',
                                                                                    system tinyint(1) unsigned NOT NULL DEFAULT '0',
                                                                                    PRIMARY KEY (id)) 
                                                                                    ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6;") !=0 && 
                //@mysql_query("DROP TABLE IF EXISTS " . DB_PREFIX . "users") !=0 &&
                //@mysql_query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "users ()") !=0 &&
                @mysql_query("INSERT INTO " . DB_PREFIX . "pages (id, title, slug, summary, content, metaDescription, metaKeywords, sort, status, parent, siteIndex, botAction) VALUES 
                                                                 (1, 'Home', 'home', 'Welcome to our web site.', '<h2>Lorem Ipsum</h2><p>Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum</p>', 'This is the Home page meta description', 'these, are, key, words', 0, 1, 1, 1, 'index, follow'),
                                                                 (2, 'About Us', 'about-us', 'Information about who we are and what we do', '<h2>Lorem Ipsum</h2><p>Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum</p>', 'This is the About Us page meta description', 'these, are, key, words', 1, 1, 0, 0, 'index, follow'),
                                                                 (3, 'Contact Us', 'contact-us', 'Contact us for more information.', '<h2>Lorem Ipsum</h2><p>Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum</p>', 'This is the Contact Us page meta description', 'these, are, key, words', 2, 1, 0, 0, 'noindex, follow'),
                                                                 (9999, '404', '404', '404 Page Missing', '<p>Well this is embarrassing...</p>', '', '', 9999, 1, 0, 0, 'noindex, nofollow');") &&
                @mysql_query("INSERT INTO " . DB_PREFIX . "settings (id, define, title, summary, value, edit, system) VALUES 
                                                                    (1, 'siteName', 'Site Name', 'The name to be displayed on your site pages.', 'gnsCMS Content Management System', 0, 1),
                                                                    (2, 'siteRoot', 'Site URL', 'The root url for your web site.', 'www.mywebsite.com', 0, 1),
                                                                    (7, 'sessionExpire', 'Admin Session Timeout', 'The time in minutes that your admin session will last before timing out and forcing you to login again.', '30', 0, 1),
                                                                    (3, 'siteTheme', 'Site Theme', 'This is the name of your site theme', 'gns001', 0, 1),
                                                                    (8, 'googleAnalytics', 'Google Analytics', 'The ID of your Google Anayltics account', 'UA-XXXXX-X', 0, 1),
                                                                    (4, 'siteWidth', 'Site Width', 'The width of your site', '980px', 0, 1),
                                                                    (5, 'siteDescription', 'Site Description', 'This is a site wide description. It will also get used in the event that you do not enter any meta tag description for any of your pages.', 'This is my site description.', 0, 1),
                                                                    (6, 'siteKeywords', 'Site Keywords', 'These are site wide keywords. They will also get used in the event that you do not enter any meta tag keywords for any of your pages.', 'these, are, my, site, keywords', 0, 1),
                                                                    (9, 'showHelp', 'Show Help Tab', 'Show or hide the help tab in the site admin upper right corner. (yes or no)', 'no', 0, 1),
                                                                    (10, 'testSetting', 'Test Setting', 'Test Summary', 'Test Value', 1, 0);")) //&&
                //@mysql_query("INSERT INTO " . DB_PREFIX . "users () VALUES ()")) 
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>gnsCMS Admin</title>
<link rel="stylesheet" href="css/stock.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/menu.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/custom.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/color.css" type="text/css" media="screen" />
<!--[if lte IE 7]>
<link rel="stylesheet" href="css/iexplorer.css" type="text/css" media="screen" />
<![endif]-->
<script type="text/javascript" src="scripts/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="scripts/jquery-ui-personalized.js"></script>
<script type="text/javascript" src="scripts/jquery-validate.js"></script>
<style>
  #passwordStrength { height:10px; margin:10px 0 10px 0; display:block; float:left; }
  #passwordDescription { margin-top:-15px; }
  .strength0 { width:250px; background:#cccccc; }
  .strength1 { width:50px; background:#ff0000; }
  .strength2 { width:100px; background:#ff5f5f; }
  .strength3 { width:150px; background:#56e500; }
  .strength4 { background:#4dcd00; width:200px; }
  .strength5 { background:#399800; width:250px; }
</style>
<script type="text/javascript">
  function checkPass(){
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
  $(document).ready(function() {
    $("#siteNavigation li ul").hide();
    $("#siteNavigation li a.current").parent().find("ul").slideToggle("slow");
    $("#siteNavigation li a.nav-top-item").click(
      function () {
        $(this).parent().siblings().find("ul").slideUp("normal");
        $(this).next().slideToggle("normal");
        return false;
      }
    );
    $("#siteNavigation li a.no-submenu").click(
      function () {
        window.location.href=(this.href);
        return false;
      }
    ); 

    $("#siteNavigation li .nav-top-item").hover(
      function () {
        $(this).stop();
        $(this).animate({ paddingRight: "25px" }, 200);
      }, 
      function () {
        $(this).stop();
        $(this).animate({ paddingRight: "15px" });
      }
    );
    $(".content-box-header h3").css({ "cursor":"s-resize" });
    $(".content-box-header-toggled").next().hide();
    $(".content-box-header h3").click(
      function () {
        $(this).parent().parent().find(".content-box-content").toggle();
        $(this).parent().toggleClass("content-box-header-toggled");
        $(this).parent().find(".content-box-tabs").toggle();
      }
    );

    $('.content-box .content-box-content div.tab-content').hide();
    $('.content-box-content div.default-tab').show();
    $('ul.content-box-tabs li a.default-tab').addClass('current');
    $('.content-box ul.content-box-tabs li a').click(
      function() { 
        $(this).parent().siblings().find("a").removeClass('current');
        $(this).addClass('current');
        var currentTab = $(this).attr('href');
        $(currentTab).siblings().hide();
        $(currentTab).show();
        return false; 
      }
    );

    $(".close").click(
      function () {
        $(this).parent().fadeTo(400, 0, function () {
          $(this).slideUp(600);
        });
        return false;
      }
    );
    var successMessage = '<?php echo $_GET['success']; ?>';
    if (successMessage != '') {
      setTimeout(function(){ $("#successMessage").fadeOut(1000, function(){ $(this).remove(); });}, 4000);
    }
    
    var errorMessage = '<?php echo $_GET['error']; ?>';
    if (errorMessage != '') {
      setTimeout(function(){ $("#errorMessage").fadeOut(1000, function(){ $(this).remove(); });}, 4000);
    }
    
    var informationMessage = '<?php echo $_GET['info']; ?>';
    if (informationMessage != '') {
      setTimeout(function(){ $("#informationMessage").fadeOut(1000, function(){ $(this).remove(); });}, 4000);
    }
    
    var attentionMessage = '<?php echo $_GET['attention']; ?>';
    if (attentionMessage != '' && successMessage != '') {
      setTimeout(function(){ $("#attentionMessage").fadeOut(1000, function(){ $(this).remove(); });}, 8000);
    } else {
      setTimeout(function(){ $("#attentionMessage").fadeOut(1000, function(){ $(this).remove(); });}, 4000);
    }
  });
  function switchContentHeading1() {
    if (document.getElementById("contentHeading").innerHTML != "Site Setup Information") {
      document.getElementById("contentHeading").innerHTML = "Site Setup Information";
    }
  }
  function switchContentHeading2() {
    if (document.getElementById("contentHeading").innerHTML != "Let's Get Started") {
      document.getElementById("contentHeading").innerHTML = "Let's Get Started";
    }
  } 
</script>
</head>
<body>
  
  <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
    
    <div id="sidebar">
    
      <div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
      
      <h1 id="sidebar-title">Site Installer</h1>
      
      <!-- Logo (221px wide) -->
      <img id="logo" src="images/adminLogo.png" alt="Simpla Admin logo" />
      
      <ul id="siteNavigation">  <!-- Accordion Menu -->
        
        <li>
          <a href="admin.php" class="nav-top-item no-submenu current">
            Installation
          </a>       
        </li>
        
      </ul> <!-- End #main-nav -->
      
    </div></div> <!-- End #sidebar -->
    
    <div id="main-content"> <!-- Main Content Section with everything -->
      <?php
        if (!$error) { 
          if ($completed) { 
      ?>
      <h2>Thanks for trying the gnsCMS Content Management System!</h2><br />
      <?php 
          } else if (file_exists('includes/config.php')) {
      ?>
      <h2>The gnsCMS Content Management System is ready!</h2><br />
      <?php 
          } else { 
      ?>
      <h2>Welcome to the gnsCMS Content Management System Installation!</h2><br />
      <?php 
          }
        } else { 
      ?>
      <h2>There was an error!</h2><br />  
      <?php
        }
      ?>
      <div class="content-box"><!-- Start Content Box -->
        <div class="content-box-header">
          <?php
            if (!$error) { 
              if ($completed) { 
          ?>
          <h3 id="contentHeading">Congradulations</h3>
          <?php 
              } else if (file_exists('includes/config.php')) {
          ?>
          <h3 id="contentHeading">Your Database Installation Has Already Been Completed</h3>
          <?php 
              } else { 
          ?>
          <h3 id="contentHeading">Site Setup Information</h3>
          
          <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab" onclick="javascript:switchContentHeading1();">Requirements & Information</a></li>
            <li><a href="#tab2" onclick="javascript:switchContentHeading2();"><span style="padding-left:24px;background:url('images/icons/plus.png') no-repeat;">Start Installation</span></a></li>
          </ul>
          <?php 
              }
            } else { 
          ?>
          <h3 id="contentHeading">Review the error message below on issues.</h3>
          <?php
            }
          ?>
          <div class="clear"></div>
          
        </div> <!-- End .content-box-header -->
        
        <div class="content-box-content">
          <?php
            if (!$error) { 
              if ($completed) { 
          ?>
            
            <div class="notification success png_bg">
              <a href="#" class="close"><img src="images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
              <div>
                Success! You have completed the installation and database setup for your new web site.
              </div>
            </div>
            
            <div class="notification error png_bg">
              <a href="#" class="close"><img src="images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
              <div>
                For security purposes, please delete this installation script (admin/install.php) from the server before using your site! 
              </div>
            </div>
            
            <div class="content-box column-left"><!-- Start Content Box -->
              <div class="content-box-header">
                <h3>About Your New Admin</h3>
              </div> <!-- End .content-box-header -->
              <div class="content-box-content">
                <div class="tab-content default-tab">
                  <h4>Some of our most popular admin features:</h4>
                  <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in porta lectus. Maecenas dignissim enim quis ipsum mattis aliquet. Maecenas id velit et elit gravida bibendum. Duis nec rutrum lorem. Donec egestas metus a risus euismod ultricies. Maecenas lacinia orci at neque commodo commodo.
                  </p>
                  <div align="right">
                    <form action="admin.php" method="post" target="_blank"> 
                      <input class="button" type="submit" value="Visit Admin" />
                    </form>
                  </div>
                </div> <!-- End #tab3 -->        
              </div> <!-- End .content-box-content -->
            </div> <!-- End .content-box -->
            <div class="content-box column-right"><!-- Start Content Box -->
              <div class="content-box-header">
                <h3>About Your New Web Site</h3>
              </div> <!-- End .content-box-header -->
              <div class="content-box-content">
                <div class="tab-content default-tab">
                  <h4>More advanced and up-to-date coding practices:</h4>
                  <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in porta lectus. Maecenas dignissim enim quis ipsum mattis aliquet. Maecenas id velit et elit gravida bibendum. Duis nec rutrum lorem. Donec egestas metus a risus euismod ultricies. Maecenas lacinia orci at neque commodo commodo.
                  </p>
                  <div align="right">
                    <form action="../" method="post" target="_blank"> 
                      <input class="button" type="submit" value="Visit Site" />
                    </form>
                  </div>
                </div> <!-- End #tab3 -->        
              </div> <!-- End .content-box-content -->
            </div> <!-- End .content-box -->
            <div class="clear"></div>
            
          <?php 
              } else if (file_exists('includes/config.php')) { 
          ?> 
            
            <div class="notification attention png_bg">
              <a href="#" class="close"><img src="images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
              <div>
                The database installation has been previously completed for this web site. Please delete this installation script (admin/install.php) from the server.
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
            <div class="tab-content default-tab" id="tab1">
              <h4>Minimum Requirements Checklist</h4>
              
              <p>Later this will be an automatic checklist for the server requirements and folder permissions needed to complete the setup.</p>
              
              <ul>
                <li>Requirement #1</li>
                <li>Requirement #2</li>
                <li>Requirement #3</li>
                <li>Requirement #4</li>
                <li>Requirement #5</li>
                <li>Requirement #6</li>
                <li>Requirement #7</li>
                <li>Requirement #8</li>
                <li>Requirement #9</li>
              </ul>
              
              <p>After you have checked all of the above requirements and they are successfully met you can proceed by clicking the "Start Intallation" tab above. And good luck!</p>
            </div>
            <div class="tab-content" id="tab2">
              <h4>Enter the required information below</h4>
                  
              <form action="install.php" method="post" id="install">
              <fieldset>
              
                <p><small style="font-weight:bolder; color:red;">* All Fields Are Required!</small></p>
              
                <p>
                  <label>Database Host</label>
                  <input class="text-input small-input" type="text" id="database_host" name="database_host" value="<?php echo (isset($database_host)) ? $database_host : 'localhost'; ?>" required />
                </p>
                
                <p>
                  <label>Database Tables Prefix</label>
                  <input class="text-input small-input" type="text" id="database_prefix" name="database_prefix" value="<?php echo (isset($database_prefix)) ? $database_prefix : 'gnsCMS_'; ?>" />
                </p>
                
                <p>
                  <label>Database Name</label>
                  <input class="text-input small-input" type="text" id="database_name" name="database_name" value="<?php echo $database_name; ?>" required />
                </p>
                
                <p>
                  <label>Database Username</label>
                  <input class="text-input small-input" type="text" id="database_username" name="database_username" value="<?php echo $database_username; ?>" required />
                </p>
                
                <p>
                  <label>Database Password</label>
                  <input class="text-input small-input" type="password" id="database_password" name="database_password" value="<?php echo $database_password; ?>" required />
                </p>
                
                <p>
                  <label>Admin Username</label>
                  <input class="text-input small-input" type="text" id="username" name="username" value="<?php echo $username; ?>" required />
                </p>
                
                <p>
                  <label>Admin Password</label>
                  <input class="text-input small-input" type="password" id="password" name="password" value="" required autocomplete="off" onkeyup="passwordStrength(this.value)"/>
                </p>
                
                <p>
                  <label>Confirm Password</label>
                  <input class="text-input small-input" type="password" id="confirm_password" name="confirm_password" value="" required autocomplete="off" onkeyup="checkPass(); return false;" />&nbsp;<span id="passwordMessage" class="passwordMessage"></span>
                </p>
                
                <p>
                  <label for="passwordStrength">Password strength</label>
                  <div id="passwordDescription">Password not entered</div>
                  <div id="passwordStrength" class="strength0"></div>
                </p>
                
                <div class="clear"></div><!-- End .clear -->
                
                <p>
                  <input class="button" type="submit" name="submit" value="Install Now!" />
                </p>
                
              </fieldset>            
              </form>          
            </div>
          <?php 
              }
            } else {
          ?>
            <p><?php echo $errorMessage; ?></p>
          <?php
            }
          ?>


            <div class="clear"></div><!-- End .clear -->
              
  
          
        </div> <!-- End .content-box-content -->
        
      </div> <!-- End .content-box -->

      <div id="footer">
        <b>Powered by <a href="http://www.gnsplanet.com/" title="The Best In Website Development" target="_blank">gnsCMS</a> :: A Truly Simple, Yet Powerful, Content Management System!<br /></b>
        <small><br /><p style="margin-top:-12px;">&#169; Copyright 2012. All Rights Reserved</p></small>
      </div><!-- End #footer -->
      
    </div> <!-- End #main-content -->
    
  </div></body>
  
</html>