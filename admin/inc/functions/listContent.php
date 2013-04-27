<?php
  function listContent() {
    $results = array();
    if (isset($_GET['categoryId']) && $_GET['categoryId'] != '' && $_GET['categoryId'] != 0) {
      $cData = Content::getByCategoryList($_GET['categoryId']);
    } else {
      $cData = Content::getTopList();
    }
    $results['content'] = $cData['results'];
    $results['totalCats'] = $cData['totalRows'];
    if ( isset( $_GET['error'] ) ) {
      if ( $_GET['error'] == "pageNotFound" ) $results['errorMessage'] = "Error: Page not found.";
      if ( $_GET['error'] == "categoryNotFound" ) $results['errorMessage'] = "Error: Category not found.";
      if ( $_GET['error'] == "pageStatusNotUpdated" ) $results['errorMessage'] = "Error: The page status was not updated. Please try again.";
      if ( $_GET['error'] == "categoryStatusNotUpdated" ) $results['errorMessage'] = "Error: The category status was not updated. Please try again.";
      if ( $_GET['error'] == "siteIndexNotUpdated" ) $results['successMessage'] = "The site index was not updated.";
    }
    if ( isset( $_GET['success'] ) ) {
      if ( $_GET['success'] == "changesSaved" ) $results['successMessage'] = "Your changes have been saved successfully.";
      if ( $_GET['success'] == "categoryCreated" ) $results['successMessage'] = "Your new category has been created successfully.";
      if ( $_GET['success'] == "pageCreated" ) $results['successMessage'] = "Your new page has been created successfully.";
      if ( $_GET['success'] == "categoryDeleted" ) $results['successMessage'] = "The category was deleted successfully.";
      if ( $_GET['success'] == "pageDeleted" ) $results['successMessage'] = "The page was deleted successfully.";
      if ( $_GET['success'] == "categoryStatusUpdated" ) $results['successMessage'] = "The category status was updated successfully.";
      if ( $_GET['success'] == "pageStatusUpdated" ) $results['successMessage'] = "The page status was updated successfully.";
      if ( $_GET['success'] == "siteIndexUpdated" ) $results['successMessage'] = "The site index was updated successfully.";
    }
    require( "inc/layout/listContent.php" );
  }
?>