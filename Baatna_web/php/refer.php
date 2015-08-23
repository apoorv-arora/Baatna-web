<?php
require_once('defines.php');

if(!isset($_POST['emails'])) {
  respond(true, "Email ID is a required field");
}
$emails = explode(',', $_POST['emails']);
$token = $_POST['token'];

$invalidEmails = [];
$isInvalid = false;
foreach($emails as $email) {
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $invalidEmails[] = $email;
    $isInvalid = true;
  }
}
if($isInvalid) {
  respond(true, "Invalid email IDs given", $invalidEmails);
}
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if(mysqli_connect_error()) {
  respond(true, "Couldn't connect to database.", mysqli_connect_error());
}

$stmt = $mysqli->query("SELECT uid, email FROM users WHERE token = ?");
$stmt->bind_param('s', $token);
$stmt->execute();
$stmt->bind_result($uid, $referrerEmail);
$stmt->fetch();
$stmt->close();

$queryString = "INSERT INTO refer (uid, email) VALUES ";
for($i = 0; $i < count($emails); $i++) {
  $queryString .= ("(?,?)" . ($i !== count($emails) - 1)?",":"");
}

$stmt = $mysqli->prepare($queryString);

foreach($emails as $email) {
  $stmt->bind_param('ss', $uid, $email);
}
$stmt->execute();

$mysqli->close();

if($stmt->affected_rows === 1) {
  mail($_POST['signupemail'], WELCOME_MAIL_SUBJECT, WELCOME_MAIL_MESSAGE, 'From: contactus@baatna.com' . "\r\n");
  respond(false, "Successfully signed up");
} else {
  respond(true, "Error in inserting your email to our database", $stmt->error); 
}
