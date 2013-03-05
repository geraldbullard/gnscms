<h2 class="login-postheader">User Configuration</h2>

<div class="cleared"></div>

<div class="login-postcontent">

<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function jqCheckAll3( id, pID )
{
   $( "#" + pID + " :checkbox").attr('checked', $('#' + id).is(':checked'));
}
//  End -->
</script>

<?php include('../include/pagination.php'); ?>
<br>
<?php
if (isset($_POST['orderby'])){
	$orderby=$_POST['orderby'];
} else {
	$orderby = 'username';
}
$result = $pagination->paginatePage("10","".TBL_USERS."","$orderby"); 
echo "<br><table>";
echo "<tr><th class='sortable'>Username</th><th class='sortable'>User Level</th><th class='sortable'>E-mail</th><th class='sortable'>Registered</th><th class='sortable'>Last Login Time</th></tr>";
		
		while ($row = $result->fetch()) {
		$timestamp = $row['timestamp'];
		$lastlogin  = date("j M, y, g:i a", $timestamp);
		$regdate = $row['regdate'];
		$reg  = date("j M, y, g:i a", $regdate);		
		echo "<tr><td><a href='".$config['WEB_ROOT']."admin/index.php?id=6&usertoedit=".$row['username']."'>".$row['username']."</a></td><td>".$row['userlevel']."</td>"
		."<td><a href='mailto:".$row['email']."'>".$row['email']."</a></td><td>"
		.$reg."</td><td>".$lastlogin."</td></tr>";		
		}
echo "</table>";
?>
<br>	

<?php
$orderby = 'regdate';
$result = displayAdminActivation($orderby);
?>

<h4>Accounts awaiting Admin or Email activation</h4>
<form name='myForm' action='adminprocess.php' method='POST'>
<table id='left' style='margin-bottom:5px;'>
<tr>
<th class='sortable'>Username</th><th class='sortable'>User Level</th>
<th class='sortable'>Email</th><th class='sortable'>Registered</th><th>
<input type="checkbox" id="checkL" onclick="jqCheckAll3(this.id, 'left');"/></th>
</tr>

<?php
while($row = $result->fetch())
{
	$regdate = $row['regdate'];
	$reg  = date("j M, y, g:i a", $regdate);	
	echo "<tr><td>".$row['username']."</td><td>".$row['userlevel']."</td><td>"
	."<a href='mailto:".$row['email']."'>".$row['email']."</a></td><td>".$reg
	."</td><td><input name='user_name[]' type='checkbox' value='".$row['username']."' />";
}
?>

</table>
<input type="hidden" name="activateusers" value="1">
<input type="submit" value="Activate Selected Users">
<br>
</form>

<br>

<h4>Banned Users</h4>
<?php
if (isset($_POST['orderby'])){
	$orderby=$_POST['orderby'];
} else {
	$orderby = 'username';
}
$result = $pagination->paginatePage("10","".TBL_BANNED_USERS."","$orderby"); 
?>
<table>
<tr>
<th class='sortable'>Username</th>
<th class='sortable'>Timed Banned</th>
</tr>

<?php		
while ($row = $result->fetch()) {
$timestamp = $row['timestamp'];
$lastlogin  = date("j M, y, g:i a", $timestamp);		
echo "<tr><td>".$row['username']."</td>"
."<td>".$lastlogin."</td></tr>";		
}
?>

</table>
<br>

<h4>Delete inactive accounts</h4>
<form action="adminprocess.php" method="POST">
<table>
<tr>
<td>Days:<br>
<select name="inactdays">
<option value="3">3</option>
<option value="7">7</option>
<option value="14">14</option>
<option value="30">30</option>
<option value="100">100</option>
<option value="365">365</option>
</select>
</td>
<td>
<br>
<input type="hidden" name="subdelinact" value="1">
<input type="submit" value="Delete All Inactive" onclick="return confirm ('Are you sure you want to delete inactive accounts, this cannot be undone?\n\n' + 'Click OK to continue or Cancel to Abort!')">
</td></tr>
</table>
</form>

<h4>Ban User</h4>
<?php echo $form->error("banuser"); ?>
<form action="adminprocess.php" method="POST">
<table>
<tr>
<td>Username:<br></td>
<td><input type="text" name="banuser" maxlength="30" value="<?php echo $form->value("banuser"); ?>">
<input type="hidden" name="subbanuser" value="1">
<input type="submit" value="Ban User">
</td></tr>
</table>
</form>


<script type="text/javascript" src="tablesort.js"></script>

</div>
<div class="cleared"></div>
