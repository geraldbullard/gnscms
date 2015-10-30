<?php 
 /**
  * Title: PHP Tutorial 1: Secure Contact Form
  * URL: http://www.matthewwatts.net/tutorials/php-tutorial-1-creating-a-secure-contact-form-for-your-website/
  * For: Processing form data and sending it to a specified E-mail address.
  * Site: matthewwatts.net
  * Author: Matthew Watts
  * Company: Rexibit Web Services - http://www.rexibit.com
  * Last Modified: 2010-09-05
  */
  include_once('inc/top.php');

  // Main Variables Used Throughout the Script
  $recipient = 'Kevin Ski';
  $siteName = 'Kevin Ski Music';
  $siteEmail = 'kswenszkowski@icloud.com';
  $subject = 'Contact from Kevin Ski Music';
  $smtphost = 'mail.kevinskimusic.com';
  $smtpuser = 'contact@kevinskimusic.com';
  $smtppass = 'K3v1nSk1!@#';
  
  // Check if the web form has been submitted
  if (isset($_POST["save"])) {
    /*
    * Process the web form variables
    * Strip out any malicious attempts at code injection, just to be safe.
    * All that is stored is safe html entities of code that might be submitted.
    */
    $contactName = htmlentities(substr($_POST["name"], 0, 100), ENT_QUOTES);
    $contactEmail = htmlentities(substr($_POST["email"], 0, 100), ENT_QUOTES);
    $contactPhone = htmlentities(substr($_POST["phone"], 0, 15), ENT_QUOTES);
    $messageContent = htmlentities(substr($_POST["message"], 0, 10000), ENT_QUOTES);

    // Check if the data entered for the E-mail is formatted like an E-mail should be
    if (!eregi('^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]{2,})+$', $contactEmail)) {
      header('Location: contact.html');
      break;
    }

    // Check if all of the form fields contain data before we allow it to be submitted successfully
    if ($contactName == "" || $contactEmail == "" || $messageContent == "") {
      header('Location: contact.html');
      break;
    }

    // Prepare the E-mail message
    $message = '<html>
                <head>
                <title>' . $siteName . ': A Contact Message</title>
                </head>
                <body>
                <p>Name: ' . $contactName . '</p>
                <p>Email: ' . $contactEmail . '</p>
                <p>Phone: ' . $contactPhone . '</p>
                <p>Message: ' . wordwrap($messageContent, 100) . '</p>
                </body>
                </html>';

    // get the PHPMailer code
    require 'inc/PHPMailerAutoload.php';

    $mail = new PHPMailer;
    $mail->isSMTP();                                     // Set mailer to use SMTP
    $mail->Host = "$smtphost";                           // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                              // Enable SMTP authentication
    $mail->Username = "$smtpuser";                       // SMTP username
    $mail->Password = "$smtppass";                       // SMTP password
    $mail->SMTPSecure = 'tls';                           // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 26;                                    // TCP port to connect to
    $mail->From = "$contactEmail";
    $mail->FromName = "$contactName";
    $mail->addAddress("$siteEmail", "$recipient");       // Add a recipient
    $mail->addReplyTo("$contactEmail", "$contactName");
    $mail->isHTML(true);                                 // Set email format to HTML
    $mail->Subject = "$subject";
    $mail->Body    = "$message";
    $mail->AltBody = "Name: $contactName\n\n . 
                      Email: $contactEmail\n\n . 
                      Phone: $contactPhone\n\n . 
                      Message: $message";
    //$mail->SMTPDebug = 3;                              // Enable verbose debug output
    //$mail->addAddress('ellen@example.com');            // Name is optional
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');
    //$mail->addAttachment('/var/tmp/file.tar.gz');      // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg'); // Optional name
    
    if (!$mail->send()) {
      header('Location: 404.html');
      break;
      // echo 'Mailer Error: ' . $mail->ErrorInfo; // save to log file later
    } else {
      header('Location: success.html');
      break;
    }
  } else { // If web form has not been submitted, show a blank form
    header('Location: 404.html');
    break;
  }
?>