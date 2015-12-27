<?php
error_reporting(E_ALL);
ini_set("display_errors", "1");
require_once('Http2.php');
$r = new HttpRequest("post", "http://52.76.14.6:8080/BaatnaServer/rest/wish/get?start=0&count=5&type=2&another_user=11", array(
        "access_token" => '60950314504451250'
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
      /*
        foreach ( $obj2 as $user ) {
        $obj3=$user->wish;
        $titl=$obj3->title;
        $desc=$obj3->description;
        $timeofpost=$obj3->time_post;
        $requiredfor=$obj3->required_for;
        ?>
        <p>You offered</p>
        <?php echo $titl; ?><br>
        <?php echo $desc; ?><br>
        <?php echo $requiredfor;?><br>
        <?php echo $timeofpost;?><br>

<?php
  }*/
}
?>
