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
   require_once('theme/bootstrap3/func.php');
   require_once('theme/bootstrap3/head.php');
   echo $gns_RCI->get('maintop', 'add'); 
?>   
<body<?php echo $gns_RCI->get('body', 'add'); ?>>
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo getSiteIndex(); ?>"><?php echo siteName; ?></a>
      </div>
      <div class="collapse navbar-collapse navbar-ex1-collapse">
        <?php echo getMenu(); ?>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
  </nav>
  <?php
    if ( ($_GET['locationName'] == substr(getSiteIndex(), 0, -5)) || ($_GET['locationName'] == '') ) { 
  ?>
  <div id="myCarousel" class="carousel slide">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide One');"></div>
        <div class="carousel-caption">
          <h1>Modern Business - A Bootstrap 3 Template</h1>
        </div>
      </div>
      <div class="item">
        <div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide Two');"></div>
        <div class="carousel-caption">
          <h1>Ready to Style &amp; Add Content</h1>
        </div>
      </div>
      <div class="item">
        <div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide Three');"></div>
        <div class="carousel-caption">
          <h1>Additional Layout Options at <a href="http://startbootstrap.com">http://startbootstrap.com</a></h1>
        </div>
      </div>
    </div>
    <!-- Controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="icon-prev"></span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="icon-next"></span>
    </a>
  </div>
  <?php
    }
    echo $gns_RCI->get('contenttop', 'add');  
    // get the needed view type and show the content
    if (isset($view) && $view == 'viewContent') {
      require_once('theme/bootstrap3/block/viewContent.php');
    } else if (isset($view) && $view == 'viewArticle') {
      require_once('theme/bootstrap3/block/viewArticle.php');
    } else if (isset($view) && $view == 'listPages') {
      require_once('theme/bootstrap3/block/listPages.php');
    } else if (isset($view) && $view == 'listArticles') {
      require_once('theme/bootstrap3/block/listArticles.php');
    } else {
      require_once('theme/bootstrap3/block/notFound.php');
    }
    echo $gns_RCI->get('contentbottom', 'add');
  ?>
  <div class="container">
    <hr>
    <footer>
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 pull-right">
          <form action="search.php" id="search_form_footer" method="GET">
            <div class="input-group">
              <input class="form-control" name="search" type="text" />
              <span class="input-group-btn">
                <button class="btn btn-default" type="submit">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
            <input name="submit" type="hidden" value="submit" />
          </form>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
          <p>Copyright &copy; Company 2013</p>
        </div>
      </div>
    </footer>
  </div><!-- /.container --> 
  <?php 
    echo $gns_RCI->get('mainbottom', 'add');
    require_once('theme/bootstrap3/bottom.php'); 
  ?>
</body>
</html>            
<?php
  // get the left col if needed
  //if ($hasLeft === true) {
  //  require_once('theme/pytheas/left.php');
  //}
?>   
<?php  
  // get the right col if needed
  //if ($hasRight === true) {
  //  require_once('theme/pytheas/right.php');
  //}
?>