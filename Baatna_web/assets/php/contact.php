<?php
require_once('defines.php');

if(!isset($_POST['email'])) {
  respond(true, "Email ID is a required field");
}
if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  respond(true, "Invalid email ID");
}



  //Set who the message is to be sent to
  $mail->addAddress('bansalaman2905@gmail.com', 'hello baatna');

  //Set the subject line
  $mail->Subject = "CONTACT";
  // TODO : Content for the mail
  $mail->Body = $_POST['message'];
if($mail->send()){
  
  respond(false, "Successfully sent");
}
 else {
  respond(true, "Error in inserting your email to our database"); 
}