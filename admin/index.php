<?php
  if (!file_exists('inc/config.php')) {
    if (file_exists('install.php')) {  
      header("Location: install.php");
    } else {
      die('You are missing needed files. Please upload the files from our archive and try this again.');
    }
  }  
  require('inc/top.php');
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <title>gnsCMS Admin | </title>
  <link href="../favicon.ico" rel="shortcut icon">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="description" content="gnsCMS Admin by maestro">
  <meta name="keywords" content="these, are, my, site, keywords">
  <meta name="application-name" content="gnsCMS Admin">
  <meta name="robots" content="index, follow">
  <link rel="shortcut icon" href="favicon.ico">
  <!-- Styles -->
  <link href="css/bootstrap-cerulean.css" rel="stylesheet">
  <link href="css/jquery-ui-1.10.3.css" rel="stylesheet">
  <link href="css/fullcalendar.css" rel='stylesheet'>
  <link href="css/fullcalendar.print.css" rel="stylesheet"  media='print'>
  <link href="css/chosen.css" rel="stylesheet">
  <link href="css/uniform.default.css" rel="stylesheet">
  <link href="css/colorbox.css" rel="stylesheet">
  <link href="css/jquery.cleditor.css" rel="stylesheet">
  <link href="css/jquery.noty.css" rel="stylesheet">
  <link href="css/noty_theme_default.css" rel="stylesheet">
  <link href="css/elfinder.min.css" rel="stylesheet">
  <link href="css/elfinder.theme.css" rel="stylesheet">
  <link href="css/jquery.iphone.toggle.css" rel="stylesheet">
  <link href="css/opa-icons.css" rel="stylesheet">
  <link href="css/uploadify.css" rel="stylesheet">
  <link href="css/jquery.wysiwyg.css" rel="stylesheet" media="screen" />
  <link href="css/bootstrap-responsive.css" rel="stylesheet">
  <link href="css/charisma-app.css" rel="stylesheet">  
  <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <!-- jQuery -->
  <script src="js/jquery-1.8.3.min.js"></script>
</head>
<body>
  <div class="container-fluid">  
    <!-- topbar starts -->
    <div class="navbar">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div>
            <a class="brand" href="index.php?action=dashboard"><img src="img/logo-85.png" /></a>
          </div>
          <div style="float:left;" class="hide-below-480">
            <form class="navbar-search pull-left" id="searchform" method="post">
              <input name="search_query" id="search_query" placeholder="<?php echo $lang['search_content']; ?>" spellcheck="false" autocomplete="off" class="search-query span2" type="text">
            </form>
            <div id="display_results" style="display:none;"></div>
          </div>          
          <div class="top-nav nav-collapse">
            <ul class="nav">
              <li><a href="index.php?action=dashboard" title="<?php echo $lang['view_dashboard']; ?>"><?php echo $lang['dashboard']; ?></a></li>
              <li><a href="index.php?action=listContent" title="<?php echo $lang['manage_content']; ?>"><?php echo $lang['content']; ?></a></li>
              <li><a href="index.php?action=theme" title="<?php echo $lang['manage_themes']; ?>"><?php echo $lang['themes']; ?></a></li>
              <li><a href="index.php?action=fileManager" title="<?php echo $lang['manage_files']; ?>"><?php echo $lang['file_manager']; ?></a></li>
              <li><a href="index.php?action=listSetting" title="<?php echo $lang['manage_settings']; ?>"><?php echo $lang['settings']; ?></a></li>
              <li><a href="index.php?action=listUser" title="<?php echo $lang['manage_users']; ?>"><?php echo $lang['users']; ?></a></li>
              <li class="hide-above-767"><a href="../" title="<?php echo $lang['view_site_new_window']; ?>"><?php echo $lang['view_site']; ?></a></li>
              <li class="hide-above-767"><a href="login.php?action=logout" title="<?php echo $lang['logout']; ?>"><?php echo $lang['logout']; ?></a></li>
              <li class="show-below-480" style="display:none;">
                <form class="navbar-search pull-left" id="searchform320" method="post">
                  <input name="search_query_320" id="search_query_320" placeholder="<?php echo $lang['search_content']; ?>" spellcheck="false" autocomplete="off" class="search-query span2" type="text">
                </form>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
          <div style="float:right; padding-top:3px;" class="hide-below-768 navbar-actions">
            <a href="../" title="<?php echo $lang['view_site_new_window']; ?>" target="_blank"><i class="icon32 icon-white icon-extlink"></i></a> <a href="login.php?action=logout" title="<?php echo $lang['logout']; ?>"><i class="icon32 icon-white icon-cross"></i></a> 
          </div>
        </div>
      </div>
    </div>
    <!-- topbar ends -->    
    <div id="display_results_320" style="display:none;"></div>
<?php   
  switch ( $action ) {
    case 'newContent':
      require('inc/functions/newContent.php');
      newContent();
      break;
    case 'listContent':
      require('inc/functions/listContent.php');
      listContent();
      break;
    case 'editContent':
      require('inc/functions/editContent.php');
      editContent();
      break;
    case 'copyContent':
      require('inc/functions/copyContent.php');
      copyContent();
      break;
    case 'moveContent':
      require('inc/functions/moveContent.php');
      moveContent();
      break;
    case 'siteIndex':
      require('inc/functions/siteIndex.php');
      siteIndex();
      break;
    case 'newSetting':
      require('inc/functions/newSetting.php');
      newSetting();
      break;
    case 'listSetting':
      require('inc/functions/listSetting.php');
      listSettings();
      break;
    case 'editSetting':
      require('inc/functions/editSetting.php');
      editSetting();
      break;
    case 'deleteSetting':
      require('inc/functions/deleteSetting.php');
      deleteSetting();
      break;
    case 'theme':
      require('inc/functions/theme.php');
      theme();
      break;
    case 'activateTheme':
      require('inc/functions/activateTheme.php');
      activateTheme();
      break;
    case 'fileManager':
      $directAccess = true;
      require('inc/functions/fileManager.php');
      fileManager();
      break;
    case 'listUser':
      require('inc/functions/listUser.php');
      listUser();
      break;
    case 'newUser':
      require('inc/functions/newUser.php');
      newUser();
      break;
    case 'editUser':
      require('inc/functions/editUser.php');
      editUser();
      break;
    case 'newGroup':
      require('inc/functions/newGroup.php');
      newGroup();
      break;
    case 'editGroup':
      require('inc/functions/editGroup.php');
      editGroup();
      break;
    case 'listGallery':
      require('inc/functions/listGallery.php');
      listGallery();
      break;
    case 'dashboard':
      require('inc/functions/dashboard.php');
      dashboard();
      break;
    default:
      require('inc/functions/dashboard.php');
      dashboard();
  }
?>
    <hr>    
    <footer>
      <div class="row-fluid no-bg">
        <div class="span6">
          <p class="pull-left">
            <?php echo $lang['copyright']; ?> &copy; <?php echo date('Y') ?> <a href="http://www.gnscms.com/" title="<?php echo $lang['copyright_title']; ?>" target="_blank"><?php echo $lang['gnscms']; ?></a><br />
            <?php echo $lang['core_code']; ?>: <a href="http://www.elated.com/articles/cms-in-an-afternoon-php-mysql/" title='<?php echo $lang['core_code_title']; ?>' target="_blank"><?php echo $lang['afternoon_cms']; ?></a><br />
            <?php echo $lang['powered_by']; ?>: <a href="http://www.usman.it/free-responsive-admin-template" title="<?php echo $lang['powered_by_title']; ?>" target="_blank"><?php echo $lang['charisma']; ?></a><br />
          </p>
        </div>
        <div class="span6">
          <p class="pull-right">
            <select id="lang_select" style="width:auto; padding-left:22px; background:url('../images/icons/flags/<?php echo $_SESSION['lang']; ?>.png') no-repeat 4px 8px;">
            <?php
              foreach ($_SESSION['langs_array'] as $language) {
                if (array_key_exists($language, $_SESSION['all_langs'])) {
                  echo '<option value="' . $language . '" style="padding:2px; background-repeat:no-repeat; background-position:bottom left; padding-left:25px; background:url(../images/icons/flags/' . $language . '.png) no-repeat 3px 6px;"' . (($_SESSION['lang'] == $language) ? ' selected' : '') . '>' . $_SESSION['all_langs'][$language] . '</option>';
                }
              }
            ?>
            </select>
            <a class="arrow-top scrollToTop" href="#">
              <img src="img/arrow-top.png" style="margin:-10px 0 0 20px;">
            </a>
          </p>
        </div>
      </div>
    </footer>
  </div><!--/.fluid-container-->
  <!-- jQuery UI -->
  <script src="js/jquery-ui-1.10.3.min.js"></script>
  <!-- transition / effect library -->
  <script src="js/bootstrap-transition.js"></script>
  <!-- alert enhancer library -->
  <script src="js/bootstrap-alert.js"></script>
  <!-- modal / dialog library -->
  <script src="js/bootstrap-modal.js"></script>
  <!-- custom dropdown library -->
  <script src="js/bootstrap-dropdown.js"></script>
  <!-- scrolspy library -->
  <script src="js/bootstrap-scrollspy.js"></script>
  <!-- library for creating tabs -->
  <script src="js/bootstrap-tab.js"></script>
  <!-- library for advanced tooltip -->
  <script src="js/bootstrap-tooltip.js"></script>
  <!-- popover effect library -->
  <script src="js/bootstrap-popover.js"></script>
  <!-- button enhancer library -->
  <script src="js/bootstrap-button.js"></script>
  <!-- accordion library (optional, not used in demo) -->
  <script src="js/bootstrap-collapse.js"></script>
  <!-- carousel slideshow library (optional, not used in demo) -->
  <script src="js/bootstrap-carousel.js"></script>
  <!-- autocomplete library -->
  <script src="js/bootstrap-typeahead.js"></script>
  <!-- tour library -->
  <script src="js/bootstrap-tour.js"></script>
  <!-- library for cookie management -->
  <script src="js/jquery.cookie.js"></script>
  <!-- calander plugin -->
  <script src='js/fullcalendar.min.js'></script>
  <!-- chart libraries start -->
  <script src="js/excanvas.js"></script>
  <script src="js/jquery.flot.min.js"></script>
  <script src="js/jquery.flot.pie.min.js"></script>
  <script src="js/jquery.flot.stack.js"></script>
  <script src="js/jquery.flot.resize.min.js"></script>
  <!-- chart libraries end -->
  <!-- select or dropdown enhancer -->
  <script src="js/jquery.chosen.min.js"></script>
  <!-- checkbox, radio, and file input styler -->
  <script src="js/jquery.uniform.min.js"></script>
  <?php if ($_GET['action'] == 'theme') { ?>
  <!-- plugin for gallery image view -->
  <script src="js/jquery.colorbox.min.js"></script>
  <?php } ?>
  <!-- rich text editor library
  <script src="js/jquery.cleditor.min.js"></script> -->
  <!-- notification plugin -->
  <script src="js/jquery.noty.js"></script>
  <!-- file manager library -->
  <script src="js/jquery.elfinder.min.js"></script>
  <!-- star rating plugin -->
  <script src="js/jquery.raty.min.js"></script>
  <!-- for iOS style toggle switch -->
  <script src="js/jquery.iphone.toggle.js"></script>
  <!-- autogrowing textarea plugin -->
  <script src="js/jquery.autogrow-textarea.js"></script>
  <!-- multiple file upload plugin -->
  <script src="js/jquery.uploadify-3.1.min.js"></script>
  <!-- history.js for cross-browser state change on ajax -->
  <script src="js/jquery.history.js"></script>
  <!-- application script for Charisma demo -->
  <script src="js/charisma.js"></script>
  <!-- ckeditor script -->
  <script src="ext/ckeditor/ckeditor.js"></script>
  <script>
    // START All Pages Functions ////////////////////////////////////////////////////////     
    // ajax search results above 479px
    function search_ajax(){
      $("#search_results").show();
      var search_this = $("#search_query").val();
      $.post("search.php", {searchit : search_this}, function(data){
        $("#display_results").html(data);
      })
    }    
    // ajax search results below 480px
    function search_ajax_320(){
      $("#search_results_320").show();
      var search_this = $("#search_query_320").val();
      $.post("search.php", {searchit : search_this}, function(data){
        $("#display_results_320").html(data);
      })
    }
    // END All Pages Functions ////////////////////////////////////////////////////////    
    // START All Pages Document Ready Function ////////////////////////////////////////////////////////
    $(document).ready(function() {
      // ajax search input field above 479px
      $("#search_query").keyup(function(event){
        event.preventDefault();
        if ($(this).val()) {
          $("#display_results").show();
          search_ajax();
        } else {
          $("#display_results").hide();
        }
      });
      // ajax search input field below 480px
      $("#search_query_320").keyup(function(event){
        event.preventDefault();
        if ($(this).val()) {
          $("#display_results_320").show();
          search_ajax_320();
        } else {
          $("#display_results_320").hide();
        }
      });
      // bind change event to language select
      $('#lang_select').bind('change', function () {
        var location = window.location.href;
        var lang = $(this).val();         
        $("#lang_select").css("background-image", "url('../images/icons/flags/" + lang + ".png')");
        var index = window.location.href.indexOf("lang");
        var result;
        if (index < 0) {
          result = location + '&lang=' + lang;
        } else {
          result = location.substr(0, index) + 'lang=' + lang;
        }
        window.location = result;
        return false;
      });            
    });
    // END All Pages Document Ready Function ////////////////////////////////////////////////////////
  </script>
  <?php
    // Include any page specific js files
    if (is_file('js/' . $_GET['action'] . '.js.php')) {
      include('js/' . $_GET['action'] . '.js.php');
    }
  ?>
</body>
</html>