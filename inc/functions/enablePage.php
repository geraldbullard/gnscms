<?php
  function enablePage() {
    if ( isset( $_POST['status'] ) ) {
      if ( !$page = Page::getByPageId( (int)$_POST['id'] ) ) {
        header( "Location: index.php?action=listPage&error=pageNotFound" );
        return;
      } 
      $page = new Page;
      $page->storeFormValues( $_POST );
      $page->updateStatus();
      header( "Location: index.php?action=listPage&success=statusUpdated" );
    } else {
      header( "Location: index.php?action=listPage&error=statusNotUpdated" );
    }
  }
?>