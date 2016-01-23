<?php



class Following
{
	private $boolean_follow=false;
	
	
	public function following_that_person($uid,$fid)
	{
		include("contents/includes/config_class.php");
		$sql='SELECT * FROM following where uid=? and fid=? LIMIT 1';
		$q=$con->prepare($sql);
		$q->execute(array($uid,$fid));

		if($q->rowCount())
		{
		
		return true;
		}
		
		
		return false;
	
	}
	
	public function is_being_followed($uid,$fid)
	{
		include("contents/includes/config_class.php");
		$sql='SELECT * FROM following where uid=? and fid=? LIMIT 1';
		$q=$con->prepare($sql);
		$q->execute(array($fid,$uid));
		if($q->rowCount())
		{
		return true;
		}
		return false;
	}
	
	public function follow_person($uid,$fid)
	{
		include("contents/includes/config_class.php");
		$sql='INSERT INTO following (uid,fid) VALUES(?,?)';
		$q=$con->prepare($sql);
		$q->execute(array($uid,$fid));
		
		
		
	}
	
	public function unfollow_person($uid,$fid)
	{
		include("contents/includes/config_class.php");
		$sql='DELETE FROM following where uid=? AND fid=?';
		$q=$con->prepare($sql);
		$q->execute(array($uid,$fid));
		
		
		
	}
	
	public function all_i_follow($uid)
	{
		
		include("contents/includes/config_class.php");
		$sql='SELECT * FROM following where uid=?';
		$q=$con->prepare($sql);
		$q->execute(array($uid));
		$all_i_follow=NULL;
		while($f = $q->fetch())
		{
							$all_i_follow[]=array('uid'=>$f['uid'],'fid'=>$f['fid']);

		}
		if(is_null($all_i_follow))
		return NULL;
		return $all_i_follow;
	}
	
	public function all_who_follow_me($uid)
	{
		
		include("contents/includes/config_class.php");
		$sql='SELECT * FROM following where fid=?';
		$q=$con->prepare($sql);
		$q->execute(array($uid));
		$all_who_follow_me=NULL;
		while($f = $q->fetch())
		{
							$all_who_follow_me[]=array('uid'=>$f['uid'],'fid'=>$f['fid']);

		}
		if(is_null($all_who_follow_me))
		return NULL;
		return $all_who_follow_me;
	

		
	}
	
}


$follow=new Following;

?>
