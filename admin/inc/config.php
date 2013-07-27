<?php
  // DATABASE CONNECTION INFORMATION ///////////////////////////////////////////////////////////
  ini_set('display_errors', true);
  define('DB_DSN', 'mysql:host=localhost;dbname=gnsplane_ancms');
  date_default_timezone_set('US/Eastern');                     // http://www.php.net/manual/en/timezones.php later add to install as dropdown option
  define('DB_HOST', 'localhost');                 // Database host
  define('DB_NAME', 'gnsplane_ancms');                 // Database name
  define('DB_USERNAME', 'gnsplane_psd');         // User name for access to database
  define('DB_PASSWORD', 'P4ss12e4');         // Password for access to database
  define('DB_ENCRYPT_KEY', '0ldxQnaXWungzcrjGV4IiXA3');          // Database encryption key
  define('DB_PREFIX', 'gnsCMS_');             // Unique prefix of table names
?>