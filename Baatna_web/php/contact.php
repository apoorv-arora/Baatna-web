<?php
require_once('defines.php');

$conn = new conn(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
// Create connection
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO ContactUs (Name, Email, Subject, Message)
  VALUES ($_POST[name], $_POST[email], $_POST[subject], $_POST[message])";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
// It is recommended to not close php tags as they might leave random whitespace. 
// More info : http://stackoverflow.com/questions/5701747/should-i-close-my-php-tags
