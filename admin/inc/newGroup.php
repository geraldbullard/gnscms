<?php 
  function newGroup() {
    if ( isset( $_POST['saveChanges'] ) ) {
      $results = array();
      $results['pageTitle'] = 'New Group';
      // User has posted the new group form: save the new group in the db
      $group = new Group;
      $group->storeFormValues( $_POST );
      $group->insert();
      header( "Location: index.php?action=listUser&success=groupCreated&newGroup=" . $group->id );
    } else {
      // the new group form was not submitted, return to the user listing page
      header( "Location: index.php?action=listUser" );
    }
  }
?>