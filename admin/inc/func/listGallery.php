<?php
  // get and list the needed gallery data
  function listGallery() {
    global $lang;
    $page_lang = scandir('inc/lang/' . $_SESSION['lang']);
    foreach ($page_lang as $file) {
      if ($file != '.' && $file != '..') {
        $parts = explode(".", $file); 
        $page = $parts[0];
        if ($page == 'gallery') {
          $page_file = $file;
        }
      }
    }
    include_once('inc/lang/' . $_SESSION['lang'] . '/' . $page_file);
    if ($_SESSION['access']->gallery > 0) {
      /*$results = array();
      if (isset($_GET['albumId']) && $_GET['albumId'] != '' && $_GET['albumId'] != 0) {
        $aData = Gallery::getByAlbumList($_GET['albumId']);
      } else {
        $aData = Gallery::getAlbumList();
      }
      $results['gallery'] = $aData['results'];
      $results['totalAlbums'] = $aData['totalRows'];
      if ( isset( $_GET['error'] ) ) {
        //if ( $_GET['error'] == "pageNotFound" ) $results['errorMessage'] = "Error: Page not found.";
        //if ( $_GET['error'] == "categoryNotFound" ) $results['errorMessage'] = "Error: Category not found.";
        //if ( $_GET['error'] == "pageStatusNotUpdated" ) $results['errorMessage'] = "Error: The page status was not updated. Please try again.";
        //if ( $_GET['error'] == "categoryStatusNotUpdated" ) $results['errorMessage'] = "Error: The category status was not updated. Please try again.";
        //if ( $_GET['error'] == "siteIndexNotUpdated" ) $results['successMessage'] = "The site index was not updated.";
      }
      if ( isset( $_GET['success'] ) ) {
        //if ( $_GET['success'] == "changesSaved" ) $results['successMessage'] = "Your changes have been saved successfully.";
        //if ( $_GET['success'] == "categoryCreated" ) $results['successMessage'] = "Your new category has been created successfully.";
        //if ( $_GET['success'] == "pageCreated" ) $results['successMessage'] = "Your new page has been created successfully.";
        //if ( $_GET['success'] == "categoryDeleted" ) $results['successMessage'] = "The category was deleted successfully.";
        //if ( $_GET['success'] == "pageDeleted" ) $results['successMessage'] = "The page was deleted successfully.";
        //if ( $_GET['success'] == "categoryStatusUpdated" ) $results['successMessage'] = "The category status was updated successfully.";
        //if ( $_GET['success'] == "pageStatusUpdated" ) $results['successMessage'] = "The page status was updated successfully.";
        //if ( $_GET['success'] == "siteIndexUpdated" ) $results['successMessage'] = "The site index was updated successfully.";
        //if ( $_GET['success'] == "contentMoved" ) $results['successMessage'] = "The content was moved successfully.";
      }*/
      require( "inc/layout/listGallery.php" );
    } else {
      require( "inc/layout/noAccess.php" );
    }
  }
?>