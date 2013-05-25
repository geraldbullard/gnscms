<?php
  /**
   * $Id: main.php, v 1.0.0 2009/01/07 datazen Exp $ :: updated 2012/06/20 maestro Exp $
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
   require('theme/docs/func.php');
   require('theme/docs/head.php'); 
   //echo getMenu();
?>
<body style="position: absolute; left: 260px;">    
  <div id="sidr" style="display: block; left: 0px;">
    <div class="graphite demo-container">
      <ul id="drilldown">
        <li><a href="#">Home</a></li>
        <li><a href="#">Products</a>
          <ul>
            <li><a href="#">Mobile Phones &#038; Accessories</a>
              <ul>
                <li><a href="#">Product 1</a>
                  <ul>
                    <li><a href="#">Part A</a>
                      <ul>
                        <li><a href="#">Sale</a>
                          <ul>
                            <li><a href="#">Special Offers</a>
                              <ul>
                                <li><a href="index.html">Offer 1</a></li>
                                <li><a href="index2.html">Offer 2</a></li>
                                <li><a href="index3.html">Offer 3</a></li>
                              </ul>
                            </li>
                            <li><a href="#">Reduced Price</a>
                              <ul>
                                <li><a href="#">Offer 4</a></li>
                                <li><a href="#">Offer 5</a></li>
                                <li><a href="#">Offer 6</a></li>
                                <li><a href="#">Offer 7</a></li>
                              </ul>
                            </li>
                            <li><a href="#">Clearance Items</a>
                              <ul>
                                <li><a href="#">Offer 9</a></li>
                              </ul>
                            </li>
                            <li class="menu-item-129"><a href="#">Ex-Stock</a>
                              <ul>
                                <li><a href="#">Offer 10</a></li>
                                <li><a href="#">Offer 11</a></li>
                                <li><a href="#">Offer 12</a></li>
                                <li><a href="#">Offer 13</a></li>
                              </ul>
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                    <li><a href="#">Part B</a></li>
                    <li><a href="#">Part C</a></li>
                    <li><a href="#">Part D</a></li>
                  </ul>
                </li>
                <li><a href="#">Product 2</a>
                  <ul>
                    <li><a href="#">Part A</a></li>
                    <li><a href="#">Part B</a></li>
                    <li><a href="#">Part C</a></li>
                    <li><a href="#">Part D</a></li>
                  </ul>
                </li>
                <li><a href="#">Product 3</a>
                  <ul>
                    <li><a href="#">Part A</a></li>
                    <li><a href="#">Part B</a></li>
                    <li><a href="#">Part C</a></li>
                    <li><a href="#">Part D</a></li>
                  </ul>
                </li>
              </ul>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <div class="clear"></div>
  </div>
  <a id="menu-trigger" href="#sidr" title="Open Menu"><img src="theme/docs/img/left-arrow.png" /></a>
  <div id="main-content">
<?php
  // get the needed view type and show the content
  if (isset($view) && $view == 'viewContent') {
    if (file_exists('theme/docs/block/viewContent.php')) {
      include('theme/docs/block/viewContent.php');
    } else {
      include('block/viewContent.php');
    }
  } else {
    if (file_exists('theme/docs/block/notFound.php')) {
      include('theme/docs/block/notFound.php');
    } else {
      include('block/notFound.php');
    }
  }
?>
  </div>
  <?php require('theme/docs/bottom.php'); ?>
</body>
</html>