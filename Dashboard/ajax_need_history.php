
<?php
    $i=$_GET['idd'];
    $sql="delete from wish where WISHID=$i ";
    require_once('query.php');
    $q=new Query();
     if($q->echoaja($sql))
     {
    $sql="SELECT user.USERID , user.USER_NAME , user.PHONE , user.EMAIL , wish.WISHID , wish.TITLE , wish.DESCRIPTION , wish.TIME_OF_POST
FROM wish
INNER JOIN user
ON wish.USERID=user.USERID";
    $values=$q->getallentires($sql);
    $ans=array();
    foreach ($values as $value)
        array_push($ans, $value);
    echo json_encode($ans);
     }
    
?>