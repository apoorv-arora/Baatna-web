<?php
$start=$_GET['start'];
$token=$_GET['tok'];

require_once('query.php');
$q = new Query();
$sql="select distinct USERID from session where ACCESS_TOKEN=$token";
$val=$q->getallentires($sql);
//var_dump($val);
//$v=$val['USERID'];
foreach ($val as $value) {
  # code...
$v=$value['USERID'];
//echo $v;
}

error_reporting(E_ALL);
ini_set("display_errors", "1");
require_once('Http2.php');
$r = new HttpRequest("post", "http://52.76.14.6:8080/BaatnaServer/rest/wish/get?start=$start&count=15&type=1&another_user=6", array(
          "access_token" => $token
    ));
  if ($r->getError()) {
      echo "sorry, an error occured";
  } 
  else {

      // parse json
    //var_dump($r->getResponse());
      $js = json_decode($r->getResponse());
      $obj=$js->{"response"};
      $obj2=$obj->wishes;
      echo json_encode($obj2);
     }
?>
