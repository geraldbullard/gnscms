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
   /*if ($hasLeft === true && $hasRight === true) {
     $mainColWidth = '50';
   } else if (($hasLeft === true && !$hasRight === true) || (!$hasLeft === true && $hasRight === true)) {
     $mainColWidth = '75';
   } else {
     $mainColWidth = '100';
   }*/
   require_once('theme/rockband/func.php');
   require_once('theme/rockband/head.php');
   echo $gns_RCI->get('maintop', 'add'); 
?>   
<body<?php echo $gns_RCI->get('body', 'add'); ?>>
  <div class="extra">
    <header>
      <div class="main">
        <div class="bg-1">
          <h1><a href="<?php echo getSiteIndex(); ?>">Rock Band</a></h1>
        </div>
        <nav>
          <div class="menu-bg-tail">
            <div class="menu-bg">
              <div class="zerogrid">
                <div class="col-full">
                  <ul class="menu">
                    <?php echo getMenu(); ?>
                  </ul>
                  <div class="menu-response"><div>MENU</div>
                    <select onchange="location=this.value">
                      <?php echo getSelectMenu(); ?>
                    </select>
                  </div>
                  <div class="clear"></div>
                </div>
                <div class="clear"></div>
              </div>
            </div>
          </div>
        </nav>
        <div class="slider-wrapper">
          <div class="slider">
            <div class="rslides_container">
              <ul class="rslides" id="slider">
                <li><img src="theme/rockband/images/slider-img1.jpg" alt="" /></li>
                <li><img src="theme/rockband/images/slider-img2.jpg" alt="" /></li>
                <li><img src="theme/rockband/images/slider-img3.jpg" alt="" /></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </header>
    <section id="content">
      <div class="main">                
        <?php
          // get the left col if needed
          if ($hasLeft === true) {
            require_once('theme/rockband/left.php');
          }
          
          echo $gns_RCI->get('contenttop', 'add');  
          // get the needed view type and show the content
          if (isset($view) && $view == 'viewContent') {
            require_once('theme/rockband/block/viewContent.php');
          } else if (isset($view) && $view == 'viewArticle') {
            require_once('theme/rockband/block/viewArticle.php');
          } else if (isset($view) && $view == 'listPages') {
            require_once('theme/rockband/block/listPages.php');
          } else if (isset($view) && $view == 'listArticles') {
            require_once('theme/rockband/block/listArticles.php');
          } else {
            require_once('theme/rockband/block/notFound.php');
          }
          echo $gns_RCI->get('contentbottom', 'add');
            
          // get the right col if needed
          if ($hasRight === true) {
            require_once('theme/rockband/right.php');
          }
        ?>
      </div>
      <div class="block"></div>
    </section>
  </div>
  <footer>
    <div class="main">
      <div class="footer-bg">
        <div class="zerogrid">
          <div class="row">
            <div class="col-full">
              <div class="footer-padding">
                <div class="wrapper">
                  <span class="footer-link"><span>Copyright &copy; 2014. City of Bridges Live. All Rights Reserved.</span></span>
                  <ul class="list-services">
                    <li><a class="tooltips n-1" title="Twitter" href="#"></a></li>
                    <li><a class="tooltips n-2" title="Facebook" href="#"></a></li>
                    <li class="last"><a class="tooltips n-3" title="Youtube" href="#"></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>      
  <?php 
    echo $gns_RCI->get('mainbottom', 'add');
    require_once('theme/rockband/bottom.php'); 
  ?>
</body>
</html>