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

$stmt = $mysqli->prepare("INSERT INTO ContactUs (Name, Email, Subject, Message) VALUES (?, ?, ?, ?)");
$stmt->bind_param('ssss', $_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message']);
$stmt->execute();

$mysqli->close();

if($stmt->affected_rows === 1) {
  respond(false, "Thanks for your input. We'll get back to your shortly");
} else {
  respond(true, "Error in inserting your message to our database", $stmt->error); 
}
