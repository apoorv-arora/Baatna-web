<?php 

if(isset($_POST['q'])&&isset($_POST['b']))
{
	
	$qu=trim($_POST['q']);
	$b=trim($_POST['b']);

echo $qu.$b;
$con= new PDO("mysql:host=localhost;dbname=dbeligon_si",'dbeligon_siuser','darkdark');
	$sql= "INSERT INTO quotes (quote,said) VALUES(?,?)";
	
	$q=$con->prepare($sql);
	$q->execute(array($qu,$b));


//echo "Inserted values are  ".$q.' '.$b;
}



?>


<html>
<body>

<form action="quote_feeder.php" method="post">
Quote:<textarea rows="3" name="q">
</textarea>
By: <input type="text" name="b">
</form>
</body>


</html>