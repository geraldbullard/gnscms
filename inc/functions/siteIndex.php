<?php
  function siteIndex() {
    if ( isset( $_POST['siteIndex'] ) ) {
      $page = new Page;
      $page->storeFormValues( $_POST );
      $page->siteIndex();
      header( "Location: index.php?action=listPage&success=siteIndexUpdated" );
    } else {
      header( "Location: index.php?action=listPage&error=siteIndexNotUpdated" );
    }
  }
?>