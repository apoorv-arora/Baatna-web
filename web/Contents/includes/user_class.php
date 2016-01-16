<?php

class User
{


	
	public function valid($u="",$p="")
	{
		
		require('contents/includes/config_class.php');
		$sql='SELECT pwd from login where email_id=? LIMIT 1';
		$q=$con->prepare($sql);
		$q->execute(array($u));
		$r=$q->fetch(PDO::FETCH_NUM);
		if(is_null($r))
		return 'what';
		
		for($i=1;$i<2;$i++)
		  {
			$p=crypt($p, '$2a$09$statink.compassword$');
		  }

		
		if($r[0]===$p)
		{
		require('contents/includes/config_class.php');
		$sql='SELECT uid from login where email_id=? AND pwd=? LIMIT 1';
		$q=$con->prepare($sql);
		$q->execute(array($u,$p));
		$r=$q->fetch(PDO::FETCH_NUM);
		if(is_null($r))
		return 'what';
		return $r[0];
		}
		
		
	}
	
	public function user_details($uid)
	{
		require('contents/includes/config_class.php');
		$details= new self;
		$sql='SELECT * from details where uid=? LIMIT 1';
		$q=$con->prepare($sql);
		$q->execute(array($uid));
		$details=$q->fetch(PDO::FETCH_OBJ);
		if(empty($details))
		return NULL;
		return $details;
	}
	
	

}

$user= new User();
?>