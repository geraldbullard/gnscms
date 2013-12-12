<?php
  function moveContent() {
    global $lang;
    if ( isset( $_POST['saveChanges'] ) ) {
      $_POST['categoryId'] = $_POST['moveId'];
      $_POST['id'] = $_POST['contentId'];
      $content = new Content;
      $content->storeFormValues( $_POST );
      $content->moveContent();
      header( "Location: index.php?action=listContent&categoryId=" . $_POST['categoryId'] . "&success=contentMoved" );        
    }
  }
?>