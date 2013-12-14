<?php
  require_once('inc/config.php');
  
  session_start();
  
  if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    session_write_close();
    header("Location: login.php?action=loggedOut");
  }
  
  try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD); 
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $st = $pdo->prepare("SELECT value FROM " . DB_PREFIX . "settings WHERE define = 'sessionExpire'");
    $st->execute();
   
    while ($settings = $st->fetch()) {
      $sessionExpireTime = $settings['value'];
    }
    
    $pdo = null;    
  } catch(PDOException $e) {
    echo "ERROR: " . $e->getMessage();
  }
    
  if (isset($_POST['login'])) {
    try {
      $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD); 
      $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
      $st = $pdo->prepare("SELECT username, password, status FROM " . DB_PREFIX . "users WHERE username = '" . $_POST['username'] . "'");
      $st->execute();
     
      $adminDetails = $st->fetch();
      
      $pdo = null;    
    } catch(PDOException $e) {
      echo "ERROR: " . $e->getMessage();
    }
    
    if (($_POST['username'] != $adminDetails['username']) || (md5($_POST['password']) != $adminDetails['password']) || ($adminDetails['status'] != 1)) {
      $error = true;
    } else {
      $_SESSION['authuser'] = $adminDetails['username'];
      $_SESSION['sessionStart'] = time();
      $_SESSION['sessionExpire'] = $_SESSION['sessionStart'] + ($sessionExpireTime['value'] * 60);
      if (isset($_SESSION['oldURL'])) {
        header("Location: " . $_SESSION['oldURL']);
      } else {
        header("Location: index.php?action=dashboard");
      }
    }
  }
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <title><?php echo $lang['gnscms']; ?> Admin | </title>
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
  <link href="css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
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
    <div class="row-fluid" style="background:none;">
      <center><img src="img/logo-400.png" id="login-logo" align="center" vspace="10" /></center>
      <div class="well span4 center login-box">
<?php 
  if (file_exists('install.php')) {
?>
        <div id="installFileExists" class="error alert alert-info center">
          <p>
            Please remove install.php immediately!.
          </p>
        </div>
<?php
  } 
  if ($error) {
?>
        <div id="wrongInformation" class="warning alert alert-info center">
          <p>
            Wrong Username, Password or Status.<br />Please contact the site administrator.
          </p>
        </div>
<?php
  }
  if ($_GET['action'] == 'loggedOut') { 
?>
        <div id="logout" class="success alert alert-info center">
          <p>
            You Have Successfully Logged Out.
          </p>
        </div>
<?php 
  }
  if ($_GET['action'] == 'notLogged') { 
?>
        <div id="notLogged" class="warning alert alert-info center">
          <p>
            You Are Not Logged In.
          </p>
        </div>
<?php 
  }
  if ($_GET['action'] == 'sessionExpired') { 
?>
        <div id="sessionExpired" class="warning alert alert-info center">
          <p>
            Your Session Has Ended. Login Again.
          </p>
        </div>
<?php 
  }
  if ($_GET['action'] == 'firstLogin') { 
?>
        <div id="firstLogin" class="success alert alert-info center">
          <p>
            Thanks For Trying gnsCMS!
          </p>
        </div>
<?php 
  }
  if ($_GET['action'] == 'noDirectAccess') { 
?>
        <div id="noDirectAccess" class="error alert alert-info center">
          <p>
            No direct access to that file!
          </p>
        </div>
<?php 
  }
?>
        <div id="defaultLoginMsg" class="error alert alert-info center" <?php if ($_GET['action']) { echo 'style="display:none;"'; } ?>>
          <p>
            Enter your username and password to login.
          </p>
        </div>
        <form class="form-horizontal" action="login.php" method="post">
          <br />
          <fieldset>
            <div class="input-prepend" title="Username">
              <span class="add-on"><i class="icon-user"></i></span><input type="text" autofocus class="input-large span10" name="username" id="username" value="" />
            </div>
            <div class="clearfix"></div>

            <div class="input-prepend" title="Password">
              <span class="add-on"><i class="icon-lock"></i></span><input type="password" class="input-large span10" name="password" id="password" value="" />
            </div>
            <div class="clearfix"></div>

            <p class="center">
            <button type="submit" name="login" class="btn btn-primary login-button">Login</button>
            </p>
          </fieldset>
        </form>
      </div><!--/span-->
      <div class="span3 center">
        <p>
          Copyright &copy; <?php echo date('Y') ?> <a href="http://www.gnscms.com/" target="_blank" title="The Best in Web Development!">gnsCMS</a><br />
          Core Code Based on: <a href="http://www.elated.com/articles/cms-in-an-afternoon-php-mysql/" target="_blank" title='Core code based on "Build a CMS in an Afternoon with PHP and MySQL" by Matt Doyle'>Afternoon CMS</a><br />
          Admin Powered by: <a href="http://usman.it/free-responsive-admin-template" title="Charisma - Open Source, Mutiple Skin, Fully Responsive Admin Template">Charisma</a><br />
        </p>
      </div>
    </div><!--/row-->
  </div><!--/.fluid-container-->
  <!-- jQuery UI -->
  <script src="js/jquery-ui-1.8.21.custom.min.js"></script>
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
    // set content status to enabled
    function enableContent(id) {
      var jsonLink = '<?php echo 'rpc.php?action=enableContent&status=1&id=ID'; ?>'
      $.getJSON(jsonLink.replace('ID', id));
      $("#status_" + id).html('<a onclick="disableContent(' + id + ');"><span class="label label-success">Enabled</span></a>');
      $("#view_" + id).show();
    }    
    // set content status to disabled
    function disableContent(id) {
      var jsonLink = '<?php echo 'rpc.php?action=disableContent&status=0&id=ID'; ?>'
      $.getJSON(jsonLink.replace('ID', id));
      $("#status_" + id).html('<a onclick="enableContent(' + id + ');"><span class="label label-important">Disabled</span></a>');
      $("#view_" + id).hide();
    }    
    // delete content
    function deleteContent(id) {
      if (confirm("Are you sure you wish to delete this content?")) {
        var jsonLink = '<?php echo 'rpc.php?action=deleteContent&id=ID'; ?>'
        $.getJSON(jsonLink.replace('ID', id));
        $("#listItem_" + id).remove();
        return true;
      } else {
        return false;
      }
    }          
    // set user status to enabled
    function enableUser(id) {
      var jsonLink = '<?php echo 'rpc.php?action=enableUser&status=1&id=ID'; ?>'
      $.getJSON(jsonLink.replace('ID', id));
      $("#status_" + id).html('<a onclick="disableUser(' + id + ');"><span class="label label-success">Enabled</span></a>');
    }    
    // set user status to disabled
    function disableUser(id) {
      var jsonLink = '<?php echo 'rpc.php?action=disableUser&status=0&id=ID'; ?>'
      $.getJSON(jsonLink.replace('ID', id));
      $("#status_" + id).html('<a onclick="enableUser(' + id + ');"><span class="label label-important">Disabled</span></a>');
    }    
    // delete user
    function deleteUser(id) {
      if (confirm("Are you sure you wish to delete this users profile?")) {
        var jsonLink = '<?php echo 'rpc.php?action=deleteUser&id=ID'; ?>'
        $.getJSON(jsonLink.replace('ID', id));
        $("#listUser_" + id).remove();
        return true;
      } else {
        return false;
      }
    }    
    // copy content modal
    $('.btn-copy').click(function() {
      var id = this.id.split('_');
      $("#copyModal").modal("show");
      $('[name="contentId"]').remove();
      $("#copy_modal_body").append('<input type="hidden" name="contentId" value="' + id[2] + '" />');
    });  
    // move content modal
    $('.btn-move').click(function() {
      var id = this.id.split('_');
      $('#moveModal').modal('show');
      $('[name="contentId"]').remove();
      $('#move_modal_body').append('<input type="hidden" name="contentId" value="' + id[2] + '" />');
    });    
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
    // get the selected layout template and show a preview
    function getLayout(sel) {
      if (sel == 'custom') {
        $('#layout_preview').hide();
        CKEDITOR.instances.content.setData('');
      } else {
        $('#layout_preview').show();
        $('#layout_preview img').attr('src', '../theme/<?php echo siteTheme; ?>/layout/' + sel + '.jpg');
        CKEDITOR.instances.content.setData('');
        $.get('../theme/<?php echo siteTheme; ?>/layout/' + sel + '.tpl', function(data) {
          CKEDITOR.instances.content.insertHtml(data);
        });
      }
    }    
    // START Document Ready Function ////////////////////////////////////////////////////////
    $(document).ready(function() {
      <?php if ($_GET['action'] == 'theme') { ?> 
      //gallery colorbox
      $('.thumbnail a').colorbox({rel:'thumbnail a', transition:"elastic", maxWidth:"95%", maxHeight:"95%"});
      <?php } ?>
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
      // create the category slug as the title is being entered
      $("#contentTitle").blur(function(){
        $("#contentSlug").val($("#contentTitle").val().toLowerCase().replace(/ /g, '-'));
        $("#menuTitle").val($("#contentTitle").val());
      });
      // set the background of the theme gallery thumbnail image to match what is in the css
      var thumbWidth = $(".thumbnail img").width();
      $(".thumbnail a").css("background-size", "150px");
      // sortable categories    
      $("#content-list").sortable({
        handle : '.sortHandle',
        update : function () {
          $("#updateSortChanges").show();
          var order = $('#content-list').sortable('serialize');
          $("#info").load("updateSort.php?" + order);
        }
      });
      // page template addition
      $('input:radio[name=type]').click(function(){
        if ($('input:radio[name=type]:checked').val() == 1) {
          $("#layout_template").show();
          $("#summaryDiv").show();
          $("#contentDiv").show();
        } else {
          $("#layout_template").hide();
          CKEDITOR.instances.content.setData('');
          $("#summaryDiv").hide();
          $("#contentDiv").hide();
        }
      });            
    });
    // END Document Ready Function ////////////////////////////////////////////////////////
  </script>
</body>
</html>