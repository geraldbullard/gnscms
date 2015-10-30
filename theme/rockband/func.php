<?php
  /**
  * $Id: func.php, v 1.0.0 2009/01/07 datazen Exp $ :: updated 2012/06/20 maestro Exp $
  *
  * gnsPLANET.com - The Foundation of Development & Research for the New Millenium
  * http://www.gnsplanet.com/
  * 
  * 3G Development - The Ultimate in Design, Functionality and Service
  * http://www.3g-dev.com/
  * 
  * Copyright � 2010 gnsPLANET, LLC. All rights reserved.
  * Copyright � 2012 3G Development. All rights reserved.
  *  
  */
  
  function isParent( $id = 0 ) {    
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "SELECT id FROM " . DB_PREFIX . "content WHERE categoryId = :categoryId LIMIT 1";
    
    $st = $conn->prepare( $sql );
    $st->bindValue( ":categoryId", $id, PDO::PARAM_INT );
    $st->execute();
    
    $row = $st->fetch();
    
    $conn = null;
    
    if ( $row ) return true;    
  }
  
  function getSiteIndex() {
    $siteIndex = mysql_fetch_assoc( mysql_query( "SELECT override, slug FROM " . DB_PREFIX . "content WHERE siteIndex = 1" ) );
    if ($siteIndex['override'] != '') {
      return $siteIndex['override'];
    } else {
      return $siteIndex['slug'] . '.html';
    }
  }
     
  function getMenu( $categoryId = 0 ) {
    $children = mysql_query( "SELECT id, title, menuTitle, override, slug, categoryId FROM " . DB_PREFIX . "content WHERE categoryId = " . ( int )$categoryId . " AND menu = 1 AND status = 1 ORDER BY sort ASC" );
    while ( $row = mysql_fetch_assoc( $children ) ) {
      $items .= '<li class="item"><a href="' . ( ( $row['override'] ) ? $row['override'] : gen_seo_friendly_titles( $row['slug'] ) . '.html' ) . '"' . (($_GET['locationName'] == $row['slug']) ? ' class="active"' : '') . '>' . ( ( $row['menuTitle'] ) ? $row['menuTitle'] : $row['title'] ) . '</a></li>';
    }
    return $items;
  } 
     
  function getSelectMenu( $categoryId = 0 ) {
    $children = mysql_query( "SELECT id, title, menuTitle, override, slug, categoryId FROM " . DB_PREFIX . "content WHERE categoryId = " . ( int )$categoryId . " AND menu = 1 AND status = 1 ORDER BY sort ASC" );
    while ( $row = mysql_fetch_assoc( $children ) ) {
      $items .= '<option value="' . ( ( $row['override'] ) ? $row['override'] : gen_seo_friendly_titles( $row['slug'] ) . '.html' ) . '">' . ( ( $row['menuTitle'] ) ? $row['menuTitle'] : $row['title'] ) . '</option>';
    }
    return $items;
  } 
  
  echo $gns_RCI->get('func', 'add');  
?>