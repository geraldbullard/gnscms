<?php
  function editUser() {
    $results = array();
    $results['formAction'] = "editUser";
    if ( isset( $_POST['saveChanges'] ) ) {
      // User has posted the user edit form: save the user changes
      if ( !$user = User::getById( (int)$_GET['editId'] ) ) {
        header( "Location: index.php?action=listUser&error=userNotFound" );
        return;
      }
      if ( !empty( $_POST['newPassword'] ) ) {
        $_POST['password'] = md5( $_POST['newPassword'] );
      }
      unset($_POST['newPassword']);
      unset($_POST['newPassConfirm']);
      $user->storeFormValues( $_POST );
      $user->update();
      header( "Location: index.php?action=listUser&success=changesSaved" );
    } elseif ( isset( $_POST['cancel'] ) ) {
      // User has cancelled their edits: return to the user list
      header( "Location: index.php?action=listUser" );
    } else {
      // User has not submitted the user edit form: display the user listing
      $results['user'] = User::getById( (int)$_GET['userId'] );
      require( "inc/layout/editUser.php" );
    }
  }
?>