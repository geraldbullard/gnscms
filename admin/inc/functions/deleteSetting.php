<?php
  function deleteSetting() {
    if ( !$setting = Setting::getById( (int)$_GET['settingId'] ) ) {
      header( "Location: index.php?action=listSetting&error=settingNotFound" );
      return;
    }
    $setting->delete();
    header( "Location: index.php?action=listSetting&success=settingDeleted" );
  }
?>