<?php
  /**
   * $Id: notFound.php, v 1.0.0 2009/01/07 datazen Exp $ :: updated 2012/06/20 maestro Exp $
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
      <h1 class="pageHeading"><?php echo htmlspecialchars($results['page']->title); ?></h1>
      <div class="pageSummary">
        <?php echo htmlspecialchars($results['page']->summary); ?>

      </div>
      <div class="pageContent">
        <?php echo $results['page']->content; ?>

      </div>
