<?php
  global $gns_admin_RCI, $gns_admin_RCO;
  
  function url_get_contents($_url) {
    if (!function_exists('curl_init')) { 
      return 'cURL is not installed!';
    } else {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $_url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $output = curl_exec($ch);
      curl_close($ch);
      return $output;
    }
  }
  
  function handleException( $exception ) {
    echo 'Sorry, a problem occurred. Please try later.';
    error_log( $exception->getMessage() );
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