<?php 

error_reporting(E_ALL);
ini_set('display_errors',1);


exec('mysqldump -u root -pbaatna BaatnaServer > my_database_dump.sql ');


require "s3.php";

$s3=new S3('AKIAIQPNONS2TQU63SBA','fePxRzxLL6+jJU4fUwV9IMrUshDHofeogh9DuNX8');
$newname=time() . '.sql';
S3::putObject(
	$s3->inputFile('my_database_dump.sql',false),
	'ridhibaatna',
	$newname,
	S3::ACL_PUBLIC_READ,
	array(),
	array(),
	S3::STORAGE_CLASS_RRS

 );
?>