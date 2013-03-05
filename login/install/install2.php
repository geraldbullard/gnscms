<?php

    require_once("settings.inc"); 

	$completed = false;
	$error_mg  = array();	
	
	if ($_POST['submit'] == "step2") {

		$database_host		= isset($_POST['database_host'])?$_POST['database_host']:"";
		$database_name		= isset($_POST['database_name'])?$_POST['database_name']:"";
		$database_username	= isset($_POST['database_username'])?$_POST['database_username']:"";
		$database_password	= isset($_POST['database_password'])?$_POST['database_password']:"";
		
		if (empty($database_host)){
			$error_mg[] = "Database host can not be empty! Please re-enter.";	
		}
		
		if (empty($database_name)){
			$error_mg[] = "Database name can not be empty! Please re-enter.";	
		}
		
		if (empty($database_username)){
			$error_mg[] = "Database username can not be empty! Please re-enter.";	
		}
		
		if (empty($database_password)){
			$error_mg[] = "Database password can not be empty! Please re-enter.";	
		}
		
		if(empty($error_mg)){
		
			$config_file = file_get_contents('../include/constants.php');
			$config_file = str_replace("_DB_HOST_", $database_host, $config_file);
			$config_file = str_replace("_DB_NAME_", $database_name, $config_file);
			$config_file = str_replace("_DB_USER_", $database_username, $config_file);
			$config_file = str_replace("_DB_PASSWORD_", $database_password, $config_file);
			
			$f = @fopen('../include/constants.php', "w+");
			if (@fwrite($f, $config_file) > 0){
                $link = @mysql_connect($database_host, $database_username, $database_password);
				if($link){					
					if (@mysql_select_db($database_name)) {                        
                        if(false == ($db_error = apphp_db_install($database_name, $sql_dump))){
                            $error_mg[] = "Could not read file ".$sql_dump."! Please check if the file exists.";                            
                            @unlink($config_file_path);
                        }else{
                        	// The following code creates the tables.
                        	$sql = explode(";",file_get_contents('db_dump.sql'));
                        	foreach($sql as $query)
                        	mysql_query($query);	
							
                            // additional operations, like setting up admin passwords etc.
							// ...
                            $completed = true;                            
                        }
					} else {
						$error_mg[] = "Database connecting error! Check your database exists.</span><br/>";
                        @unlink($config_file_path);
					}
				} else {
					$error_mg[] = "Database connecting error! Check your connection parameters.</span><br/>";
                    @unlink($config_file_path);
				}
			} else {				
				$error_mg[] = "Can not open configuration file ../include/constants.php";				
			}
			@fclose($f);			
		}
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
  <TBODY>
<TR>
    <TD class="text" vAlign="top">
        <H2>New Installation of <?=$application_name;?>!</H2>
        
        Follow the wizard to setup your database.<BR><BR>
        <TABLE width="100%" cellSpacing="0" cellPadding="0" border="0">
        <TBODY>
						<?php if(!$completed){
							
							foreach($error_mg as $msg){
								echo "<tr><td class=text align=left><span style='color:#bb5500;'>&#8226; ".$msg."</span></td></tr>";
							}
						?>
							<tr><td>&nbsp;</td></tr>
							<tr>
								<td class="text" align="left">	
									<input type="button" class="form_button" value="Back" name="submit" onClick="javascript: history.go(-1);">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="button" class="form_button" value="Retry" name="submit" onClick="javascript: location.reload();">
								</td>
							</tr>
							
						<?php } else {?>
							<tr><td>&nbsp;</td></tr>
							<TR>
								<TD class="text" align="left">
									<b>Step 2. Installation Completed</b>
								</td>
							</tr>
							<tr><td>&nbsp;</td></tr>	
							<tr>
								<TD class="text" align="left">
									<span style='color:red;'>The constants.php file was sucessfully updated with your database credentials and your database was populated with the new tables.<br /><br />Please now <em>register</em> with the username: <strong>admin</strong> and a password of your choice. After you register with the <em>admin</em> account, visit the administration panel and fill out the configuration fields with your website details. <br /><br />
										<b>!!! For security reasons, please also remove the install folder from your server.</b>
									</span>
									<br /><br />
									<?php if($application_start_file != ""){ 
										echo "<A href='".$application_start_file."'>Proceed to the registration page...</A>";
									} ?>
								</td>
							</tr>
						
						<?php } ?>
                        </tbody>
                        </table>
                        <br />                         
    </TD>
</TR>
</TBODY>
</TABLE>
                  
</body>
</html>

<?php 

  function apphp_db_install($database, $sql_file) {
    $db_error = false;

    if (!@apphp_db_select_db($database)) {
      if (@apphp_db_query('create database ' . $database)) {
        apphp_db_select_db($database);
      } else {
        $db_error = mysql_error();
        return false;		
      }
    }

    if (!$db_error) {
      if (file_exists($sql_file)) {
        $fd = fopen($sql_file, 'rb');
        $restore_query = fread($fd, filesize($sql_file));
         fclose($fd);
      } else {
          $db_error = 'SQL file does not exist: ' . $sql_file;
          return false;
      }
		
      $sql_array = array();
      $sql_length = strlen($restore_query);
      $pos = strpos($restore_query, ';');
      for ($i=$pos; $i<$sql_length; $i++) {
        if ($restore_query[0] == '#') {
          $restore_query = ltrim(substr($restore_query, strpos($restore_query, "\n")));
          $sql_length = strlen($restore_query);
          $i = strpos($restore_query, ';')-1;
          continue;
        }
        if ($restore_query[($i+1)] == "\n") {
          for ($j=($i+2); $j<$sql_length; $j++) {
            if (trim($restore_query[$j]) != '') {
              $next = substr($restore_query, $j, 6);
              if ($next[0] == '#') {
                // find out where the break position is so we can remove this line (#comment line)
                for ($k=$j; $k<$sql_length; $k++) {
                  if ($restore_query[$k] == "\n") break;
                }
                $query = substr($restore_query, 0, $i+1);
                $restore_query = substr($restore_query, $k);
                // join the query before the comment appeared, with the rest of the dump
                $restore_query = $query . $restore_query;
                $sql_length = strlen($restore_query);
                $i = strpos($restore_query, ';')-1;
                continue 2;
              }
              break;
            }
          }
          if ($next == '') { // get the last insert query
            $next = 'insert';
          }
          if ( (stristr('create', $next)) || (stristr('insert', $next)) || (stristr('drop t', $next)) ) {
            $next = '';
            $sql_array[] = substr($restore_query, 0, $i);
            $restore_query = ltrim(substr($restore_query, $i+1));
            $sql_length = strlen($restore_query);
            $i = strpos($restore_query, ';')-1;
          }
        }
      }

      for ($i=0; $i<sizeof($sql_array); $i++) {
		apphp_db_query($sql_array[$i]);
      }
      return true;
    } else {
      return false;
    }
  }

  function apphp_db_select_db($database) {
    return mysql_select_db($database);
  }

  function apphp_db_query($query) {
    global $link;
    $res=mysql_query($query, $link);
    return $res;
  }

?>