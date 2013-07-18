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
  * Copyright © 2010 gnsPLANET, LLC. All rights reserved.
  * Copyright © 2012 3G Development. All rights reserved.
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
     
  function getMenu( $categoryId = 0 ) {
    $children = mysql_query( "SELECT id, title, menuTitle, override, slug, categoryId, type FROM " . DB_PREFIX . "content WHERE categoryId = " . ( int )$categoryId . " AND menu = 1 AND status = 1 ORDER BY sort ASC" );
    $items = array( );
    while ( $row = mysql_fetch_assoc( $children ) ) {                   
      $items[] = '<li><a href="' . ( ( $row['override'] ) ? $row['override'] : gen_seo_friendly_titles( $row['slug'] ) . '.html' ) . '">' . ( ( $row['menuTitle'] ) ? $row['menuTitle'] : $row['title'] ) . ( isParent( $row['id'] ) ? ' &nbsp;<i class="icon-angle-down"></i>' : '' ) . '</a>' . getMenu( $row['id'] ) . '</li>';
    }
    if ( count( $items ) ) {
      return '<ul class="nav-menu dropdown-menu">' . implode( '', $items ) . '</ul>';
    } else {
      return '';
    }
  }   
?>