<?php 
  function newSetting() {
    $results = array();
    $results['pageTitle'] = 'New Setting';
    $results['formAction'] = 'newSetting';
    if ( isset( $_POST['saveChanges'] ) ) {
      // User has posted the setting edit form: save the new setting
      $setting = new Setting;
      $setting->storeFormValues( $_POST );
      $setting->insert();
      if (isset($_POST['edit']) && $_POST['edit'] == 0) {
        header( "Location: index.php?action=listSetting&success=changesSaved&attention=locked" );
      } else {
        header( "Location: index.php?action=listSetting&success=changesSaved" );
      }
    } elseif ( isset( $_POST['cancel'] ) ) {
      // User has cancelled their edits: return to the settings list
      header( "Location: index.php?action=listSetting" );
    } else {
      // User has not posted the setting edit form yet: display the form
      $results['setting'] = new Setting;
      require( "inc/layout/editSetting.php" );
    }
  }
?>