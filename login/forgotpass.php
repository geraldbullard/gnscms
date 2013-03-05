<?php
/**
 * ForgotPass.php
 *
 * This page is for those users who have forgotten their password and want to 
 * have a new password generated for them and sent to the email address attached 
 * to their account in the database. The new password is not displayed on the 
 * website for security purposes.
 *
 * Originally written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated by The Angry Frog : January 11th, 2012
 */
include("include/session.php");
$config = $database->getConfigs();
?>

<html>
<head>
	<title><?php echo $config['SITE_NAME']; ?> - Forgot Password</title>
</head>
<body>

<?php
/**
 * Forgot Password form has been submitted and no errors
 * were found with the form (the username is in the database)
 */
if(isset($_SESSION['forgotpass'])){
   /**
    * New password was generated for user and sent to user's
    * email address.
    */
   if($_SESSION['forgotpass']){
      echo "<h1>New Password Generated</h1>";
      echo "<p>Your new password has been generated "
          ."and sent to the email <br>associated with your account. "
          ."<a href=".$config['WEB_ROOT'].$config['home_page'].">Main</a>.</p>";
   }
   /**
    * Email could not be sent, therefore password was not
    * edited in the database.
    */
   else{
      echo "<h1>New Password Failure</h1>";
      echo "<p>There was an error sending you the "
          ."email with the new password,<br> so your password has not been changed. "
          ."<a href=".$config['WEB_ROOT'].$config['home_page'].">Home</a>.</p>";
   }
       
   unset($_SESSION['forgotpass']);
}
else{

/**
 * Forgot password form is displayed, if error found
 * it is displayed.
 */
?>

<form action="process.php" method="POST">

<h1>Forgot Password</h1>
<table align="left" border="0" cellspacing="0" cellpadding="3">
	<tr>
		<td colspan='2'>Please fill out the form below. You'll need your username and the<br>
e-mail address you used to register (unless you have since changed it).
	</td>
</tr>

<tr>
	<td><?php echo $form->error("user"); ?></td>
</tr>
<tr>
	<td>Username:</td>
	<td>
		<input type="text" tabindex="1" name="user" value="<?php echo $form->value("user"); ?>">	
	</td>
</tr>
<tr>
	<td>E-mail address:</td> 
	<td><input type="text" tabindex="2" name="email" value="<?php echo $form->value("email"); ?>"></td>
</tr>
<tr>
	<td>
		<input type="hidden" name="subforgot" value="1">
 		<input type="submit" value="Get New Password">
 	</td>
</tr>
</table>
</form>
<?php
}
?>

</body>
</html>
