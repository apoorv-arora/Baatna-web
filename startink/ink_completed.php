<?php

require_once('contents/includes/config_class.php');
require_once('contents/includes/session_class.php');
require_once('contents/includes/sanitize_text.php');
require_once('contents/includes/activity_class.php');


$ink=$_GET['act'];
$ink_name=$_GET['ink'];

$ink=$sanitize->san($ink);
$ink_name=$sanitize->san($ink_name);

$activity->update_sketch($ink,$ink_name);

echo 'updated and added to the accomplished section';

header("location:home.php");


?>
