<?php
if(!isset($_SESSION['user']))
{
	//Application Configurations
	$app_id		= "459309394127720";
	$app_secret	= "697ffaaeab7bb2715975cb0dba9eff8e";
	$site_url	= "http://startink.com/index.php";

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
	// We may or may not have this data based 
	// on whether the user is logged in.
	// If we have a $user id here, it means we know 
	// the user is logged into
	// Facebook, but we don’t know if the access token is valid. An access
	// token is invalid if the user logged out of Facebook.
	//print_r($user);
	if($user){
		// Get logout URL
		$logoutUrl = $facebook->getLogoutUrl();
	}else{
		// Get login URL
		$loginUrl = $facebook->getLoginUrl(array(
			'scope'			=> 'publish_actions, email',
			'redirect_uri'	=> $site_url,
			));
	}

	if($user){

		try{
		// Proceed knowing you have a logged in user who's authenticated.
		$user_profile = $facebook->api('/me');
		//Connecting to the database. You would need to make the required changes in the common.php file
		//In the common.php file you would need to add your Hostname, username, password and database name!
		print_r($user_profile);
		
		//important data for reference
		include('contents/includes/config.php');
		$con->beginTransaction();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

		$user_profile['name'];
		$user_profile['email'];
		$user_profile['gender'];
		$user_profile['bio'];
		//date end
		

list($fn,$surname)=explode(" ",$user_profile['name']);

$result=0;

$sql="SELECT * FROM LOGIN WHERE email=?";
		$q=$con->prepare($sql);
		$q->execute(array($user_profile['email']));
		$r=$q->fetch(PDO::FETCH_NUM);
		if(is_null($r[0]))
		{
			  $sql = "INSERT INTO login (email_id) VALUES(?)";
			  $q=$con->prepare($sql);
			  $q->execute(array($user_profile['email']));
			  
			  $sql='SELECT uid from login where email_id=? LIMIT 1';
			  $q=$con->prepare($sql);
			  $q->execute(array($user_profile['email']));
			  $uid=$q->fetch(PDO::FETCH_NUM);
			  //echo "<strong>$uid[0]</strong>";
			  
			  $sql = "INSERT INTO details (fn,ln,sex,uid) VALUES(?,?,?,?)";
			  $q=$con->prepare($sql);
			  $q->execute(array($fn,$surname,$user_profile['gender'],$uid[0]));
			  $result=1;
			  echo 'done';
			 
			  $_SESSION['user'] = $user_profile['email'];
			  $_SESSION['id'] = $user_profile['id'];
			$con->commit();
			  
}

else
{
$_SESSION['user'] = $r['email_id'];
$_SESSION['fb_id'] = $user_profile['id'];
}
}
catch(Exception $e)
{
	echo 'error: '.$e;
	$con->rollback();
	$user=NULL;
	
}


		
		
	}
}
?>