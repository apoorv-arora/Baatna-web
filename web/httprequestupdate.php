<?php
$wishid=$_GET['wishid'];
error_reporting(E_ALL);
ini_set("display_errors", "1");
require_once('Http2.php');
$r = new HttpRequest("post", "http://52.76.14.6:8080/BaatnaServer/rest/wish/update", array(
        "access_token" => '50333614514760655',
        "client_id" => 'bt_android_client',
        "app_type" => 'bt_android',
        "wishId" => $wishid,
        "action" => '1'
    ));
  if ($r->getError()) {
   // var_dump($r->getError());
     // echo "sorry, an error occured";
  } 
  else {
      // parse json
      $js = json_decode($r->getStatus());
      //var_dump($js);
      echo json_encode(true);
    
  }
?>
