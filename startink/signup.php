<?php



?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sign Up</title>
</head>

<body>
Welcome to the club :)
<script type="text/javascript">
 var RecaptchaOptions = {
    theme : 'blackglass'
 };
 </script>
<form method="post" action="verify_captcha.php">
        <?php
          require_once('contents/includes/recaptchalib.php');
          $publickey = "6Lfp69sSAAAAAKAYD6be5fXlf-B3NeRlwI9aDKD7"; // you got this from the signup page
          echo recaptcha_get_html($publickey);
        ?>
        <input type="submit" value="All Right, M Ready" />
      </form>

</body>
</html>