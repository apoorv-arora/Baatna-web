<?php

class Vote
{
public function cnt($aid)
	{
		include("config_class.php");
		$sql="SELECT COUNT(*) FROM act_like WHERE aid=?";
		$q=$con->prepare($sql);
		$q->execute(array($aid));
		$r=$q->fetch(PDO::FETCH_NUM);
		if(empty($r[0]))
		return $r[0]=0;
		else
		return $r[0];
		
	}
	
	
public function upvote($aid)
{
		include("config_class.php");
		$sql="INSERT INTO act_like (aid,uid) VALUES(?,?)";
		$q=$con->prepare($sql);
		$q->execute(array($aid,$_SESSION['uid']));
		$r=$q->fetch(PDO::FETCH_NUM);
		
		
}


public function downvote($aid)
{
		include("config_class.php");
		$sql="DELETE FROM act_like WHERE aid=? and uid=?";
		$q=$con->prepare($sql);
		$q->execute(array($aid,$_SESSION['uid']));
		$r=$q->fetch(PDO::FETCH_NUM);
}

public function check($aid)
{
		include("config_class.php");
		$sql="SELECT * FROM act_like WHERE aid=? and uid=?";
		$q=$con->prepare($sql);
		$q->execute(array($aid,$_SESSION['uid']));
		$r=$q->fetch(PDO::FETCH_BOTH);
		if(empty($r[0]))
		return 0;
		else
		return 1;
		
	
}

public function get_voters_list($aid)
{
		include("config_class.php");
		$sql="SELECT uid FROM act_like WHERE aid=?";
		$q=$con->prepare($sql);
		$q->execute(array($aid));
		$r=$q->rowCount();
		if(empty($r)&&is_null($r))
		return NULL;
		
		else
		{
			
			while($a = $q->fetch())
			{
				
				$voters[]=$a['uid'];
			}
			
			return $voters;
		}
		
	
}

}

$vote = new Vote;
?>