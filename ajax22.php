<?php
$t=$_GET['title'];
$d=$_GET['description'];
$tt=$_GET['required_for'];

//echo "title".$t." description".$d."  require_for".$tt;
error_reporting(E_ALL);
ini_set("display_errors", "1");
require_once('Http2.php');
$r = new HttpRequest("post", "http://52.76.14.6:8080/BaatnaServer/rest/wish/add", array(
        "client_id" => 'bt_android_client',
        "app_type" => 'bt_android',
        "title" =>  $t,
        "description" => $d,
        "required_for" => $tt,
        //"title" =>  't',
        //"description" => 'd',
        //"required_for" => '89',
        "access_token" => '60950314504451250'
    ));
  if ($r->hasError()) {
    //echo $r->getError();
      //echo "sorry, an error occured";
      echo(json_encode(true));
  } 
  else {
  	// parse json and show tweets
      $js = json_decode($r->getResponse());
      	$res=$js->{"response"};
      if($res=="success")
      {

        echo(json_encode(true));
      }
      
  	  }
?>