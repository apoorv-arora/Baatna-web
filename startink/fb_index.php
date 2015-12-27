<?php
include_once "fbconnect.php";


?>


<?php if(isset($_SESSION['email_id_via_fb'])) { ?>

<?php

$email = $_SESSION['email_id_via_fb'];

$sql="SELECT * FROM login WHERE email_id=?";
		$q=$con->prepare($sql);
		$q->execute(array($email));
		$r=$q->fetch(PDO::FETCH_ASSOC);
		$_SESSION['uid']=$r['uid'];
		
}

?>