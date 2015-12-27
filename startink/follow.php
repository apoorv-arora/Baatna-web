<?php
require_once('contents/includes/config_class.php');
require_once('contents/includes/session_class.php');
require_once('contents/includes/following_class.php');
require_once('contents/includes/sanitize_text.php');

$session->check_login();
if(!$session->is_logged_in())
{
	header("location:index.php");
}

if(isset($_POST['follow']))
{
$callback=$sanitize->san($_POST['callback']);
list($uid,$fid)=explode('_',$_POST['follow']);
if($_SESSION['uid']!=$sanitize->san($uid)||(is_nan($uid)|| is_nan($fid)))
header("location:".urldecode($callback)); 

else
{
	
echo 'here';	
if(!$follow->following_that_person($uid,$fid))
	$follow->follow_person($uid,$fid);
	
	header("location:".urldecode($callback)); 
	
}
}

else if(isset($_POST['unfollow']))
{
$callback=$sanitize->san($_POST['callback']);
list($uid,$fid)=explode('_',$_POST['unfollow']);
if($_SESSION['uid']!=$sanitize->san($uid)||(is_nan($uid)|| is_nan($fid)))
header("location:".urldecode($callback)); 

else
{
	
echo 'here';	
if($follow->following_that_person($uid,$fid))
	$follow->unfollow_person($uid,$fid);
	
	header("location:".urldecode($callback)); 
	
}
	
	
}
?>