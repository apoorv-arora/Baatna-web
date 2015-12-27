<?php

require_once('contents/includes/config_class.php');
require_once('contents/includes/session_class.php');
require_once('contents/includes/user_class.php');
require_once('contents/includes/get_fb_id.php');
require_once('contents/includes/following_class.php');

$session->check_login();
if(!$session->is_logged_in())
	header("location:index.php");

if($user->user_details($_GET['user'])==NULL)
exit();
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

}

else exit(0);

$details=new User;
$details=$user->user_details($username);
$date= date_create($details->birth);


?>

<div style="margin-top:30px;">
<h2><?php echo $user->user_details($username)->fn.' Follows'; ?></h2><?php $all_i_follow=$follow->all_i_follow($username);

if(count($all_i_follow)!=0)
foreach($all_i_follow as $a):

$user_detail_obj=$user->user_details($a['fid']);
	echo '<a href="user.php?user='.$a['fid'].'" title="'.$user_detail_obj->quote.'"><div style=" margin:5px 10px; display:inline-block;"><div><img src="https://graph.facebook.com/'.$facebook->fb_image($a['fid']).'/picture?" style="text-align:center;">';    

echo '</div><div>'.$user_detail_obj->fn.'</div></div></a>';
endforeach;

else
echo 'none as of now';
?>
</div>
<div style="margin-bottom:50px;">

</div>
<div>
<h2>Inkers Who Follow <?php  echo $user->user_details($username)->fn;  ?></h2> <?php $all_who_follow_me=$follow->all_who_follow_me($username); 
if($all_who_follow_me!=0)
foreach($all_who_follow_me as $a):
if($a['uid']==$username)
{ echo 'none as of now';continue;
}
	$user_detail_obj=$user->user_details($a['uid']);
	echo '<a href="user.php?user='.$a['uid'].'" title="'.$user_detail_obj->quote.'"><div style=" margin:5px 10px; display:inline-block;"><div><img src="https://graph.facebook.com/'.$facebook->fb_image($a['uid']).'/picture?height=50&width=60" style="text-align:center; overflow:hidden;">
';

echo '</div><div>'.$user_detail_obj->fn.'</div></div></a>';
endforeach;

else
echo 'none as of now';




?>
</div>
