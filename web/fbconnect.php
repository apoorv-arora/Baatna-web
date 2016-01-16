<?php
//session_start();
	//Application Configurations
	echo "entered fbconnect.php\n";
	?><br><?php
	$app_id		= "1616586518597594";
	$app_secret	= "130fab5b2279b34a238163311e9793ea";
	$site_url	= "http://baatna.com/";

	try{
		include_once "src/facebook.php";
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
	//Get accesstoken
	try{
	 $fbToken = $facebook->getAccessToken($user);
	} catch(Exception $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
	}  catch(Exception $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
	}

	if (isset($fbToken)) {

    // Logged in
    // Store the $accessToken in a PHP session
    // You can also set the user as "logged in" at this point
	} elseif ($facebook->getError()) {
    // There was an error (user probably rejected the request)
    echo '<p>Error: ' . $facebook->getError();
    echo '<p>Code: ' . $facebook->getErrorCode();
    echo '<p>Reason: ' . $facebook->getErrorReason();
    echo '<p>Description: ' . $facebook->getErrorDescription();
    exit;
	}
	echo "facebook token is:-".$fbToken;
	?>
	<br><?php
	

	

	// We may or may not have this data based 
	// on whether the user is logged in.
	// If we have a $user id here, it means we know 
	// the user is logged into
	// Facebook, but we don’t know if the access token is valid. An access
	// token is invalid if the user logged out of Facebook.
	//print_r($user);
		// Get logout URL
//		$logoutUrl = $facebook->getLogoutUrl();
		// Get login URL
		$loginUrl = $facebook->getLoginUrl(array(
			'scope'			=> 'publish_actions, email, user_birthday',
			'redirect_uri'	=> $site_url,
			));

	//if got any info

	if($user)
	{
		echo $user." true \n";
		try{
			echo "entered";
		// Proceed knowing you have a logged in user who's authenticated.
		$user_profile = $facebook->api('/me?fields=name,email,id,gender,birthday,permissions'); //link
		//Connecting to the database. You would need to make the required changes in the common.php file
		//In the common.php file you would need to add your Hostname, username, password and database name!
		
		print_r($user_profile);
		
		//important data for reference
		include('contents/includes/config_class.php');
		?><br><?php
		echo "exited configclass.php";
		//$con->beginTransaction();
        //$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

		$profile_pic =  "http://graph.facebook.com/".$user_profile['id']."/picture";
 		//echo "<img src=\"" . $profile_pic . "\" />";
		$user_profile['name'];
		//date end
		error_reporting(E_ALL);
		ini_set("display_errors", "1");
		require_once('Http2.php');
		$r = new HttpRequest("post", "http://52.76.14.6:8080/BaatnaServer/rest/auth/login?isFacebookLogin=true", array(
        "client_id" => 'bt_android_client',
        "app_type" => 'bt_android',
        "profile_pic" =>  $profile_pic,
        "user_name" => $user_profile['name'],
        "email" => $user_profile['email'],
        //"email" => 'ridhi-1995@hotmail.com',
        "password" => '..',
        "address" => '..',
        "phone" => '0',
		"registration_id" => '0',
		"latitude" => '0',
		"longitude" => '0',
		"fbid" => $user_profile['id'],
		"fbdata" => $user_profile['name'],
		"fb_token" => $fbToken,
		"fb_permission" => $user_profile['permissions']
    	));
  		if ($r->getError()) {
      	echo "sorry, an error occured";
  		}	 
  		else {
      	// parse json and show tweets
        $js = json_decode($r->getResponse());
      	var_dump($js);
       	$obj=$js->response;
       	$res=json_decode($obj);
       	$access_token=$res->access_token;
       	echo $access_token;
		//$_session['token']=$access_token;
        }   	
  	   }		
		catch(Exception $e)
		{
		echo 'error: '.$e;
		//$con->rollback();
		$user=NULL;
	
		}		
	}
	else
	{
		echo "user is empty";
	}
//}
 
?>