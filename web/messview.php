<!DOCTYPE html>
<html>
<head>
  <title>messageviewing</title>
</head>
<body>
<table border="2px" align="center">
<thead>
  <th>messages</th>
</thead>

<?php
//echo $access_token;
error_reporting(E_ALL);
ini_set("display_errors", "1");
require_once('Http2.php');
$r = new HttpRequest("post", "http://52.76.14.6:8080/BaatnaServer/rest/messaging/view_messages", array(
          "access_token" => "68474014519902762",
          //"access_token" => $access_token,
          "to_userId" => "13"
    ));
  if ($r->hasError()) {
  	echo $r->getError();
      echo "sorry, an error occured";
  } 
  else 
  	  {
      // parse json
      // var_dump($r->getResponse());
      $js = json_decode($r->getResponse());
      //var_dump($js);
      $msg1=$js->{"messages1"};
      $msg2=$js->{"messages2"};
      $ans=array();
      //var_dump($msg1);
      //var_dump($msg2);
      foreach ( $msg1 as $m1 ) {
        $msg=$m1->message;
        $id=$m1->messageId;
        $time=$m1->timeOfMessage;
        $from=$m1->fromUserId;
        $to=$m1->toUserId;
        array_push($ans, array('id'=>$id,'msg'=>$msg) );

        ?>
        
        
        <?php     
     }
     foreach ( $msg2 as $m2 ) {
        $msg2=$m2->message;
        $id=$m2->messageId;
        $time=$m2->timeOfMessage;
        $from=$m2->fromUserId;
        $to=$m2->toUserId;
        array_push($ans, array('id'=>$id,'msg'=>$msg2) );
        ?>
        <?php     
     }

      usort($ans,"cmp");
      foreach ($ans as $item) 
      {
        echo $item['id']."  ".$item['msg'];
      }

  }
    function cmp($a, $b)
    {
    if ($a["id"] == $b["id"]) 
        return 0;
    
    return ($a["id"] < $b["id"]) ? -1 : 1;
}

?>

</table>
</body>
</html>