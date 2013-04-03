<?php
  function listContent() {
    $results = array();
    if (isset($_GET['categoryId']) && $_GET['categoryId'] != '') {
      $cData = Category::getByCategoryList($_GET['categoryId']);
      $pData = Page::getPageListByCat($_GET['categoryId']);
    } else {
      $cData = Category::getCategoryList();
      $pData = Page::getPageList();
    }
    $results['categories'] = $cData['results'];
    $results['pages'] = $pData['results'];
    $results['totalCats'] = $cData['totalRows'];
    $results['totalPages'] = $pData['totalRows'];
    if ( isset( $_GET['error'] ) ) {
      if ( $_GET['error'] == "pageNotFound" ) $results['errorMessage'] = "Error: Page not found.";
      if ( $_GET['error'] == "categoryNotFound" ) $results['errorMessage'] = "Error: Category not found.";
      if ( $_GET['error'] == "pageStatusNotUpdated" ) $results['errorMessage'] = "Error: The page status was not updated. Please try again.";
      if ( $_GET['error'] == "categoryStatusNotUpdated" ) $results['errorMessage'] = "Error: The category status was not updated. Please try again.";
    }
    if ( isset( $_GET['success'] ) ) {
      if ( $_GET['success'] == "changesSaved" ) $results['successMessage'] = "Your changes have been saved successfully.";
      if ( $_GET['success'] == "pageCreated" ) $results['successMessage'] = "Your new page has been created successfully.";
      if ( $_GET['success'] == "categoryCreated" ) $results['successMessage'] = "Your new category has been created successfully.";
      if ( $_GET['success'] == "pageDeleted" ) $results['successMessage'] = "The page was deleted successfully.";
      if ( $_GET['success'] == "categoryDeleted" ) $results['successMessage'] = "The category was deleted successfully.";
      if ( $_GET['success'] == "pageStatusUpdated" ) $results['successMessage'] = "The page status was updated successfully.";
      if ( $_GET['success'] == "categoryStatusUpdated" ) $results['successMessage'] = "The category status was updated successfully.";
    }
    require( "inc/layout/listContent.php" );
  }
?>