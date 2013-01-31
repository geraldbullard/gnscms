<?php
  function theme() {
    if ( isset( $_GET['error'] ) ) {
      if ( $_GET['error'] == "themeNotActivated" ) $results['errorMessage'] = "Error: The current theme was not updated. Please try again.";
    }
    if ( isset( $_GET['success'] ) ) {
      if ( $_GET['success'] == "themeActivated" ) $results['successMessage'] = "Your current theme has been updated successfully.";
    }
    require( "inc/layout/theme.php" );
  }
?>