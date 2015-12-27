
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script language=javascript type='text/javascript'>

	function showDiv(val) 
	{

		if(document.getElementsByClassName('show').item(val+1).style.display == "block")
		{
		document.getElementsByClassName('show').item(val+1).style.display = "none";
		//console.log('here');
		document.getElementsByClassName('show').item(val).style.display="block";
		
		}
		else
		{
		document.getElementsByClassName('show').item(val-1).style.display = "none";
		//console.log('here');
		document.getElementsByClassName('show').item(val).style.display="block";
		//console.log('here');
	
		}
	
	}
	
</script>


<title>Quick Tour</title>

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

	-webkit-transition: all 0.5s ease-in-out;
	-moz-transition: all 0.5s ease-in-out;
	-o-transition: all 0.5s ease-in-out;
	transition: all 0.5s ease-in-out;
	transition-delay:0.0s;
}

#logo:hover
{
	-moz-transform: scale(1.1) rotate(-4deg) translateX(0px) translateY(0px) skewX(0deg) skewY(0deg);
	-webkit-transform: scale(1.1) rotate(-4deg) translateX(0px) translateY(0px) skewX(0deg) skewY(0deg);
	-o-transform: scale(1.1) rotate(-4deg) translateX(0px) translateY(0px) skewX(0deg) skewY(0deg);
	-ms-transform: scale(1.1) rotate(-4deg) translateX(0px) translateY(0px) skewX(0deg) skewY(0deg);
	transform: scale(1.1) rotate(-4deg) translateX(0px) translateY(0px) skewX(0deg) skewY(0deg); 

	-webkit-transition: all 0.5s ease-in-out;
	-moz-transition: all 0.5s ease-in-out;
	-o-transition: all 0.5s ease-in-out;
	transition: all 0.5s ease-in-out;
	transition-delay:0.0s;
}


		#picture
		{
			display: inline-block;
			height=400px;
			width=600px;
			margin-right: 20px;
			margin-top: 30px;							
		}
		
		
		#content
		{
			display: inline-block;
			margin-right: 10px;
			text-align: left;
			width: 180px;
			vertical-align: top;		
		}
		
		
		#heading
		{
			font-size: 120%;
			text-decoration: underline;
			margin-top: 150px;
			margin-bottom: 20px;
		}
		
		
		#description
		{
			font-size: 80%;
			color: #777;
			height: 225px;
		}

		#tag
		{
			padding-left:10%;
			font-family:SI;
			color:white;
			font-size:200%;
		}
		
		.inline
		{
			display: inline-block;
		}
		
		
		.show
		{
			font-size: 130%;
			height: 510px;	
			margin-top: 30px;
		}
		
		#continue
		{
			border: none;
			height: 30px;
			width: 90px;
			color: #fff ;
			background-color: #a52a2a;
			font-size:100%;
			cursor: pointer;
			margin-right: 20px;
		}


		</style>


</head>

<body>
	<header>
		<span class="container">
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
		</span>
	</header>


<div class="show" >
	
	<div style="margin-top: 20px; margin-bottom: 50px">
		WELCOME...
		<br />
		This is a quick tour guide.
		<br />
	</div>
	
	<div>
		<input type="button" name="answer" value="START" onclick="showDiv(1)" style="border: none; height: 30px; width: 90px; color: #fff ; background-color: #a52a2a; font-size:100%; cursor: pointer;"/>
	</div >
</div>



<div class="show" style=" display: none">
	
	<div class="inline" style="vertical-align: top; margin-top: 30px">
		<input id="continue" type="button" name="answer" value="Back" onclick="showDiv(0)" />
	</div>
	
	
	<div id="picture" class="inline" >
		<img src="contents/images/home_page.PNG" height="400px" width="600px" style="border: 10px solid #444; border-radius: 2px;">
	</div>
	
	<div id="content" class="inline">
		
		<div id="heading">
			set your goals
		</div>	
		
		<div id="description">
			<p>
			 After sign up, enlist your<br />goals with a deadline(optional).<br /> If you don't want to share with<br />your friends, keep it private.
			</p>
		</div>
		
		<input id="continue" type="button" name="answer" value="Continue" onclick="showDiv(2)" />
		
	</div>
	
	<div class="inline" >
		<hr style="height: 400px; width: 4px; color: #eee; background-color: #777; opacity: 0.5" />		
		
	</div>
	
</div>




<div class="show" style=" display: none;">	


	<div class="inline" style="vertical-align: top; margin-top: 30px">
		<input id="continue" type="button" name="answer" value="Back" onclick="showDiv(1)" />
	</div>
	
	<div id="picture">
		<img src="contents/images/support_remark.PNG" height="400px" width="600px" style="border: 10px solid #444; border-radius: 2px;">
	</div>
	
	
	<div id="content">
		
		<div id="heading">be supportive</div>
	
		<div id="description" >
			Encourage your friends
			<br />
			by clicking
			<img src="contents/images/support.PNG" height="16px" width="16px" style="vertical-align: middle" >
			SUPPORT
			<br />
			<br />
			Update your comments
			<br />
			in
			<img src="contents/images/remarks.png" height="16px" width="16px" style="vertical-align: middle" >
			REMARKS section.
			<br />
		</div>
		
		<input id="continue" type="button" name="answer" value="Continue" onclick="showDiv(3)" />
		
	</div>
	
	<div class="inline" >
		<hr style="height: 400px; width: 4px; color: #eee; background-color: #777; opacity: 0.5" />		
	</div>
	
</div>





<div class="show" style=" display: none" >
	
	<div class="inline" style="vertical-align: top; margin-top: 30px">
		<input id="continue" type="button" name="answer" value="Back" onclick="showDiv(2)" />
	</div>
	
	<div id="picture" >
		<img src="contents/images/activity_name.PNG" height="400px" width="600px" style="border: 10px solid #444; border-radius: 2px;">
	</div>
	
	
	<div id="content">
		<div id="heading">
			helping hands
		</div>
		<div id="description">
			On Activity Page, add
			<br />
			suggestion and opinion
			<br />
			for your friends for how
			<br />
			to accomplish that goal.
			<br />
		</div>
		<input id="continue" type="button" name="answer" value="Continue" onclick="showDiv(4)"/>
	
	</div>
	
	<div class="inline" >
		<hr style="height: 400px; width: 4px; color: #eee; background-color: #777; opacity: 0.5" />		
	</div>
	
</div>


<div class="show" style="display: none;">	
	
	<div class="inline" style="vertical-align: top; margin-top: 30px">
		<input id="continue" type="button" name="answer" value="Back" onclick="showDiv(3)" />
	</div>
	
	<div id="picture" >
		<img src="contents/images/follow.PNG" height="400px" width="600px" style="border: 10px solid #444; border-radius: 2px;">
	</div>
	
	
	<div id="content">
	
		<div id="heading">
			get connected
		</div>
		
		<div id="description">
			Follow other Inkers to
			<br />
			find out what their 
			<br />
			goals are and get
			<br />
			motivated.
		</div>	
	
		<input id="continue" type="button" name="answer" value="Continue" onclick="showDiv(5)"/>
		
	</div>
	
	<div class="inline" >
		<hr style="height: 400px; width: 4px; color: #eee; background-color: #777; opacity: 0.5" />		
	</div>
	
</div>



<div class="show" style="display: none;">
	
	<div class="inline" style="vertical-align: top; margin-top: 30px">
		<input id="continue" type="button" name="answer" value="Back" onclick="showDiv(4)" />
	</div>
		
	<div id="picture" >
		<img src="contents/images/done1.png" height="400px" width="600px" style="border: 10px solid #444; border-radius: 2px;">
	</div>
	
	<div id="content">
	
		<div id="heading">
			get set go
		</div>
		
		<div id="description">
			Don't just write down your
			<br />
			goals, also achieve them.
			<br />
			<br />
			Avail offers and discounts
			<br />
			provided for easy 
			<br />
			completion of your goals.
			<br />
			(coming soon...)
			<br />
		</div>
		
		<button id="continue">
			<a href="home.php" style="color: #fff;">
				Done
			</a>
		</button>
	
	</div>
	
	<div class="inline" >
		<hr style="height: 400px; width: 4px; color: #eee; background-color: #777; opacity: 0.5" />		
	</div>
	
	
	
</div>

<div class="show" style="display: none"></div>

<div style="text-align: right; margin-bottom: 30px; margin-right: 350px; margin-top: 20px;">

		<a href="home.php">HOME</a>

</div>


<footer>
	<?php
	include("footer.php");?>
</footer>


</body>
</html>