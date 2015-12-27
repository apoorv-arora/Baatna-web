<?php

require_once('contents/includes/config_class.php');
require_once('contents/includes/session_class.php');
require_once('contents/includes/vote_class.php');
require_once('contents/includes/sanitize_text.php');
$session->check_login();
if(!$session->is_logged_in())
header("location:index.php");


$aid=$_POST['vote']=$sanitize->san($_POST['vote']);
$ink=$_POST['activity']=$sanitize->san($_POST['activity']);
$vote_exists=$vote->check($_POST['vote']);

$vote_exists==0?$vote->upvote($_POST['vote']):$vote->downvote($_POST['vote']);

if(isset($_GET['callback']) && !empty($_GET['callback']))
	{
		echo 'here';
		echo urldecode($_GET['callback']);
			header("location:".urldecode($_GET['callback']));
	}
	

$vote_count=$vote->cnt($aid);
$ink_value=$aid."_".$ink;

if($vote_count!=0)
{
if($vote->check($aid))
{
	if($vote_count==1)
{
	echo "<span class='support' onClick='get_voters(".'"'.$ink_value.'"'.")'>: You.</span>";
}


elseif($vote_count==2)
	echo "<span class='support' onClick='get_voters(".'"'.$ink_value.'"'.")'>: You and 1 other.</span>";

elseif($vote_count>2)
echo "<span class='support' onClick='get_voters(".'"'.$ink_value.'"'.")'>: You and ".($vote_count-1)." others.</span>";

}

else
{
	if($vote_count==1)
	echo "<span class='support' onClick='get_voters(".'"'.$ink_value.'"'.")'>: 1 other.</span>";
else
	echo "<span class='support' onClick='get_voters(".'"'.$ink_value.'"'.")'>:".$vote_count." others</span>";

}
}
	
?>