<?php
  require('inc/config.php');
  $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
  if (isset($_GET['leftadd'])) {
    
  }
  if (isset($_GET['rightadd'])) {
    
  }
  if (isset($_GET['sort'])) {
    foreach ($_GET['box'] as $newsort => $box) {
      $box = 'box_' . $box . '.php';
      $sql = 'UPDATE ' . DB_PREFIX . 'blocks SET sort = ' . $newsort . ' WHERE filename = "' . $box . '"';
      $st = $conn->prepare( $sql );
      $st->execute(); 
    }
  }
  $conn = null;
?>