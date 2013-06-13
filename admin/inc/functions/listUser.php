<?php
  function listUser() {
    $results = array();
    $aResults = array();
    $data = User::getUser();
    $aData = Access::getAll();
    $results['users'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    $results['pageTitle'] = "Admin User Profiles";
    $aResults['access'] = $aData['results'];
    if ( isset( $_GET['success'] ) ) {
      if ( $_GET['success'] == "userCreated" ) $results['successMessage'] = "Your new admin user profile has been created successully.";
      if ( $_GET['success'] == "accessCreated" ) $results['successMessage'] = "Your new admin access level has been created successully.";
      if ( $_GET['success'] == "changesSaved" ) $results['successMessage'] = "Your user profile changes have been saved successully.";
      if ( $_GET['success'] == "aChangesSaved" ) $results['successMessage'] = "Your access level changes have been saved successully.";
    }
    require( "inc/layout/listUser.php" );
  }
?>