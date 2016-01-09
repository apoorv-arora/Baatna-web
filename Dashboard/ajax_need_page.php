<?php
    
    $p=$_GET['v'];
    $gpa=$_GET['gp'];
    $a=$_GET['at'];
        $sql="update WISH set $gpa=$p where USERID=$a";
    require_once('query.php');
    $q=new Query();
     if($q->echoaja($sql))
                echo( json_encode(true));
    
?>