<html>
<head>
<title>Sending email using PHP</title>
</head>
<body>
<?php
require_once('contents/includes/PHPMailer/class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

$mail->IsSMTP(); // telling the class to use SMTP

try {
  $mail->Host       = "mail.startink.com"; // SMTP server
  $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
  $mail->SMTPAuth   = true;                  // enable SMTP authentication
  $mail->Host       = "mail.startink.com"; // sets the SMTP server
  $mail->Port       = 25;                    // set the SMTP port for the GMAIL server
  $mail->Username   = "dbeligon"; // SMTP account username
  $mail->Password   = "*******";        // SMTP account password
  $mail->AddReplyTo('lets@startink.com', 'startINK');
  $mail->AddAddress('grisham@startink.com', 'Grisham');
  $mail->AddAddress('dipankar@startink.com', 'Dipankar');
  $mail->SetFrom('lets@startink.com', 'startINK');
  $mail->AddReplyTo('lets@startink.com', 'startINK');
  $mail->Subject = 'Welcome to startINK';
  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
  $mail->MsgHTML("<br>
<h4>Hi Grisham,
<br>
Welcome to the amazing world of StartINK.</h4>
<p>  We thank you for joining StartINK and want you to know that we are psyched to have you aboard!!
<br>
With StartINK, you have a chance to achieve your goals in a smarter way and share your experiences
<br>
with passionate people like you.StartINK is really awesome for you and here are some things you can 
<br>
do at StartINK :</p>
<h4>
-	Set timer for your goals/INKs.
<br>
-	Share your goals with your friends.
<br>
-	Inspire and encourage your friends.
<br>
-	Get inspired and share dreams.
<br>
-	Accomplish INKs and share experiences.
</h4>
Click here to login into your account and create a new INK.
<br>
HERE IS AN EASY METHOD TO READ THIS MAIL, take our <a href='http://startink.com/tour.php'>tour</a>.<br>

<br>
<p style='font-size:80%'>
Feel free to read our <a href='http://startink.com/TermsOfService.php'>privacy policy</a>, <a href='http://stasrtink.com/disclaimer.php'>disclaimer</a> and our <a 

href='http://startink.com/about.php'>about</a> page for more information. In case you want to ask something specific or have any other questions, please drop a mail at 

<a href='mailto:'>support@starink.com</a> and we will get back to you.  
</p>

Team startINK<br>

<img src='http://startink.com/contents/images/header.png' height='30'>
"
);
  $mail->Send();
  echo "Message Sent OK<p></p>\n";
} catch (phpmailerException $e) {
  echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  echo $e->getMessage(); //Boring error messages from anything else!
}
   ?>
