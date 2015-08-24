<?php
require_once('defines.php');

DEFINE('WELCOME_MAIL_SUBJECT', 'Welcome to Baatna');


if(!isset($_POST['signupemail'])) {
  respond(true, "Email ID is a required field");
}
if(!filter_var($_POST['signupemail'], FILTER_VALIDATE_EMAIL)) {
  respond(true, "Invalid email ID");
}
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if(mysqli_connect_error()) {
  respond(true, "Couldn't connect to database.", mysqli_connect_error());
}

$token = getToken($_POST['signupemail']);
$stmt = $mysqli->prepare("INSERT INTO users (email, token) VALUES (?, ?)");
$stmt->bind_param('ss', $_POST['signupemail'], $token);
$stmt->execute();

$mysqli->close();

if($stmt->affected_rows === 1) {
  //Set who the message is to be sent to
  $mail->addAddress($_POST['signupemail'], 'John Doe');

  //Set the subject line
  $mail->Subject = WELCOME_MAIL_SUBJECT;
  // TODO : Content for the mail
  $mail->Body = "Welcome to Baatna.\n\r Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n\r Visit http://baatna.com/referral.php?token={$token} to refer it to your friends";

  $mail->send();

  respond(false, "Successfully signed up", [$token]);
} else {
  respond(true, "Error in inserting your email to our database", $stmt->error); 
}
