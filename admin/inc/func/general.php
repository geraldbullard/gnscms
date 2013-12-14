<?php
  
  function load_page_content( $_action ) {
    switch ( $_action ) {
      case 'newContent':
        require_once('inc/func/newContent.php');
        newContent();
        break;
      case 'listContent':
        require_once('inc/func/listContent.php');
        listContent();
        break;
      case 'editContent':
        require_once('inc/func/editContent.php');
        editContent();
        break;
      case 'copyContent':
        require_once('inc/func/copyContent.php');
        copyContent();
        break;
      case 'moveContent':
        require_once('inc/func/moveContent.php');
        moveContent();
        break;
      case 'siteIndex':
        require_once('inc/func/siteIndex.php');
        siteIndex();
        break;
      case 'newSetting':
        require_once('inc/func/newSetting.php');
        newSetting();
        break;
      case 'listSetting':
        require_once('inc/func/listSetting.php');
        listSettings();
        break;
      case 'editSetting':
        require_once('inc/func/editSetting.php');
        editSetting();
        break;
      case 'deleteSetting':
        require_once('inc/func/deleteSetting.php');
        deleteSetting();
        break;
      case 'theme':
        require_once('inc/func/theme.php');
        theme();
        break;
      case 'activateTheme':
        require_once('inc/func/activateTheme.php');
        activateTheme();
        break;
      case 'fileManager':
        $directAccess = true;
        require_once('inc/func/fileManager.php');
        fileManager();
        break;
      case 'listUser':
        require_once('inc/func/listUser.php');
        listUser();
        break;
      case 'newUser':
        require_once('inc/func/newUser.php');
        newUser();
        break;
      case 'editUser':
        require_once('inc/func/editUser.php');
        editUser();
        break;
      case 'newGroup':
        require_once('inc/func/newGroup.php');
        newGroup();
        break;
      case 'editGroup':
        require_once('inc/func/editGroup.php');
        editGroup();
        break;
      case 'listGallery':
        require_once('inc/func/listGallery.php');
        listGallery();
        break;
      case 'dashboard':
        require_once('inc/func/dashboard.php');
        dashboard();
        break;
      default:
        require_once('inc/func/dashboard.php');
        require_once('inc/func/dashboard.php');
        dashboard();
    }
  }
  function handleException( $exception ) {
    echo 'Sorry, a problem occurred. Please try later.';
    error_log($exception->getMessage());
  }
  
  function gen_seo_friendly_titles( $_title ) {
    $replace_what = array( '  ', ' - ', ' ', ', ', ',' );
    $replace_with = array( ' ', '-', '-', ',', '-' );
    $title = strtolower( $_title );
    $title = str_replace( $replace_what, $replace_with, $title );
    return $title;
  }
  
  function getPageTitle( $_action ) {
    global $lang;
    
    $actionTitleArr = array('dashboard' => $lang['dashboard'],
                            'editContent' => $lang['manage_content'],
                            'listContent' => $lang['manage_content'],
                            'editSetting' => $lang['manage_settings'],
                            'listSetting' => $lang['manage_settings'],
                            'theme' => $lang['manage_themes'],
                            'fileManager' => $lang['manage_files'],
                            'editUser' => $lang['manage_users'],
                            'listUser' => $lang['manage_users'],
                            'editGroup' => $lang['manage_groups'],
                            'listGallery' => $lang['manage_galleries']
                            );
                            
    foreach ( $actionTitleArr as $get => $text ) {
      if ( $_action == $get ) {
        $title = $text;
      }
    }
    
    return $title;
  }
  
  function langSelectArray() {
    $langArr = '';
    foreach ( $_SESSION['langs_array'] as $language ) {
      if ( array_key_exists( $language, $_SESSION['all_langs'] ) ) {
        $langArr .= '<option value="' . $language . '" style="padding:2px; background-repeat:no-repeat; background-position:bottom left; padding-left:25px; background:url(../images/icons/flags/' . $language . '.png) no-repeat 3px 6px;"' . ( ( $_SESSION['lang'] == $language ) ? ' selected' : '' ) . '>' . $_SESSION['all_langs'][$language] . '</option>';
      }
    }
    return $langArr;
  }
  
?>