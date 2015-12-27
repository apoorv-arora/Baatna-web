<?php 

require_once('contents/includes/config_class.php');
require_once('contents/includes/session_class.php');
require_once('contents/includes/user_class.php');
require_once('contents/includes/activity_class.php');
require_once("contents/includes/vote_class.php");
include("contents/includes/comment_class.php");
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
	<?php echo $obj->ink;?>
</div>


<div id="content">

		<div style="background-color:#CCC; font-weight: bold">
			Supporting: <?php echo $vote->cnt($obj->id); ?>
			<hr />
		</div>

		
			
		<div>

				<div id="show_comments" style="max-height:400px; text-align:left; padding:4px; overflow-y: scroll">

					<?php 

						$all_comments=$comments->show_comm($obj->id);  
//print_r($all_comments);

						if(!is_null($all_comments))
						{
							foreach($all_comments as $all_comments):
					?>
		
		
						<div id="<?php echo $all_comments['id']; ?>">
		
								<div style="vertical-align: top">
				
										<div class="inline" style="text-decoration:none;  vertical-align:top">
												<a href="user.php?user=<?php echo $all_comments['uid']; ?>" style: "text-decoration: none">
    	    						   				<img src="https://graph.facebook.com/<?php echo $facebook->fb_image($all_comments['uid']);?>/picture?height=20&width=20" style="vertical-align:middle;">
												</a>
										</div>

										<div class="inline" style="font-weight: bold;  vertical-align:top">
												<a href="user.php?user=<?php echo $all_comments['uid']; ?>">
													<?php 
														echo $all_comments['name']; 
													?>
												</a>
										</div>
		
										<div class="inline" style="width: 400px; height: auto;">
											:
											<?php 
												echo $all_comments['comment'];
											?>
										</div>
    	
					    			    <?php 
											if($_SESSION['uid']==$all_comments['uid'])
											{
												echo '<div class="inline" style="float:right; z-index:100;">'; 
												echo '<button class="delete_button" type="submit" title="Delete Remark" onClick="del_remark('.$all_comments['id'].')">x</button>';
												echo '</div>';
											}
										?>
		
								</div>
				
					
								<div style="font-size:75%; margin-left: 35px; color: #999;">
									<?php 
								echo 'added at: '.date("H:i \h\r\s,jS F,Y",strtotime($all_comments['ta'])).'</div>';
								echo '<hr style:"color:#cccccc;" />';
						echo '</div>';
						endforeach;
					}
									?>
		
			</div>
	</div>

</div>


<div id="hiddenelement">
		
		<hr />
		<div class="inline" style="text-decoration:none;">
			<a href="user.php?user=<?php echo $_SESSION['uid']; ?>">
				<img src="https://graph.facebook.com/<?php echo $facebook->fb_image($_SESSION['uid']);?>/picture?height=20&width=20" style="vertical-align:middle;">
			</a>
		</div>


		<div class="inline" style="font-weight: bold;">
			<a href="user.php?user=<?php echo $_SESSION['uid']; ?>">
				<?php echo $user->user_details($_SESSION['uid'])->fn; ?>
			</a>
		</div>

        <span class="comments">:</span>

        <span id="add_comment" style=" vertical-align:middle;">
			<textarea id="comment_section" value=" " class="fields" placeholder="Write Your Comment" cols="50" rows="2" name="comment" style="resize:none; line-height:1em; font-size:1.1em; vertical-align:middle;"></textarea>
			<input type="hidden" value="<?php echo $obj->id;?>" name="activity">
			<input type="hidden" value="<?php echo rand(1000000000,9999999999999)?>" name="token">
			<input type="submit" value="Post Remark" onClick="post_remark()" style="background-color: #a52a2a; color: #fff; height: 32px; font-size: 100%; font-weight:bold; cursor: pointer;">
		</span>

</div>

