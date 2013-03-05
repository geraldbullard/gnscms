<?php
include("../include/session.php");
include ('adminfunctions.php');
$config = $database->getConfigs();

if(!$session->isAdmin()){
   header("Location: ".$config['WEB_ROOT'].$config['home_page']);
}
else{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"[]>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
     <title><?php echo $config['SITE_NAME']; ?> Admin Page</title>

    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="forms.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../include/pagination.css" type="text/css" media="screen" />
    <!--[if IE 6]><link rel="stylesheet" href="style.ie6.css" type="text/css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" href="style.ie7.css" type="text/css" media="screen" /><![endif]-->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="script.js"></script>
    
</head>
<body>
<div id="login-page-background-glare">
    <div id="login-page-background-glare-image"> </div>
</div>
<div id="login-main">
    <div class="login-sheet">
        <div class="login-sheet-tl"></div>
        <div class="login-sheet-tr"></div>
        <div class="login-sheet-bl"></div>
        <div class="login-sheet-br"></div>
        <div class="login-sheet-tc"></div>
        <div class="login-sheet-bc"></div>
        <div class="login-sheet-cl"></div>
        <div class="login-sheet-cr"></div>
        <div class="login-sheet-cc"></div>
        <div class="login-sheet-body">
            <div class="login-header">
                <div class="login-header-clip">
                <div class="login-header-center">
                    <div class="login-header-png"></div>
                    <div class="login-header-jpeg"></div>
                </div>
                </div>
                <div class="login-logo">
                                                </div>
            </div>
            <div class="cleared reset-box"></div>
<div class="login-nav">
	<div class="login-nav-l"></div>
	<div class="login-nav-r"></div>
<div class="login-nav-outer">
	<ul class="login-hmenu">
		<li>
			<a href="index.php?id=1" <?php if ((isset($_GET['id'])) && ($_GET['id'] == 1)) { echo "class='active'"; } ?>><span class="l"></span><span class="r"></span><span class="t">Home</span></a>
		</li>	
		<li>
			<a href="index.php?id=2" <?php if ((isset($_GET['id'])) && ($_GET['id'] == 2)) { echo "class='active'"; } ?>><span class="l"></span><span class="r"></span><span class="t">General Settings</span></a>	
		</li>
		<li>
			<a href="index.php?id=3" <?php if ((isset($_GET['id'])) && ($_GET['id'] == 3)) { echo "class='active'"; } ?>><span class="l"></span><span class="r"></span><span class="t">User Settings</span></a>
		</li>	
		<li>
			<a href="index.php?id=4" <?php if ((isset($_GET['id'])) && ($_GET['id'] == 4)) { echo "class='active'"; } ?>><span class="l"></span><span class="r"></span><span class="t">Help / Support</span></a>
		</li>	
		<li>
			<a href="index.php?id=5" <?php if ((isset($_GET['id'])) && ($_GET['id'] == 5)) { echo "class='active'"; } ?>><span class="l"></span><span class="r"></span><span class="t">About Us</span></a>
		</li>	
		<li style='margin-left:15px;'>
			<a href='../process.php'><span class="l"></span><span class="r"></span><span class="t">Logout</span></a>
		</li>
	</ul>
</div>
</div>
<div class="cleared reset-box"></div>
<div class="login-content-layout">
                <div class="login-content-layout-row">
                    <div class="login-layout-cell login-content">
<div class="login-post">
    <div class="login-post-body">
<div class="login-post-inner login-article">
                                
                                                
  <?php
  if (((isset($_GET['id'])) &&($_GET['id'] == 1)) || (!isset($_GET['id']))) { include('admin_home.php'); };
  if ((isset($_GET['id'])) && ($_GET['id'] == 2)) { include('configs.php'); };
  if ((isset($_GET['id'])) && ($_GET['id'] == 3)) { include('userconfig.php'); };
  if ((isset($_GET['id'])) && ($_GET['id'] == 4)) { include('help_support.php'); };
  if ((isset($_GET['id'])) && ($_GET['id'] == 5)) { include('aboutus.php'); };
  if ((isset($_GET['id'])) && ($_GET['id'] == 6)) { include('adminuseredit.php'); };
  ?>
 
                </div>

		<div class="cleared"></div>
    </div>
</div>

                      <div class="cleared"></div>
                    </div>
                </div>
            </div>
            <div class="cleared"></div>
            <div class="login-footer">
                <div class="login-footer-t"></div>
                <div class="login-footer-l"></div>
                <div class="login-footer-b"></div>
                <div class="login-footer-r"></div>
                <div class="login-footer-body">
                            <div class="login-footer-text">
                                <span style="font-family:Verdana;font-size:10px;">PHP Login Script - V<?php echo $config['Version'];?> - (c) <a href="http://www.angry-frog.com">Angry Frog</a></span>

                                                            </div>
                    <div class="cleared"></div>
                </div>
            </div>
    		<div class="cleared"></div>
        </div>
    </div>
    <div class="cleared"></div>
    <p class="login-page-footer"></p>
</div>

</body>
</html>
<?php
}
?>