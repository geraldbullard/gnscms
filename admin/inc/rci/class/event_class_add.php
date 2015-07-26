<?php
  $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  
  $eventsTableExists = (mysql_num_rows(mysql_query("SHOW COLUMNS FROM " . DB_PREFIX . "groups LIKE 'events'"))) ? true : false;
  if ($eventsTableExists !== true) {
    mysql_query("ALTER TABLE " . DB_PREFIX . "_groups ADD events TINYINT(1) UNSIGNED NOT NULL DEFAULT '1'");
  }
  
  require_once('inc/class/Event.class.php');
  
  // set the action from the url
  $action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
  
  // enable the event
  if ($action == 'enableEvent') {
    $event = new Event;
    $event->storeFormValues($_GET);
    $event->updateStatus(); 
  }
  
  // disable the event
  if ($action == 'disableEvent') {
    $event = new Event;
    $event->storeFormValues($_GET);
    $event->updateStatus(); 
  }
  
  // delete the event
  if ($action == 'deleteEvent') {
    $event = new Event;
    $event->storeFormValues($_GET);
    $event->delete(); 
  }
  
  // if $_POST is detected
  if (isset($_POST['events'])) {
    $_SESSION['postevents'] = ($_POST['events'] != '') ? $_POST['events'] : 0;
  }
  
  if (isset($_GET['newGroup']) && $_GET['newGroup'] != '') {
    // Update the events access level for new groups
    $update = "UPDATE " . DB_PREFIX . "groups SET events = :events WHERE id = :id";  
    $st = $conn->prepare ( $update );
    $st->bindValue( ":events", $_SESSION['postevents'], PDO::PARAM_INT );
    $st->bindValue( ":id", $_GET['newGroup'], PDO::PARAM_INT );
    $st->execute();
  } else if (isset($_POST['events']) && !isset($_GET['newGroup'])) {
    // Update the events access level for existing groups
    $update = "UPDATE " . DB_PREFIX . "groups SET events = :events WHERE id = :id";  
    $st = $conn->prepare ( $update );
    $st->bindValue( ":events", ($_POST['events'] != '') ? $_POST['events'] : 0, PDO::PARAM_INT );
    $st->bindValue( ":id", $_GET['editId'], PDO::PARAM_INT );
    $st->execute();
  }
  
  // Get the current edit access level for events
  $editaccess = "SELECT events FROM " . DB_PREFIX . "groups WHERE id = :id";  
  $ea = $conn->prepare ( $editaccess );
  $ea->bindValue( ":id", $_GET['groupId'], PDO::PARAM_INT );
  $ea->execute();
  
  $ea = $ea->fetch();
    
  $_SESSION['editaccess'] = $ea['events'];
  
  // Get the logged in admin access level for events
  $sessionaccess = "SELECT events FROM " . DB_PREFIX . "groups WHERE id = :id";  
  $sa = $conn->prepare ( $sessionaccess );
  $sa->bindValue( ":id", User::getGroupID($_SESSION['authuser']), PDO::PARAM_INT );
  $sa->execute();
  
  $sa = $sa->fetch();
    
  $_SESSION['access']->events = $sa['events'];
  
  $conn = null;
?>
