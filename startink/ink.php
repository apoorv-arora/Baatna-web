<?php

require_once('contents/includes/config_class.php');
require_once('contents/includes/session_class.php');
require_once('contents/includes/user_class.php');
require_once('contents/includes/activity_class.php');
require_once("contents/includes/vote_class.php");
include("contents/includes/comment_class.php");
require_once("contents/includes/sanitize_text.php");
require_once("contents/includes/following_class.php");
require_once('contents/includes/get_fb_id.php');



//verify the get variables
if(isset($_GET['act']))
{
	$obj= new Activity;
	$_GET['act']=urldecode($_GET['act']);
	$obj->ink=$sanitize->san($_GET['act']);
	$row_returned=$activity->ink_exists($obj);
	$user_has_done=$activity->ink_completed_for_user($obj);
	$user_is_doing=$activity->ink_exists_for_user($obj);
	
	if($row_returned==0)
	{
	echo 'No such activity found';
	header("location:http://startink.com/home.php");
	exit();
	}
}

$session->check_login();
$loggedin=$session->is_logged_in();
if(!$session->is_logged_in())
{
	include('guest_window.php');
		//header("location:http://startink.com/index.php");
		exit();
}

$details=new User;
$details=$user->user_details($_SESSION['uid']);
$date= date_create($details->birth);



?>

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

<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.16/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.16/themes/hot-sneaks/jquery-ui.css" />
<script src="http://startink.com/contents/jQuery-Timepicker-Addon-master/jquery-ui-timepicker-addon.js"></script>


<style type="text/css">
.ui-timepicker-div .ui-widget-header{ margin-bottom: 8px; }
.ui-timepicker-div dl{ text-align: left; }
.ui-timepicker-div dl dt{ height: 25px; }
.ui-timepicker-div dl dd{ margin: -25px 0 10px 65px; }
.ui-timepicker-div td { font-size: 90%; }


</style>

 <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# startinkapp: http://ogp.me/ns/fb/startinkapp#">
  <meta property="fb:app_id"      content="459309394127720" /> 
  <meta property="og:type"        content="startinkapp:activity" /> 
  <meta property="og:url"         content="<?php if(isset($_GET['act'])) echo 'http://startink.com/activity/'.urlencode($_GET['act']); else echo 'http://startink.com/ink.php'; ?>" /> 
  <meta property="og:title"       content="<?php  if(isset($_GET['act'])) echo urldecode($_GET['act']); else echo 'An activity'; ?>" /> 
  <meta property="og:image"       content="http://startink.com/me2.jpg" /> 
  <meta property="og:description" content="<?php  ?>" />
  

</head>

<body>
<?php include("contents/includes/header.php");?>

	<div class="center" style="min-height:410px;">
		
		
			<div style="margin-top: 30px;">
					
					<div class="center inline" style="margin: 10px; width: 600px; height:150px; background-color: #ddd; border-radius: 5px ">
						
						<div id="ink_image" style="margin-top: 15px; margin-right: 10px" class="inline">
							<img src="http://startink.com/contents/images/ink_it_blue.png" height="120px" style="vertical-align:middle;" >
						</div>

						<div class="inline" style="width:1px; height:120px; background-color:#aaa; margin-right:20px; vertical-align:middle;" >
							
						</div>

						<div id="ink_name" class="inline" style="font-size:95%; line-height:1.6em; text-align:left; vertical-align:middle;">
							
							<div style="font-size:20px;">
								<a href="<?php echo 'http://startink.com/activity/'.urlencode($_GET['act'])?>">
									<?php echo $_GET['act'];?>
								</a>
							</div>

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
							<ul style="list-style-type:disc; color: #444">
								<li>		
									<div id="list" >INKers Doing It</div>
								</li>
								<li>
									<div id="list" >INKers who accomplished</div>
								</li>
								<li>
									<div id="list" >Total Helps</div>
								</li>
							</ul>
						</div>		
						
						<div class="inline" style="vertical-align: bottom;margin-left:15px;">
							<?php
								if($user_has_done) echo '<span style="background-color:#a52a2a; color:white; padding:4px 4px; border:#fff solid 2px;">You Have Done This</span>';
								elseif($user_is_doing) echo '<span style="background-color:#a52a2a; color:white; padding:4px 4px; border:#fff solid 2px;">You Are Doing This</span>';
								else echo '<a href="#" id="new_ink" style="border:#000 solid 2px; background-color:#fff; color:#a52a2a; padding:4px 4px;">Mee Too!!</a>';
								?>
						</div>
				
					</div>
				
				</div>
					
				
				<div class="inline" style="width:1px; min-height:200px; background-color:#ddd; vertical-align:middle;">
				</div>
				
				
				<div class="inline">
					
					<div class="inline" style="width:550px; height:1px; background-color:#ddd; vertical-align:middle;" >
					</div>


					<div >
						<textarea class="input_fields" type="text" name="suggestion" value="" placeholder="add your suggestions on how to complete it..." style=" width:500px;margin:1% 0% 1.5% 0%;font-size:120%;border-radius: 5px 5px 5px 5px;color:#000;box-shadow:#003;border:none;padding:1px;border:2px solid #a52a2a;"></textarea>
					</div>
					
				
					<div class="center" style=" width: 500px; text-align: right">
						<input type="submit" value="Post" onClick="post_remark()" style="background-color: #a52a2a; color: #fff; height: 32px; width:50px; font-size: 100%; font-weight:bold; cursor: pointer;">
					</div>
					
				
					<div class="inline" style="width:500px; height:1px; background-color:#ddd; vertical-align:middle;" >
					</div>
					
					<div style="max-width: 500px">
						
						
					</div>
					
					
				</div>

				
				<div class="inline" style="width:1px; min-height:200px; background-color:#ddd; vertical-align:middle;">
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

			
<!--
				<div id="follow_people_doing" style="margin-top:30px; width:350px;"class="center inline">
					
					<div><h2>People You Know:</h2>
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
				if($_SESSION['uid']==$users_doing_it['uid'])
				$sess=1;
			}
			$others=NULL;
		
			if(is_null($user_doing_array))
			echo 'None';
	
			elseif(count($user_doing_array)==1&&$sess)
			echo 'None';
		
			else
			foreach($user_doing_array as $a)
			{
				if($_SESSION['uid']==$a['users'])
				continue;
		  
				if($follow->following_that_person($_SESSION['uid'],$a['users'])||$follow->is_being_followed($_SESSION['uid'],$a['users']))
				{
	     			$user_detail_obj=$user->user_details($a['users']);
					echo '<a href="user.php?user='.$a['users'].'" title="'.$user_detail_obj->quote.'"><div style=" margin:5px 10px; display:inline-block;"><div><img src="https://graph.facebook.com/'.$facebook->fb_image($a['users']).'/picture?height=50&width=60" style="text-align:center; overflow:hidden;">';
					echo '</div><div>'.$user_detail_obj->fn.'</div></div></a>';
		  		}
		  		else
		  			$others[]=$a['users'];
		  	}
			
?>
			</div>
		
	
			<div style="width:350px;" class="inline">

				<div>
					<h2>Others:</h2>
				</div>
		<?php
		if(is_null($others))
			echo 'None';
		else
			foreach($others as $a)
			{
				if($_SESSION['uid']==$a)
				continue;
				
			  	$user_detail_obj=$user->user_details($a);
				echo '<a href="user.php?user='.$a.'" title="'.$user_detail_obj->quote.'"><div style=" margin:5px 10px; display:inline-block;"><div><img src="https://graph.facebook.com/'.$facebook->fb_image($a).'/picture?height=50&width=60" style="text-align:center; overflow:hidden;">';
				echo '</div><div>'.$user_detail_obj->fn.'</div></div></a>';
			}
		?>
<br>


			</div>
-->


<script type="text/javascript">

$('#selectedDateTime').datetimepicker({
	minDate: new Date(<?php echo date("Y,m-1,d,H,i");?>),//2010, 11, 20, 8, 30),
	maxDate: new Date(<?php $future=time()+60*60*24*5000 ;echo date("Y,m-1,d,H,i",$future);?>)//2010, 11, 31, 17, 30)
});

</script>


<footer>
<?php include("footer.php")?>


</footer>


</body>
</html>
