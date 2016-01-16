<?php
 //echo $access_token; 
error_reporting(E_ALL);
ini_set("display_errors", "1");
require_once('Http2.php');
$r = new HttpRequest("post", "http://52.76.14.6:8080/BaatnaServer/rest/messaging/get", array(
          
          "access_token"=> "68474014519902762",
          //"access_token" => $access_token,
          "client_id" => "bt_android_client",
          "app_type" => "bt_android"
    ));
  if ($r->hasError()) {
  	echo $r->getError();
      echo "sorry, an error occured";
  } 
  else 
  	  {
      // parse json
      
      $js = json_decode($r->getResponse());
      $response=$js->{"response"};
      $msg=$response->{"messages"};
      
 foreach ( $msg as $m ) {
        $obj=$m->{"message"};
       
        $wish=$obj->wish;
        $user=$obj->user;
        
        $u2=$user->user;
        $name=$u2->user_name;
        ?>
        <p>You can talk to </p>
        <?php  echo $name; ?><br>
        
        <?php     
     }
  }
      
?>