<?php
  function theme() {
    global $lang;
    $page_lang = scandir('inc/lang/' . $_SESSION['language']);
    foreach ($page_lang as $file) {
      if ($file != '.' && $file != '..') {
        $parts = explode(".", $file); 
        $page = $parts[0];
        if ($page == 'theme') {
          $page_file = $file;
        }
      }
    }
    include_once('inc/lang/' . $_SESSION['language'] . '/' . $page_file);
    if ($_SESSION['access']->themes > 0) {
      if ( isset( $_GET['error'] ) ) {
        if ( $_GET['error'] == "themeNotActivated" ) $results['errorMessage'] = "Error: The current theme was not updated. Please try again.";
      }
      if ( isset( $_GET['success'] ) ) {
        if ( $_GET['success'] == "themeActivated" ) $results['successMessage'] = "Your current theme has been updated successfully.";
      }
      require( "inc/layout/theme.php" );
    } else {
      require( "inc/layout/noAccess.php" );
    }
  }
?>