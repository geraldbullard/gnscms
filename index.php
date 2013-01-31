<?php
  if (!file_exists('inc/config.php')) {
    if (file_exists('install.php')) {  
      header("Location: install.php");
    } else {
      die('You are missing needed files. Please upload the files from our archive and try this again.');
    }
  }
  
  require('inc/top.php');
  
  if ($_SESSION['authuser'] != ADMIN_USERNAME) {
    header("Location: login.php?action=notLogged");
  }

  switch ( $action ) {
    case 'newPage':
      require('inc/functions/newPage.php');
      newPage();
      break;
    case 'listPage':
      require('inc/functions/listPage.php');
      listPages();
      break;
    case 'editPage':
      require('inc/functions/editPage.php');
      editPage();
      break;
    case 'enablePage':
      require('inc/functions/enablePage.php');
      enablePage();
      break;
    case 'disablePage':
      require('inc/functions/disablePage.php');
      disablePage();
      break;
    case 'deletePage':
      require('inc/functions/deletePage.php');
      deletePage();
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
    default:
      require('inc/functions/dashboard.php');
      dashboard();
  }
?>