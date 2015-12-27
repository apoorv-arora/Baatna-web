<?php 
	require_once('contents/includes/session_class.php');
	require_once('contents/includes/config_class.php');
	require_once('contents/includes/user_class.php');
	require_once('contents/includes/sanitize_text.php');

    $app_id		= "1616586518597594";
	$app_secret	= "130fab5b2279b34a238163311e9793ea";
	$site_url	= "http://localhost/startink/welcome.php";

	try{
		include("src/facebook.php");
	}catch(Exception $e){
		error_log($e);

	
	}
	
	
	// Create our application instance
	$facebook = new Facebook(array(
		'appId'		=> $app_id,
		'secret'	=> $app_secret,
		));

	// Get User ID
	$user = $facebook->getUser();
	echo "user id is:".$user;
	// We may or may not have this data based 
	// on whether the user is logged in.
	// If we have a $user id here, it means we know 
	// the user is logged into
	// Facebook, but we don’t know if the access token is valid. An access
	// token is invalid if the user logged out of Facebook.
	print_r($user);
		// Get logout URL
		$logoutUrl = $facebook->getLogoutUrl();

		// Get login URL
		$loginUrl = $facebook->getLoginUrl(array(
			'scope'			=> 'publish_actions,email',
			//'scope'			=> 'user_friends,publish_actions,email,user_birthday,permissions',
			'redirect_uri'	=> $site_url,
			));
		
	
?>



<!DOCTYPE HTML>
	<head>
<html>
		<meta charset="utf-8">
		<link href="contents/styles/index.css" rel="stylesheet">
		<link rel="shortcut icon" href="contents/images/favicon.ico">

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
       
		
	</head>

	
	<body>
	
		<div id="fb-root">
		</div>
		<script src="//connect.facebook.net/en_US/all.js#xfbml=1&appId=1616586518597594" type="text/javascript">
		</script>

	<div class="container">

		<div id="slide_login_section">
			      
			
<!--Login section-->              
			<div id="login_section" style="text-align: center;">
    		
        		<a href="<?php echo $loginUrl; ?>" id="facebook" style="float:left;">
        			<div >
            			<img src="contents/images/facebook_sign_up.png" height="40">
            		</div>
        		</a>
        
    		</div>
      
		</div>


	</div>
</div>

</body>
</html>
