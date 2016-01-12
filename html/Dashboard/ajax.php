<?php
	$status=$_GET['status'];
	require_once('query.php');
	$q=new Query();
	if($status=="Block")
		$status=1;
	elseif($status=="Unblock")
		$status=0;
	$sql="select * from USER where blockun=$status";
	$values=$q->getallentires($sql);
	$ans=array();
	foreach ($values as $value)
		array_push($ans, $value);
	echo json_encode($ans);
?>