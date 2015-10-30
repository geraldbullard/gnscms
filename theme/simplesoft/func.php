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
    while ($row = mysql_fetch_assoc($children)) {
      // check if current category has pages
      $parent = mysql_fetch_assoc(mysql_query("SELECT id FROM " . DB_PREFIX . "content WHERE categoryId = " . (int)$row['id'] . " AND type = 1"));
      // if item is a category and has pages, or item is a page, show it
      // commented out for now to add links to all menu items 
      // and show all items with a "status" of 1 and "show in menu" of 1
      //if (!empty($parent) || $row['type'] == 1) {
        // old method to remove link of categories with pages
        //$items[] = '<li>' . (($row['type'] == 1) ? '<a href="' . gen_seo_friendly_titles($row['slug']) . '.html">' . $row['menuTitle'] . '</a>' : '<a>' . $row['menuTitle'] . '</a>') . getMenu($row['id']) . '</li>';
        $items[] = '<li><a href="' . gen_seo_friendly_titles($row['slug']) . '.html">' . $row['menuTitle'] . '</a>' . getMenu($row['id']) . '</li>';
      //}
    }
    if (count($items)) {
      return '<ul>' . implode('', $items) . '</ul>';
    } else {
      return '';
    }
  }
   
?>