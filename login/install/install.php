<?php

    require_once("settings.inc");    
	
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
  <TBODY>
<tr>
    <td class="text" vAlign="top">
        <h2>New Installation of <?php echo $application_name; ?>!</h2>
        
        Follow the wizard to setup your database.<BR><BR>
        <strong>Step 1. Database Import</strong>
         <form method="post" action="install2.php">
        <table width="100%" border="0" cellspacing="0" cellpadding="5" class="text">
          <tr>
            <td width="26%">Database Host:</td>
            <td width="74%"><input type="text" class="form_text" name="database_host" value='localhost' size="30"></td>
          </tr>
          <tr>
            <td>Database Name:</td>
            <td><input type="text" class="form_text" name="database_name" size="30" value="<?php if (isset($database_name)) { echo $database_name; } ?>"></td>
          </tr>
          <tr>
            <td>Database Username:</td>
            <td><input type="text" class="form_text" name="database_username" size="30" value="<?php if (isset($database_username)) { echo $database_username; } ?>"></td>
          </tr>
          <tr>
            <td>Database Password:</td>
            <td><input type="text" class="form_text" name="database_password" size="30" value="<?php if (isset($database_password)) { echo $database_password; } ?>"></td>
          </tr>       
          <tr><td colspan="2"> <br>
<input type="button" class="form_button" name="btn_cancel" value="Cancel" onClick="document.location.href='index.php'">
				    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="submit" class="form_button" name="btn_submit" value="Continue"><input type="hidden" name="submit" value="step2" />  
                     </td></tr>
        </table>
        </form>
        
</td>
</tr>
</TBODY>
</table>
                  
</body>
</html>
