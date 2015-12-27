<!doctype html>
<html><head>
<meta charset="utf-8">
<style type="text/css">

@font-face{
	font-family: SI;
	src: url('contents/styles/font.ttf');
}	

body
{
width:100%;
height:100%;
padding:0%;
margin:0%;
background:none repeat scroll 0 0 #BBB ;
color:#000;
position: relative;

background: #1e5799; /* Old browsers */
background: -moz-linear-gradient(top,  #1e5799 0%, #7db9e8 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#1e5799), color-stop(100%,#7db9e8)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #1e5799 0%,#7db9e8 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #1e5799 0%,#7db9e8 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #1e5799 0%,#7db9e8 100%); /* IE10+ */
background: linear-gradient(to bottom,  #1e5799 0%,#7db9e8 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1e5799', endColorstr='#7db9e8',GradientType=0 ); /* IE6-9 */

}

header
{
	padding:3% 0 4% 0;
/*background-color:#112d42;
*/text-shadow:#000000 5px;
}

#tag
{ padding-left:5%;
font-family:SI;
color:white;
	
}

</style>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<title>SignUp</title>
</head>

<body>
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    // init the FB JS SDK
    FB.init({
      appId      : '459309394127720', // App ID from the App Dashboard
      channelUrl : 'localhost/startink/tests/facebooktest/facebook.php', // Channel File for x-domain communication
      status     : true, // check the login status upon init?
      cookie     : true, // set sessions cookies to allow your server to access the session?
      xfbml      : true  // parse XFBML tags on this page?
    });

    // Additional initialization code such as adding Event Listeners goes here
FB.getLoginStatus(function(response) {
  if (response.status === 'connected') {
    // the user is logged in and has authenticated your
    // app, and response.authResponse supplies
    // the user's ID, a valid access token, a signed
    // request, and the time the access token 
    // and signed request each expire
    var uid = response.authResponse.userID;
    var accessToken = response.authResponse.accessToken;
  } else if (response.status === 'not_authorized') {
    // the user is logged in to Facebook, 
    // but has not authenticated your app
  } else {
    // the user isn't logged in to Facebook.
  }
 });

  };

  // Load the SDK's source Asynchronously
  // Note that the debug version is being actively developed and might 
  // contain some type checks that are overly strict. 
  // Please report such bugs using the bugs tool.
  (function(d, debug){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all" + (debug ? "/debug" : "") + ".js";
     ref.parentNode.insertBefore(js, ref);
   }(document, /*debug*/ false));
</script>

<!--Header section-->
<header class="fixed_width" style="padding-left:10%;">
<img id="logo" alt="logo" src="contents/images/logo_smaller.png" style="border-radius:10px; vertical-align:middle; clip:rect(30px 10px 30px 10px); margin-bottom:-2%">
<span id="tag" style="font-size:24px; line-height:1.5em; ">
"There is no better way to START"
</span>
</header>
<hr>
<!--Header section ends-->


<div id="fb_box">
<h3 >User Registration using <span style="color: #5c75a9">Facebook Registration Plugin</span></h3>
<br/>
<div id="add"></div>

<fb:login-button autologoutlink="true" onlogin="OnRequestPermission();">
</fb:login-button>
<script language="javascript" type="text/javascript">
    FB.init({
        appId: 'Your_Application_ID',
        status: true,
        cookie: true,
        xfbml: true
    });   
</script>

        <div id="container">
	
	<div id="reg_form">
                <iframe src='http://www.facebook.com/plugins/registration.php?
                        client_id=459309394127720&
                        redirect_uri=http://localhost/startink/save_user_fb.php&
                        fields=[
                        {"name":"name"},
                        {"name":"email"},
                        {"name":"gender"},
                        {"name":"birthday"},
                        {"name":"location"},
                        {"name":"password"},
                        {"name":"captcha"},
                        ]'
                        scrolling="auto"
                        frameborder="no"
                        style="border:none"
                        allowTransparency="true"
                        width="450"
                        height="450">
                </iframe>
	</div>
	</div>

</div>  <!-- End #fb_box -->

</body>
</html>