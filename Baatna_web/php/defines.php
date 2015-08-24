<?php
DEFINE('DB_USERNAME', 'root');
DEFINE('DB_PASSWORD', '');
DEFINE('DB_HOST', '127.0.0.1');
DEFINE('DB_PORT', '8889');
DEFINE('DB_DATABASE', 'baatna');

function respond($err, $msg, $data = []) { // Function to return JSON response
  die(json_encode(array('error' => $err, 'msg' => $msg, 'data' => $data)));
}
function getToken($email) {
  return password_hash($email, PASSWORD_BCRYPT);
}

require_once(__DIR__ . '/../vendor/autoload.php');
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
// TODO: Enter email id and password
$mail->Username = "yolo@lmao.com";
$mail->Password = "diz_iz_whyr_ur_passwordz_goz";
$mail->setFrom('contactus@baatna.com', 'Baatna - Web Team');

//Set an alternative reply-to address
//$mail->addReplyTo('replyto@example.com', 'First Last');
