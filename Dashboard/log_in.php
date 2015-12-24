<?php
require_once('query.php');
$q = new Query();
if($_POST['name']==null || $_POST['password']==null)
{
	header('Location:login.html');
}
else
{
	$email=explode('@',$_POST['name']);
	$company=explode('.',$email[1]);
	if($company[0]=='baatna')
	{
		$sql="select PASSW from user where EMAIL='".$_POST['name']."'";
		$val=$q->getallentires($sql);
		if(empty($val))
			header('Location:login.html');
		foreach($val as $value)
		{
			if($value['PASSW']==$_POST['password'])
			{
				session_start();
				$_session['baatna']="sessionset";
				header('Location:nav.html');
			}	
			else
			{
				header('Location:login.html');
			}
		}
	}
	else
		header('Location:login.html');
}

?>