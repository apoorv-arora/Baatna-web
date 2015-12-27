<?php
require_once('contents/includes/config_class.php');
require_once('contents/includes/session_class.php');
require_once('contents/includes/sanitize_text.php');
require_once('contents/includes/comment_class.php');
require_once('contents/includes/get_fb_id.php');
require_once('contents/includes/user_class.php');

$session->check_login();
if(!$session->is_logged_in())
	header("location:index.php");
	
	try{
		
	if($session->is_logged_in() && !empty($_POST['comment']))
	{
		
		//echo "here";
		$_POST['comment']=$sanitize->san($_POST['comment']);
		if(!empty($_POST['comment']))
		
		
		$comments->add_comm();
		
	
		
	}
	
	/*if(isset($_GET['callback']) && !empty($_GET['callback']))
	{
		//echo urldecode($_GET['callback']);
			header("location:".urldecode($_GET['callback']));
			
	}
	
	else {
		
	skip_insertion_part:

    header("location:profile_page.php");
	}
	*/
}

	
	catch(Exception $e)
	{
		echo "Error";
		$con->rollback();
		
	}
?>

	<div id="<?php echo $new_comment_id=$comments->cid_comm($_POST['comment']); ?>" style="vertical-align: top;">

			<div class="inline" style="text-decoration:none;  vertical-align:top">	
				<a href="user.php?user=<?php echo $_SESSION['uid'];?>" style="color:black;">
        			<img src="https://graph.facebook.com/<?php echo $facebook->fb_image($_SESSION['uid']);?>/picture?height=20&width=25" style="vertical-align:middle;">
	    		</a>
			</div>	
		
			
			<div class="inline" style="font-weight: bold;  vertical-align:top">
				<a href="user.php?user=<?php echo $_SESSION['uid'];?>" style="color:black;">	
					<?php 
						echo $user->user_details($_SESSION['uid'])->fn ; 
					?>
				</a>
			</div>
  
		
		<div class="inline" style="height: auto;">: <?php echo $_POST['comment'];?></div>
        
        <?php 
			echo '<div class="inline" style="float:right; z-index:100;">'; 
			echo '<button class="delete_button" type="submit" title="Delete Remark" onClick="del_remark('.$new_comment_id.')">x</button>';
			echo '</div>';
		?>
	
		<div style="font-size:75%; margin-left: 35px; color: #999;">
			<?php 
				echo 'added at: '.date("H:i \H\R\S,jS F,Y",time()).'</div><hr>';

echo '</div>';




