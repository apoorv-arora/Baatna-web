<?php
  require_once('contents/includes/recaptchalib.php');
  $privatekey = "6Lfp69sSAAAAAHjpZAQQ_qznOhApxZ7X0UpAfuAC";
  $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

  if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly
    die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
         "(reCAPTCHA said: " . $resp->error . ")");
  } else {
	  echo 'success';
    // Your code here to handle a successful verification
  }
  ?>
  
  <!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
</body>
</html>