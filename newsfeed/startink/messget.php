<?php
 //echo $access_token; 
//$access_token="68474014519902762";
error_reporting(E_ALL);
ini_set("display_errors", "1");
require_once('Http2.php');
$r = new HttpRequest("post", "http://52.76.14.6:8080/BaatnaServer/rest/messaging/get", array(
          
          "access_token"=> $access_token,
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
        $nam=array();
      
 	foreach ( $msg as $m ) {
        $obj=$m->{"message"};
       
        $wish=$obj->wish;
        $user=$obj->user;
        
        $u2=$user->user;
        $name=$u2->user_name;
        $id=$u2->user_id;
        array_push($nam,array('name'=>$name,'id'=>$id));
        // echo $name; 
     }
        include 'messview.php';
  }
      
?>