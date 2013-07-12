<?php
  function dashboard() {
    if ($_SESSION['access']->dashboard > 0) {
      require( "inc/layout/dashboard.php" );
    } else {
      require( "inc/layout/noAccess.php" );
    }
  }
?>