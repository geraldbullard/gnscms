<?php

    require_once("settings.inc");    

    //if (file_exists($config_file_path)) {        
	//	header("location: ".$application_start_file);
    //    exit;
	//}
        
    ob_start();
    phpinfo(-1);
    $phpinfo = array('phpinfo' => array());
    if(preg_match_all('#(?:<h2>(?:<a name=".*?">)?(.*?)(?:</a>)?</h2>)|(?:<tr(?: class=".*?")?><t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>(?:<t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>(?:<t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>)?)?</tr>)#s', ob_get_clean(), $matches, PREG_SET_ORDER))
    foreach($matches as $match){
        if(strlen($match[1]))
            $phpinfo[$match[1]] = array();
        elseif(isset($match[3]))
            $phpinfo[end(array_keys($phpinfo))][$match[2]] = isset($match[4]) ? array($match[3], $match[4]) : $match[3];
        else
            $phpinfo[end(array_keys($phpinfo))][] = $match[2];
    }

    
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Installation Guide</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
	<link rel="stylesheet" type="text/css" href="img/styles.css">
</head>
<BODY text="#000000" vLink="#2971c1" aLink="#2971c1" link="#2971c1" bgColor="#ffffff">
    
<br>
<br>
<br>
<br>
<table align="center" width="70%" cellspacing="0" cellpadding="8" style="border-style: dashed; border-color:#666; border-width:thin">
  <tbody>
<TR>
    <TD class="text" vAlign="top">
        <H2>New Installation of <?php echo $application_name; ?>!</H2>
        
        Follow the wizard to setup your database.<BR><BR>
   
        <TABLE width="100%" cellSpacing="0" cellPadding="0" border="0">
          <TBODY>
            <TR>
              <TD class="text" align="left"><b>Getting System Info</b></TD>
            </TR>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <TD class="text" align="left"><UL>
                <li>PHP version: 
				<?php 
				if (floatval(phpversion()) < 5.1) {
					echo "<span style='color: #ff0000;'>".floatval(phpversion())." - The script will not work unless you update your PHP version.</span>"; 
				} else {
					echo "<span style='color: #348017;'>".floatval(phpversion())." - Your version of PHP will support this script.</span>"; 
				}  
				?>
				</li>
                <li>PDO Enabled:
                  <?php if (class_exists('PDO')) { echo '<span style="color: #348017;">Yes</span>'; } else { echo '<span style="color: #f00;">No - Check the instructions or forum on how to enable this.</span>'; } ?>
                </UL></TD>
            </TR>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <TR>
              <TD class="text" align="left"> Click on Start button to continue. </TD>
            </TR>
            <tr>
              <td><br><input type="button" class="form_button" value="Start" name="submit" title="Click to start installation" onClick="document.location.href='install.php'"></td>
            </tr>
          </TBODY>
      </TABLE></TD>
</TR>
</TBODY>
</TABLE>
                  
</body>
</html>