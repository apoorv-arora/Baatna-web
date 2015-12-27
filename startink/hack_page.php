<?php


// Prints something like: Monday
$ful="Grisham jindal";
list($f,$l)=explode(" ",$ful);
echo $f." ".$l;


$source = '12/17/1990';
$date = new DateTime($source);
echo $date->format('Y-m-d').'<br>'; // 31.07.2012

echo 
date("Y-m-d H:i:s",strtotime('12/17/1990'))
?>