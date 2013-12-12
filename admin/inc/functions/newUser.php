<?php 
  function newUser() {
    global $lang;
    if ( isset( $_POST['saveChanges'] ) ) {
      $results = array();
      $results['pageTitle'] = 'New User';
      // User has posted the new user form: save the new user in the db
      $user = new User;
      $user->storeFormValues( $_POST );
      $user->insert();
      header( "Location: index.php?action=listUser&success=userCreated" );
    } else {
      // the new user form was not submitted, return to the user listing page
      header( "Location: index.php?action=listUser" );
    }
  }
?>