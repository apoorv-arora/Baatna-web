<?php 

require_once('contents/includes/config_class.php');
require_once('contents/includes/session_class.php');
require_once('contents/includes/user_class.php');
require_once('contents/includes/activity_class.php');
require_once("contents/includes/vote_class.php");
include("contents/includes/comment_class.php");
require_once("contents/includes/sanitize_text.php");
require_once('contents/includes/get_fb_id.php');


if(isset($_GET['ink_name']))
{
	$session->check_login();
	if(!$session->is_logged_in())
	{
	header("location:index.php");
	}

}




?>



	<div id="heading">
		Adding : <span id="new_ink_name"><?php echo $_GET['name']; ?></span>
	</div>

	<div id="content">
		<form action="process_sketch.php" method="post">
<div>

<input type="hidden" readonly  id="new_ink" value="<?php echo $_GET['name']; ?>" name="new_ink">
<div style="padding:0 30px;">
<input type="text" size="39" id="selectedDateTime" name="selectedDateTime" placeholder="Date before U intend to finish it(optional)" class="fields"  />
</div>
<br>

<div style="padding:0 30px;">
<span title="Private Inks will not be shown to public">PRIVATE:<input type="checkbox" name="private"></span><br>

<input type="submit" value="INK IT!" style="width:60px; height:30px; text-align:right;">

<div id="ink_added">
</div>
</div>
</div>

</form>
	</div>