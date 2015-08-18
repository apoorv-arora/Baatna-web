<?php
require_once('defines.php');

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if (mysqli_connect_error()) {
  die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

echo 'Connected successfully.';



// Create connection
echo "Inside sign up script";
//$conn = new mysqli($servername, $username, $password, $dbname, $port);
// Check connection
// if ($mysqli->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }  else
// 	echo "";

$sql = "INSERT INTO SignUps (Email) VALUES ($_POST[signupemail])";

if ($mysqli->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $mysqli->error;
}

$mysqli->close();
// It is recommended to not close php tags as they might leave random whitespace. 
// More info : http://stackoverflow.com/questions/5701747/should-i-close-my-php-tags
