<?php
  function listPages() {
    $results = array();
    $data = Page::getPageList();
    $results['pages'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    if ( isset( $_GET['error'] ) ) {
      if ( $_GET['error'] == "pageNotFound" ) $results['errorMessage'] = "Error: Page not found.";
      if ( $_GET['error'] == "statusNotUpdated" ) $results['errorMessage'] = "Error: The page status was not updated. Please try again.";
      if ( $_GET['error'] == "siteIndexNotUpdated" ) $results['errorMessage'] = "Error: The site index page was not updated. Please try again.";
    }
    if ( isset( $_GET['success'] ) ) {
      if ( $_GET['success'] == "changesSaved" ) $results['successMessage'] = "Your page changes have been saved successfully.";
      if ( $_GET['success'] == "pageCreated" ) $results['successMessage'] = "Your new page has been created successfully.";
      if ( $_GET['success'] == "pageDeleted" ) $results['successMessage'] = "The page was deleted successfully.";
      if ( $_GET['success'] == "statusUpdated" ) $results['successMessage'] = "The page status was updated successfully.";
      if ( $_GET['success'] == "siteIndexUpdated" ) $results['successMessage'] = "The site index page was updated successfully.";
    }
    require( "inc/layout/listPages.php" );
  }
?>