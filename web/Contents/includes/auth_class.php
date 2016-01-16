<?php

class Auth
{

	
	function check_set()
	{
		if(isset($_POST['email'])&& isset($_POST['pwd']))
		{
			return true;
		}
		
	}
	function set_session($uid)
	{
		echo $uid;

			session_start();
			$_SESSION['uid']=$uid;
			return true;
		
	}
	
		
}


$auth= new Auth;

?>