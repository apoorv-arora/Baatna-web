<?php

	$status=$_GET['STATUS'];
	require_once('query.php');
	$q=new Query();
	if($status=="DELETED")
		$status=0;
	elseif($status=="ACTIVE")
		$status=1;
	elseif($status=="ACCEPTED")
		$status=2;
	elseif($status=="OFFERED")
		$status=3;
	elseif($status=="RECEIVED")
		$status=4;
	elseif($status=="FULFILLED")
		$status=5;

	$sql="SELECT user.USERID , user.USER_NAME , user.PHONE , user.EMAIL , user.FACEBOOKID , wish.STATUS, wish.WISHID , wish.TITLE , wish.DESCRIPTION , wish.TIME_OF_POST 
FROM wish
INNER JOIN user
ON wish.USERID=user.USERID 
where wish.STATUS=".$status;
	$values=$q->getallentires($sql);
	$ans=array();
	foreach ($values as $value)
		array_push($ans, $value);
	echo json_encode($ans);
?>