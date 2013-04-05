<?php
  /**
   * $Id: viewPage.php, v 1.0.0 2009/01/07 datazen Exp $ :: updated 2012/06/20 maestro Exp $
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
      <article class="hero clearfix">
        <div class="col_100">
          <h1><?php echo htmlspecialchars($pageResults->title); ?></h1>
          <p><?php echo htmlspecialchars($pageResults->summary); ?></p>
        </div>
      </article>
      <article class="article clearfix">
<?php 
  echo $pageResults->content; 
?>
        <div class="clearfix"></div>
      </article>
