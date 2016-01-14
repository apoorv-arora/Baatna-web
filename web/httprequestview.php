<?php
$start=$_GET['start'];
$token=$_GET['tok'];

require_once('query.php');
$q = new Query();
$sql="select distinct USERID from SESSION where ACCESS_TOKEN=$token";
$val=$q->getallentires($sql);

foreach ($val as $value) {
  # code...
$v=$value['USERID'];
echo $v;
}

//$v=$val['USERID'];
error_reporting(E_ALL);
ini_set("display_errors", "1");
require_once('Http2.php');
$r = new HttpRequest("post", "http://52.76.14.6:8080/BaatnaServer/rest/wish/get?start=$start&count=15&type=2&another_user=$v", array(
       // "access_token" => '50333614514760655'
          "access_token" => $token
    ));
  if ($r->getError()) {
      echo "sorry, an error occured";
  } 
  else {

      // parse json
      $js = json_decode($r->getResponse());
      $obj=$js->{"response"};
      $obj2=$obj->wishes;
      echo json_encode($obj2);
     
}
?>
