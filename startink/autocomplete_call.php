<?php

require_once('contents/includes/config_class.php');
$w = strtolower($_GET['search']);
if (!$w) return;
$sql = "SELECT todo AS ink
FROM activity_list
WHERE todo LIKE '".$w."%'
OR todo LIKE '%".$w."?'
OR todo LIKE '%".$w."%'
OR todo = '".$w."' LIMIT 10";
$q=$con->prepare($sql);
$rs=$q->execute();
$row=$q->rowCount();
if($row)
{
echo '<table id="auto_help" class="fields" style=" text-align:left; margin-left:20px; padding:.2% .6%; position:absolute;z-index:2;">';
while($rs=$q->fetch()) 
{
$cname = $rs['ink'];
echo '<tr class="" style="cursor:pointer;" onClick="select_from_suggested(this)" onMouseOver="change_bg_color(this)" onMouseOut="change_bg_color(this)"><td >'.$cname.'</td></tr>';
	
}

echo "</tbody></table>";

}
?>

