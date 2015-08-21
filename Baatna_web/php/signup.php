<?php
require_once('defines.php');

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

$stmt = $mysqli->prepare("INSERT INTO SignUps (Email) VALUES ?");
$stmt->bind_param('s', $_POST['signupemail']);
$stmt->execute();

$mysqli->close();

if($stmt->affected_rows === 1) {
  respond(false, "Successfully signed up");
} else {
  respond(true, "Error in inserting your email to our database", $stmt->error); 
}
