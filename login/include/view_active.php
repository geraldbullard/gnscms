<?php
/**
 * Just a little page widget, tells how many registered members
 * there are, how many users currently logged in and viewing site,
 * and how many guests viewing site. Active users are displayed,
 * with link to their user information.
 * 
 * include("include/session.php"); must be called on a page
 * displaying this widget.
 */

echo "<b>Member Total:</b> ".$database->getNumMembers()."<br>";
echo "There are ".$database->num_active_users." registered members and ";
echo $database->num_active_guests." guests viewing the site.<br><br>";

if(!defined('TBL_ACTIVE_USERS')) {
  die("Error processing page");
}

global $database;
$stmt = $database->connection->query("SELECT username FROM ".TBL_ACTIVE_USERS." ORDER BY timestamp DESC,username");
/* Error occurred, return given name by default */
$num_rows = $stmt->columnCount();

if(!$stmt || ($num_rows < 0)){
   echo "Error displaying info";
}
else if($num_rows > 0){
   /* Display active users, with link to their info */
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		echo "<a href='userinfo.php?user=".$row['username']."'>".$row['username']."</a>  /";
	}
}
?>