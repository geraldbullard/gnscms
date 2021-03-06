<?php
  function editGroup() {
    global $lang;
    $page_lang = scandir('inc/lang/' . $_SESSION['language']);
    foreach ($page_lang as $file) {
      if ($file != '.' && $file != '..') {
        $parts = explode(".", $file); 
        $page = $parts[0];
        if ($page == 'group') {
          $page_file = $file;
        }
      }
    }
    include_once('inc/lang/' . $_SESSION['language'] . '/' . $page_file);
    if ($_SESSION['access']->users > 1) {
      $results = array();
      $results['formAction'] = "editGroup";
      if ( isset( $_POST['saveChanges'] ) ) {
        // User has posted the group edit form: save the group changes
        if ( !$group = Group::getById( (int)$_GET['editId'] ) ) {
          header( "Location: index.php?action=listUser&error=groupNotFound" );
          return;
        }
        $group = new Group;
        $group->storeFormValues( $_POST );
        $group->update();
        header( "Location: index.php?action=listUser&success=groupChangesSaved" );
      } elseif ( isset( $_POST['cancel'] ) ) {
        // User has cancelled their edits: return to the group list
        header( "Location: index.php?action=listUser" );
      } else {
        // User has not submitted the group edit form: display the group edit form
        $results['group'] = Group::getById( (int)$_GET['groupId'] );
        require( "inc/layout/editGroup.php" );
      }
    } else {
      require( "inc/layout/noAccess.php" );
    }
  }
?>