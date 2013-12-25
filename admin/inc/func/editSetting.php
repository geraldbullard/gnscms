<?php
  function editSetting() {
    global $lang;
    $page_lang = scandir('inc/lang/' . $_SESSION['language']);
    foreach ($page_lang as $file) {
      if ($file != '.' && $file != '..') {
        $parts = explode(".", $file); 
        $page = $parts[0];
        if ($page == 'setting') {
          $page_file = $file;
        }
      }
    }
    include_once('inc/lang/' . $_SESSION['language'] . '/' . $page_file);
    if ($_SESSION['access']->settings > 1) {
      $results = array();
      $results['pageTitle'] = "Edit Setting";
      $results['formAction'] = "editSetting";
      if ( isset( $_POST['saveChanges'] ) ) {
        // User has posted the setting edit form: save the setting changes
        if ( !$setting = Setting::getById( (int)$_POST['settingId'] ) ) {
          header( "Location: index.php?error=settingNotFound" );
          return;
        } 
        $setting->storeFormValues( $_POST );
        $setting->update();
        header( "Location: index.php?action=listSetting&success=changesSaved" );
      } elseif ( isset( $_POST['cancel'] ) ) {
        // User has cancelled their edits: return to the settings list
        header( "Location: index.php?action=listSetting" );
      } else {
        // User has not posted the setting edit form yet: display the form
        $results['setting'] = Setting::getById( (int)$_GET['settingId'] );
        require( "inc/layout/editSetting.php" );
      }
    } else {
      require( "inc/layout/noAccess.php" );
    }
  }
?>