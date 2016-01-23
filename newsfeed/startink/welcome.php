<?php
session_start();
//echo "entered welcome.php";
?>
<br>
<?php

require_once('contents/includes/config_class.php');
//require_once('contents/includes/session_class.php');
include("fbconnect.php");
//$token=$_GET['token'];
//echo "token is".$access_token;
//echo "after fbconnect";

//check if the user has all sessions present
/*
$session->check_login();
	if($session->is_logged_in())
	{
		header("location:http://www.baatna.com");
		//header("location:home.php");
		
	}
*/
//uid was not set, it means the user signedup just now and has no pwd


?>

<!Doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Welcome</title>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>
welcome to BAATNA

<input type="submit" value="logout" qual="<?php echo $access_token; ?>" class="logout">
<?php
//include("wishweb.php");
//include("wishget.php");
include("newsfeed.php");
//include("messget.php");
?>
</body>
</html>
<script>
  jQuery(function($){
          $('.logout').on('click',function(){
          		var token=$(this).attr('qual');
              console.log(token);
              $.ajax({
              url: "check.php", 
              type:'get',
              dataType:'json',
              data:
              {
                tok:token
              },
               success:function(user) 
                {
                  window.location = "http://localhost/startink/index2.php";
                	console.log("ajax passed");

               },
             error:function(){
                
                console.log("ajax failed");
              }
          });
        });
        });
</script>