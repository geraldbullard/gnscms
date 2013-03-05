<?php
   /**
    * displayUsers - Displays the users database table in
    * a nicely formatted html table.
    */
   function displayUsers(){
      global $database;
      
      $sql = $this->connection->query("SELECT username,userlevel,email,timestamp FROM ".TBL_USERS." ORDER BY userlevel DESC,username");
      $count = $sql->rowCount();
      
      if(!$sql || $count < 0){
      echo "Error displaying info";
      return;
      }
      if($count == 0){
      echo "Database table empty";
      return;
      }
      /* Display table contents */
     echo "<table border=\"0\" cellspacing=\"2\" cellpadding=\"4\">\n";
     echo "<tr><td><b>Username</b></td><td><b>Level</b></td><td><b>Email</b></td><td><b>Last Active</b></td></tr>\n";
     for($i=0; $i<$num_rows; $i++){
      $uname  = mysql_result($result,$i,"username");
      $ulevel = mysql_result($result,$i,"userlevel");
      $email  = mysql_result($result,$i,"email");
      $time   = mysql_result($result,$i,"timestamp");
      $timet  = date("F j, Y, g:i a", $time);   

     echo "<tr><td>$uname</td><td>$ulevel</td><td>$email</td><td>$timet</td></tr>\n";
     }
     echo "</table><br>\n";
  }
  
   /**
    * displayBannedUsers - Displays the banned users
    * database table in a nicely formatted html table.
    */
   function displayBannedUsers(){
      global $database;
      $sql = $database->connection->query("SELECT username,timestamp FROM ".TBL_BANNED_USERS." ORDER BY username");
      // $result = $database->query($q);
      /* Error occurred, return given name by default */
      $count = $sql->rowCount();
      if(!$sql || $count < 0){
      echo "Error displaying info";
      return;
      }
      if($count == 0){
      echo "Database table empty";
      return;
      }
      /* Display table contents */
      echo "<table align=\"left\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\n";
      echo "<tr><td><b>Username</b></td><td><b>Time Banned</b></td></tr>\n";
      for($i=0; $i<$num_rows; $i++){
      $uname = mysql_result($result,$i,"username");
      $time  = mysql_result($result,$i,"timestamp");

      echo "<tr><td>$uname</td><td>$time</td></tr>\n";
     }
    echo "</table><br>\n";
	}

	function displayAdminActivation($orderby){
		global $database;
		$sql = $database->connection->query("SELECT username, regdate, email, userlevel "
		."FROM ".TBL_USERS." WHERE userlevel = ".ADMIN_ACT." OR userlevel = ".ACT_EMAIL." ORDER BY $orderby DESC");
	return $sql;
	}
	
?>