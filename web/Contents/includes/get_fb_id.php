<?php

class FBID
{
	
	public function fb_image($u)
	{
		require('contents/includes/config_class.php');
		$sql='SELECT fb_id from login where uid=?';
		$q=$con->prepare($sql);
		$q->execute(array($u));
		$r=$q->fetch(PDO::FETCH_ASSOC);
		return $r['fb_id'];
		
	}
	
	
}

$facebook=new FBID;

?>