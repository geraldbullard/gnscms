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
      if ( $_GET['error'] == "categoryNotFound" ) $results['errorMessage'] = "Error: Category not found.";
      if ( $_GET['error'] == "statusNotUpdated" ) $results['errorMessage'] = "Error: The category status was not updated. Please try again.";
    }
    if ( isset( $_GET['success'] ) ) {
      if ( $_GET['success'] == "changesSaved" ) $results['successMessage'] = "Your category changes have been saved successfully.";
      if ( $_GET['success'] == "pageCreated" ) $results['successMessage'] = "Your new category has been created successfully.";
      if ( $_GET['success'] == "pageDeleted" ) $results['successMessage'] = "The category was deleted successfully.";
      if ( $_GET['success'] == "statusUpdated" ) $results['successMessage'] = "The categopry status was updated successfully.";
    }
    require( "inc/layout/listContent.php" );
  }
?>