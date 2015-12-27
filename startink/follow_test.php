<?php

require_once('contents/includes/config_class.php');
require_once('contents/includes/session_class.php');
require_once('contents/includes/user_class.php');
require_once('contents/includes/get_fb_id.php');
require_once('contents/includes/following_class.php');

$session->check_login();
if(!$session->is_logged_in())
	{echo 'error'; exit();}


?>

<div style="margin-top:30px;">
<h2><?php echo 'You Follow'; ?></h2><?php $all_i_follow=$follow->all_i_follow($_SESSION['uid']);

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
<h2>Inkers Who Follow You:</h2> <?php $all_who_follow_me=$follow->all_who_follow_me($_SESSION['uid']); 
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
