<?php 

require_once('contents/includes/config_class.php');
require_once('contents/includes/session_class.php');
require_once('contents/includes/user_class.php');
require_once('contents/includes/activity_class.php');
require_once("contents/includes/vote_class.php");
require_once("contents/includes/sanitize_text.php");
require_once('contents/includes/get_fb_id.php');



if(isset($_GET['id_value']))
{
	$session->check_login();
	if(!$session->is_logged_in())
	{
	header("location:index.php");
	}
	

	
	$obj= new Activity;
	list($obj->id,$obj->ink)=explode('_',$_GET['id_value']);
	$obj->id=$sanitize->san($obj->id);
	$obj->ink=$sanitize->san($obj->ink);
	$user_is_doing=$activity->ink_exists($obj);
	if($user_is_doing==0)
	{
	echo 'no it doesnot belong here';
	exit();
	}
	
	



}




?>

<div id="heading">
<?php echo "Votes on '".$obj->ink."'";?>
</div>
<div id="content" style="max-height:400px; overflow-y:scroll;">

<div style="margin-bottom:20px; background-color:#CCC;">
Supporting: <?php echo $vote->cnt($obj->id); ?>

</div>

<?php

$voters=$vote->get_voters_list($obj->id);
$user_details= new User;
foreach( $voters as $voter)
{
	
	$user_details=$user->user_details($voter);
	?><a href="users.php?user=<?php echo $voter; ?>">
	<div style="display:inline-block; margin:5px 8px;">
        <img src="https://graph.facebook.com/<?php echo $facebook->fb_image($voter);?>/picture?height=50&width=50" style="vertical-align:middle;">
        <div><?php echo $user_details->fn; ?></div>
    </div></a>

<?php
}
?>




</div>
