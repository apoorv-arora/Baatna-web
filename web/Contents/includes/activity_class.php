<?php 


class Activity
{
	private $aid;
	
	
	public function ink_exists($obj)
	{
		require('config_class.php');
		if(empty($obj->id))
		$sql='SELECT aid from act_priv WHERE activity="'.strip_tags($obj->ink).'"';
		else 
		$sql='SELECT * from act_priv WHERE aid= '.$obj->id.' AND activity="'.$obj->ink.'"';
		
		$q=$con->prepare($sql);
		$q->execute();
		return $q->rowCount();
		
	}
	
	public function ink_exists_for_user($obj)
	{
		require('config_class.php');
		if(empty($obj->id))
		$sql='SELECT aid from act_priv WHERE activity="'.strip_tags($obj->ink).'" AND uid=?';
		else 
		$sql='SELECT * from act_priv WHERE aid= '.$obj->id.' AND activity="'.$obj->ink.'" AND uid=?';
		
		$q=$con->prepare($sql);
		$q->execute(array($_SESSION['uid']));
		return $q->rowCount();
		
	}
	
	public function ink_completed_for_user($obj)
	{
		require('config_class.php');
		if(empty($obj->id))
		$sql='SELECT act_priv.* from act_time,act_priv WHERE act_priv.activity="'.$obj->ink.'" AND act_priv.uid=? AND act_time.completed=1 AND act_priv.aid=act_time.aid';
		else 
		$sql='SELECT act_priv.* from act_time, act_priv WHERE act_priv.activity="'.$obj->ink.'" AND aid= '.$obj->id.' AND  act_priv.uid=? AND completed=1 AND act_priv.aid=act_time.aid';
		
		$q=$con->prepare($sql);
		$q->execute(array($_SESSION['uid']));
		return $q->rowCount();
		
		
	}
	
	
	public function insert_new_ink($obj)
	{
		
		
		require('config_class.php');
		
		
		
		try{
			
			if(self::ink_exists_for_user($obj))
			throw new Exception("already exists");
			$con->beginTransaction();
			$ink= new self;
			
			if(!isset($obj->priv))
			$obj->priv='off';
			
			$sql='INSERT into act_priv (aid,uid,activity,private) values(0,?,?,?)';
			$q=$con->prepare($sql);
			$q->execute(array($_SESSION['uid'],strip_tags($obj->ink),$obj->priv));
			
			$sql='SELECT aid from act_priv where uid=? AND activity=?';
			$q=$con->prepare($sql);
			$q->execute(array($_SESSION['uid'],strip_tags($obj->ink)));
			$aid=$q->fetch(PDO::FETCH_NUM);

			
			$sql='INSERT into act_time (aid,uid,ta,time_allot) values(?,?,?,?)';
			$q=$con->prepare($sql);
			$q->execute(array($aid[0],$_SESSION['uid'],date("Y-m-d H:i:s",time()),date("Y-m-d H:i:s",$obj->time)));
			$ink=$q->fetch(PDO::FETCH_OBJ);
			//print_r($ink);
			
			
			

			$con->commit();
			echo 'done';
		
		}
		
		catch(Exception $e)
		{
			echo $e->getMessage();
			echo 'sorry';
			$con->rollback();
			header("location:home.php");
		}

		
	}
	
	public function get_sketch($user)
	{
		require('config_class.php');
		
		
		try{
			$con->beginTransaction();
			
			$ink= new self;
			//echo $_SESSION['uid'];
			$sql='SELECT act_time.*,act_priv.* from act_time,act_priv WHERE completed=0 AND act_priv.aid=act_time.aid AND act_priv.uid='.$user.' ORDER BY act_time.ta DESC';//$_SESSION['uid'];
			//$sql='SELECT act_time.ta,act_time.tc,act_priv.activity from act_time,act_priv where act_priv.aid=act_time.aid';
			$q=$con->prepare($sql);
			$ink_details=$q->execute();
			
			$send= new self;
			$send->rows=$q->rowCount();
			if($send->rows==0)
			goto skip;
			//$ink=$q->fetch(PDO::FETCH_ASSOC); 
			/*it is used only for single fetching... 
			a fetching removes the object fetched and starts from the other fetched object... can be useful...*/
			//print_r($ink);
			
			while($ink_details = $q->fetch())
			{
				
				$inks[]=array('activity'=>$ink_details['activity'],'ta'=>$ink_details['ta'], 'act'=>$ink_details['aid'],'user'=>$ink_details['uid'],'time_alloted'=>$ink_details['time_allot'],'private'=>$ink_details['private']);
				
			}
			
			
			$send->inks=$inks;
			skip:
			
			return $send;
			

			}
		
		catch(Exception $e)
		{
			echo $e->getMessage();
			echo 'sorry';
			$con->rollback();
		}

		
		
		
	}
	
	
	public function get_completed_inks($user)
	{
		require('config_class.php');
		
		
		try{
			$con->beginTransaction();
			
			$ink= new self;
			//echo $_SESSION['uid'];
			$sql='SELECT act_time.*,act_priv.* from act_time,act_priv WHERE completed=1 AND act_priv.aid=act_time.aid AND act_priv.uid='.$user.' ORDER BY act_time.tc DESC';//$_SESSION['uid'];
			//$sql='SELECT act_time.ta,act_time.tc,act_priv.activity from act_time,act_priv where act_priv.aid=act_time.aid';
			$q=$con->prepare($sql);
			$ink_details=$q->execute();
			
			$send= new self;
			$send->rows=$q->rowCount();
			if($send->rows==0)
			goto skip;
			//$ink=$q->fetch(PDO::FETCH_ASSOC); 
			/*it is used only for single fetching... 
			a fetching removes the object fetched and starts from the other fetched object... can be useful...*/
			//print_r($ink);
			
			while($ink_details = $q->fetch())
			{
				
				$inks[]=array('activity'=>$ink_details['activity'],'ta'=>$ink_details['ta'], 'act'=>$ink_details['aid'],'user'=>$ink_details['uid'],'time_alloted'=>$ink_details['time_allot'],'private'=>$ink_details['private'],'tc'=>$ink_details['tc']);
				
			}
			
			
			$send->inks=$inks;
			skip:
			
			return $send;
			

			}
		
		catch(Exception $e)
		{
			echo $e->getMessage();
			echo 'sorry';
			$con->rollback();
		}

		
		
		
	}
	
	
	public function update_sketch($ink_to_be_updated,$ink_name)
	{
		require('config_class.php');
		try{
			
			$con->beginTransaction();
			
			$ink= new self;
			
			$ink->id=$ink_to_be_updated;
			$ink->ink=$ink_name;
			
			if(Activity::ink_exists_for_user($ink)!=1)
			exit();
			$sql='UPDATE act_time SET tc=?, completed=1 WHERE aid=? AND uid='.$_SESSION['uid'];
			$q=$con->prepare($sql);
			$q->execute(array(date('Y-m-d H:i:s',time()),$ink_to_be_updated));
			$ink=$q->fetch(PDO::FETCH_ASSOC);
			print_r($ink);
						
			$con->commit();
			
			echo 'done';
				
			}
		
		catch(Exception $e)
		{
			echo $e->getMessage();
			echo 'sorry';
			$con->rollback();
		}

		
		
		
		
	}
	
	public function del_sketch($to_del)
	{
		require('config_class.php');
		
		
		
		try{
			
			$con->beginTransaction();
			
			$ink= new self;
			
			$sql='DELETE from act_time WHERE aid=? and uid='.$_SESSION['uid'];
			$q=$con->prepare($sql);
			$q->execute(array($to_del));
			$ink=$q->fetch(PDO::FETCH_ASSOC);
			print_r($ink);
			
			
			$sql='DELETE from act_priv WHERE aid=? and uid='.$_SESSION['uid'];
			$q=$con->prepare($sql);
			$ink=$q->execute(array($to_del));
			print_r($ink);
			
			
			$con->commit();
			echo 'done';
				
			}
		
		catch(Exception $e)
		{
			echo $e->getMessage();
			echo 'sorry';
			$con->rollback();
		}

		
		
				
	}
	
	public function get_completed_inks_private($user)
	{
		require('config_class.php');
		
		
		try{
			$con->beginTransaction();
			
			$ink= new self;
			//echo $_SESSION['uid'];
			$sql='SELECT act_time.*,act_priv.* from act_time,act_priv WHERE completed=1 AND act_priv.aid=act_time.aid AND act_priv.private="off" AND act_priv.uid='.$user.' ORDER BY act_time.tc DESC';//$_SESSION['uid'];
			//$sql='SELECT act_time.ta,act_time.tc,act_priv.activity from act_time,act_priv where act_priv.aid=act_time.aid';
			$q=$con->prepare($sql);
			$ink_details=$q->execute();
			
			$send= new self;
			$send->rows=$q->rowCount();
			if($send->rows==0)
			goto skip;
			//$ink=$q->fetch(PDO::FETCH_ASSOC); 
			/*it is used only for single fetching... 
			a fetching removes the object fetched and starts from the other fetched object... can be useful...*/
			//print_r($ink);
			
			while($ink_details = $q->fetch())
			{
				
				$inks[]=array('activity'=>$ink_details['activity'],'ta'=>$ink_details['ta'], 'act'=>$ink_details['aid'],'user'=>$ink_details['uid'],'time_alloted'=>$ink_details['time_allot'],'private'=>$ink_details['private'],'tc'=>$ink_details['tc']);
				
			}
			
			
			$send->inks=$inks;
			skip:
			
			return $send;
			

			}
		
		catch(Exception $e)
		{
			echo $e->getMessage();
			echo 'sorry';
			$con->rollback();
		}

		
		
		
	}
	
	public function get_sketch_private($user)
	{
		require('config_class.php');
		
		
		try{
			$con->beginTransaction();
			
			$ink= new self;
			//echo $_SESSION['uid'];
			$sql='SELECT act_time.*,act_priv.* from act_time,act_priv WHERE completed=0 AND act_priv.aid=act_time.aid AND act_priv.private="off" AND act_priv.uid='.$user.' ORDER BY act_time.ta DESC';//$_SESSION['uid'];
			//$sql='SELECT act_time.ta,act_time.tc,act_priv.activity from act_time,act_priv where act_priv.aid=act_time.aid';
			$q=$con->prepare($sql);
			$ink_details=$q->execute();
			
			$send= new self;
			$send->rows=$q->rowCount();
			if($send->rows==0)
			goto skip;
			//$ink=$q->fetch(PDO::FETCH_ASSOC); 
			/*it is used only for single fetching... 
			a fetching removes the object fetched and starts from the other fetched object... can be useful...*/
			//print_r($ink);
			
			while($ink_details = $q->fetch())
			{
				
				$inks[]=array('activity'=>$ink_details['activity'],'ta'=>$ink_details['ta'], 'act'=>$ink_details['aid'],'user'=>$ink_details['uid'],'time_alloted'=>$ink_details['time_allot'],'private'=>$ink_details['private']);
				
			}
			
			
			$send->inks=$inks;
			skip:
			
			return $send;
			

			}
		
		catch(Exception $e)
		{
			echo $e->getMessage();
			echo 'sorry';
			$con->rollback();
		}

		
		
		
	}
	
	
	
	
	
	
}

$activity= new Activity;

?>