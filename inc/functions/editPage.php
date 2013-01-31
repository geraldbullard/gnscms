<?php
  function editPage() {
    $results = array();
    if ( isset( $_POST['saveChanges'] ) ) {
      // User has posted the page edit form: save the page changes
      if ( !$page = Page::getByPageId( (int)$_POST['pageId'] ) ) {
        header( "Location: index.php?action=listPage&error=pageNotFound" );
        return;
      }
      // set the bot action values for insert into db
      if ($_POST['botAction1'] == 'on') $botAction1 = 'index';
      if ($_POST['botAction1'] == '') $botAction1 = 'noindex';
      if ($_POST['botAction2'] == 'on') $botAction2 = 'follow';
      if ($_POST['botAction2'] == '') $botAction2 = 'nofollow';
      $botActionArray = array($botAction1, $botAction2);
      $_POST['botAction'] = implode(", ", $botActionArray);
      // continue as normal
      $page->storeFormValues( $_POST );
      $page->update();
      header( "Location: index.php?action=listPage&success=changesSaved" );
    } elseif ( isset( $_POST['cancel'] ) ) {
      // User has cancelled their edits: return to the page list
      header( "Location: index.php?action=listPage" );
    } else {
      // User has not posted the page edit form yet: display the form
      $results['page'] = Page::getByPageId( (int)$_GET['pageId'] );
      $data = Page::getPageList();
      $results['pages'] = $data['results'];
      require( "inc/layout/editPage.php" );
    }
  }
?>