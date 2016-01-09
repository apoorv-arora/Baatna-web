<?php
    $status=$_GET['status'];
    $i=$_GET['idd'];
    $reason=$_GET['reason'];
    $time=$_GET['time'];
   // $sql="update user set blockun=$status where USERID=$i";

    if($reason!="empty")
    {
        //$sql="update user set blockun=$status ,reason='$reason',blocktime='$time' where USERID=$i";
        $sql="update user set blockun=$status where USERID=$i";
    }
    else
    {
        $sql="update user set blockun=$status where USERID=$i";
    }
    require_once('query.php');
    $q=new Query();
     if($q->echoaja($sql))
     {
       /* array_push($value,$value2['reason']);
      array_push($value,$value2['time']);
       array_push($ans,$value);*/
     
                //echo( json_encode($ans));
       echo( json_encode(true));
    }
?>