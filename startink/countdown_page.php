<?php

try{
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Kolkata');
$timezone = date_default_timezone_get();
$datetime1 = new DateTime();
$datetime2 = new DateTime('2012-12-15');
$interval = $datetime1->diff($datetime2);
$timdif=$interval->format('%D:%H:%I:%S');

}

catch(Exception $e)
{
	exit();
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
<meta name="keywords" content="Start Ink, Startink" />
<link href="contents/images/splash.png" rel="shortcut icon">
    <title>STARTINK</title>
    <link type="text/css" href="contents/styles/index.css" rel="stylesheet"/>
    <script charset="utf-8" type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
    <script src="contents/scripts/js/countdown.jquery.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
      $(function(){
        $('#counter').countdown({
          image: '/contents/images/digits.png',
          startTime: '<?php echo $timdif; ?>'
        });

        
      });
    </script>
    <style type="text/css">
      br { clear: both; }
      .cntSeparator {
        font-size: 54px;
        margin: 10px 7px;
        color: #FFF;
      }
      .desc {margin: 7px 12px 7px 70px;width: 540px;
}
      .desc div {
        float: left;
        font-family: Arial;
        width: 70px;
        margin-right: 65px;
        font-size: 13px;
        font-weight: bold;
        color: #FFF;
      }
    </style>


</head>

<body style="background: #131317">
<center>
<div id="logo">
<img src="logo_smaller.png" style="text-align:center" height="140" width="245px" alt="Logo">
</div>
<div id="quote_section">
<?php include("contents/includes/quotes.php");?>
</div>
</br>
</br>
<div id="cont">
<center>
</br>
<div style="font-size:20px"><h1> Starting Soon </h1></div>
<div id="counter"></div>
  <div class="desc cent">
    <div>Days</div>
    <div>Hours</div>
    <div>Minutes</div>
    <div>Seconds</div>
  </div>
  </div>
  </center>
</center>
</body>
</html>