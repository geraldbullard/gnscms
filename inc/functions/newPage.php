<?php
  function newPage() {
    if ( isset( $_POST['saveChanges'] ) ) {
      // set the bot action values for insert into db
      if ($_POST['botAction1'] == 'on') $botAction1 = 'index';
      if ($_POST['botAction1'] == '') $botAction1 = 'noindex';
      if ($_POST['botAction2'] == 'on') $botAction2 = 'follow';
      if ($_POST['botAction2'] == '') $botAction2 = 'nofollow';
      $botActionArray = array($botAction1, $botAction2);
      $_POST['botAction'] = implode(", ", $botActionArray);
      // continue as normal
      // User has posted the setting edit form: save the new setting
      $page = new Page;
      $page->storeFormValues( $_POST );
      $page->insert();
      header( "Location: index.php?action=listPage&success=pageCreated" );
    }
  }
?>