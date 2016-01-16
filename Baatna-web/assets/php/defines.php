<?php
DEFINE('DB_USERNAME', 'root');
DEFINE('DB_PASSWORD', '');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_PORT', '3306');
DEFINE('DB_DATABASE', 'baatna');

function respond($err, $msg, $data = []) { // Function to return JSON response
  die(json_encode(array('error' => $err, 'msg' => $msg, 'data' => $data)));
}
function getToken($email) {
  return password_hash($email, PASSWORD_BCRYPT);
}
echo"read";

require_once('C:/wamp/www/Baatna-web/vendor/autoload.php');
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
// TODO: Enter email id and password
$mail->Username = "aman@baatna.com";
$mail->Password = "invincible phobia";
$mail->setFrom('aman@baatna.com', 'Baatna - Web Team');

//Set an alternative reply-to address
//$mail->addReplyTo('replyto@example.com', 'First Last');
