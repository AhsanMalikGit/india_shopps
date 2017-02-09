<?php 
if($_SERVER['HTTP_HOST']=='localhost')
{
	$server = 'localhost';
	$login = 'root'; 
	$password = ''; 
	$db = 'coupon'; 
}else{
	// you can change the following details as per your database configuration
	$server = 'localhost';
	$login = 'wwwindia_admin'; 
	$password = 'yTxAQ}x^_RS)'; 
	$db = 'wwwindia_app';  	
}

// establish database connection

$conn = mysql_connect($server, $login, $password) or die(mysql_error());

mysql_select_db($db, $conn) or die(mysql_error($conn));
date_default_timezone_set("Asia/Kolkata");

?>
