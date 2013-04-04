<?php 
  require('inc/config.php');
  $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
  foreach ($_GET['listCatItem'] as $newsort => $categoryId) {
    $sql = "UPDATE " . DB_PREFIX . "categories SET sort = $newsort WHERE id = $categoryId";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
    $st->execute(); 
  }
  $conn = null;
?>