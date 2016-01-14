<?php

$token=$_GET['tok'];
error_reporting(E_ALL);
ini_set("display_errors", "1");
require_once('Http2.php');
$r = new HttpRequest("post", "http://52.76.14.6:8080/BaatnaServer/rest/auth/logout", array(
        "access_token" => $token
    ));
  if ($r->getError()) {
      echo "sorry, an error occured";
  } 
  else {
  	
  	echo $r->getResponse();
     
	}
?>


?>