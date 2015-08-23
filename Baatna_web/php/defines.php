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
