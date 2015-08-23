<?php
require_once('php/defines.php');

if(!isset($_GET['token'])) header("Location: index.html");
$token = $_GET['token'];
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if(mysqli_connect_error()) { respond(true, "Couldn't connect to database.", mysqli_connect_error()); }

$stmt = $mysqli->prepare("SELECT uid, email FROM users WHERE token = ?");
$stmt->bind_param('s', $token);
$stmt->execute();
$stmt->bind_result($uid, $referrerEmail);
$stmt->fetch();
$stmt->close();
$mysqli->close();

// query database to get details of the token
$personDetails = ["uid" => $uid, "email" => $referrerEmail];
?>
<!DOCTYPE html>
<html ng-app="myApp">

  <head>
    <meta charset="utf-8"/>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.2/css/foundation.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png"> 
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png"> 
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png"> 
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png"> 
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png"> 
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png"> 
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png"> 
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png"> 
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png"> 
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png"> 
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png"> 
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png"> 
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png"> 
    <link rel="manifest" href="/manifest.json"> 
    <meta name="msapplication-TileColor" content="#ffffff"> 
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png"> 
    <meta name="theme-color" content="#ffffff"><link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png"> 
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png"> 
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png"> 
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png"> 
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png"> 
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png"> 
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png"> 
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png"> 
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png"> 
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png"> 
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png"> 
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png"> 
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png"> 
    <link rel="manifest" href="/manifest.json"> 
    <meta name="msapplication-TileColor" content="#ffffff"> 
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png"> 
    <meta name="theme-color" content="#ffffff">

    <title>Baatna - Referral Page</title>
  </head>

  <body>

    <header class="header" data-scroll-speed="3">
      <div class="row">
        <div class="large-3 columns">
          <h1><a href="index.html" class=""><img class="logo top_bar"src="images/baatna web-02.png"></a></h1></div>
        <div class="large-9 columns">
          <div class="row right">
            <ul class="button-group top_padd">
              <li><a href="#" data-tab='1' class="button">About</a></li>
              <li><a href="#" data-tab='2' class="button">Features</a></li>
              <li><a href="https://angel.co/baatna/jobs/" target="_blank" data-tab='3' class="button">Jobs</a></li>
              <li class="active"><a data-tab='4' href="#" class="button active sign_up">Sign Up</a></li>
            </ul>
          </div>

        </div>
      </div>
    </header>

    <div class="outer_wrapper">
      <div class="illustrations" data-scroll-speed="1">
        <image src="images/home back-14 2.png"/>
      </div>


      <div class="intro">

        <div class="phone_container right" data-scroll-speed="7">
          <img class="demo_phone" src="images/baatna web-03.png">
        </div>
        <div class="row" data-scroll-speed="7">
          <div class=" columns medium-8">
            <div class="hero_desc">
            <h2>Welcome <?php echo $personDetails['email'];?></h2>
              <h2>Refer Baatna to your friends and colleagues</h2>
            </div>
            <div class='detail'>
              <form action="php/refer.php" method="post" id="referralForm">
                <label>Enter email ids of your friends you wish to refer baatna to.</label>
                <input class="hidden" name="token" id="token" value="<?php echo $token; ?>"hidden/>
                <textarea class="form-control" rows="3" id="emails" name="emails" placeholder="Enter comma-separated email ids"/></textarea>
                <button class="button">Refer Baatna</button>
              </form>
            </div>
          </div>
          <div class="columns medium-4">

          </div>
        </div>
      </div>

    </div>

      <div id="Confirm_pop" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
      <h2 id="modalTitle">Thanks for signing up for the preview</h2>
      <p class="lead">Check your mail for more details!</p>
      <a class="close-reveal-modal" aria-label="Close">&#215;</a>
      </div>  
    <div id="Error_pop" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
      <h2 id="modalTitle">Oops, we ran into some issues.</h2>
      <p class="lead"><span id="errorDetails"></span></p>
      <a class="close-reveal-modal" aria-label="Close">&#215;</a>
    </div>  

      <div id="form_pop" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
        <h2 id="modalTitle">Would love to hear from you!</h2>
        <p class="lead">We hang out in Delhi Currently</p>
        <p>Tweet at us for a quick reply @baatnacommunity <br>or <br>Fill out the form below and we'll be in touch: </p>
        <form class="form-style-4" action="" method="post">
          <label for="field1">
            <span>Enter Your Name</span><input type="text" id="name" name="name" required="true" />
          </label>
          <label for="field2">
            <span>Email Address</span><input type="email" id="email" name="email" required="true" />
          </label>
          <label for="field3">
            <span>Short Subject</span><input type="text" id="subject" name="subject" required="true" />
          </label>
          <label for="field4">
            <span>Message to Us</span><textarea name="message" id="message" onkeyup="adjust_textarea(this)" required="true"></textarea>
          </label>
          <label>
            <span>&nbsp;</span><input type="submit" value="Send Letter" id="submit" />
          </label>
        </form>
        <a class="close-reveal-modal" aria-label="Close">&#215;</a>
      </div>

      <footer>
        <div class="row">
          <div class="large-3 columns">
            <h1><img class="logo_alt"src="images/baatna web-12.png"></h1></div>
          <div class="large-9 columns">
            <div class="row right">
              <ul class="button-group footer_nav">

                <li><a href="team.html" class="">Team</a></li>
                <li><a href="#" class="">About Us</a></li>
                <li><a href="#" class="">Terms</a></li>
                <li><a href="#" class="">Privacy</a></li>
                <li class="active"><a href="#" data-reveal-id="form_pop">Contact</a></li>
              </ul>
            </div>

          </div>
        </div>
      </footer>

      <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js'></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.2/js/foundation.js"></script>
      <script src="js/refer.js"></script>
  </body>
</html>
