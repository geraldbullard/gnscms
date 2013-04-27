<?php
  function siteIndex() {
    if ( isset( $_POST['siteIndex'] ) ) {
      $content = new Content;
      $content->storeFormValues( $_POST );
      $content->siteIndex();
      header( "Location: index.php?action=listContent&success=siteIndexUpdated" );
    } else {
      header( "Location: index.php?action=listContent&error=siteIndexNotUpdated" );
    }
  }
?>