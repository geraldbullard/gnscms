<?php
  // DATABASE CONNECTION INFORMATION ///////////////////////////////////////////////////////////
  ini_set('display_errors', true);
  define('DB_DSN', 'mysql:host=localhost;dbname=gnsplane_ancms' );
  date_default_timezone_set('US/Eastern');                     // http://www.php.net/manual/en/timezones.php later add to install as dropdown option
  define('DB_HOST', 'localhost');                 // Database host
  define('DB_NAME', 'gnsplane_ancms');                 // Database name
  define('DB_USERNAME', 'gnsplane_psd');         // User name for access to database
  define('DB_PASSWORD', 'P4ss12e4');         // Password for access to database
  define('DB_ENCRYPT_KEY', 'ZlG8Rc5kyoX3WhsGwgcV9lTq');          // Database encryption key
  define('DB_PREFIX', 'gnsCMS_');             // Unique prefix of table names
  define('ADMIN_USERNAME', 'admin');               // Admin username until moved to database
  define('ADMIN_PASSWORD', 'P4ss12e4');               // Admin password until moved to database
  define('INCLUDES_PATH', 'includes');                         // path to includes
?>