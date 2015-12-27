<?php
require_once('contents/includes/config_class.php');
require_once('contents/includes/session_class.php');
include("fbconnect.php");

$session->check_login();
	if($session->is_logged_in())
	{
		header("location:home.php");
		
	}

//uid was not set, it means the user signedup just now and has no pwd


?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Welcome</title>
</head>

<body>
Hi, <?php echo $fn; ?><br>

Your Data has been saved.
</body>
</html>