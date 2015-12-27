
<?php
/* These salts are examples only, and should not be used verbatim in your code.
   You should generate a distinct, correctly-formatted salt for each password.
*/
/*$pwd="boobsforfun";
for($i=1;$i<5;$i++)
{
    $pwd=crypt($pwd, '$2a$09$statink.compassword$');
}

echo $pwd;*/
/*
echo 'starting...<br/>';
for($i = 0; $i < 5; $i++) {
  print "$i<br/>";
  flush();
  sleep(2);
}
print 'DONE!<br/>';
*/

/*ob_start();
$token=md5(uniqid());
		setcookie('startink_rm',$token,time()+3600*24*7,"/",'',false,true);
	print_r($_COOKIE);
$p='dark';	
	for($i=1;$i<2;$i++)
		  {
			$p=crypt($p, '$2a$09$statink.compassword$');
		  }
echo $p;
ob_get_contents();
sleep(5);
echo 'before ob flush';
*/


$p='dark';	
	for($i=1;$i<2;$i++)
		  {
			$p=crypt($p, '$2a$09$statink.compassword$');
		  }
echo $p;?>



<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>

<div>

<div style="display:inline;">
<img src="FlexSlider-1.8/demo-stuff/inacup_donut.jpg" height="50" width="50">
</div>
<div>
Hello
</div>

</div>
</body>
</html>