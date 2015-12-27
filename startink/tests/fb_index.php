<?php
include_once "fbconnect.php";
	
if (isset($_SESSION['user'])) echo '<a href="logout.php">Logout</h5></a>';
else echo '<a href="' . $loginUrl . '">Login</a>';
?>


<?php if(isset($_SESSION['fb_id'])) { ?>
<img src="https://graph.facebook.com/<?php echo $_SESSION['fid']; ?>/picture?type=large"/>
<?php } ?>
<?php if(!isset($_SESSION['user'])) { ?>
<div id="f-connect-button"><a href='<?php echo $loginUrl ?>'><img src="images/f-connect.png" alt="Connect to your Facebook Account"/></a></div>
<?php } else { ?>
<?php

$email = $_SESSION['user'];

$sql="SELECT * FROM LOGIN WHERE email=?";
		$q=$con->prepare($sql);
		$q->execute(array($email));
		$r=$q->fetch(PDO::FETCH_NUM);
		
?> </div>
			<div style="float:left; margin-left:20px;">	<h1><?php echo($r['fn']." ".$r['ln']);?></h1>
				<div class="profile-info"></br>
					<?php
				echo "<b>   GENDER : </b>" . $r['sex'];
				echo "<br/><b>   EMAIL : </b>" . $row['email_id'];
				echo "<br/><b>   BIO : </b>You have probably not specified your About Me on Facebook! Specifying you might help you get more friends";
				
				?>				
				</div><div class="clr"></div>
		<?php } ?>	</div>
	</div><div class="clr"></div>
</div>
                  
              </div>
		  </div>
                    
                    
                   
    </div>
				<div class="clr"></div>
		  </div>
		</div>
</body>
</html>