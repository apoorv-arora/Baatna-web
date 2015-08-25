<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Baatna";
$port = "8889";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);
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
?>