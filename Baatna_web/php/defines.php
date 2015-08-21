<?php
DEFINE('DB_USERNAME', 'root');
DEFINE('DB_PASSWORD', 'root');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_PORT', '8889');
DEFINE('DB_DATABASE', 'Baatna');

function respond($err, $msg, $data = []) { // Function to return JSON response
  die(json_encode(array('error' => $err, 'msg' => $msg, 'data' => $data)));
}
