<?php
  if (!file_exists('inc/config.php')) {
    if (file_exists('install.php')) {  
      header("Location: install.php");
    } else {
      die('You are missing needed files. Please upload the files from our archive and try this again.');
    }
  }
  
  require('inc/top.php');
  
  switch ( $action ) {
    case 'newContent':
      require('inc/functions/newContent.php');
      newContent();
      break;
    case 'listContent':
      require('inc/functions/listContent.php');
      listContent();
      break;
    case 'editContent':
      require('inc/functions/editContent.php');
      editContent();
      break;
    case 'copyContent':
      require('inc/functions/copyContent.php');
      copyContent();
      break;
    case 'moveContent':
      require('inc/functions/moveContent.php');
      moveContent();
      break;
    case 'siteIndex':
      require('inc/functions/siteIndex.php');
      siteIndex();
      break;
    case 'newSetting':
      require('inc/functions/newSetting.php');
      newSetting();
      break;
    case 'listSetting':
      require('inc/functions/listSetting.php');
      listSettings();
      break;
    case 'editSetting':
      require('inc/functions/editSetting.php');
      editSetting();
      break;
    case 'deleteSetting':
      require('inc/functions/deleteSetting.php');
      deleteSetting();
      break;
    case 'theme':
      require('inc/functions/theme.php');
      theme();
      break;
    case 'activateTheme':
      require('inc/functions/activateTheme.php');
      activateTheme();
      break;
    case 'fileManager':
      $directAccess = true;
      require('inc/functions/fileManager.php');
      fileManager();
      break;
    case 'listUser':
      require('inc/functions/listUser.php');
      listUser();
      break;
    case 'newUser':
      require('inc/functions/newUser.php');
      newUser();
      break;
    case 'editUser':
      require('inc/functions/editUser.php');
      editUser();
      break;
    default:
      require('inc/functions/dashboard.php');
      dashboard();
  }
?>