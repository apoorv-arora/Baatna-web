<?php


require_once('contents/includes/config_class.php');
require_once('contents/includes/session_class.php');
require_once('contents/includes/user_class.php');
require_once('contents/includes/activity_class.php');
require_once("contents/includes/vote_class.php");
include("contents/includes/comment_class.php");
require_once("contents/includes/sanitize_text.php");
require_once('contents/includes/get_fb_id.php');
require_once("contents/includes/following_class.php");

date_default_timezone_set("Asia/Kolkata");
 
$session->check_login();
if(!$session->is_logged_in())
{
	header("location:index.php");
}

$details=new User;
$details=$user->user_details($_SESSION['uid']);
$date= date_create($details->birth);
//creating hashing for comment deletion

?>

<html>


</html>