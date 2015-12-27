<?php
include_once('contents/includes/config_class.php');	
include_once('contents/includes/sanitize_text.php');	
try{


if(!isset($_POST['private']))
$_POST['private']='off';


//echo $_POST['new_ink'];
//echo $_POST['private'];

if(!empty($_POST['new_ink']))
{

require_once('contents/includes/user_class.php');
require_once('contents/includes/activity_class.php');
require_once('contents/includes/session_class.php');

$session->check_login();

if($session->is_logged_in())
{
	
$act_obj= new Activity;


$act_obj->ink=$sanitize->san($_POST['new_ink']);

$act_obj->priv=$_POST['private'];


//date conversion Y,m,d,H,i
$date=$_POST['selectedDateTime'];

$timestamp_future=strtotime($date);
if(is_nan($timestamp_future))
$timestamp_future=NULL;

//echo "time stamp:".$timestamp."fetched date: ".date("y,m,d,H,i",$timestamp);
//echo " Time now:".time();
//echo "Present time".date("y,m,d,H,i",time());
if(!($timestamp_future>=time()))
{
	echo "not a true date";
	header("location:home.php");
}


$act_obj->time=$timestamp_future;
$activity->insert_new_ink($act_obj);
header("location:ink.php?act=".urlencode($act_obj->ink)."&true");

}
//header("location:profile_page.php");

}
}

catch(Exception $e)
{
	echo 'oops';
	}
	

?>