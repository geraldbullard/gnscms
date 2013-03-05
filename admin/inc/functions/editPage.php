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
      ($_POST['botAction1'] == 'on') ? $botAction1 = 'index' : $botAction1 = 'noindex';
      ($_POST['botAction2'] == 'on') ? $botAction2 = 'follow' : $botAction2 = 'nofollow';
      ($_POST['menu'] == 'on') ? $_POST['menu'] = 1 : $_POST['menu'] = 0;
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