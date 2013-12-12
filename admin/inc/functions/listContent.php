<?php
  // get and list the needed content data
  function listContent() {
    global $lang;
    if ($_SESSION['access']->content > 0) {
      $results = array();
      if (isset($_GET['categoryId']) && $_GET['categoryId'] != '' && $_GET['categoryId'] != 0) {
        $cData = Content::getByCategoryList($_GET['categoryId']);
      } else {
        $cData = Content::getTopList();
      }
      $results['content'] = $cData['results'];
      $results['totalCats'] = $cData['totalCats'];
      $results['totalPages'] = $cData['totalPages'];
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
        if ( $_GET['success'] == "contentMoved" ) $results['successMessage'] = "The content was moved successfully.";
      }
      require( "inc/layout/listContent.php" );
    } else {
      require( "inc/layout/noAccess.php" );
    }
  }
  
  // reate the breadcrumb path for content listing navigation
  function createPath($id) {
    try {
      $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD); 
      $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
      $st = $pdo->prepare("SELECT id, title, categoryId FROM " . DB_PREFIX . "content WHERE id = :id");
      $st->bindValue( ":id", $id, PDO::PARAM_INT );
      $st->execute();
      
      $result = $st->fetch();
      
      $pdo = null;    
    } catch(PDOException $e) {
      echo "ERROR: " . $e->getMessage();
    }
    
    if ($result['categoryId'] == 0) {
      $name = '<a href="index.php?action=listContent&categoryId=' . $result['id'] . '">' . $result['title'] . '</a>';  
      return $name;
    } else {
      $name = ' > <a href="index.php?action=listContent&categoryId=' . $result['id'] . '">' . $result['title'] . '</a>';
      return createPath($result['categoryId']) . " " . $name;
    }
  }
  
  // create the category listing dropdown data
  function listCategories($parent_id, $level = 0) {
    $query = "SELECT id, title FROM " . DB_PREFIX . "content WHERE categoryId = " . $parent_id . " AND type = 0 ORDER BY sort ASC";
    $res = mysql_query($query) or die($query);
    if (mysql_num_rows($res) == 0) return;
    while (list($id, $title) = mysql_fetch_row($res)) {
      if ($level == 0) {
        $add = '';
      } else {
        $add = str_repeat("&nbsp;&nbsp;", $level);
      }
      echo '<option value="' . $id . '">' . $add . $title . '</option>';
      listCategories($id, $level+1);
    }
    
    /*try {
      $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD); 
      $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
      $st = $pdo->prepare("SELECT id, title FROM " . DB_PREFIX . "content WHERE categoryId = :categoryId AND type = 0 ORDER BY sort ASC");
      $st->bindValue( ":categoryId", $parent_id, PDO::PARAM_INT );
      $st->execute(); 
      $pdo = null;    
    } catch(PDOException $e) {
      echo "ERROR: " . $e->getMessage();
    }
    
    while (list($id, $title) = $st->fetchAll()) {
      print_r($id[0]['id']);
      echo '|';
      print_r($title[0]['title']);
      if ($level == 0) {
        $add = '';
      } else {
        $add = str_repeat("&nbsp;&nbsp;" . $level, $level);
        $level = ($level+1);
      }
      echo '<option value="' . $id['id'] . '">' . $add . $title['title'] . '</option>';
      listCategories($id['id'], $level);
    }*/
  }
?>