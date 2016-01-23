<?php


class Comments
{
	public function show_comm($aid=0)
	{
		require('config_class.php');
		$sql='SELECT * FROM act_comment WHERE aid=?';
		$q=$con->prepare($sql);
		$q->execute(array($aid));
		
//echo $count=$q->rowCount();
		while($com=$q->fetch())
		{
		//print_r($com);
		$sql="SELECT fn,ln FROM details WHERE uid=?";
		$q1=$con->prepare($sql);
		$r2=$q1->execute(array($com['uid']));
		$r2=$q1->fetch(PDO::FETCH_ASSOC);
		$all_comments[]= array('id'=>$com['comment_id'],'uid'=>$com['uid'],'name'=>($r2['fn']." ".$r2['ln']),'comment'=>$com['comment'],'ta'=>$com['ta'],'token'=>$com['hash']);
		
		//print_r($r2);
		}
		
		if(empty($all_comments))
		$all_comments=NULL;
		
		return $all_comments;
		//echo "<br>";
//		echo '<a href="user.php?user='.$com['uid'].'">'.$r2['fn']." ".$r2['mn']." ".$r2['ln'].'</a>'.":";
//		echo $com['comment']."<br>";
//		echo 'Added at: '.date("H:i \H\R\S,jS F,Y",strtotime($com['ta']));
//		echo "<br>";
//	    }
		
		
	}
	
	public function del_comm($comment_id=0)
	{
	
		  require('contents/includes/config_class.php');
		  $con->beginTransaction();
		  
		  $sql="DELETE FROM act_comment WHERE comment_id=?";
		  $q=$con->prepare($sql);
		  $q->execute(array($comment_id));
		  $r=$q->fetch(PDO::FETCH_NUM);
		  //echo 'here';
		  $con->commit();
	
	}
	
	public function add_comm()
	{
		
		require('contents/includes/config_class.php');
		$con->beginTransaction();
		$sql="INSERT INTO act_comment (aid,uid,comment,hash) VALUES(?,?,?,?)";
		$q=$con->prepare($sql);
		$q->execute(array($_POST['activity'],$_SESSION['uid'],Sanitext::san($_POST['comment']),$_POST['token']));
		$r=$q->fetch(PDO::FETCH_NUM);
		//echo 'here';
		
		$con->commit();
		return 1;

	}
	
	public function count_comm($aid)
	{
		
		require('contents/includes/config_class.php');
		$con->beginTransaction();
		$sql="SELECT * FROM act_comment WHERE aid=?";
		$q=$con->prepare($sql);
		$q->execute(array($aid));
		$rows=$q->rowCount();
		$con->commit();
		return $rows;

	}
	
	public function cid_comm($comment)
	{

		require('contents/includes/config_class.php');
		$con->beginTransaction();
		$sql="SELECT comment_id FROM act_comment WHERE comment=? AND uid=? ORDER BY ta DESC LIMIT 1";
		$q=$con->prepare($sql);
		$q->execute(array($comment,$_SESSION['uid']));
		$r=$q->fetch(PDO::FETCH_NUM);
		$con->commit();
		return $r[0];
	}
	
	
}

$comments= new Comments;
?>