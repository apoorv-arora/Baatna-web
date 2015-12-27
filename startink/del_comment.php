<?php
require_once('contents/includes/config_class.php');
require_once('contents/includes/session_class.php');
require_once('contents/includes/sanitize_text.php');
require_once('contents/includes/comment_class.php');

$session->check_login();
if(!$session->is_logged_in())
	header("location:index.php");
	
	try{
	
		
	if($session->is_logged_in() && !empty($_POST['delc']))
	{
		
		//echo "here";
		$_POST['delc']=$sanitize->san($_POST['delc']);
		if(!empty($_POST['delc'])&&!is_nan($_POST['delc']))
		
			
	$comments->del_comm($_POST['delc']);
	return 1;
	
	}
	
	/*if(isset($_GET['callback']) && !empty($_GET['callback']))
	{
		//echo urldecode($_GET['callback']);
			header("location:".urldecode($_GET['callback']));
			
	}
	
	else {
	
    header("location:profile_page.php");
	}*/
}

	
	catch(Exception $e)
	{
		echo "Error";
		$con->rollback();
		
	}

	
	
?>