<?php


require_once('contents/includes/config_class.php');
require_once('contents/includes/session_class.php');
require_once('contents/includes/user_class.php');
require_once('contents/includes/activity_class.php');
require_once("contents/includes/vote_class.php");
include("contents/includes/comment_class.php");
require_once("contents/includes/sanitize_text.php");
require_once('contents/includes/get_fb_id.php');
require_once("contents/includes/following_class.php");

date_default_timezone_set("Asia/Kolkata");
$session->check_login();
if(!$session->is_logged_in())
{
	header("location:index.php");
}

$details=new User;
$details=$user->user_details($_SESSION['uid']);
$date= date_create($details->birth);
//creating hashing for comment deletion

?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
		<?php include("contents/includes/age.php");?>
		<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow|Nunito:300|Cantarell' rel='stylesheet' type='text/css'><link href="contents/styles/profile.css" type="text/css" rel="stylesheet">
		<link rel="shortcut icon" href="contents/images/favicon.ico">

		<script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-38503967-1']);
  		  _gaq.push(['_trackPageview']);

  		  function() 
  		  {
    	  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
   		  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
  		  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
 		  })();

		</script>
	

<script type="text/javascript">

		function show_more()
{
	console.log("here");
	//$('#lots_of_bksp').hide('1000');
	$("#popup_ink").fadeIn('slow').css("display","inline-block");
	document.getElementById("lots_of_bksp").className="hidden";
	//$('#popup_ink').show('1000');
	//document.getElementById("popup_ink").style.direction="inline-block";
	
	
}

function show_less()
{
	console.log("here");
	if(!document.getElementById("new_ink").value)
	{
		$("#popup_ink").fadeOut('slow').css("display","none");
		//document.getElementById("popup_ink").className="hidden";
		document.getElementById("lots_of_bksp").className="show";
	}
}

function select_from_suggested(val)
{
	document.getElementById("new_ink").value=val.firstChild.innerHTML;
	document.getElementById("auto_help").className="hidden";
	
	
}

function change_bg_color(val)
{
	if(val.className=="pointed")
	val.className="";
	else
	val.className="pointed";
	
}

function show_completed_button(val)
{
	val.style.display="inline-block";
	
}

function changetextr(val)
{
val.innerHTML="<img src='contents/images/done.png' height='15'> Report Completion?";
}

function changetexti(val)
{
val.innerHTML="<img src='contents/images/time_left.png' height='15'> INK in progress!";
}


function ajaxcall(str)
{
	
var xmlhttp;
if (str.length==0)
  {
  document.getElementById("auto_fill").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		
    document.getElementById("auto_fill").innerHTML=xmlhttp.responseText;
    }
	
  }
  
xmlhttp.open("GET","autocomplete_call.php?search="+str,true);
xmlhttp.send();


}



//date vali bakchodi
window.onload=function(){ new CountUp('<?php  echo date_format($date,'F d, Y H:i:s'); ?>', 'counter'); }

//appending autofill
</script>

<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.16/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.16/themes/hot-sneaks/jquery-ui.css" />
<script src="contents/jQuery-Timepicker-Addon-master/jquery-ui-timepicker-addon.js"></script>
<script src="contents/scripts/js/coundown-min.js"></script>
<script src="contents/scripts/js/timeago.js"></script>
<script src="contents/scripts/ajax/usage_test.js"></script>
<style type="text/css">
.ui-timepicker-div .ui-widget-header{ margin-bottom: 8px; }
.ui-timepicker-div dl{ text-align: left; }
.ui-timepicker-div dl dt{ height: 25px; }
.ui-timepicker-div dl dd{ margin: -25px 0 10px 65px; }
.ui-timepicker-div td { font-size: 90%;}

</style>

<title>startINK</title>
</head>
<body>


<!--header starts-->
<?php include("contents/includes/header.php"); ob_get_contents();?>
<!--header ends-->



<div id="main" class="centr container" style="text-align:left;">
<div id="left_panel" style=" display:inline-block; vertical-align:top;">

<div id="user_details" style="padding:10px; background-color:#C0C0C0; border-radius:8px;">
<div id="user_image" style="margin-bottom:10px;">
<img src="https://graph.facebook.com/<?php echo $facebook->fb_image($_SESSION['uid']); ?>/picture?height=199&width=179" style= "text-align:center; overflow:hidden;">
<!--<img src="contents/images/users/<?php echo $_SESSION['uid']; ?>.jpg" id="profile_pic" height="0px" style="">
	https://graph.facebook.com/<?php echo $facebook->fb_image($_SESSION['uid']); ?>/picture?height=199&width=179
--></div>

<div style=" line-height:1.4em;">
<div><strong><?php echo $details->fn; ?></strong></div>
<div style="font-size: 85%;"><?php echo $details->profession; ?></div>
<div style="font-size: 85%;"><?php echo '"'.$details->quote.'"'; ?></div>
</div>

</div>

<div style="color:black; margin-top:20px; background-color:#C0C0C0; padding:8px 16px; border-radius:8px;">

<form onClick="get_inks_to_complete()" style="color:black; cursor:pointer;">
<div class="panel_tabs">Inks to accomplish <strong>(<?php $inks=$activity->get_sketch($_SESSION['uid']); echo $inks->rows;?>)</strong>
</div>
</form>



<form onClick="get_completed_inks()" id="accomplished" type="submit" style="color:black; cursor:pointer;">
<div  class="panel_tabs">Accomplished Inks <strong>(<?php $inks=$activity->get_completed_inks($_SESSION['uid']); echo $inks->rows;?>)</strong>
</div>
</form>


<form  onClick="show_follow(this)"  style="color:black; cursor:pointer;">
<div class="panel_tabs">Following/Followers<strong>(<?php  echo ($follow->all_i_follow($_SESSION['uid']))? count($follow->all_i_follow($_SESSION['uid'])): '0'  ?>/<?php echo ($follow->all_who_follow_me($_SESSION['uid']))? count($follow->all_who_follow_me($_SESSION['uid'])) : '0' ?>)</strong>
</div>
</form>

<a style="color:black; cursor:pointer;">
<div class="panel_tabs">Updates &beta; phase
</div>
</a>



</div>

</div><!--left panel closed-->



<div id="center_panel" style="display: inline-block ; width:500px;">

      <div style="text-align:center; margin-left:0px; height:90px;">
    		  <form action="process_sketch.php" method="post">
    		  <div style="margin:10px;">

        		  <div>
        			  <input class="fields" type="text"  id="new_ink" name="new_ink" onKeyUp="ajaxcall(this.value)" onFocus="show_more()" onBlur="show_less()" autocomplete="off" placeholder="Got something new to do?" size="60" maxlength="100">
        			  <div id="auto_fill" class="" style="color:#33FF33;">
			          </div>
        		  </div>
				  <br>
        		 
        		  <div id="lots_of_bksp" class="show">
        	 		 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        		  </div>
        
        		  <div id="popup_ink" class="hidden">
        			  <input type="text" size="39" id="selectedDateTime" name="selectedDateTime" placeholder="Date before U intend to finish it(optional)" class="fields"  />
        		  </div>

				  <div style="display:inline-block;">
						<span title="Private Inks will not be shown to public">
							PRIVATE:<input type="checkbox" name="private">
						</span>
						<input type="submit" value="INK IT!" style="width:60px; height:30px" onClick="popup_details()">
				  </div>
		 	  </div>
			  </form>
	  </div>

	  <div id="section_ajax">
		  <?php 

			echo '<div style="text-align:left; margin-left:40px; margin-top:20px;">';
			$inks=$activity->get_sketch($_SESSION['uid']);
			echo '<h3>You have ';
			
			if($inks->rows==0) 
			{
				echo 'no INKs to accomplish. Add one!</h3></div>'; goto end_section;
			}
			else 
				echo ($inks->rows==1)?$inks->rows.' Ink to accomplish</h3></div>':$inks->rows.' Inks to accomplish</h3></div>';


			foreach($inks->inks as $ink): ob_get_contents(); 
		  ?>

<div class="wrapper">
	<article class="ink_display <?php if(strtotime($ink['time_alloted'])<1) ; else if((time()-strtotime($ink['time_alloted']))>0) echo 'ink_display1'; ?> ">
		
		<a href="#<?php echo $ink['act'] ?>">
		</a>

		
		<div class="ink_pic_section">
			
			<div class="inline" style="vertical-align: top">
				<img src="contents/images/ink_it_blue.png" class="ink_image" height="50" width="50" style="vertical-align:middle;">
			</div>

			<div class="inline">
				<div class="ink_details">
					<a href="<?php echo 'ink.php?act='.urlencode($ink['activity'])?>"><?php echo $ink['activity'];?></a>
					<?php 
					if($ink['private']==='on') 
					echo '<span style="font-size:55%;">(private INK)</span>';
					?>
				</div>
				
				<div class="inline" style="vertical-align: top">
					<form method="post" action="process_del.php">
						<input type="hidden" value="<?php echo $ink['act']?>" name="act">
							<button class="delete_button" onClick="confirm_del()"  title="delete this INK" type="submit" style="cursor:pointer;">
								<strong>X</strong>
							</button>
					</form>
				</div>
				
			</div>
			
			<div class='addedat' style="display: inline-block"> 
					added at: 
					<?php 
					echo date("H:i \H\R\S,jS F,Y",strtotime($ink['ta']));
					?>
			</div>
		
		</div>

	
		<div style="height:5%; margin-top: 5px; margin-bottom: 5px;">
				
				<div class="time_to_finish inline" style="position:relative; border:#000066 4px;" id="<?php echo strtotime($ink['ta'])?>">
					<?php 

					if(strtotime($ink['time_alloted'])<1)
						echo 'Some INKs take more than just time.';

					else if((time()-strtotime($ink['time_alloted']))<0)
						echo '<script type="text/javascript">
						var timerId =
						countdown('.strtotime($ink["time_alloted"])."000".'
				    	,
    					function(ts) {
						if('.strtotime($ink["time_alloted"]).'000>(new Date().getTime()))
      					document.getElementById('.strtotime($ink['ta']).').innerHTML =" Time Left: "+ts.toHTML();
	 						else document.getElementById('.strtotime($ink['ta']).').innerHTML = "Time Lapsed!";
					      },
    					countdown.MONTHS|countdown.DAYS|countdown.HOURS|countdown.MINUTES|countdown.SECONDS);
 						</script>';

					else 
						echo 'Time Lapsed!';

					?>
				</div>

			<div class="inline" style="float: right; display: none	">
					<div class="inline">
							<button class="delete_button" type="submit" value="edit" title="edit timer">
								edit
							</button>
					</div>
					
					<div class="inline">
							<button class="delete_button" type="submit" value="delete" title="delete timer">
								delete
							</button>
					</div>
			</div>
			
			
		</div>
 

		<div >
				<div style="text-align:left;">
					<div class="inline">
						<img src="contents/images/support.png" height="15">
					</div>
					
					<div class="inline" style="vertical-align: top">
						Support
					</div>

					<div class="inline" style="vertical-align: top">
					<?php  
					$ink_value=$ink['act']."_".$ink['activity'];
					if($vote->cnt($ink['act']))
						echo "<span onClick='get_voters(".'"'.$ink_value.'"'.")'>: ".$vote->cnt($ink['act'])." Inkers</span>";

					?>
					</div>

				</div>

				
				<div onClick="load_content('<?php echo $ink['act'].'_'.urlencode($ink['activity']); ?>')">
			
					<div class="inline">
						<img src="contents/images/remarks.png" height="15">
					</div>
					
					<div class="support_remarks inline" style="vertical-align: top">
						<?php 
							echo $comments->count_comm($ink['act'])?($comments->count_comm($ink['act'])? ' Remarks:'.$comments->count_comm($ink['act']):'Remarks, Add One'):'No Remarks, Add One';
						?>
					</div>
					 
				</div>
		

				<a href="ink_completed.php?<?php echo 'act='.$ink['act'].'&ink='.urlencode($ink['activity']); ?>">
					<div class="ihavecompleted" onMouseOver="changetextr(this)" onMouseOut="changetexti(this)">
						<div class="inline">
							<img src="contents/images/time_left.png" height="15">
						</div>
						
						<div class="inline" style="vertical-align: top">
							INK in progress!
						</div>
			
					</div>
				</a>

		</div>

	</article>

</div>

<?php 
endforeach;
?>


<?php 
end_section:
?>
</div>
</div>



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
</div>



<footer>
	<?php 
	include("footer.php")
	?>
</footer>


<script type="text/javascript">

	$('#selectedDateTime').datetimepicker({
		minDate: new Date(<?php echo date("Y,m-1,d,H,i");?>),//2010, 11, 20, 8, 30),
		maxDate: new Date(<?php $future=time()+60*60*24*5000 ;echo date("Y,m-1,d,H,i",$future);?>)//2010, 11, 31, 17, 30)
	});

	jQuery(document).ready(function() {
	  jQuery("div.timeago").timeago();
	});

</script>

<div id='show_more_oversurface'>
	displaying over text;
</div> 

<script src="contents/scripts/js/jquery.reveal.js">
	
</script>


</body>
</html>