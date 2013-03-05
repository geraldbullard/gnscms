<?php
/**
 * AdminProcess.php
 * 
 * The AdminProcess class is meant to simplify the task of processing
 * admin submitted forms from the admin center, these deal with
 * member system adjustments.
 *
 * Written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated: August 15, 2004
 */
include("../include/session.php");

class AdminProcess
{
   /* Class constructor */
   function AdminProcess(){
      global $session;
      /* Make sure administrator is accessing page */
      if(!$session->isAdmin()){
         header("Location: ".$config['WEB_ROOT'].$config['home_page']);
         return;
      }
      /* Admin submitted update user level form */
      if(isset($_POST['subupdlevel'])){
         $this->procUpdateLevel();
      }
      /* Admin submitted delete user form */
      else if(isset($_GET['subdeluser'])){
         $this->procDeleteUser();
      }
      /* Admin submitted delete inactive users form */
      else if(isset($_POST['subdelinact'])){
         $this->procDeleteInactive();
      }
      /* Admin submitted ban user form */
      else if(isset($_POST['subbanuser'])){
         $this->procBanUser();
      }
      /* Admin submitted delete banned user form */
      else if(isset($_POST['subdelbanned'])){
         $this->procDeleteBannedUser();
      }
      /* Admin submitted configuration changes */
      else if(isset($_POST['configedit'])){
         $this->procConfigEdit();
      }
      /* Admin submitted user activation form */
      else if(isset($_POST['activateusers'])){
         $this->procActivateUsers();
      }
      /* Admin submitted edit user account form */
      else if(isset($_POST['subedit']) && ($_POST['button'] == "Edit Account")){
         $this->procEditAccount();
      }
      else if(isset($_POST['subedit']) && ($_POST['button'] == "Delete")){
         $this->procDeleteUser();
      }
      /* Should not get here, redirect to home page */
      else{
         header("Location: ".$config['WEB_ROOT'].$config['home_page']);
      }
   }

   /**
    * procUpdateLevel - If the submitted username is correct,
    * their user level is updated according to the admin's
    * request.
    */
   function procUpdateLevel(){
      global $session, $database, $form;
      /* Username error checking */
      $subuser = $this->checkUsername("upduser");
      
      /* Errors exist, have user correct them */
      if($form->num_errors > 0){
         $_SESSION['value_array'] = $_POST;
         $_SESSION['error_array'] = $form->getErrorArray();
         header("Location: ".$session->referrer);
      }
      /* Update user level */
      else{
         $database->updateUserField($subuser, "userlevel", (int)$_POST['updlevel']);
         header("Location: ".$session->referrer);
      }
   }
   
   /**
    * procDeleteUser - If the submitted username is correct,
    * the user is deleted from the database.
    */
   function procDeleteUser(){
      global $session, $database, $form;
      /* Username error checking */
      $subuser = $this->checkUsername("username");
      
      /* Errors exist, have user correct them */
      if($form->num_errors > 0){
         $_SESSION['value_array'] = $_POST;
         $_SESSION['error_array'] = $form->getErrorArray();
         header("Location: ".$session->referrer);
      }
      /* Delete user from database */
      else{
         $sql = $database->connection->prepare("DELETE FROM ".TBL_USERS." WHERE username = '$subuser'");
         $sql->execute();
         header("Location: ".$session->referrer);
      }
   }
   
   /**
    * procDeleteInactive - All inactive users are deleted from
    * the database, not including administrators. Inactivity
    * is defined by the number of days specified that have
    * gone by that the user has not logged in.
    */
   function procDeleteInactive(){
      global $session, $database;
      $inact_time = $session->time - $_POST['inactdays']*24*60*60;
      $sql = $database->connection->prepare("DELETE FROM ".TBL_USERS." WHERE timestamp < $inact_time AND userlevel != ".ADMIN_LEVEL);
      $sql->execute();
      header("Location: ".$session->referrer);
   }
   
   /**
    * procBanUser - If the submitted username is correct,
    * the user is banned from the member system, which entails
    * removing the username from the users table and adding
    * it to the banned users table.
    */
   function procBanUser(){
      global $session, $database, $form;
      /* Username error checking */
      $subuser = $this->checkUsername("banuser");
      
      /* Errors exist, have user correct them */
      if($form->num_errors > 0){
         $_SESSION['value_array'] = $_POST;
         $_SESSION['error_array'] = $form->getErrorArray();
         header("Location: ".$session->referrer);
      }
      /* Ban user from member system */
      else{
         $sql = $database->connection->prepare("DELETE FROM ".TBL_USERS." WHERE username = '$subuser'");
         $sql->execute();

         $sql = $database->connection->prepare("INSERT INTO ".TBL_BANNED_USERS." VALUES ('$subuser', $session->time)");
         $sql->execute();
         header("Location: ".$session->referrer);
      }
   }
   
   /**
    * procDeleteBannedUser - If the submitted username is correct,
    * the user is deleted from the banned users table, which
    * enables someone to register with that username again.
    */
   function procDeleteBannedUser(){
      global $session, $database, $form;
      /* Username error checking */
      $subuser = $this->checkUsername("delbanuser", true);
      
      /* Errors exist, have user correct them */
      if($form->num_errors > 0){
         $_SESSION['value_array'] = $_POST;
         $_SESSION['error_array'] = $form->getErrorArray();
         header("Location: ".$session->referrer);
      }
      /* Delete user from database */
      else{
      	 $sql = $database->connection->prepare("DELETE FROM ".TBL_BANNED_USERS." WHERE username = '$subuser'");
         $sql->execute();

         header("Location: ".$session->referrer);
      }
   }
   
   /**
    * checkUsername - Helper function for the above processing,
    * it makes sure the submitted username is valid, if not,
    * it adds the appropritate error to the form.
    */
   function checkUsername($uname, $ban=false){
      global $database, $form;
	  $config = $database->getConfigs();
      /* Username error checking */
      $subuser = $_POST[$uname];
      $field = $uname;  //Use field name for username
      if(!$subuser || strlen($subuser = trim($subuser)) == 0){
         $form->setError($field, "* Username not entered<br>");
      }
      else{
         /* Make sure username is in database */
         $subuser = stripslashes($subuser);
         if(strlen($subuser) < $config['min_user_chars'] || strlen($subuser) > $config['max_user_chars'] ||
            !preg_match("/^[a-z0-9]([0-9a-z_-\s])+$/i", $subuser) ||
            (!$ban && !$database->usernameTaken($subuser))){
            $form->setError($field, "* Username does not exist<br>");
         }
      }
      return $subuser;
   }
   
   /**
    * configEdit - function for updating the website configurations in the
    * configuration table in the database.
    */
   function procConfigEdit(){
   	global $session, $form;
   	/* Account edit attempt */
      $retval = $session->editConfigs($_POST['sitename'], $_POST['sitedesc'], $_POST['emailfromname'], 
      $_POST['adminemail'], $_POST['webroot'], $_POST['home_page'], $_POST['activation'], 
      $_POST['min_user_chars'], $_POST['max_user_chars'], $_POST['min_pass_chars'], 
      $_POST['max_pass_chars'], $_POST['send_welcome'], $_POST['enable_login_question'], 
      $_POST['enable_capthca'], $_POST['all_lowercase'], $_POST['user_timeout'], $_POST['guest_timeout'], 
      $_POST['cookie_expiry'], $_POST['cookie_path']);
	  
   /* Account edit successful */
      if($retval){
         $_SESSION['configedit'] = true;
         header("Location: ../admin/index.php?id=2");
      }
      /* Error found with form */
      else{
         $_SESSION['value_array'] = $_POST;
         $_SESSION['error_array'] = $form->getErrorArray();
         header("Location: ../admin/index.php?id=2");
      }
   }
   
   /**
    * procActivateUsers - function to activate users selected by Admin
    * on the Admin Page.
    */
    function procActivateUsers(){
   	global $session, $database, $mailer;
	$config = $database->getConfigs();
   	/* Account edit attempt */
   	foreach($_POST['user_name'] as $username) {
    $sql = $database->connection->prepare("UPDATE ".TBL_USERS." SET USERLEVEL = '3' WHERE username = '$username'");
    $sql->execute();
	$req_user_info = $database->getUserInfo($username);
	$email = $req_user_info['email'];
	$mailer->adminActivated($username,$email,$config);
   	}
	header("Location: ../admin/index.php?id=3");
   }
   
   /**
    * procEditAccount - Admin account editing function.
    */
   function procEditAccount(){
      global $session, $form;
      /* Account edit attempt */
      $retval = $session->adminEditAccount($_POST['username'], $_POST['newpass'], $_POST['conf_newpass'], $_POST['email'], $_POST['userlevel'], $_POST['usertoedit']);

      /* Account edit successful */
      if($retval){
         $_SESSION['adminedit'] = true;
         $_SESSION['usertoedit'] = $_POST['usertoedit'];
         header("Location: ../admin/index.php?id=6");
      }
      /* Error found with form */
      else{
         $_SESSION['value_array'] = $_POST;
         $_SESSION['error_array'] = $form->getErrorArray();
         header("Location: ../admin/index.php?id=6&usertoedit=".$_POST['usertoedit']);
      }
   }
   
};

/* Initialize process */
$adminprocess = new AdminProcess;

?>
