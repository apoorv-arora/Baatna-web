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

$details=new User;
$details=$user->user_details($_SESSION['uid']);
$date= date_create($details->birth);

?>
<!doctype html>
<html>
<head>
<?php include("contents/includes/age.php");?>
<link rel="stylesheet" href="contents/styles/follow.css">
<script type="text/javascript">
window.onload=function(){ new CountUp('<?php  echo date_format($date,'F d, Y H:i:s'); ?>', 'counter'); }


</script>
<meta charset="utf-8">
<title>Following|<?php echo $user->user_details($_GET['user'])->fn.'|startINK'; ?></title>
</head>

<body>

<?php include('contents/includes/header.php'); ?>

<div style="margin-top:30px;">
<h2><?php echo ($_GET['user']==$_SESSION['uid'])? 'You Follow':$user->user_details($_GET['user'])->fn.' Follows'; ?></h2><?php $all_i_follow=$follow->all_i_follow($_GET['user']);

if(count($all_i_follow)!=0)
foreach($all_i_follow as $a):

$user_detail_obj=$user->user_details($a['fid']);
	echo '<a href="user.php?user='.$a['fid'].'" title="'.$user_detail_obj->quote.'"><div style=" margin:5px 10px; display:inline-block;"><div><img src="https://graph.facebook.com/'.$facebook->fb_image($a['fid']).'/picture?height=50&width=60" style="text-align:center; overflow:hidden;">
';

echo '</div><div>'.$user_detail_obj->fn.'</div></div></a>';
endforeach;

else
echo 'none as of now';
?>
</div>
<div style="margin-bottom:50px;">

</div>
<div>
<h2>Inkers Who Follow <?php  echo ($_GET['user']==$_SESSION['uid'])?'You': $user->user_details($_GET['user'])->fn.':';  ?></h2> <?php $all_who_follow_me=$follow->all_who_follow_me($_GET['user']); 
if($all_who_follow_me!=0)
foreach($all_who_follow_me as $a):
if($a['uid']==$_SESSION['uid'])
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
</body>
</html>