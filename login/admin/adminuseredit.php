<?php
/**
 * AdminUserEdit.php
 *
 * This page is for admin to edit user's account information
 * such as their password, email address, etc.
 *
 * Written by: Siggles
 * Last Updated: December 26, 2011
 */

/**
 * User has submitted form without errors and user's
 * account has been edited successfully.
 */
if(isset($_SESSION['adminedit'])){
   unset($_SESSION['adminedit']);
   
   echo "<h1>User Account Edit Success!</h1><br>";
   echo "<p><b>".$_SESSION['usertoedit']."'s</b> account has been successfully updated. "
		."<br><br>Back to the <a href='../admin/index.php?id=3'>Admin Page</a></p>";
		unset($_SESSION['usertoedit']);
}
else{

/**
 * If user is not logged in, then do not display anything.
 * If user is logged in, then display the form to edit
 * account information, with the current email address
 * already in the field.
 */
if(!$session->isAdmin()){
   header("Location: ".$config['WEB_ROOT'].$config['home_page']);
} else {	
$usertoedit=$_GET['usertoedit'];
$req_user_info = $database->getUserInfo($usertoedit);
?>
<h1>Admin User Account Edit : <?php echo $usertoedit; ?></h1>
<?php
if($form->num_errors > 0){
   echo "<td>".$form->num_errors." error(s) found</td>";
}
?>
<form action="adminprocess.php" method="POST">
<table align="left" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>Username:</td>
<td><input name="username" type="text" value="
<?php
if($form->value("username") == ""){
   echo $req_user_info['username'];
}else{
   echo $form->value("username");
}
?>" size="30" maxlength="30"></td>
<td><?php echo $form->error("username"); ?></td>
</tr>
<tr>
<td>New Password:</td>
<td><input name="newpass" type="password" value="
<?php echo $form->value("newpass"); ?>" size="30" maxlength="30"></td>
<td><?php echo $form->error("newpass"); ?></td>
</tr>
<tr>
<td>Confirm New Password:</td>
<td><input name="conf_newpass" type="password" value="
<?php echo $form->value("newpass"); ?>" size="30" maxlength="30"></td>
<td><?php echo $form->error("newpass"); ?></td>
</tr>
<tr>
<td>Email:</td>
<td><input name="email" type="text" value="
<?php
if($form->value("email") == ""){
   echo $req_user_info['email'];
}else{
   echo $form->value("email");
}
?>" size="30" maxlength="50">
</td>
<td><?php echo $form->error("email"); ?></td>
</tr>
<tr>
<td>User level:</td>
<td><input name="userlevel" type="text" value="
<?php
if($form->value("userlevel") == ""){
   echo $req_user_info['userlevel'];
}else{
   echo $form->value("userlevel");
}
?>" size="4" maxlength="10"></td>
<td><?php echo $form->error("userlevel"); ?></td>
</tr>
<tr><td align="right">
<input type="hidden" name="subedit" value="1">
<input type="hidden" name="usertoedit" value="<?php echo $usertoedit; ?>">
<input type="submit" name="button" value="Edit Account">
</td>
<td colspan="2" style="text-align:right;">
<input type="submit" name="button" value="Delete" onclick="return confirm ('Are you sure you want to delete this user, this cannot be undone?\n\n' + 'Click OK to continue or Cancel to Abort!')">
</td>
</tr>
</table>
</form>
<?php
} 
}
?>