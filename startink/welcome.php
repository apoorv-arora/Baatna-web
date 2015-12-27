<?php
//echo "entered welcome.php";
require_once('contents/includes/config_class.php');
require_once('contents/includes/session_class.php');
include("fbconnect.php");
//echo "after fbconnect";

//check if the user has all sessions present

$session->check_login();
	if($session->is_logged_in())
	{
		header("location:http://www.baatna.com");
		//header("location:home.php");
		
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
welcome
</body>
</html>