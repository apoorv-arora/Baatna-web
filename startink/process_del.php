<?php

try{
	
require_once('contents/includes/user_class.php');
require_once('contents/includes/activity_class.php');
require_once('contents/includes/session_class.php');

$to_del=$_POST['act'];


$activity->del_sketch($to_del);



header("location:home.php");

}
catch(Exception $e)
{
	echo 'oops';
}
?>