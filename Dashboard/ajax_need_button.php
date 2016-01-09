<?php
require_once('query.php');
$q2 = new Query();
$id=$_GET['WISHID'];
$sql2= "SELECT * from userwish where WISHID=$id";
$val2=$q2->getallentires($sql2);
foreach ($val2 as $value2) 
{
    $sql3="SELECT USER.USERID , USER.FACEBOOKID , USER.PHONE , USER.EMAIL from user
      where USER.USERID=".$value2['USER_TWO_ID'];
  $val3=$q2->getallentires($sql3);
  $ans=array();
        foreach ($val3 as $value) 
        {
     array_push($value,$value2['WISH_STATUS']);
      array_push($value,$value2['WISHID']);
      array_push($ans,$value);
  }
}
echo json_encode($ans);
?>