<?php
  function listUser() {
    $results = array();
    $data = User::getUser();
    $results['users'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    $results['pageTitle'] = "Admin User Profiles";
    if ( isset( $_GET['success'] ) ) {
      if ( $_GET['success'] == "userCreated" ) $results['successMessage'] = "Your new admin user profile has been created successully.";
      if ( $_GET['success'] == "changesSaved" ) $results['successMessage'] = "Your user profile changes have been saved.";
    }
    require( "inc/layout/listUser.php" );
  }
?>