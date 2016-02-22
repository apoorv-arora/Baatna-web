<?php
require_once('defines.php');

if(!isset($_POST['email'])) {
  respond(true, "Email ID is a required field");
}
if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  respond(true, "Invalid email ID");
}
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if(mysqli_connect_error()) {
  respond(true, "Couldn't connect to database.", mysqli_connect_error());
}


$mysqli->close();

if(1) {
  //Set who the message is to be sent to
  $mail->addAddress('hello@baatna.com', 'hello baatna');

  //Set the subject line
  $mail->Subject = WELCOME_MAIL_SUBJECT;
  // TODO : Content for the mail
  $mail->Body = $_POST['message'];

  $mail->send();

  respond(false, "Successfully sent", [$token]);
} else {
  respond(true, "Error in inserting your email to our database", $stmt->error); 
}