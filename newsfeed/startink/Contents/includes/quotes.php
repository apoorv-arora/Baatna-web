<?php

class Quote
{

public function quote()
{
try{
$con= new PDO("mysql:host=localhost;dbname=dbeligon_si",'dbeligon_siuser','darkdark');		

for($i=0;$i<=5;$i++)
{
$sql="SELECT * from quotes where id=?";
$q=$con->prepare($sql);
$q->execute(array(rand(3,60)));
$r=$q->fetch(PDO::FETCH_OBJ);

$quote_array='i['.($k-1).']='.'"'.$r->quote.'"'.';';
}
}
	 

catch(Exception $e)
{
exit();
}
}
}

$quote= new Quote;
?>