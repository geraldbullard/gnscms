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
  function getMenu($categoryId = 0) {
    $children = mysql_query("SELECT id, menuTitle, slug, categoryId, type FROM " . DB_PREFIX . "content WHERE categoryId = " . (int)$categoryId . " AND menu = 1 AND status = 1 ORDER BY sort ASC");
    $items = array();
    $cnt = 0;
    while ($row = mysql_fetch_assoc($children)) {
      $items[] = '<li><a href="' . gen_seo_friendly_titles($row['slug']) . '.html">' . $lvl . $row['menuTitle'] . '</a>' . getMenu($row['id']) . '</li>';
    }
    if (count($items)) {
      return '<ul' . (($cnt == 0) ? ' id="drilldown"' : '') . '>' . implode('', $items) . '</ul>';
      $cnt++;
    } else {
      return '';
    }
  }   
?>