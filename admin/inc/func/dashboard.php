<?php
  function dashboard() {
    global $lang;
    $page_lang = scandir('inc/lang/' . $_SESSION['language']);
    foreach ($page_lang as $file) {
      if ($file != '.' && $file != '..') {
        $parts = explode(".", $file); 
        $page = $parts[0];
        if ($page == 'dashboard') {
          $page_file = $file;
        }
      }
    }
    include_once('inc/lang/' . $_SESSION['language'] . '/' . $page_file);
    if ($_SESSION['access']->dashboard > 0) {
      require( "inc/layout/dashboard.php" );
    } else {
      require( "inc/layout/noAccess.php" );
    }
  }
?>