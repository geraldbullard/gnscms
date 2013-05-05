<?php
  // makes a random alpha numeric string of a given lenth
  function makePin($lenth = 24) {
    $aZ09 = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
    $out = '';
    for ($c = 0; $c < $lenth; $c++) {
      $out .= $aZ09[mt_rand(0, count($aZ09)-1)];
    }
    return $out;
  }
  // ensures the avlue is an email address
  function isEmail($email) {
    return preg_match('|^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]{2,})+$|i', $email);
  };  
  $completed = false;
  if ($_POST['submit'] == "Install Now!") {
    define('DB_ENCRYPT_KEY', makePin());
    define('DB_PREFIX', $_POST['database_prefix']);
    $database_host = $_POST['database_host'];
    $database_prefix = $_POST['database_prefix'];
    $database_name = $_POST['database_name'];
    $database_username = $_POST['database_username'];
    $database_password = $_POST['database_password'];
    $firstname = preg_replace("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $_POST['firstname']);
    $lastname = preg_replace("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $_POST['lastname']);
    if (isEmail($_POST['email'])) $email = preg_replace("/[^\.\@ a-zA-Z0-9()]/", "", strip_tags($_POST['email']));
    $username = preg_replace( "/[^\,\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $_POST['username']);
    $password = md5($_POST['password']);
    $gender = $_POST['gender'];
    $inputError = false;
    if (empty($username) || empty($password) || empty($database_host) || empty($database_username) || empty($database_password) || empty($database_name)) {
      $inputError = true;
      $inputMessage = 'All fields are required on the installation tab. Please click "Start Instalation" and try again.';
    } else {
      $f = @fopen("inc/config.php", "w+");
      $database_inf = "<?php
  // DATABASE CONNECTION INFORMATION ///////////////////////////////////////////////////////////
  ini_set('display_errors', true);
  define('DB_DSN', 'mysql:host=" . $database_host . ";dbname=" . $database_name . "');
  date_default_timezone_set('US/Eastern');                     // http://www.php.net/manual/en/timezones.php later add to install as dropdown option
  define('DB_HOST', '" . $database_host . "');                 // Database host
  define('DB_NAME', '" . $database_name . "');                 // Database name
  define('DB_USERNAME', '" . $database_username . "');         // User name for access to database
  define('DB_PASSWORD', '" . $database_password . "');         // Password for access to database
  define('DB_ENCRYPT_KEY', '" . DB_ENCRYPT_KEY . "');          // Database encryption key
  define('DB_PREFIX', '" . $database_prefix . "');             // Unique prefix of table names
?>"; 
      $error = false;
      if (@fwrite($f, $database_inf) > 0) {
        fclose($f);
        chmod('inc/config.php', 0444);
        if (@mysql_connect($database_host, $database_username, $database_password)) {
          if (@mysql_select_db($database_name)) {
            if (@mysql_query("DROP TABLE IF EXISTS " . DB_PREFIX . "content") != 0 &&
                @mysql_query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "content (id smallint(5) unsigned NOT NULL AUTO_INCREMENT,
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
                                                                                   siteIndex tinyint(1) unsigned NOT NULL DEFAULT '0',
                                                                                   botAction varchar(22) COLLATE utf8_unicode_ci NOT NULL, 
                                                                                   menu tinyint(1) unsigned NOT NULL DEFAULT '1',
                                                                                   categoryId smallint(5) unsigned NOT NULL DEFAULT '0',
                                                                                   type tinyint(1) unsigned NOT NULL DEFAULT '1',
                                                                                   PRIMARY KEY (id)) 
                                                                                   ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4;") != 0 &&
                @mysql_query("DROP TABLE IF EXISTS " . DB_PREFIX . "settings") != 0 &&
                @mysql_query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "settings (id smallint(5) unsigned NOT NULL AUTO_INCREMENT,
                                                                                    define varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                    title varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                    summary text COLLATE utf8_unicode_ci NOT NULL,
                                                                                    value mediumtext COLLATE utf8_unicode_ci NOT NULL,
                                                                                    edit tinyint(1) unsigned NOT NULL DEFAULT '1',
                                                                                    system tinyint(1) unsigned NOT NULL DEFAULT '0',
                                                                                    PRIMARY KEY (id)) 
                                                                                    ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11;") != 0 &&
                @mysql_query("DROP TABLE IF EXISTS " . DB_PREFIX . "users") != 0 &&
                @mysql_query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "users (id smallint(5) unsigned NOT NULL AUTO_INCREMENT,
                                                                                 firstname varchar(128) COLLATE utf8_unicode_ci NOT NULL,
                                                                                 lastname varchar(128) COLLATE utf8_unicode_ci NOT NULL,
                                                                                 email varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                 username varchar(48) COLLATE utf8_unicode_ci NOT NULL,
                                                                                 password varchar(40) COLLATE utf8_unicode_ci NOT NULL,
                                                                                 gender varchar(1) COLLATE utf8_unicode_ci NOT NULL,
                                                                                 level smallint(5) unsigned NOT NULL,
                                                                                 status tinyint(1) unsigned NOT NULL DEFAULT '1',
                                                                                 PRIMARY KEY (id, username)) 
                                                                                 ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3;") != 0 &&
                @mysql_query("INSERT INTO " . DB_PREFIX . "content (id, title, slug, menuTitle, override, summary, content, metaDescription, metaKeywords, sort, status, siteIndex, botAction, menu, categoryId, type) VALUES
                                                                   (28, 'Contact Us', 'contact-us', 'Contact Us', '', 'Contact us for more information.', '<h2>Lorem Ipsum</h2><p>Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum</p>', 'This is the Contact Us page meta description', 'these, are, key, words', 3, 1, 0, 'noindex, follow', 1, 0, 1),
                                                                   (27, 'About Us', 'about-us', 'About Us', '', 'Information about who we are and what we do', '<h2>Lorem Ipsum</h2>\r\n\r\n<p>Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum</p>\r\n', 'This is the About Us page meta description', 'these, are, key, words', 2, 1, 0, 'index, follow', 1, 0, 1),
                                                                   (25, '404', '404', '404', '', '404 Page Not Found', '<p>Well this is embarrassing...</p>', '', '', 5, 1, 0, 'noindex, nofollow', 0, 0, 1),
                                                                   (26, 'Home', 'home', 'Home', '', 'You don''t always need to make difficult work of running management system with administrative panel to have a web site. Simpliste is a very simple and easy to use HTML template for web projects where you only need to create one or couple of pages with simple layout. If you are working on a lightweight information page with as less efforts for you to code and as less kilobytes for the user to download as possible, Simpliste is what you need.', '<div class=\"col_33\">\r\n<h2>Clean code</h2>\r\n<img alt=\"\" class=\"img_floatleft\" src=\"theme/simplesoft/img/ico-options.png\" />\r\n<p>HTML5 and CSS3 made live of web developers easier than ever. Welcome to the world where less code and less files required. &ldquo;Simpliste&rdquo; has different skins and all of them are created with no images for styling at all.</p>\r\n\r\n<p>Template contains CSS-reset based on the reset file from <a href=\"http://html5boilerplate.com/\" target=\"_blank\">HTML5 boilerplate</a> which makes appearens of &ldquo;Simpliste&rdquo; skins consistent in different browsers.</p>\r\n\r\n<p>Print styles and styles for mobile devices are already included in the stylesheet.</p>\r\n</div>\r\n\r\n<div class=\"col_33\">\r\n<h2>Responsive markup</h2>\r\n<img alt=\"\" class=\"img_floatleft\" src=\"theme/simplesoft/img/ico-devices.png\" />\r\n<p>You know that now it&#39;s time to think more about your users with mobile devices. This template will make your site respond to your client&#39;s browser with no effort on your part.</p>\r\n\r\n<p>Multi-column layout becomes one column for viewers with tablets, navigation elements become bigger for users with smartphones. And your desktop browser users will see just a normal web site.</p>\r\n\r\n<p>Try changing the width of your browser window and you&#39;ll see how &ldquo;Simpliste&rdquo; works.</p>\r\n</div>\r\n\r\n<div class=\"col_33\">\r\n<h2>Easy to use</h2>\r\n<img alt=\"\" class=\"img_floatleft\" src=\"theme/simplesoft/img/ico-documentation.png\" />\r\n<p>&ldquo;Simpliste&rdquo; is not a template for a CMS. You can use its code right away after downloading without reading any documentation. Place your content, make customisations and voil&agrave; the site is ready to upload to the server.</p>\r\n\r\n<p>All content management can be done by using existing sample blocks and styles. Almost every template style is represented among samples on this page. Off course you can create your own styles, which is easy as well.</p>\r\n</div>\r\n\r\n<div class=\"clearfix\">&nbsp;</div>\r\n\r\n<h1 id=\"samples\">&ldquo;Simpliste&rdquo; in use</h1>\r\n\r\n<div class=\"col_50\">\r\n<h2>Sample content</h2>\r\n\r\n<h3>Principles behind &ldquo;Simpliste&rdquo;</h3>\r\n\r\n<ul>\r\n  <li>Really simple</li>\r\n  <li>Has ready to use set of simple designs</li>\r\n  <li>It&#39;s written using HTML5 and CSS3</li>\r\n  <li>It responds to mobile devices</li>\r\n  <li>No CMS</li>\r\n  <li>Free</li>\r\n</ul>\r\n\r\n<h3>How to use?</h3>\r\n\r\n<ol>\r\n  <li>Choose one skin from the list above</li>\r\n  <li>Click download button</li>\r\n  <li>Unpack files</li>\r\n  <li>Make any customisation you need</li>\r\n  <li>Upload your new site to the server</li>\r\n</ol>\r\n</div>\r\n\r\n<div class=\"col_50\">\r\n<form action=\"#\" class=\"form\" method=\"post\">\r\n<h2>Sample form</h2>\r\n\r\n<p class=\"col_50\"><label for=\"name\">Simple name:</label><br />\r\n<input id=\"name\" name=\"name\" tabindex=\"1\" type=\"text\" value=\"\" /></p>\r\n\r\n<p class=\"col_50\"><label for=\"email\">Simple e-mail:</label><br />\r\n<input id=\"email\" name=\"email\" tabindex=\"1\" type=\"text\" value=\"\" /></p>\r\n\r\n<div class=\"clearfix\">&nbsp;</div>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>Your favorite number</h3>\r\n\r\n<div class=\"col_33\"><label for=\"radio-choice-1\"><input id=\"radio-choice-1\" name=\"radio-choice-1\" tabindex=\"2\" type=\"radio\" value=\"choice-1\" /> One</label><br />\r\n<label for=\"radio-choice-2\"><input id=\"radio-choice-2\" name=\"radio-choice-1\" tabindex=\"3\" type=\"radio\" value=\"choice-2\" /> Two</label><br />\r\n<label for=\"radio-choice-3\"><input id=\"radio-choice-3\" name=\"radio-choice-1\" tabindex=\"4\" type=\"radio\" value=\"choice-3\" /> Three</label></div>\r\n\r\n<div class=\"col_33\"><label for=\"radio-choice-4\"><input id=\"radio-choice-4\" name=\"radio-choice-1\" tabindex=\"2\" type=\"radio\" value=\"choice-1\" /> Four</label><br />\r\n<label for=\"radio-choice-5\"><input id=\"radio-choice-5\" name=\"radio-choice-1\" tabindex=\"3\" type=\"radio\" value=\"choice-2\" /> Five</label><br />\r\n<label for=\"radio-choice-6\"><input id=\"radio-choice-6\" name=\"radio-choice-1\" tabindex=\"4\" type=\"radio\" value=\"choice-3\" /> Six</label></div>\r\n\r\n<div class=\"col_33\"><label for=\"radio-choice-7\"><input id=\"radio-choice-7\" name=\"radio-choice-1\" tabindex=\"2\" type=\"radio\" value=\"choice-1\" /> Seven</label><br />\r\n<label for=\"radio-choice-8\"><input id=\"radio-choice-8\" name=\"radio-choice-1\" tabindex=\"3\" type=\"radio\" value=\"choice-2\" /> Eight</label><br />\r\n<label for=\"radio-choice-9\"><input id=\"radio-choice-9\" name=\"radio-choice-1\" tabindex=\"3\" type=\"radio\" value=\"choice-2\" /> Niine</label></div>\r\n\r\n<div class=\"clearfix\">&nbsp;</div>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><label for=\"select-choice\">Simple city:</label> <select id=\"select-choice\" name=\"select-choice\"><option value=\"Choice 1\">London</option><option value=\"Choice 2\">Paris</option><option value=\"Choice 3\">Rome</option> </select></p>\r\n\r\n<p><label for=\"textarea\">Simple testimonial:</label><br />\r\n<textarea cols=\"40\" id=\"textarea\" name=\"textarea\" rows=\"8\"></textarea></p>\r\n\r\n<p><label for=\"checkbox\"><input id=\"checkbox\" name=\"checkbox\" type=\"checkbox\" /> Simple agreement</label></p>\r\n\r\n<div><button class=\"button\" type=\"button\">Submit</button></div>\r\n</form>\r\n</div>\r\n\r\n<div class=\"clearfix\">&nbsp;</div>\r\n\r\n<div class=\"col_33\">\r\n<h2>More elements</h2>\r\n\r\n<p>Use <code>strong</code> tag for information with <strong>strong importance</strong>. Use <code>em</code> tag to <em>stress emphasis</em> on a word or phrase.</p>\r\n\r\n<p class=\"warning\">Sample <code>.warning</code></p>\r\n\r\n<p class=\"success\">Sample <code>.success</code></p>\r\n\r\n<p class=\"message\">Sample <code>.message</code></p>\r\n</div>\r\n\r\n<div class=\"col_66\">\r\n<h2>CSS classes table</h2>\r\n\r\n<table class=\"table\">\r\n  <tbody>\r\n    <tr>\r\n      <th>Class</th>\r\n      <th>Description</th>\r\n    </tr>\r\n    <tr>\r\n      <td><code>.col_33</code></td>\r\n      <td>Column with 33% width</td>\r\n    </tr>\r\n    <tr>\r\n      <td><code>.col_50</code></td>\r\n      <td>Column with 50% width</td>\r\n    </tr>\r\n    <tr>\r\n      <td><code>.col_66</code></td>\r\n      <td>Column with 66% width</td>\r\n    </tr>\r\n    <tr>\r\n      <td><code>.col_100</code></td>\r\n      <td>Full width column with proper margins</td>\r\n    </tr>\r\n    <tr>\r\n      <td><code>.clearfix</code></td>\r\n      <td>Use after or wrap a block of floated columns</td>\r\n    </tr>\r\n    <tr>\r\n      <td><code>.left</code></td>\r\n      <td>Left text alignment</td>\r\n    </tr>\r\n    <tr>\r\n      <td><code>.right</code></td>\r\n      <td>Right text alignment</td>\r\n    </tr>\r\n    <tr>\r\n      <td><code>.center</code></td>\r\n      <td>Centered text alignment</td>\r\n    </tr>\r\n    <tr>\r\n      <td><code>.img_floatleft</code></td>\r\n      <td>Left alignment for images in content</td>\r\n    </tr>\r\n    <tr>\r\n      <td><code>.img_floatright</code></td>\r\n      <td>Right alignment for images in content</td>\r\n    </tr>\r\n    <tr>\r\n      <td><code>.img</code></td>\r\n      <td>Makes image change its width when browser window width is changed</td>\r\n    </tr>\r\n  </tbody>\r\n</table>\r\n</div>\r\n\r\n<div class=\"clearfix\">&nbsp;</div>\r\n', 'This is the Home page meta description', 'these, are, key, words', 0, 1, 1, 'index, follow', 1, 0, 1),
                                                                   (22, 'Info Pages', 'info-pages', 'Info Pages', '', '', '<h2>Lorem Ipsum</h2>\r\n\r\n<p>Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum</p>\r\n', 'meta description', 'key,words', 1, 1, 0, 'index, follow', 1, 0, 0),
                                                                   (23, 'Sub Category 2', 'sub-category-2', 'Sub Category 2', '', '', '<h2>Lorem Ipsum</h2>\r\n<p>Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum</p>', 'meta description', 'key,words', 2, 0, 0, 'index, follow', 1, 22, 0),
                                                                   (34, 'Test Page', 'test-page', 'Test Page', '', 'Test Summary', '<h2>Lorem Ipsum</h2>\r\n<p>Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum</p>', '', '', 0, 1, 0, 'index, follow', 1, 22, 1),
                                                                   (35, 'Sub Category 1', 'sub-category-1', 'Sub Category 1', '', '', '<h2>Lorem Ipsum</h2>\r\n<p>Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum</p>', '', '', 1, 1, 0, 'index, follow', 1, 22, 0),
                                                                   (36, 'Test Page 2', 'test-page-2', 'Test Page 2', '', '', '<h2>Lorem Ipsum</h2>\r\n<p>Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum</p>', '', '', 1, 1, 0, 'index, follow', 1, 35, 1)") != 0 && 
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
                                                                    (10, 'testSetting', 'Test Setting', 'Test Summary', 'Test Value', 1, 0);") != 0 &&
                @mysql_query("INSERT INTO " . DB_PREFIX . "users (id, firstname, lastname, email, username, password, gender, level, status) VALUES 
                                                                 (1, '" . $firstname . "', '" . $lastname . "', '" . $email . "', '" . $username . "', '" . $password . "', '" . $gender . "', 99, 1);")) 
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
                  <label for="database_host" class="control-label">Database Host</label>
                  <div class="controls">
                    <input class="text-input small-input" type="text" id="database_host" name="database_host" value="<?php echo (isset($database_host)) ? $database_host : 'localhost'; ?>" required />
                  </div>
                </div>
                
                <div class="control-group">
                  <label for="database_prefix" class="control-label">Database Tables Prefix</label>
                  <div class="controls">
                    <input class="text-input small-input" type="text" id="database_prefix" name="database_prefix" value="<?php echo (isset($database_prefix)) ? $database_prefix : 'gnsCMS_'; ?>" />
                  </div>
                </div>
                
                <div class="control-group">
                  <label for="database_name" class="control-label">Database Name</label>
                  <div class="controls">
                    <input class="text-input small-input" type="text" id="database_name" name="database_name" value="<?php echo $database_name; ?>" required />
                  </div>
                </div>
                
                <div class="control-group">
                  <label for="database_username" class="control-label">Database Username</label>
                  <div class="controls">
                    <input class="text-input small-input" type="text" id="database_username" name="database_username" value="<?php echo $database_username; ?>" required />
                  </div>
                </div>
                
                <div class="control-group">
                  <label for="database_password" class="control-label">Database Password</label>
                  <div class="controls">
                    <input class="text-input small-input" type="password" id="database_password" name="database_password" value="<?php echo $database_password; ?>" required />
                  </div>
                </div>
                
                <div class="control-group">
                  <label for="firstname" class="control-label">Admin First Name</label>
                  <div class="controls">
                    <input class="text-input small-input" type="text" id="firstname" name="firstname" value="<?php echo $firstname; ?>" required />
                  </div>
                </div>
                
                <div class="control-group">
                  <label for="" class="control-label">Admin Last Name</label>
                  <div class="controls">
                    <input class="text-input small-input" type="text" id="lastname" name="lastname" value="<?php echo $lastname; ?>" required />
                  </div>
                </div>
                
                <div class="control-group">
                  <label for="email" class="control-label">Admin Email</label>
                  <div class="controls">
                    <input class="text-input small-input" type="text" id="email" name="email" value="<?php echo $email; ?>" required />
                  </div>
                </div>
                
                <div class="control-group">
                  <label for="username" class="control-label">Admin Username</label>
                  <div class="controls">
                    <input class="text-input small-input" type="text" id="username" name="username" value="<?php echo $username; ?>" required />
                  </div>
                </div>
                
                <div class="control-group">
                  <label for="password" class="control-label">Admin Password</label>
                  <div class="controls">
                    <input class="text-input small-input" type="password" id="password" name="password" value="" required autocomplete="off" onkeyup="passwordStrength(this.value)" />
                  </div>
                </div>
                
                <div class="control-group">
                  <label for="confirm_password" class="control-label">Confirm Password</label>
                  <div class="controls">
                    <input class="text-input small-input" type="password" id="confirm_password" name="confirm_password" value="" required autocomplete="off" onkeyup="checkPass(); return false;" />&nbsp;<span id="passwordMessage" class="passwordMessage"></span>
                  </div>
                </div>
                
                <div class="control-group">
                  <label for="passwordStrength" class="control-label">Password strength</label>
                  <div class="controls">
                    <div id="passwordDescription">Password not entered</div>
                    <div id="passwordStrength" class="strength0"></div>
                  </div>
                </div>
                
                <div class="control-group">
                  <label for="gender" class="control-label">Gender</label>
                  <div class="controls">
                    <label class="radio">
                      <div class="radio"><span><input type="radio" value="m" name="gender" style="opacity: 0;"></span></div>
                      Male
                    </label>
                    <div style="clear:both"></div>
                    <label class="radio">
                      <div class="radio"><span><input type="radio" value="f" name="gender" style="opacity: 0;"></span></div>
                      Female
                    </label>
                  </div>
                </div>
                
                <input type="hidden" id="level" name="level" value="99" />
                <input type="hidden" id="status" name="status" value="1" />
                
                <div class="control-group">
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