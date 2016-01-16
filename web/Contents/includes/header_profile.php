<header>

<div id="info_section">
<div style="text-align:left;">
<a href="profile_page.php" title="Goto Home Page">
<div class="inline" style="cursor:pointer">
<div class="inline">
<img src="contents/images/users/<?php echo $_SESSION['uid']; ?>.jpg" id="profile_pic" height="60px" style="">
</div>

<div class="inline">
<table>
<tr><td><?php echo $details->fn; ?></td></tr>
<tr><td><?php echo $details->profession; ?></td></tr>
<tr><td><?php echo '"'.$details->quote.'"'; ?></td></tr>
</table>
</div>
</div>
</a>

<div class="inline" style="float:right;">
<table>
<tr><td><a href="about_statink.php">About Us</a></td></tr>
<tr><td><a>Settings</a></td></tr>
<tr><td><a href="logout.php">Log Out</a></td></tr>
</table>
</div>
</div>
</div>
<div>

<div id="age_section" style="text-align:center; box-shadow:2px 2px 2px 2px #112b24;">
<div>Your Age Is Passing As </div>
<div>
<div id='counter'></div>
</div>
<script type="text/javascript">new CountUp('<?php  echo date_format($date,'F d, Y H:i:s')?>','counter');</script>
</div>
</div>
</header>
<!--<hr style="border-bottom:#FFFFFF; border-bottom-width:1px; clear:both; border-bottom-style:solid none; border-top-color:#b6b8b7; border-top-width:1px;">-->