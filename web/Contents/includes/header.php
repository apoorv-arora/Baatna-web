<header>

<div class="center" style="text-align:left;">
<div style="text-align:left;" class="inline">
<a href="home.php">
<img src="contents/images/header_logo.png" height="40" style=" margin-top:3px; vertical-align:middle;"></a>
</div>

<div style="text-align:right; float:right; vertical-align:bottom; margin-top:13px;" class="inline">

<a href="home.php"><div class="translate inline" style="">Hello, <?php echo $details->fn; ?></div></a>
<a href="home.php"><div class="translate inline" style="">Home</div></a>
<div class="inline translate">
<a href="team.php"><span style="">TEAM</span></a>
</div>

<a href="logout.php" style="color:black;"><div class="inline translate">
<span style="">Logout</span>
</div></a>

</div>
</div>
</header>

<div id="age_section" style="text-align:center; margin:0 auto; box-shadow:2px 2px 2px 2px #112b24; width:500px; clear:both;">
<div>Your Age Is Passing As </div>
<div>
<div id='counter'></div>
</div>
<script type="text/javascript">new CountUp('<?php  echo date_format($date,'F d, Y H:i:s')?>','counter');</script>
</div>

<!--age ends here.
-->
