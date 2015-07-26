<?php
  function listEvent() {
    global $lang;
    $page_lang = scandir('inc/lang/' . $_SESSION['lang']);
    foreach ($page_lang as $file) {
      if ($file != '.' && $file != '..') {
        $parts = explode(".", $file); 
        $page = $parts[0];
        if ($page == 'event') {
          $page_file = $file;
        }
      }
    }
    include_once('inc/lang/' . $_SESSION['lang'] . '/' . $page_file);
    if ($_SESSION['access']->events > 0) {
      $results = array();
      $data = Event::getAll();
      $results['events'] = $data['results'];
      $results['totalEvents'] = $data['totalRows'];
      $results['pageTitle'] = "Events Calendar"; // $lang['events_page_title'];
      if ( isset( $_GET['error'] ) ) {
        if ( $_GET['error'] == "eventNotFound" ) $results['errorMessage'] = "Error: Event not found.";
      }
      if ( isset( $_GET['success'] ) ) {
        if ( $_GET['success'] == "eventCreated" ) $results['successMessage'] = "Your new event has been created successully.";
        if ( $_GET['success'] == "changesSaved" ) $results['successMessage'] = "Your event changes have been saved.";
      }
      require( "inc/layout/listEvent.php" );
    } else {
      require( "inc/layout/noAccess.php" );
    }
  }
?>