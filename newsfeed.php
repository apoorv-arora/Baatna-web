<!DOCTYPE html>
<html>
<head>
  <title></title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>

</body>
</html>

<?php
$m=new Memcached();
$m->addServer("localhost",11211);
$result=$m->get("feed");
$obj2;
if($m->getResultCode()!=Memcached::RES_NOTFOUND)
{
$js=json_decode($result);
 $obj=$js->{"response"};
    $obj2=$obj->{"newsFeed"};
//var_dump($obj);
//print "from cache";
 foreach ( $obj2 as $user ) {
        if($user->type == 1 )
        {
          $obj3=$user->userFirst;
        //in userfirst
          $use=$obj3->user;
        //in user
          $name=$use->user_name;
         // $pic=$use->profile_pic;
          $fbid=$use->fbId;
          $profile_pic =  "http://graph.facebook.com/".$fbid."/picture";
          $timeofpost=$user->timestamp;
      //$m->set("feed",$resultObj,50);
          ?>
          <div class="emp">
          <p><?php echo $name; ?> joins your neighbourhood<br>
          <?php echo $timeofpost; ?>
          <?php echo "<img src=\"" . $profile_pic . "\" />";
            
          ?><br></p>
          </div>
          <?php
        }
        else if($user->type == 2)
        {
            $obj3=$user->userFirst;
            //in userfirst
            $use=$obj3->user;
            //in user
            $name=$use->user_name;
            $fbid=$use->fbId;
          $profile_pic =  "http://graph.facebook.com/".$fbid."/picture";
            //in wish
            $wis=$user->wish;
            $wis2=$wis->wish;
            $titl=$wis2->title;
            $desc=$wis2->description;
            $required=$wis2->required_for;
            $time=$wis2->time_post;
            $id=$wis2->wish_id;
            $timeofpost=$user->timestamp;
            ?>
            <div class="emp">
            <p id="<?php echo $id; ?>" ><?php echo $name; ?> wants to borrow a <?php echo $titl; ?> for <?php echo $required; ?> days
            <br> Posted on <?php echo $timeofpost; echo "<img src=\"" . $profile_pic . "\" />"; ?> 
            <br><?php echo $desc; ?><br>
            <input type="button" value="accept" class="accept" acctok="<?php echo $access_token; ?>">
            <input type="button" value="decline" class="decline" acctok="<?php echo $access_token; ?>">
            </p>
            </div>
            <?php
        }
        elseif ($user->type == 3) 
        {
            $obj3=$user->userFirst;
            $use=$obj3->user;
            $name=$use->user_name;
            $fbid=$use->fbId;
          $profile_pic =  "http://graph.facebook.com/".$fbid."/picture";

            $timeofpost=$user->timestamp;
            //in wish
            $wis=$user->wish;
            $wis2=$wis->wish;
            $titl=$wis2->title;
            $desc=$wis2->description;
            $required=$wis2->required_for;
            $time=$wis2->time_post;  

            $obj33=$user->users;
            foreach ($obj33 as $value) 
            {
            $uses=$value->user; 
            $name2=$uses->user_name;
            }
            ?>
        <div class="emp">
        <p><?php echo $name2; ?> offered <?php echo $titl; ?> to <?php echo $name; ?>
        <br><?php echo $timeofpost; echo "<img src=\"" . $profile_pic . "\" />"; ?><br>
        <?php echo $desc; ?>
        </p> 
        </div>
  <?php
  }
  }
}
else{
error_reporting(E_ALL);
ini_set("display_errors", "1");
require_once('Http2.php');
$r = new HttpRequest("post", "http://52.76.14.6:8080/BaatnaServer/rest/newsfeed/get?start=0&count=15", array(
       // "access_token" => '8745314507707378',
	"access_token" => '72839314546014570';
//           "access_token" => $access_token,
        "client_id" => 'bt_android_client',
        "app_type" =>'bt_android'
    ));
  if ($r->getError()) {
      echo "sorry, an error occured";
    exit();
  } 
  else{
// parse json
  $resultObj=$r->getResponse();
  $js = json_decode($r->getResponse());
 $obj=$js->{"response"};
      $obj2=$obj->{"newsFeed"};

  $m->set("feed",$resultObj,50);
  }
 }
  
      
    
      // echo json_encode($obj2);
      //in newsfeed
      foreach ( $obj2 as $user ) {
        if($user->type == 1 )
        {
          $obj3=$user->userFirst;
        //in userfirst
          $use=$obj3->user;
        //in user
          $name=$use->user_name;
         // $pic=$use->profile_pic;
          $fbid=$use->fbId;
          $profile_pic =  "http://graph.facebook.com/".$fbid."/picture";
          $timeofpost=$user->timestamp;
      //$m->set("feed",$resultObj,50);
          ?>
          <div class="emp">
          <p><?php echo $name; ?> joins your neighbourhood<br>
          <?php echo $timeofpost; ?>
          <?php echo "<img src=\"" . $profile_pic . "\" />";
            
          ?><br></p>
          </div>
          <?php
        }
        else if($user->type == 2)
        {
            $obj3=$user->userFirst;
            //in userfirst
            $use=$obj3->user;
            //in user
            $name=$use->user_name;
            $fbid=$use->fbId;
          $profile_pic =  "http://graph.facebook.com/".$fbid."/picture";
            //in wish
            $wis=$user->wish;
            $wis2=$wis->wish;
            $titl=$wis2->title;
            $desc=$wis2->description;
            $required=$wis2->required_for;
            $time=$wis2->time_post;
            $id=$wis2->wish_id;
            $timeofpost=$user->timestamp;
            ?>
            <div class="emp">
            <p id="<?php echo $id; ?>" ><?php echo $name; ?> wants to borrow a <?php echo $titl; ?> for <?php echo $required; ?> days
            <br> Posted on <?php echo $timeofpost; echo "<img src=\"" . $profile_pic . "\" />"; ?> 
            <br><?php echo $desc; ?><br>
            <input type="button" value="accept" class="accept" acctok="<?php echo $access_token; ?>">
            <input type="button" value="decline" class="decline" acctok="<?php echo $access_token; ?>">
            </p>
            </div>
            <?php
        }
        elseif ($user->type == 3) 
        {
            $obj3=$user->userFirst;
            $use=$obj3->user;
            $name=$use->user_name;
            $fbid=$use->fbId;
          $profile_pic =  "http://graph.facebook.com/".$fbid."/picture";

            $timeofpost=$user->timestamp;
            //in wish
            $wis=$user->wish;
            $wis2=$wis->wish;
            $titl=$wis2->title;
            $desc=$wis2->description;
            $required=$wis2->required_for;
            $time=$wis2->time_post;  

            $obj33=$user->users;
            foreach ($obj33 as $value) 
            {
            $uses=$value->user; 
            $name2=$uses->user_name;
            }
            ?>
        <div class="emp">
        <p><?php echo $name2; ?> offered <?php echo $titl; ?> to <?php echo $name; ?>
        <br><?php echo $timeofpost; echo "<img src=\"" . $profile_pic . "\" />"; ?><br>
        <?php echo $desc; ?>
        </p> 
        </div>
        <?php    
      }
    }
?>
<script type="text/javascript">
  jQuery(function($){    
          $('.accept').on('click',function(){
            id=$(this).parent().attr('id');
            var token=$(this).attr('acctok');
            console.log(id);
              $.ajax({
              url: "httprequestupdate.php", 
              type:'get',
              dataType:'json',
              data:{
                wishid:id,
                tok:token
              },
               success:function() 
                {
                  
                  console.log("ajax passed");
               },
             error:function(){
                
                console.log("ajax failed");
              }
          });
        });

           $('.decline').on('click',function(){
            id=$(this).parent().attr('id');
            obj2=$(this).attr('qual');
            var token=$(this).attr('acctok');
            console.log(id);
               $.ajax({
              url: "check.php", 
              type:'get',
              dataType:'json',
              data:{
                obj2:obj2,
                tok:token
              },
               success:function(user) 
                {
                  //console.log(user);
                  console.log("ajax passed");
               },
             error:function(){
                
                console.log("ajax failed");
              }
          });            
        });


      });
</script>
