<?php
  function fileManager() {
    if ($_SESSION['access']->files > 0) {
      require( "inc/layout/fileManager.php" );
    } else {
      require( "inc/layout/noAccess.php" );
    }
  }
?>