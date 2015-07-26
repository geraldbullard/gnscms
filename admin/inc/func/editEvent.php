<?php
  function editEvent() {
    global $lang;
    $page_lang = scandir('inc/lang/' . $_SESSION['lang']);
    foreach ($page_lang as $file) {
      if ($file != '.' && $file != '..') {
        $parts = explode(".", $file); 
        $page = $parts[0];
        if ($page == 'content') {
          $page_file = $file;
        }
      }
    }
    include_once('inc/lang/' . $_SESSION['lang'] . '/' . $page_file);
    if ($_SESSION['access']->events > 1) {
      $results = array();
      if ( isset( $_POST['saveChanges'] ) ) {
        $_POST['id'] = $_POST['editId'];
        unset($_POST['editId']);
        // User has posted the content edit form: save the content changes
        if ( !$event = Event::getById( (int)$_POST['id'] ) ) {
          header( "Location: index.php?action=listEvent&error=eventNotFound" );
          return;
        }
        $event = new Event;
        $event->storeFormValues( $_POST );
        $event->update();
        header( "Location: index.php?action=listEvent&success=changesSaved" );
      } elseif ( isset( $_POST['cancel'] ) ) {
        // User has cancelled their edits: return to the events list
        header( "Location: index.php?action=listEvent" );
      } else {
        if ( !$event = Event::getById( (int)$_GET['editId'] ) ) {
          header( "Location: index.php?action=listEvent&error=eventNotFound" );
          return;
        }
        // User has not submitted the event edit form: display the form
        $results['event'] = Event::getById( (int)$_GET['editId'] );
        require( "inc/layout/editEvent.php" );
      }
    } else {
      require( "inc/layout/noAccess.php" );
    }
  }
?>