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

	$sql="SELECT USER.USERID , USER.USER_NAME ,USER.FACEBOOKDATA, USER.PhoneNumber ,USER.FACEBOOKDATA, USER.EMAIL , USER.FACEBOOKID , WISH.STATUS,WISH.Required_For, WISH.WISHID , WISH.TITLE , WISH.DESCRIPTION , WISH.TIME_OF_POST 
FROM WISH
INNER JOIN USER
ON WISH.USERID=USER.USERID 
where WISH.STATUS=".$status;
	$values=$q->getallentires($sql);
	$ans=array();
	foreach ($values as $value)
	{
$temp=array();
		
	    $obj=json_decode($value['FACEBOOKDATA']);
        $data= $obj->name;

        // Get timestamp from somewhere and assume it's $timestamp
    $timestamp = (int) ($value['TIME_OF_POST'] / 1000);
    // MySQL takes year-month-day hour:minute:second format
    $mysql_datetime = date('Y-m-d H:i:s', $timestamp);
	//echo $data;
	//echo $mysql_datetime;
	
	array_push($temp,$value['WISHID']);
	array_push($temp,$value['TITLE']);
	array_push($temp,$value['DESCRIPTION']);
	array_push($temp,$value['Required_For']);
	array_push($temp, $data);
	array_push($temp, $mysql_datetime);
	array_push($temp,$value['PhoneNumber']);
	array_push($temp,$value['EMAIL']);
	array_push($ans,$temp);
}
	echo json_encode($ans);
?>
