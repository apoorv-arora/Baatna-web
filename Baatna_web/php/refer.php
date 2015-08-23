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

$stmt = $mysqli->prepare("SELECT uid, email FROM users WHERE token = ?");
$stmt->bind_param('s', $token);
$stmt->execute();
$stmt->bind_result($uid, $referrerEmail);
$stmt->fetch();
$stmt->close();

foreach($emails as $email) {
  $stmt = $mysqli->prepare( "INSERT INTO referrals (uid, email) VALUES (?, ?)");
  $stmt->bind_param('ss', $uid, $email);
  $stmt->execute();
}

$mysqli->close();

respond(false, "Successfully added the referrals.");
