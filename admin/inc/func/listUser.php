<?php
  function listUser() {
    global $lang;
    $page_lang = scandir('inc/lang/' . $_SESSION['language']);
    foreach ($page_lang as $file) {
      if ($file != '.' && $file != '..') {
        $parts = explode(".", $file); 
        $page = $parts[0];
        if ($page == 'user') {
          $page_file = $file;
        }
      }
    }
    include_once('inc/lang/' . $_SESSION['language'] . '/' . $page_file);
    if ($_SESSION['access']->users > 0) {
      $results = array();
      $gResults = array();
      $data = User::getAll();
      $gData = Group::getAll();
      $results['users'] = $data['results'];
      $results['totalRows'] = $data['totalRows'];
      $results['pageTitle'] = "Admin User Management";
      $gResults['groups'] = $gData['results'];
      $gResults['totalRows'] = $gData['totalRows'];
      if ( isset( $_GET['success'] ) ) {
        if ( $_GET['success'] == "userCreated" ) $results['successMessage'] = "Your new admin user profile has been created successully.";
        if ( $_GET['success'] == "groupCreated" ) $results['successMessage'] = "Your new admin group has been created successully.";
        if ( $_GET['success'] == "changesSaved" ) $results['successMessage'] = "Your user profile changes have been saved successully.";
        if ( $_GET['success'] == "groupChangesSaved" ) $results['successMessage'] = "Your group changes have been saved successully.";
      }
      require( "inc/layout/listUser.php" );
    } else {
      require( "inc/layout/noAccess.php" );
    }
  }
?>