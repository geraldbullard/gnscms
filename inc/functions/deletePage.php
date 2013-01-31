<?php
  function deletePage() {
    if ( !$page = Page::getByPageId( (int)$_GET['pageId'] ) ) {
      header( "Location: index.php?action=listPage&error=pageNotFound" );
      return;
    }
    $page->delete();
    header( "Location: index.php?action=listPage&success=pageDeleted" );
  }
?>
