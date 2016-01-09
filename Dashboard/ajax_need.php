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

	$sql="SELECT USER.USERID , USER.USER_NAME , USER.PHONE , USER.EMAIL , USER.FACEBOOKID , WISH.STATUS, WISH.WISHID , WISH.TITLE , WISH.DESCRIPTION , WISH.TIME_OF_POST 
FROM WISH
INNER JOIN USER
ON WISH.USERID=USER.USERID 
where WISH.STATUS=".$status;
	$values=$q->getallentires($sql);
	$ans=array();
	foreach ($values as $value)
		array_push($ans, $value);
	echo json_encode($ans);
?>