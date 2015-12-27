<?php
require_once('contents/includes/config_class.php');
require_once('contents/includes/session_class.php');

define('FACEBOOK_APP_ID', '459309394127720');
define('FACEBOOK_SECRET', '697ffaaeab7bb2715975cb0dba9eff8e');
// No need to change function body
function parse_signed_request($signed_request, $secret) {
list($encoded_sig, $payload) = explode('.', $signed_request, 2);

// decode the data
$sig = base64_url_decode($encoded_sig);
$data = json_decode(base64_url_decode($payload), true);

if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
error_log('Unknown algorithm. Expected HMAC-SHA256');
return null;
}

// check sig
$expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
if ($sig !== $expected_sig) {
error_log('Bad Signed JSON signature!');
return null;
}

return $data;
}

function base64_url_decode($input) {
return base64_decode(strtr($input, '-_', '+/'));
}

if ($_REQUEST) {
$response = parse_signed_request($_REQUEST['signed_request'],
FACEBOOK_SECRET);

echo "<pre>";
//print_r($response);
echo "</pre>"; // Uncomment this for printing the response Array

$fullname = $response["registration"]["name"];
$email = $response["registration"]["email"];
$password = $response["registration"]["password"];
$dob=$response["registration"]["birthday"];
$gender=$response["registration"]["gender"];
$location=$response["registration"]["location"];
$facebookID=$response["user_id"];
echo $facebookID;
$dob= date("Y-m-d H:i:s",strtotime($dob));
echo $dob;
if($gender=="Male")
$sex=1;
else
$sex=0;

list($fn,$surname)=explode(" ",$fullname);

$result=0;
try{
$con->beginTransaction();
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

			  $sql = "INSERT INTO login (email_id,pwd) VALUES(?,?)";
			  $q=$con->prepare($sql);
			  $q->execute(array($email,$password));
			  
			  $sql='SELECT uid from login where email_id=? AND pwd=? LIMIT 1';
			  $q=$con->prepare($sql);
			  $q->execute(array($email,$password));
			  $uid=$q->fetch(PDO::FETCH_NUM);
			  //echo "<strong>$uid[0]</strong>";
			  
			  $sql = "INSERT INTO details (fn,ln,birth,location,sex,uid) VALUES(?,?,?,?,?,?)";
			  $q=$con->prepare($sql);
			  $q->execute(array($fn,$surname,$dob,$location['name'],$sex,$uid[0]));
			  $result=1;
			  $con->commit();
			  echo 'done';
			  
			
			
}

catch(Exception $e)
{
	echo 'error: '.$e;
	$con->rollback();
	header("location:http://localhost/startink/signup_facebook.php");
	
}

if($result)
{ 
echo "Successfully registered.";

}	
else {
// Error
// Redirect to error page
}
} else {
echo '$_REQUEST is empty';
}
?>
