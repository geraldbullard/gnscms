<?php
  function editContent() {
    global $lang;
    $page_lang = scandir('inc/lang/' . $_SESSION['language']);
    foreach ($page_lang as $file) {
      if ($file != '.' && $file != '..') {
        $parts = explode(".", $file); 
        $page = $parts[0];
        if ($page == 'content') {
          $page_file = $file;
        }
      }
    }
    include_once('inc/lang/' . $_SESSION['language'] . '/' . $page_file);
    if ($_SESSION['access']->content > 1) {
      $results = array();
      if ( isset( $_POST['saveChanges'] ) ) {
        $_POST['id'] = $_POST['editId'];
        unset($_POST['editId']);
        // User has posted the content edit form: save the content changes
        if ( !$content = Content::getById( (int)$_POST['id'] ) ) {
          header( "Location: index.php?action=listContent&categoryId=" . $_GET['categoryId'] . "&error=" . ($_POST['type'] == 0) ? "category" : "page" . "NotFound" );
          return;
        }
        ($_POST['botAction1'] == 'on') ? $botAction1 = 'index' : $botAction1 = 'noindex';
        ($_POST['botAction2'] == 'on') ? $botAction2 = 'follow' : $botAction2 = 'nofollow';
        ($_POST['menu'] == 'on') ? $_POST['menu'] = 1 : $_POST['menu'] = 0;
        $botActionArray = array($botAction1, $botAction2);
        $_POST['botAction'] = implode(", ", $botActionArray);
        unset($_POST['botAction1']);
        unset($_POST['botAction2']);
        $_POST['lastModified'] = date('Y-m-d');
        $content = new Content;
        $content->storeFormValues( $_POST );
        $content->update();
        header( "Location: index.php?action=listContent&categoryId=" . $_GET['categoryId'] . "&success=changesSaved" );
      } elseif ( isset( $_POST['cancel'] ) ) {
        // User has cancelled their edits: return to the content list
        header( "Location: index.php?action=listContent&categoryId=" . $_GET['categoryId'] );
      } else {
        // User has not submitted the content edit form: display the form
        $results['content'] = Content::getById( (int)$_GET['editId'] );
        require( "inc/layout/editContent.php" );
      }
    } else {
      require( "inc/layout/noAccess.php" );
    }
  }
?>