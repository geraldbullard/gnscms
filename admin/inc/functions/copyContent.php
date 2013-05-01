<?php
  function copyContent() {
    if ( isset( $_POST['saveChanges'] ) ) {
      $_POST['categoryId'] = $_POST['copyId'];
      $_POST['id'] = $_POST['contentId'];
      $content = new Content;
      $content->storeFormValues( $_POST );
      $content->copyContent();
      header( "Location: index.php?action=listContent&categoryId=" . $_POST['categoryId'] . "&success=contentCopied" );        
    }
  }
?>