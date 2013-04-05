<?php
  function editCategory() {
    $results = array();
    if ( isset( $_POST['saveChanges'] ) ) {
      // User has posted the category edit form: save the category changes
      if ( !$category = Category::getByCategoryId( (int)$_POST['editId'] ) ) {
        header( "Location: index.php?action=listContent&categoryId=" . $_GET['categoryId'] . "&error=categoryNotFound" );
        return;
      }
      // set the bot action values for insert into db
      ($_POST['botAction1'] == 'on') ? $botAction1 = 'index' : $botAction1 = 'noindex';
      ($_POST['botAction2'] == 'on') ? $botAction2 = 'follow' : $botAction2 = 'nofollow';
      ($_POST['menu'] == 'on') ? $_POST['menu'] = 1 : $_POST['menu'] = 0;
      $botActionArray = array($botAction1, $botAction2);
      $_POST['botAction'] = implode(", ", $botActionArray);
      // continue as normal
      $category->storeFormValues( $_POST );
      $category->update();
      header( "Location: index.php?action=listContent&categoryId=" . $_GET['categoryId'] . "&success=changesSaved" );
    } elseif ( isset( $_POST['cancel'] ) ) {
      // User has cancelled their edits: return to the category list
      header( "Location: index.php?action=listContent&categoryId=" . $_GET['categoryId'] );
    } else {
      // User has not posted the category edit form yet: display the form
      $results['category'] = Category::getByCategoryId( (int)$_GET['editId'] );
      $data = Category::getCategoryList();
      $results['categories'] = $data['results'];
      require( "inc/layout/editCategory.php" );
    }
  }
?>