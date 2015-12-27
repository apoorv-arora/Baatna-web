<?php 
	require_once('contents/includes/session_class.php');
	require_once('contents/includes/config_class.php');
	require_once('contents/includes/user_class.php');
	require_once('contents/includes/sanitize_text.php');

//require_once('contents/includes/quotes.php');




	$session->check_login();
	if($session->is_logged_in())
	{
		header("location:home.php");
		
	}


	if(!empty($_POST['email'])&& !empty($_POST['pwd']))
	{
		if(!$session->check_login())
		{
			$_SESSION['uid']=$user->valid($sanitize->san($_POST['email']),$_POST['pwd']);
			echo $_SESSION['uid'];
			if(is_numeric($_SESSION['uid']))
			{
				$session->login();
				header("location:home.php");
			}
			else
			{
				$error="Slow down ;)";
				$session->logout();
			}
		}
	}
	
    $app_id		= "1024066637634361";
	$app_secret	= "8531a0d997b43427b9853b829f59018d";
	$site_url	= "http://startink.com/welcome.php";

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
	// We may or may not have this data based 
	// on whether the user is logged in.
	// If we have a $user id here, it means we know 
	// the user is logged into
	// Facebook, but we don’t know if the access token is valid. An access
	// token is invalid if the user logged out of Facebook.
	//print_r($user);
		// Get logout URL
		$logoutUrl = $facebook->getLogoutUrl();
		// Get login URL
		$loginUrl = $facebook->getLoginUrl(array(
			'scope'			=> 'publish_actions, email, user_birthday',
			'redirect_uri'	=> $site_url,
			));
		
	
?>



<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<link href="contents/styles/index.css" rel="stylesheet">
		<link rel="shortcut icon" href="contents/images/favicon.ico">
<!--for video-->
	
<!--end for video-->

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38503967-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
		<script type="text/javascript">

		window.onload=function() 
		{
			var quotes = $(".quotes");
    		var quoteIndex = -1;
    
    		function showNextQuote() 
    		{
        		++quoteIndex;
        		quotes.eq(quoteIndex % quotes.length)
            	.fadeIn(1000)
            	.delay(10000)
            	.fadeOut(1000, showNextQuote);
    		}
    
    		showNextQuote();
    
		}
		</script>
		
		<title>startINK	</title>
		
	</head>

	
	<body>
		<div id="fb-root">
		</div>
		<script src="//connect.facebook.net/en_US/all.js#xfbml=1&appId=459309394127720" type="text/javascript">
		</script>
<!--Header section-->

		<header>
			<div class="container">
				<img id="logo" alt="logo" src="contents/images/header_logo.png" height="70px" >
				
				<span id="tag">
					<img src="contents/images/tag_line.png">
					<span style="margin-left:20px;">
						
						<a href="http://facebook.com/startINKing" target="_blank" style="text-decoration:none;">
							<img src="contents/images/facebook-icon.png" height="32">
						</a>
						&nbsp;
						
						<a href="http://twitter.com/accomplishINKs" target="_blank">
							<img src="contents/images/twitter-icon.png" height="32">
						</a>
					</span>
				</span>
			</div>
</header>

<div id="background_section">
<!--Header section ends-->
<!--Quote and Login-->
	<div class="container">

		<div id="slide_login_section">
			      
			<div id="video_slide">
				<div style="font-size: 200%; font-family: Helvetica; margin-bottom: 40px;">
					Live up your dreams in three steps -
				</div>
				
				<div style="">
					<ul id="mylist" style="margin-left: -40px">
						
						<li id="list">
							<span id="steps">Sign up</span>
							<img src="contents/images/list1.png" width="250" height="150" />
						</li>
						
						<li id="list">
							<span id="steps">Add goals</span>
							<img src="contents/images/list(b).png" width="250" height="150" />
						</li>
						
						<li id="list">
							<span id="steps">Execute</span>
							<img src="contents/images/list(c).png" width="250" height="150" />
						</li>
						
					</ul>
				</div>
				
							
			<!--	<div style="; width: 200px; height: 125px; vertical-align: top; margin-left: 20px;">
					
				</div>
				<iframe width="500" height="250" src="http://www.youtube.com/embed/Rr4sNE4uZ-A" frameborder="0" allowfullscreen></iframe>			
			-->
			</div>
		
<!--Login section-->              
			<div id="login_section" style="text-align: center;">
    		
    			<form  action="index.php" method="post">
        			<input class="input_fields" type="email" name="email" placeholder="EMAIL">
        			<input type="password"  class="input_fields" name="pwd" placeholder="PASSWORD">
        			<div id="remember_me_login">
        				<div id="remember">
            				<label for="remember me"><input type="checkbox" value="Rememberme" checked >Remember Me</label>
            			</div>
            
            			<input id="submit_button" type="submit" value="LOGIN" style="border-style:none; float:right;"> 
            			<hr style="clear:both; color: black;">
        			</div>
        		</form>
        
        		<a href="<?php echo $loginUrl; ?>" id="facebook" style="float:left;">
        			<div >
            			<img src="contents/images/facebook_sign_up.png" height="40">
            		</div>
        		</a>
        
        		<div class="fb-like" data-href="http://www.startink.com" data-send="false" data-width="450" data-show-faces="true" data-font="lucida grande">
        		</div>
        
    		</div>
        
			
			<div style="border: thick #222">
				<iframe width="600" height="300" src="http://www.youtube.com/embed/Rr4sNE4uZ-A" frameborder="0" allowfullscreen></iframe>
			</div>

		</div>


	</div>
<!--
	<div id="information_section">
		
		

		
		<div class="information_tables" style="height:284px;">
			
			<div>
				<p style="text-align:center;">1. SIGN UP</p>
				<h6>Sign up using Facebook.<br>
                Connect with your friends and share your dreams.
				</h6>
			</div>
		</div>
	
	
		
		
		<div class="information_tables" style="background-color:">
			
			<div>
				<p style="text-align:center;">2. INK </p>
				<h6>Create INKs aka Activities.<br>
 Just click on “Got something new to do?”  and enlist anything you wish to do .<br>
               Set a deadline for your task and Ink it.    
				</h6>
			</div>
		</div>
	

		
		
		
		<div class="information_tables" style="background-color:">
			<div>
				<p style="text-align:center;">3. EXECUTE</p>
                <h6>Cool , you’ve got a task and a deadline to complete it .<br>
We know that you will feel great when you do it . <br>
Acknowledge it by clicking on the "Report Completion” button.
					</h6>
			</div>	
		</div>
		
		
		
	</div>
-->


</div>


<footer>
	<?php
	include("footer.php");?>
</footer>

</body>
</html>
