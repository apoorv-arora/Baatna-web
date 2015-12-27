<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php if(isset($_GET['act'])) echo urldecode($_GET['act']).' | startINK'; else echo 'Activity Page'; ?></title>
<?php include("contents/includes/age.php");?>

<link type="text/css" href="http://startink.com/contents/styles/ink.css" rel="stylesheet">
<link rel="shortcut icon" href="http://startink.com/contents/images/favicon.ico">
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

 <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# startinkapp: http://ogp.me/ns/fb/startinkapp#">
  <meta property="fb:app_id"      content="459309394127720" /> 
  <meta property="og:type"        content="startinkapp:activity" /> 
  <meta property="og:url"         content="<?php if(isset($_GET['act'])) echo 'http://startink.com/activity/'.urlencode($_GET['act']); else echo 'http://startink.com/ink.php'; ?>" /> 
  <meta property="og:title"       content="<?php  if(isset($_GET['act'])) echo urldecode($_GET['act']); else echo 'An activity'; ?>" /> 
  <meta property="og:image"       content="http://startink.com/me2.jpg" /> 
  <meta property="og:description" content="<?php  ?>" />
  

</head>

<body>

<header>

<div class="center" style="text-align:left;">
<div style="text-align:left;" class="inline">
<a href="http://startink.com/home.php">
<img src="http://startink.com/contents/images/header_logo.png" height="40" style=" margin-top:3px; vertical-align:middle;"></a>
</div>

<div style="text-align:right; float:right; vertical-align:bottom; margin-top:13px;" class="inline">

<div class="translate inline" style="">Hello, Guest</div>
<a href="http://startink.com/"><div class="translate inline" style="">Login</div></a>
<a href="http://startink.com/team.php"><div class="inline translate" style="">TEAM</div></a>
<a href="http://startink.com/about.php" style="color:black;"><div class="inline translate">About Us</div></a>

</div>
</div>
</header>

<div id="age_section" style="text-align:center; margin:0 auto; box-shadow:2px 2px 2px 2px #112b24; width:500px; clear:both;">
<div>Your are visiting currently as Guest</div>
<div>
<a href="tour.php" style="font-size:24px; color:#a52a2a;"><div>Take a Tour</div></a>
</div>
</div>



<div style="min-height:410px">
<div id="center_panel">
<div id="activity_img" class="center">
<div id="ink_image" style="margin-right:40px;" class="inline">
<img src="http://startink.com/contents/images/ink_it_blue.png" height="120px" style="vertical-align:middle;" >
</div>

<div style="width:1px; height:150px; background-color:#a52a2a; margin-right:30px; vertical-align:middle;" class="inline"></div>

<div id="ink_name" class="inline" style="font-size:95%; line-height:1.6em; text-align:left; width:400px;vertical-align:middle;">
<span style="font-size:20px;"><a href="<?php echo 'http://startink.com/activity/'.urlencode($_GET['act'])?>"><?php echo $_GET['act'];?></a>
</span>


	<!--jQuery-->
	<script src="http://startink.com/contents/scripts/js/jquery.reveal.js"></script>

	<script type="text/javascript">
	

	
		$(document).ready(function() {
			$('#new_ink').click(function(e) { // Button which will activate our modal
			   	$('#modal').reveal({ // The item which will be opened with reveal
				  	animation: 'fade',                   // fade, fadeAndPop, none
					animationspeed: 300,                       // how fast animtions are
					closeonbackgroundclick: true,              // if you click background will modal close?
					dismissmodalclass: 'close'    // the class of a button or element that will close an open modal
				});
			return false;
			});
		});
	</script>


<div>
<div><div class="inline" style="width:150px;">INKers Doing It<span></span></div></div>
</div>
<div>
<div><div class="inline" style="width:150px;">INKers who accomplished<span></span></div></div>
</div>

<div>
<div><div class="inline" style="width:150px;">Total Helps<span></span></div></div>
</div>

<div>

</div>

</div>
</div>

</div>

<div id="modal">
	<div id="heading">
		Adding : <?php echo $_GET['act']; ?>
	</div>

	<div id="content">
		<form action="process_sketch.php" method="post">
<div>

<input type="hidden" readonly  id="new_ink" value="<?php echo $_GET['act']; ?>" name="new_ink">
<div style="padding:0 30px;">
<input type="text" size="39" id="selectedDateTime" name="selectedDateTime" placeholder="Date before U intend to finish it(optional)" class="fields"  />
</div>
<br>

<div style="padding:0 30px;">
<span title="Private Inks will not be shown to public">PRIVATE:<input type="checkbox" name="private"></span><br>

<input type="submit" value="INK IT!" style="width:60px; height:30px; text-align:right;">

<div id="ink_added">
</div>
</div>
</div>

</form>
	</div>
</div>


<div id="follow_people_doing" style="margin-top:30px; width:700px;"class="center inline">
<div>
<h3>Inkers Doing This:</h3>
</div>
<?php

$sql='SELECT uid FROM act_priv WHERE activity=? AND private=?';

		$q=$con->prepare($sql);
		$users_doing_it=$q->execute(array($obj->ink,'off'));
		$user_doing_array=NULL;
		$sess=0;
		while($users_doing_it=$q->fetch())
		{
			$user_doing_array[]= array('users'=>$users_doing_it['uid']);
		}
		
		foreach($user_doing_array as $a)
		{
			
		  	$user_detail_obj=$user->user_details($a['users']);

			  echo '<a href="user.php?user='.$a['users'].'" title="'.$user_detail_obj->quote.'"><div style=" margin:5px 10px; display:inline-block;"><div><img src="https://graph.facebook.com/'.$facebook->fb_image($a['users']).'/picture?height=50&width=60" style="text-align:center; overflow:hidden;">
';
echo '</div><div>'.$user_detail_obj->fn.'</div></div></a>';

			  
		  }
		  
		 
		  
		
		
		
		
?>
</div>

<script type="text/javascript">

$('#selectedDateTime').datetimepicker({
	minDate: new Date(<?php echo date("Y,m-1,d,H,i");?>),//2010, 11, 20, 8, 30),
	maxDate: new Date(<?php $future=time()+60*60*24*5000 ;echo date("Y,m-1,d,H,i",$future);?>)//2010, 11, 31, 17, 30)
});



</script>

</div>

<footer>
<?php include("footer.php")?>


</footer>


</body>
</html>
