<?php
  function activateTheme() {
    global $lang;
    if ( isset( $_GET['value'] ) ) {
      $setting = new Setting;
      $setting->storeFormValues( $_GET );
      $setting->activateTheme();
      header( "Location: index.php?action=theme&success=themeActivated" );
    } else {
      header( "Location: index.php?action=theme&error=themeNotActivated" );
    }
  }
?>