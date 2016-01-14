<?php

class Cookie
{

	private function create_cookie($uid)
	{
		$token=md5(uniqid());
		setcookie('startink_rm',$token,time()+3600*24*7,"/",'',false,true);
		setcookie($cookie,$token,time()+3600*24*7,"/",'localhost/startink/',false,true);
	}
	
	private function remove_cookie()
	{

	}
	
	private function check_cookie()
	{
		
	}
	
	public function update_cookie($uid)
	{
		list($a,$b,$c)=explode('_',$_COOKIE['startink.com']);
		require('config_class.php');
		$sql="UPDATE login set coke=? where uid=";

		
	}
	
	
	
	
}


$cookie= new Cookie;


?>
