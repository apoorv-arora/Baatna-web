<?php 

require_once('contents/includes/config_class.php');
require_once('contents/includes/session_class.php');
require_once('contents/includes/user_class.php');
require_once('contents/includes/activity_class.php');
require_once("contents/includes/vote_class.php");
require_once("contents/includes/comment_class.php");
require_once("contents/includes/sanitize_text.php");
require_once("contents/includes/following_class.php");
require_once('contents/includes/get_fb_id.php');


$session->check_login();
if(!$session->is_logged_in())
header("location:index.php");

$details=new User;
$details=$user->user_details($_SESSION['uid']);
$date= date_create($details->birth);


if(isset($_GET['user']) && !empty($_GET['user']))
{
    preg_match("|\d+|", $_GET['user'], $_GET['user']);
	//$_GET['user'] = preg_replace('/[^-a-zA-Z0-9_%]/','', $_GET['user']);
	
$_GET['user']=array_shift($_GET['user']);
$username=ltrim($_GET['user'],'0');

if($_SESSION['uid']==$username)
{
echo 'Same Profile';
header("location:index.php");	
}
$user_d=$user->user_details($username);
if($user_d===NULL)
{
	echo "USER DOES NOT EXIST.";
	exit();
}

$user_fullname= $user_d->fn." ".$user_d->ln;

}

else exit(0);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $user_fullname."'s Profile";?></title>
<link rel="stylesheet" href="contents/styles/user.css">


<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.16/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.16/themes/hot-sneaks/jquery-ui.css" />
<script src="contents/jQuery-Timepicker-Addon-master/jquery-ui-timepicker-addon.js"></script>
<style type="text/css">
.ui-timepicker-div .ui-widget-header{ margin-bottom: 8px; }
.ui-timepicker-div dl{ text-align: left; }
.ui-timepicker-div dl dt{ height: 25px; }
.ui-timepicker-div dl dd{ margin: -25px 0 10px 65px; }
.ui-timepicker-div td { font-size: 90%; }
</style>

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

<script src="contents/scripts/js/coundown-min.js"></script>
<script src="contents/scripts/ajax/usage_user.js"></script>
<?php include("contents/includes/age.php");?>
</head>

<body>
	<?php include("contents/includes/header.php");?>

	<div id="main" class="centr container" style="text-align:left;">
		
		<div id="left_panel" style=" display:inline-block; vertical-align:top;">
			
			<div id="user_details" style="padding:10px; background-color:#C0C0C0; border-radius:8px;">
					
					<div id="user_image" style="margin-bottom:10px;">
							
							<img src="https://graph.facebook.com/<?php echo $facebook->fb_image($username); ?>/picture?height=199&width=179" style="text-align:center; overflow:hidden;">
<!--<img src="contents/images/users/<?php echo $user_fullname;?>.jpg" id="profile_pic" height="0px" style="">
-->
					</div>


					<div style=" line-height:1.4em;">
						<div>
							<strong>
								<?php 
								echo $user_fullname; 
								?>
							</strong>
						</div>
					
						<div style="font-size: 85%;">
							<?php 
							echo $user_d->profession; 
							?>
						</div>

						<div style="font-size: 85%;">
							<?php 
							echo '"'.$user_d->quote.'"'; ?>
						</div>
					</div>

			</div>

			<div style="color:black; margin-top:20px; background-color:#C0C0C0; padding:8px 16px; border-radius:8px;">
				<script type="text/javascript">

				function changemo(val)
				{
					document.getElementById('butt').innerHTML="Unfollow";
	
				}

				function changemt(val)
				{
	
					document.getElementById('butt').innerHTML="Following";
	
				}

				</script>

				<?php
//echo ($follow->following_that_person($_SESSION['uid'],$username))? 'true':'false';
				if(!$follow->following_that_person($_SESSION['uid'],$username))
				{

					echo '<form action="follow.php" method="post">';
					echo '<div class="panel_tabs" id="follow" data-name="'.$user_d->fn.'">';
					echo '<input type="hidden" name="callback" value="'.urlencode($_SERVER["REQUEST_URI"]).'"><button  id="butt" type="submit" value="'.$_SESSION["uid"]."_".$username.'" name="follow" style=" width:100%; border:none; background:transparent; cursor:pointer">Follow '.$user_d->fn.'</button></div></form>';      

				}

				else
				{
					echo '<form action="follow.php" method="post">';
					echo '<div class="panel_tabs" id="follow" onMouseOver="changemo(this)" onMouseOut="changemt(this)" data-name="'.$user_d->fn.'">';
					echo '<input type="hidden" name="callback" value="'.urlencode($_SERVER["REQUEST_URI"]).'"><button type="submit" id="butt" value="'.$_SESSION["uid"]."_".$username.'" name="unfollow" style=" width:100%; border:none; background:transparent; cursor:pointer">Following</button></div></form>';               
	
				}
				
					

				?>


				<form onClick="get_inks_to_complete()" style="color:black; cursor:pointer;">
					
						<div class="panel_tabs">Inks to accomplish <strong>(<?php $inks=$activity->get_sketch_private($username); echo $inks->rows;?>)</strong>
						</div>
				
				</form>




				<form onClick="get_completed_inks()" id="accomplished" type="submit" style="color:black; cursor:pointer;">
				
						<div  class="panel_tabs">Accomplished Inks <strong>(<?php $inks=$activity->get_completed_inks_private($username); echo $inks->rows;?>)</strong>
						</div>

				</form>


				<form  onClick="show_follow(this)" data-user="<?php echo $username;?>" style="color:black; cursor:pointer;">
						
						<div class="panel_tabs">Following/Followers<strong>(<?php  echo ($follow->all_i_follow($username))?count($follow->all_i_follow($username)):'0' ?>/<?php echo ($follow->all_who_follow_me($username))? count($follow->all_who_follow_me($username)):'0' ?>)</strong>
						</div>
				
				</form>


				<a style="color:black; cursor:pointer;">
				
					<div class="panel_tabs">Updates &beta; phase
					</div>
				
				</a>


			</div>

		</div><!--left panel closed-->



		<div id="center_panel" style="display: inline-block ; width:500px;">

				<div id="section_ajax">
					
						<?php  $inks=$activity->get_sketch_private($username);
						echo '<div id="inks" style="text-align:left; margin-left:40px; margin-top:40px;"><h3>';
						echo  $user_d->fn.' has ';
						
						if($inks->rows==0)
						{
							echo 'no INKs to complete.</h3></div>'; 
							goto end_section;
						}
						
						else 
							echo ($inks->rows==1)?$inks->rows.' Ink to complete</h3></div>':$inks->rows.' Inks to complete</h3></div>';

						foreach($inks->inks as $ink): 


						?>
						
						<div class="wrapper">
								<article class="ink_display">

										<div class="ink_pic_section">
													<div class="inline">
															<img src="contents/images/ink_it_blue.png" class="ink_image" height="50" width="50" style="vertical-align:middle;">

															<div class="ink_details">
																<a href="<?php echo 'ink.php?act='.urlencode($ink['activity'])?>"><?php echo $ink['activity']?></a>
															</div>

															
															<div class='addedat timeago'>
																added at:
																<?php 
																echo date("H:i \H\R\S,jS F,Y",strtotime($ink['ta']));
																?>
															</div>

													</div>
										</div>

										<?php
//date difference for percentage to show on bar
										$time_total_given_by_user=(date("U",strtotime($ink['time_alloted']))-date("U",strtotime($ink['ta'])));
										$time_left=(date("U",strtotime($ink['time_alloted']))-time());
										$time_percentage=($time_left*100/($time_total_given_by_user));
										?>
						
										<div style="height:5%;">
												<div class="time_to_finish inline" style="position:relative; border:#000066 4px;" id="<?php echo strtotime($ink['ta'])?>">
												<?php 
												if(strtotime($ink['time_alloted'])<1)
												echo 'Some INKs take more than just time.';

												else if((time()-strtotime($ink['time_alloted']))<0)
												echo '
												<script type="text/javascript">
												var timerId =
												countdown('.strtotime($ink["time_alloted"])."000".'
												,
											    function(ts) {
												if('.strtotime($ink["time_alloted"]).'000>(new Date().getTime()))
											    document.getElementById('.strtotime($ink['ta']).').innerHTML = ts.toHTML()+" to accomplish.";
												else document.getElementById('.strtotime($ink['ta']).').innerHTML = "Time Lapsed!";
											    },
											    countdown.MONTHS|countdown.DAYS|countdown.HOURS|countdown.MINUTES);
												</script>';

												else echo 'Time Lapsed!';

												?>
										
												</div>

												<div style="display:none;">
													<div class="inline">
														<button type="submit" value="edit" style="width:35px; font-size:55%; background:none; border: 2px thick #FFFFFF;">
															EDIT
														</button>
													</div>

													<div class="inline">
														<button type="submit" value="delete" style="width:50px; font-size:55%; background:none; border: 2px thick #FFFFFF;">
															DELETE
														</button>
													</div>
												</div>
										</div>


										<div style="margin-top:10px;">
											
												<div style="text-align:left;">
											
														<div class="inline">
															<img src="contents/images/support.png" height="15">
														</div>
												
														<div class="inline" style="vertical-align: top">
															<span class="support" onClick="vote(this)" data-id="<?php echo $ink['act']; ?>" data-name="<?php echo urlencode($ink['activity']); ?>" title="click to support this activity">
															<?php 
															echo $vote->check($ink['act'])?"Unsupport":"Support"; 
															?>
															</span>
												
															<?php
															$vote_count=$vote->cnt($ink['act']);
															$ink_value=$ink['act']."_".$ink['activity'];
		
															echo "<span class='support' onClick='get_voters(".'"'.$ink_value.'"'.")'>";
															if($vote_count!=0)
															{
																if($vote->check($ink['act']))
																{
																	if($vote_count==1)
																	{
			//	echo "<span 	class='support' onCl	ick='get_voters(".'"'.$ink_value.'"'.")'>: You.</span>";
																		echo ' : You.';
																	}
																	elseif($vote_count==2)
			//	echo "<span class='support' 	onClick='get_voters(".'"'.$ink_value.'"'.")'>: You and 1 other.</span>";
																		echo " : You and 1 other.";
															
																	elseif($vote_count>2)
			//echo "<span class='support' onClick='get_voters(".'"'.$ink_value.'"'.")'>: You and ".($vote_count-1)." others.</span>";
																		echo ' : You and '.($vote_count-1).' others.';
																}

																else
																{
																	if($vote_count==1)
			//	echo "<span class='support' onClick=		'get_voters(".'"'.$ink_value.'"'.")'>: 1 other.</span>";
																		echo ' : 1 other.';
															
																	else
			//	echo "<span class='support' onClick='get_voters(".'"'.$ink_value.'"'.")'>:".$vote_count." others</span>";
																		echo ' :'.$vote_count.'others.';
	
																}
															}
															echo '</span>'
															?>
	
													</div>
												</div>

									
												<div class="inline" onClick="load_content('<?php echo $ink['act'].'_'.urlencode($ink['activity']); ?>')">
											
											
													<div class="inline">
															<img src="contents/images/remarks.png" height="15">
													</div>
					
													<div class="remarks inline" style="vertical-align: top">
					
														<?php 
															echo $comments->count_comm($ink['act'])?($comments->count_comm($ink['act'])? ' Remarks:'.$comments->count_comm($ink['act']):'Remarks, Add One'):'No Remarks, Add One';
														?> 
						
													</div>
												</div>
							
							
									</div>

							<div>
														
								<div class="inline">
										<img src="contents/images/me2.png" height="15">
								</div>
										
								
								<div class="metoo inline" onClick="meetoo('<?php echo $ink['activity'] ?>')" class="inline ihavecompleted">
									Mee Too!!
								</div>
														
							</div>






</article>

</div>
<?php endforeach;?>

<?php end_section:?>
</div>
</div>

<!--completed-->
<div id="right_panel" style=" color:#FFF;" class="inline">
<div style="padding:10px 15px;">
<h2 style="text-align:center;">| Ask Yourself |</h2>
<p>    What have you always wanted to do but have not done yet?</p>
<p>    What will you do if you have unlimited time, money and resources?</p>
<p>    What are your biggest goals and dreams?</p>
   <p> What achievements do you want to have?</p>
    <p>What experiences do you want to have / feel?</p>
    <p>Are there any special moments you want to witness?</p>
    <p>What activities or skills do you want to learn or try out?</p>
    <p>What are the most important things you can ever do?</p>
    <p>What do you need to do to lead a life of the greatest meaning?</p>
<p>What if you were to die tomorrow? What would you wish you could do before you die?</p>

</div>
</div>
</div>



<footer>
<?php include("footer.php")?>
</footer>
<script src="contents/scripts/js/jquery.reveal.js"></script>

<div id='show_more_oversurface'>

</div> 

<div id='show_more_oversurface_meetoo'>
<div id="heading">
		Adding : <span id="new_ink_name"></span>
	</div>

	<div id="content">
		<form action="process_sketch.php" method="post">
<div>

<input type="hidden" readonly  id="new_ink" value="" name="new_ink">
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

<script type="text/javascript">

$('#selectedDateTime').datetimepicker({
	minDate: new Date(<?php echo date("Y,m-1,d,H,i");?>),//2010, 11, 20, 8, 30),
	maxDate: new Date(<?php $future=time()+60*60*24*5000 ;echo date("Y,m-1,d,H,i",$future);?>)//2010, 11, 31, 17, 30)
});



</script>


</body>
</html>