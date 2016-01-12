
<?php
    $i=$_GET['idd'];
    $sql="update WISH set status=0 where WISHID=$i ";
    require_once('query.php');
    $q=new Query();
     if($q->echoaja($sql))
     {
    $sql="SELECT USER.USERID , USER.USER_NAME , USER.PHONE , USER.EMAIL , WISH.WISHID , WISH.TITLE , WISH.DESCRIPTION , WISH.TIME_OF_POST
FROM WISH
INNER JOIN USER
ON WISH.USERID=USER.USERID";
    $values=$q->getallentires($sql);
    $ans=array();
    foreach ($values as $value)
        array_push($ans, $value);
    echo json_encode($ans);
     }
    
?>