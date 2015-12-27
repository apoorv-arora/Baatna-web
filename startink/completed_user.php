<?php

if(!isset($_POST['type'])&&!isset($_POST['user']))
{
	echo 'error';
	exit();
}
require_once('contents/includes/config_class.php');
require_once('contents/includes/session_class.php');
require_once('contents/includes/user_class.php');
require_once('contents/includes/activity_class.php');
require_once("contents/includes/vote_class.php");
include("contents/includes/comment_class.php");
require_once("contents/includes/sanitize_text.php");
require_once('contents/includes/get_fb_id.php');

date_default_timezone_set("Asia/Kolkata");

$session->check_login();
if(!$session->is_logged_in())
{
	header("location:index.php");
}


$_POST['type']=$sanitize->san($_POST['type']);
$_POST['user']=$sanitize->san($_POST['user']);

$details=new User;


if($_POST['type']==='completed')
{
echo '<div id="inks" style="text-align:left; margin-left:40px; margin-top:40px;"><h3>';
$inks=$activity->get_completed_inks_private($_POST['user']);

echo '<h3>'.$user->user_details($_POST['user'])->fn.' has ';
if($inks->rows==0) {echo 'no accomplished INKs.</h3></div>'; goto end_section;}
else echo ($inks->rows==1)?'accomplished '.$inks->rows.' Ink</h3></div>':'accomplished '.$inks->rows.' Inks</h3></div>';



foreach($inks->inks as $ink): 


?>
	<div class="wrapper">
		<article class="ink_display">


			<div class="ink_pic_section">
				<div class="inline" style="">
					<img src="contents/images/ink_it_blue.png" class="ink_image" height="50" width="50" style="vertical-align:middle;">
				</div>
				
					<div class="ink_details inline">

						<a href="<?php echo 'ink.php?act='.urlencode($ink['activity'])?>">
							<?php 
							echo $ink['activity']
							?>
						</a>
					</div>

			</div>
			
			<div class="addedat">
				inked at:
				<?php 
					echo date("H:i \H\R\S,jS F,Y",strtotime($ink['ta']));
				?>
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


			<div style="margin-top:5px;">
				<div style="text-align:left;">
					<div class="inline">
						<img src="contents/images/support.png" height="15">
					</div>
					
					<div class="support inline" onClick="vote(this)" data-id="<?php echo $ink['act']; ?>" data-name="<?php echo urlencode($ink['activity']); ?>" title="click to support this activity">
						<?php 
							echo $vote->check($ink['act'])?"Unsupport":"Support"; 
						?>
					</div>
					
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
//	echo "<span class='support' onClick='get_voters(".'"'.$ink_value.'"'.")'>: You.</span>";
								echo ': You.';
							}
							
							elseif($vote_count==2)
//	echo "<span class='support' onClick='get_voters(".'"'.$ink_value.'"'.")'>: You and 1 other.</span>";
								echo ": You and 1 other.";

							elseif($vote_count>2)
//echo "<span class='support' onClick='get_voters(".'"'.$ink_value.'"'.")'>: You and ".($vote_count-1)." others.</span>";
								echo ': You and'.($vote_count-1).'others';
						}

						else
						{
							if($vote_count==1)
//	echo "<span class='support' onClick='get_voters(".'"'.$ink_value.'"'.")'>: 1 other.</span>";
								echo ': 1 other.';
	
							else
//	echo "<span class='support' onClick='get_voters(".'"'.$ink_value.'"'.")'>:".$vote_count." others</span>";
								echo ':'.$vote_count.'others.';

						}
					}
					echo '</span>'
					?>
				</div>

				
				<div class="inline remarks" onClick="load_content('<?php echo $ink['act'].'_'.urlencode($ink['activity']); ?>')">
					<div class="inline">
						<img src="contents/images/remarks.png" height="15">
					</div>
			
					<div class="support_remarks inline" style="vertical-align: top">
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
		
			<div  onClick="meetoo('<?php echo $ink['activity'] ?>')" class="inline ihavecompleted">
				Mee Too!!
			</div>
		</div>

		<div>
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
							echo 'added at: '.date("H:i \H\R\S,jS F,Y",strtotime($all_comments['ta']));
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
</div>

<?php 
	endforeach;
	} 

	elseif($_POST['type']==='inks')
	{
		echo '<div id="inks" style="text-align:left; margin-left:40px; margin-top:40px;"><h3>';
		$inks=$activity->get_sketch_private($_POST['user']);
		echo '<h3>'.$user->user_details($_POST['user'])->fn.' has ';
		if($inks->rows==0) {echo 'no INKs to complete.</h3></div>'; goto end_section;}
		else echo ($inks->rows==1)?$inks->rows.' Ink to complete</h3></div>':$inks->rows.' Inks to complete</h3></div>';


		foreach($inks->inks as $ink): 
?>
		<div class="wrapper">
		
				<article class="ink_display <?php if(strtotime($ink['time_alloted'])<1) ; else if((time()-strtotime($ink['time_alloted']))>0) echo 'ink_display1'; ?> ">
				
					<a href="#<?php echo $ink['act'] ?>">
					</a>

					<div class="ink_pic_section">
							<div class="inline" style="">
								<img src="contents/images/ink_it_blue.png" class="ink_image" height="50" width="50" style="vertical-align:middle;">
							</div>
							
							<div class="ink_details">
								<a href="<?php echo 'ink.php?act='.urlencode($ink['activity'])?>"><?php echo $ink['activity'];?></a>
								<?php if($ink['private']==='on') echo '<span style="font-size:55%;">(private INK)</span>';?>
							</div>
						
							<div class='addedat timeago'>
								inked at:<?php echo date("H:i \H\R\S,jS F,Y",strtotime($ink['ta']));?>
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
    							countdown.MONTHS|countdown.DAYS|countdown.HOURS|countdown.MINUTES|countdown.SECONDS);
 								</script>';

								else 
									echo 'Time Lapsed!';

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
					<div style="text-align:left;">
						<div class="inline">
							<img src="contents/images/support.png" height="15">
						</div>
						
						<div class="support inline" onClick="vote(this)" data-id="<?php echo $ink['act']; ?>" data-name="<?php echo urlencode($ink['activity']); ?>" title="click to support this activity">
								<?php echo $vote->check($ink['act'])?"Unsupport":"Support"; ?>
						</div>
						
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
//	echo "<span class='support' onClick='get_voters(".'"'.$ink_value.'"'.")'>: You.</span>";
									echo ': You.';
								}


								elseif($vote_count==2)
//	echo "<span class='support' onClick='get_voters(".'"'.$ink_value.'"'.")'>: You and 1 other.</span>";
									echo ": You and 1 other.";

								elseif($vote_count>2)
//echo "<span class='support' onClick='get_voters(".'"'.$ink_value.'"'.")'>: You and ".($vote_count-1)." others.</span>";
									echo ': You and '.($vote_count-1).' others.';
							}

							else
							{
								if($vote_count==1)
//	echo "<span class='support' onClick='get_voters(".'"'.$ink_value.'"'.")'>: 1 other.</span>";
									echo ': 1 other.';

								else
//	echo "<span class='support' onClick='get_voters(".'"'.$ink_value.'"'.")'>:".$vote_count." others</span>";
									echo ':'.$vote_count.' others.';

							}
						}
						echo '</span>'
						?>
				</div>

				<div onClick="load_content('<?php echo $ink['act'].'_'.urlencode($ink['activity']); ?>')">
					<div class="inline">
						<img src="contents/images/remarks.png" height="15">
					</div>
					
					<div class="support_remarks inline" style="vertical-align: top">
						<?php echo $comments->count_comm($ink['act'])?($comments->count_comm($ink['act'])? ' Remarks:'.$comments->count_comm($ink['act']):'Remarks, Add One'):'No Remarks, Add One';?> 
					</div>

				</div>

				<div>
					<div class="inline">
						<img src="contents/images/me2.png" height="15">
					</div>
	
					<div class="inline" onClick="meetoo('<?php echo $ink['activity'] ?>')" class="inline ihavecompleted">
						Mee Too!!
					</div>
				</div>



			<div>


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
							echo 'added at: '.date("H:i \H\R\S,jS F,Y",strtotime($all_comments['ta']));
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

</div>

<?php endforeach;
}

else {echo 'Failed to Load';}
end_section:?>
	
