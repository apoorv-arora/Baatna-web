<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US"
      xmlns:fb="https://www.facebook.com/2008/fbml"> 
<head prefix="og: http://ogp.me/ns# startinkapp: 
                  http://ogp.me/ns/apps/startinkapp#">
  <title>Page</title>
  <meta property="fb:app_id" content="459309394127720" /> 
  <meta property="og:type" content="startinkapp:activity" /> 
  <meta property="og:title" content="Jump" /> 
  <meta property="og:image" content="http://startink.com/logo_smaller.png" /> 
  <meta property="og:description" content="Ink desc on jump the wall" /> 
  <meta property="og:url" content="http://startink.com/php_obj.php">

 <script src="//connect.facebook.net/en_US/all.js"></script>
  <script type="text/javascript">
  function postCook()
  {
      FB.api(
        '/me/startinkapp:ink',
        'post',
        { activity: 'http://startink.com/php_obj.php' },
        function(response) {
           if (!response || response.error) {
              alert('Error occured'+response.error);
           } else {
              alert('Cook was successful! Action ID: ' + response.id);
           }
        });
  }
  </script>
</head>
<body>

 <div id="fb-root"></div>
<script>


  FB.getLoginStatus(function(response) {
  if (response.status === 'connected') {
    console.log("connected");
  } else if (response.status === 'not_authorized') {
    console.log("not_authorized");
  } else {
    console.log("not_logged_in");
  }
 });


  // Additional JS functions here
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '459309394127720', // App ID
      channelUrl : '', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    });

    // Additional init code here

  };
  
  function login() {
    FB.login(function(response) {
        if (response.authResponse) {
          testAPI();  // connected
        } else {
            // cancelled
        }
    });
}
function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
        console.log('Good to see you, ' + response.name + '.');
    });
}

  FB.getLoginStatus(function(response) {
  if (response.status === 'connected') {
    console.log("connected");
  } else if (response.status === 'not_authorized') {
    console.log("not_authorized");
  } else {
    console.log("not_logged_in");
  }
 });




  // Load the SDK Asynchronously
  
</script>

  <h3>Test</h3>
  <p>
    
  </p>

  <br>
  <form>
    <input type="button" value="ink" onclick="postCook()" />
  </form>
</body>
</html>