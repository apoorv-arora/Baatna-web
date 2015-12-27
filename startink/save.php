<?php


if(isset($_POST['pass'])&&isset($_POST['pass1'])&&isset($_POST['proff']))
{
	
	if(!($_POST['pass']===$_POST['pass1']))
	header("location:wellcome.php");
	
require_once('contents/includes/session_class.php');
require_once('contents/includes/config_class.php');
error_reporting(E_ALL);


for($i=1;$i<2;$i++)
		  {
			$_POST['pass']=crypt($_POST['pass'], '$2a$09$statink.compassword$');
		  }


$sql='UPDATE login SET pwd=? where email_id=?';
		$q=$con->prepare($sql);
		$q->execute(array($_POST['pass'],$_SESSION['email_id_via_fb']));
		
		
$sql='SELECT uid from login where email_id=?';
		$q=$con->prepare($sql);
		$q->execute(array($_SESSION['email_id_via_fb']));
		$r=$q->fetch(PDO::FETCH_NUM);
		$_SESSION['uid']=$r['0'];
		
$sql='UPDATE details SET profession=? where uid=?';
		$q=$con->prepare($sql);
		$q->execute(array($_POST['proff'],$_SESSION['uid']));
		
		
		
}

   
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tour</title>

<style type="text/css">
		@charset "utf-8";
/* CSS Document */

		@font-face
		{
			font-family: SI;
			src: url('contents/styles/font.ttf');
		}	

	body{
		font-family:Arial, Helvetica, sans-serif;
		position:relative;
		padding:0 0 0 0;
		color:#000;
		width:100%;
		margin:0%;
		cursor:default;
		height:100%;
		background-image:url(contents/images/white_texture.png);
		text-align:center;
		font-size:80%;
		overflow-y:scroll;
	}


		header
		{
			padding:1% 0% 1% 0%;
			text-shadow:#000000 5px;
			background-color:#a52a2a;
			box-shadow:0 2px 4px #000000;
		}

		h2,h4
		{
			text-align:left;
		}

		.container
		{
			margin: 0 auto;
			width: 95%;
			text-align:center;
		}

		#logo
		{
			vertical-align:middle;
			text-align:left;
	
		}

		#tag
		{
			padding-left:10%;
			font-family:SI;
			color:white;
			font-size:200%;
		}


		</style>


</head>

<body>
	<header>
		<div class="container">
			<a href="index.php">
				<img id="logo" alt="logo" src="contents/images/header_logo.png" height="70px">
			</a>
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
<br />
<br />
<br />
<br />
<br />

<div style="min-height: 370px; font-size: 130%">	
	All set to start an awesome journey??!!??
	<br />
	<br />
	Have a quick 
	<a href="tour_welcome.php">
		<strong>
			Tour
		</strong>	
	</a>.
	<br>
	<br>

</div>


<footer>
	<?php
	include("footer.php");?>
</footer>


</body>
</html>