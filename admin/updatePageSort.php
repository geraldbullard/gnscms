<?php 
  require('inc/config.php');
  $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
  foreach ($_GET['listItem'] as $newsort => $pageId) {
    $sql = "UPDATE " . DB_PREFIX . "pages SET sort = $newsort WHERE id = $pageId";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
    $st->execute(); 
  }
  $conn = null;
?>