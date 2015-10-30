<?php
  /**
   * $Id: listPages.php, v 1.0.0 2009/01/07 datazen Exp $ :: updated 2012/06/20 maestro Exp $
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
?>
      <ul id="headlines">
<?php 
  foreach ($results['pages'] as $page) { 
    $pageURL = '<a href="' . gen_seo_friendly_titles($page->title) . '.html">' . htmlspecialchars($page->title) . '</a>';
  ?>
        <li>
          <h2><?php echo $pageURL; ?></h2>
          <p class="pageSummary">
            <?php echo htmlspecialchars($page->summary); ?>
          </p>
        </li>
<?php 
  } 
?>
      </ul>
