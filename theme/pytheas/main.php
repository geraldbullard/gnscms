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
   require('theme/pytheas/func.php');
?>
<?php require('theme/pytheas/head.php'); ?>   
<body>
  <div id="wrap" class="container clr" style="<?php echo 'width:' . siteWidth; ?>">
    <header id="masthead" class="site-header clr" role="banner">
      <div class="logo">
        <h1><a href="./" rel="home"><?php echo siteName; ?></a></h1>
        <p class="site-description"><?php echo siteSlogan; ?></p>                                
      </div>
      <div class="masthead-right">
        <div class="masthead-right-content">
          <i class="icon-phone"></i>Call us: 999-999-9999                  
        </div>
      </div>
    </header>
    <div id="navbar" class="navbar clr">
      <nav role="navigation" class="navigation main-navigation clr" id="site-navigation">
        <span class="nav-toggle">Menu<i class="toggle-icon icon-arrow-down"></i></span>
        <div class="menu-main-container">
          <?php echo getMenu(); ?>
        </div>            
      </nav>          
    </div>
    <div id="main" class="site-main row clr fitvids">
      <div id="home-wrap" class="clr">
        <header class="page-header clr">
          <h1><?php echo htmlspecialchars($contentResults->title); ?></h1>
        </header>                         
        <?php
          // get the left col if needed
          if ($hasLeft) {
            require('theme/pytheas/left.php');
          }
        ?>
        <div id="main" class="site-main row clr fitvids" style="float:left; <?php echo 'width:' . $mainColWidth . '%;'; ?>">
          <div id="primary" class="content-area span_24 row clr">
            <div id="content" class="site-content" role="main"> 
              <?php  
                // get the needed view type and show the content
                if (isset($view) && $view == 'viewContent') {
                  require('theme/pytheas/block/viewContent.php');
                } else if (isset($view) && $view == 'viewArticle') {
                  require('theme/pytheas/block/viewArticle.php');
                } else if (isset($view) && $view == 'listPages') {
                  require('theme/pytheas/block/listPages.php');
                } else if (isset($view) && $view == 'listArticles') {
                  require('theme/pytheas/block/listArticles.php');
                } else {
                  require('theme/pytheas/block/notFound.php');
                }
              ?>
            </div>
          </div>
        </div>
        <?php  
          // get the right col if needed
          if ($hasRight) {
            require('theme/pytheas/right.php');
          }
        ?>
      </div>
    </div>
    <footer id="footer" class="site-footer">
      <div id="footer-widgets" class="row clr">
        <div class="footer-box span_6 col clr-margin">
          <div class="footer-widget widget_text clr">
            <h6 class="widget-title">Pytheas</h6>
            <div class="textwidget">
              Nam sit amet odio eu mauris ornare dapibus. Morbi pellentesque vehicula nisi id viverra.
            </div>
          </div>                  
        </div>
        <div class="footer-box span_6 col">
          <div class="footer-widget widget_wpex_port_posts_thumb_widget clr">
            <h6 class="widget-title">Marketing Projects</h6>
            <ul class="wpex-widget-recent-posts">
              <li class="clr">                                      
                <a href="http://wpexplorer-demos.com/pytheas/portfolio/stamps/" title="Stamps" class="title"><img src="http://demoswpex.wpengine.netdna-cdn.com/pytheas/wp-content/uploads/sites/41/2012/02/SocialStamps-50x50.png" alt="Stamps" /></a>
                <div class="wpex-recent-posts-content clr">
                  <a href="http://wpexplorer-demos.com/pytheas/portfolio/stamps/" title="Stamps">Stamps</a>
                  <div class="wpex-widget-recent-posts-date"><i class="icon-time"></i>February 29, 2012</div>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <div class="footer-box span_6 col">
          <div class="footer-widget widget_wpex_posts_thumb_widget clr">
            <h6 class="widget-title">Featured Posts</h6>
            <ul class="wpex-widget-recent-posts">
              <li class="clr">                                     
                <a href="http://wpexplorer-demos.com/pytheas/events-on-the-horizon/" title="Events On The Horizon" class="title"><img src="http://demoswpex.wpengine.netdna-cdn.com/pytheas/wp-content/uploads/sites/41/2013/04/photodune-3906712-desert-m-normal-50x50.jpg" alt="Events On The Horizon" /></a>
                <div class="wpex-recent-posts-content clr">
                  <a href="http://wpexplorer-demos.com/pytheas/events-on-the-horizon/" title="Events On The Horizon">Events On The Horizon</a>
                  <div class="wpex-widget-recent-posts-date"><i class="icon-time"></i>April 25, 2013</div>
                </div>
              </li>
            </ul>
          </div>                            
        </div>
        <div class="footer-box span_6 col">
          <div class="footer-widget widget_tag_cloud clr">
            <h6 class="widget-title">Tags</h6>
            <div class="tagcloud">
              <a href='http://wpexplorer-demos.com/pytheas/tag/beautiful/' class='tag-link-5' title='3 topics' style='font-size: 8pt;'>beautiful</a>
              <a href='http://wpexplorer-demos.com/pytheas/tag/business/' class='tag-link-6' title='3 topics' style='font-size: 8pt;'>business</a>
              <a href='http://wpexplorer-demos.com/pytheas/tag/free/' class='tag-link-7' title='3 topics' style='font-size: 8pt;'>free</a>
              <a href='http://wpexplorer-demos.com/pytheas/tag/minimal/' class='tag-link-8' title='3 topics' style='font-size: 8pt;'>minimal</a>
              <a href='http://wpexplorer-demos.com/pytheas/tag/portfolio/' class='tag-link-9' title='3 topics' style='font-size: 8pt;'>portfolio</a>
              <a href='http://wpexplorer-demos.com/pytheas/tag/theme/' class='tag-link-11' title='3 topics' style='font-size: 8pt;'>theme</a>
              <a href='http://wpexplorer-demos.com/pytheas/tag/wordpress/' class='tag-link-12' title='3 topics' style='font-size: 8pt;'>wordpress</a>
            </div>
          </div>                    
        </div>
      </div>
    </footer>
    <div id="footer-bottom" class="row clr">
      <div id="copyright" class="span_12 col clr-margin" role="contentinfo">
        <a href="http://gnscms.com/" title="gnsCMS - A Truly Simple yet Powerful Content Management System!">gnsCMS</a> Theme originally by: <a href="http://www.wpexplorer.com/pytheas-free-wordpress-theme/" title="Pytheas Free Responsive Corporate/Portfolio WordPress Theme">WPExplorer</a>
      </div>
      <div id="footer-menu" class="span_12 col">
        <div class="menu-footer-container">
          <ul id="social" class="clr">
            <li><a href="http://www.twitter.com/wpexplorer" title="twitter" target="_blank"><img src="http://demoswpex.wpengine.netdna-cdn.com/pytheas/wp-content/themes/Pytheas/images/social/twitter.png" alt="twitter" /></a></li>
            <li><a href="https://www.facebook.com/WPExplorerThemes" title="facebook" target="_blank"><img src="http://demoswpex.wpengine.netdna-cdn.com/pytheas/wp-content/themes/Pytheas/images/social/facebook.png" alt="facebook" /></a></li>
            <li><a href="http://www.pinterest.com/wpexplorer" title="pinterest" target="_blank"><img src="http://demoswpex.wpengine.netdna-cdn.com/pytheas/wp-content/themes/Pytheas/images/social/pinterest.png" alt="pinterest" /></a></li>
            <li><a href="http://themeforest.net/user/WPExplorer?ref=wpexplorer" title="envato" target="_blank"><img src="http://demoswpex.wpengine.netdna-cdn.com/pytheas/wp-content/themes/Pytheas/images/social/envato.png" alt="envato" /></a></li>
            <li><a href="http://www.wpexplorer.me/pytheas/feed/" title="rss" target="_blank"><img src="http://demoswpex.wpengine.netdna-cdn.com/pytheas/wp-content/themes/Pytheas/images/social/rss.png" alt="rss" /></a></li>
          </ul>
          <ul id="menu-footer-1" class="menu">
            <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3822"><a href="http://www.wpexplorer-demos.com/pytheas/">Home</a></li>
            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3824"><a href="http://wpexplorer-demos.com/pytheas/contact/">Contact</a></li>
            <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3823"><a href="#top">Top</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>  
  <?php require('theme/pytheas/bottom.php'); ?>
</body>
</html>