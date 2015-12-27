<?php

if(!isset($_POST['type']))
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

if($_POST['type']==='completed')
{
	echo '<div style="text-align:left; margin-left:40px; margin-top:20px;">';
	$inks=$activity->get_completed_inks($_SESSION['uid']);
	echo '<h3>You have ';
	
	if($inks->rows==0) 
	{
		echo 'no accomplished INKs. Add one!</h3></div>'; 
		goto end_section;
	}
	else 
		echo ($inks->rows==1)?'accomplished '.$inks->rows.' Ink</h3></div>':'accomplished '.$inks->rows.' Inks</h3></div>';

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
					
				<div style="display:inline-block; float:right">
					<form method="post" action="process_del.php">
						<input type="hidden" value="<?php echo $ink['act']?>" name="act">
							<button class="delete_button" onClick="confirm_del()"  title="delete INK" type="submit" style="cursor:pointer;">
								<strong>X</strong>
							</button>
					</form>
				</div>
	
			</div>
			

			<div class='addedat'>
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
					
					<div class="inline" style="vertical-align: top">
						Support
					</div>
					<?php
						$ink_value=$ink['act']."_".$ink['activity'];
						if($vote->cnt($ink['act']))
							echo "<span onClick='get_voters(".'"'.$ink_value.'"'.")'>: ".$vote->cnt($ink['act'])." Inkers</span>";

					?>

				</div>

				
				<div class="support_remarks" onClick="load_content('<?php echo $ink['act'].'_'.urlencode($ink['activity']); ?>')">
				
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

		</article>
	</div>


	<?php 
	endforeach; 
} 


elseif($_POST['type']==='inks')
{
	echo '<div style="text-align:left; margin-left:40px; margin-top:20px;">';
	$inks=$activity->get_sketch($_SESSION['uid']);
	echo '<h3>You have ';
	
	if($inks->rows==0) 
	{
		echo 'no INKs to accomplish. Add one!</h3></div>'; goto end_section;
	} 
	else 
		echo ($inks->rows==1)?$inks->rows.' Ink to accomplish </h3></div>':$inks->rows.' Inks to accomplish</h3></div>';


	foreach($inks->inks as $ink): ?>
	
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
								<a href="<?php echo 'ink.php?act='.urlencode($ink['activity'])?>">
									<?php echo $ink['activity'];
									?>
								</a>
						
								<?php 
									if($ink['private']==='on') 
									echo '<span style="font-size:55%;">(private INK)</span>';
								?>
						
							</div>
						
							<div class="inline">
								<span style="display:inline-block; float:right; vertical-align: top">
									<form method="post" action="process_del.php">
										<input type="hidden" value="<?php echo $ink['act']?>" name="act">
											<button class="delete_button" onClick="confirm_del()"  title="delete this INK" type="submit" style="cursor:pointer;">
												<strong>X</strong>
											</button>
									</form>
								</span>
							</div>
							
						</div>
				
						<div class='addedat'>
							inked at:
							<?php 
								echo date("H:i \H\R\S,jS F,Y",strtotime($ink['ta']));
							?>
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
								<button type="submit" value="edit" style="width:35px; font-size:55%; background:none; border: 2px thick #FFFFFF;">
									EDIT
								</button>
							</div>

							<div class="inline">
								<button type="submit" value="delete" style="width:50px; font-size:55%; background:none; border: 2px thick #FFFFFF;">
									DELETE
								</button>
							</div>
						</div>
				
				</div>

			
				<div>
					<div style="text-align:left;">
						<div class="inline">
							<img src="contents/images/support.png" height="15">
						</div>
					
						<div class="inline" style="vertical-align: top">
							Support
						</div>
				
						<?php

							$ink_value=$ink['act']."_".$ink['activity'];
							if($vote->cnt($ink['act']))
							echo "<span onClick='get_voters(".'"'.$ink_value.'"'.")'>: ".$vote->cnt($ink['act'])." Inkers</span>";

						?>
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
	}

	else 
	{
		echo 'Failed to Load';
	}

	end_section:
	?>
	
