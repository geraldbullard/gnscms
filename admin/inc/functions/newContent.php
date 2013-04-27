<?php
  function newContent() {
    if ( isset( $_POST['saveChanges'] ) ) {
      ($_POST['botAction1'] == 'on') ? $botAction1 = 'index' : $botAction1 = 'noindex';
      ($_POST['botAction2'] == 'on') ? $botAction2 = 'follow' : $botAction2 = 'nofollow';
      ($_POST['menu'] == 'on') ? $_POST['menu'] = 1 : $_POST['menu'] = 0;
      $botActionArray = array($botAction1, $botAction2);
      $_POST['botAction'] = implode(", ", $botActionArray);
      $content = new Content;
      $content->storeFormValues( $_POST );
      $content->insert();
      if ($_POST['type'] == 0) {
        header( "Location: index.php?action=listContent&categoryId=" . $_GET['categoryId'] . "&success=categoryCreated" );
      } else {
        header( "Location: index.php?action=listContent&categoryId=" . $_GET['categoryId'] . "&success=pageCreated" );
      }
        
    }
  }
?>