<?php
require_once('contents/includes/config_class.php');

require_once('contents/includes/session_class.php');

$session->logout();
echo "You have been logged out";
header("location:index2.php");

?>