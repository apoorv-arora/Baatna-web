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
<link href="contents/styles/profile.css" type="text/css" rel="stylesheet">
<link rel="shortcut icon" href="contents/images/favicon.ico">
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

<style type="text/css">
.ui-timepicker-div .ui-widget-header{ margin-bottom: 8px; }
.ui-timepicker-div dl{ text-align: left; }
.ui-timepicker-div dl dt{ height: 25px; }
.ui-timepicker-div dl dd{ margin: -25px 0 10px 65px; }
.ui-timepicker-div td { font-size: 90%; }
</style>

<title>Home Page</title>
</head>
<body>


<!--header starts-->
<?php include("contents/includes/header.php");?>
<!--header ends-->



<div id="main" class="centr container" style="text-align:left;">
<div id="left_panel" style=" display:inline-block; vertical-align:top;">

<div id="user_details" style="padding:10px; background-color:#C0C0C0; border-radius:8px;">
<div id="user_image" style="margin-bottom:10px;">
<img src="https://graph.facebook.com/<?php echo $facebook->fb_image($_SESSION['uid']); ?>/picture?height=199&width=179" style="text-align:center; overflow:hidden;">
<!--<img src="contents/images/users/<?php echo $_SESSION['uid']; ?>.jpg" id="profile_pic" height="0px" style="">
--></div>

<div style=" line-height:1.4em;">
<div><strong><?php echo $details->fn; ?></strong></div>
<div><?php echo $details->profession; ?></div>
<div><?php echo '"'.$details->quote.'"'; ?></div>
</div>

</div>

<div style="color:black; margin-top:20px; background-color:#C0C0C0; padding:8px 16px; border-radius:8px;">

<a  href="profile_page.php" style="color:black; cursor:pointer;">
<div class="panel_tabs">Inks to complete <strong>(<?php $inks=$activity->get_sketch($_SESSION['uid']); echo $inks->rows;?>)</strong>

</div>
</a>
<a href="completed.php" style="color:black; cursor:pointer;">
<div  class="panel_tabs">Accomplished Inks <strong>(<?php $inks=$activity->get_completed_inks($_SESSION['uid']); echo $inks->rows;?>)</strong>
</div>
</a>

<a  href="follows.php?user=<?php echo $_SESSION['uid']?>"style="color:black; cursor:pointer;">
<div class="panel_tabs">Following/Followers<strong>(<?php  echo count($follow->all_i_follow($_SESSION['uid'])) ?>/<?php echo count($follow->all_who_follow_me($_SESSION['uid'])) ?>)</strong>
</div>
</a>

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
<div id="auto_fill" class="" style="color:#33FF33;"></div>
</div>
<br>
<div id="lots_of_bksp" class="show">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>
<div id="popup_ink" class="hidden">
<input type="text" size="39" id="selectedDateTime" name="selectedDateTime" placeholder="Date before U intend to finish it(optional)" class="fields"  />
</div>

<div style="display:inline-block;">
<span title="Priveate Inks will not be shown to public">PRIVATE:<input type="checkbox" name="private"></span>
<input type="submit" value="INK IT!" style="width:60px; height:30px" onClick="popup_details()">
</div>
</div>

</form>
</div>

<?php 

echo '<div style="text-align:left; margin-left:40px; margin-top:20px;">';
$inks=$activity->get_completed_inks($_SESSION['uid']);
echo '<h3>You have ';
if($inks->rows==0) {echo 'no INK. Add one!</h3></div>'; goto end_section;}
else echo ($inks->rows==1)?$inks->rows.' Ink  to complete</h3></div>':$inks->rows.' Inks to complete</h3></div>';



foreach($inks->inks as $ink): ?>
<div class="wrapper">
<article class="ink_display">

<div>
<span style="display:inline-block; float:right">
<form method="post" action="process_del.php">
<input type="hidden" value="<?php echo $ink['act']?>" name="act">
<button class="delete_button" onClick="confirm_del()"  title="click to delete this INK" type="submit" style="cursor:pointer;">
<img  src="contents/images/delete_bones.png" value="Del">
</button>
</form>
</span>
</div>

<div class="ink_pic_section">
<div class="inline" style="">

<img src="contents/images/ink_it_blue.png" class="ink_image" height="50" width="50" style="vertical-align:middle;">

<div class="ink_details">

<a href="<?php echo 'ink.php?act='.urlencode($ink['activity'])?>"><?php echo $ink['activity']?></a>

</div>

<div class='addedat timeago'><?php echo date("H:i \H\R\S,jS F,Y",strtotime($ink['ta']));?></div>

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
echo 'Reported Completion: '.date("H:i \H\R\S,jS F,Y",strtotime($ink['tc']));
?>
</div>
<div style="display:none;">
<div class="inline">
<button type="submit" value="edit" style="width:35px; font-size:55%; background:none; border: 2px thick #FFFFFF;">EDIT</button>
</div>
<div class="inline">
<button type="submit" value="delete" style="width:50px; font-size:55%; background:none; border: 2px thick #FFFFFF;">DELETE</button>
</div>
</div>
</div>

<div>
<div class="inline support_remarks" style="text-align:center; margin-top:15px; border-radius:10px;" onClick="load_content('<?php echo $ink['act'].'_'.urlencode($ink['activity']); ?>')">
<div class="table_alin">
<span style="text-align:left;"><?php echo $vote->cnt($ink['act'])?$vote->cnt($ink['act']).' INKers In Support': "Support Section" ;?></span>
</div>
<div style="height:1px; width:140px; background-color:#000;"></div>
<div class="table_alin">
<?php echo $comments->count_comm($ink['act'])?($comments->count_comm($ink['act'])? ' Remarks:'.$comments->count_comm($ink['act']):'No Remarks, Add One'):'No Remarks, Add One';?> 
</div>
</div>
<div style="width:1px; height:36px; vertical-align:bottom; margin-top:15px; background-color:#000;" class="inline">
</div>



</div>
<div>

<div id="add_comment" style="display:none;">
<form method="post" action="add_comment.php?callback=<?php echo urlencode($_SERVER['REQUEST_URI'])?>">
<textarea id="comment_section" class="fields" placeholder="Write Your Comment" cols="50" rows="1" name="comment" style="resize:none; line-height:1em; font-size:1.1em;">
</textarea>
<input type="hidden" value="<?php echo $ink['act'];?>" name="activity">
<input type="hidden" value="<?php echo rand(1000000000,9999999999999)?>" name="token">
<input type="submit" value="Splash a thought!">
</form>
</div>

<div id="show_comments" style="display:none;">
<?php 

$all_comments=$comments->show_comm($ink['act']);  
//print_r($all_comments);

if(!is_null($all_comments))
{
foreach($all_comments as $all_comments)
{
echo "<br>";
		echo '<a href="user.php?user='.$all_comments['uid'].'">'.$all_comments['name'].'</a>'.":";
		echo $all_comments['comment']."<br>";
		echo 'Added at: '.date("H:i \H\R\S,jS F,Y",strtotime($all_comments['ta']));
		echo "<br>";
//if($_SESSION['uid']==$all_comments['uid'])
{
	echo '<form  method="post" action="del_comment.php?callback='.urlencode($_SERVER['REQUEST_URI']).'">'; 
    echo '<input type="hidden" name="del_comment" value="'.$all_comments['id'].'">';
	echo '<input type="submit" value="DEL INK">';
	echo '</form>';
}
}
}
?>
</div>

</div>


</article>
<hr>
</div>
<?php endforeach; end_section:?>

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





<footer>
<?php include("footer.php")?>

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
<script src="contents/scripts/js/jquery.reveal.js"></script>

<script type="text/javascript">

function load_content(ink_value)
{
	var xmlhttp;

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
		
    document.getElementById("show_more_oversurface").innerHTML=xmlhttp.responseText;
	call();
    }
  }
  
xmlhttp.open("GET","get_content_ajax.php?id_value="+ink_value,true);
xmlhttp.send();

	
	
}
	function call(){
		 // Button which will activate our modal
			   	$('#show_more_oversurface').reveal({ // The item which will be opened with reveal
				  	animation: 'fade',                   // fade, fadeAndPop, none
					animationspeed: 300,                       // how fast animtions are
					closeonbackgroundclick: true,              // if you click background will modal close?
					dismissmodalclass: 'close'    // the class of a button or element that will close an open modal
				});
			return false;

		
	}
</script>
<style type="text/css">
#show_more_oversurface {
	visibility:hidden;
	width:700px;
	height:auto;
	padding:8px;

	background:rgba(0,0,0,.3);

	-webkit-border-radius:8px;
	-moz-border-radius:8px;
	border-radius:8px;

	position:fixed !important;
	top:30% !important;
	left:35%; !important;
	margin-top:-94px !important;
	margin-left:-180px !important;
	z-index:101;
}


#heading {
	width:700px;
	height:60px;

	background-image: -webkit-linear-gradient(top, rgb(249, 249, 249), rgb(233, 233, 233));
	background-image: -moz-linear-gradient(top, rgb(249, 249, 249), rgb(233, 233, 233));
	background-image: -o-linear-gradient(top, rgb(249, 249, 249), rgb(233, 233, 233));
	background-image: -ms-linear-gradient(top, rgb(249, 249, 249), rgb(233, 233, 233));
	background-image: linear-gradient(top, rgb(249, 249, 249), rgb(233, 233, 233));
	filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0,StartColorStr='#f9f9f9', EndColorStr='#e9e9e9');

	border-bottom:1px solid #bababa;

	-webkit-box-shadow:
		inset 0px -1px 0px #fff,
		0px 1px 3px rgba(0,0,0,.08);
	-moz-box-shadow:
		inset 0px -1px 0px #fff,
		0px 1px 3px rgba(0,0,0,.08);
	box-shadow:
		inset 0px -1px 0px #fff,
		0px 1px 3px rgba(0,0,0,.08);

	-webkit-border-radius:4px 4px 0px 0px;
	-moz-border-radius:4px 4px 0px 0px;
	border-radius:4px 4px 0px 0px;

	font-size:14px;
	font-weight:bold;
	text-align:center;
	line-height:44px;

	color:#444444;
	text-shadow:0px 1px 0px #fff;
}

#content {
	width:700px;
	height:auto;

	background:#fcfcfc;

	-webkit-box-shadow:0px 1px 3px rgba(0,0,0,.25);
	-moz-box-shadow:0px 1px 3px rgba(0,0,0,.25);
	box-shadow:0px 1px 3px rgba(0,0,0,.25);

	-webkit-border-radius:0px 0px 4px 4px;
	-moz-border-radius:0px 0px 4px 4px;
	border-radius:0px 0px 4px 4px;
}

#content p {
	font-size:13px;
	font-weight:normal;
	text-align:center;
	line-height:22px;
	color:#555555;

	width:100%;
	float: left;

	margin:19px 0;
}

.reveal-modal-bg { 
	position: fixed; 
	height: 100%;
	width: 100%;
	background: #000;
	background: rgba(0,0,0,.4);
	z-index: 100;
	display: none;
	top: 0;
	left: 0; 
}


</style>



</body>
</html>