<?php
  function newEvent() {
    if ( isset( $_POST['saveChanges'] ) ) {
      $event = new Event;
      $event->storeFormValues( $_POST );
      $event->insert();
      header( "Location: index.php?action=listEvent&success=eventCreated" );
    }
  }
?>