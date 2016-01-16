<?php 

class Session
{
	
	//public $uid;
	private $logged=false;
	
	function Session()
	{
		session_start();
		session_regenerate_id();
		
	}
	
	public function check_login()
	{
		if(isset($_SESSION['uid']))
		{
			$this->logged=true;
		//	$this->uid=$_SESSION['uid'];
			}
		
		else
		{
			//unset($this->uid);
			$this->logged=false;
			
		
		}
		
		return $this->logged;

	}
	
	public function login()
	{
		$this->logged=true;
		//$this->user=$_SESSION['uid'];
	}
	
	public function is_logged_in()
	{
		return $this->logged;
	}
	
	public function logout()
	{
		unset($_SESSION['uid']);
		//unset($this->uid);
		$this->logged=false;
	}
	
}

$session= new Session();
?>