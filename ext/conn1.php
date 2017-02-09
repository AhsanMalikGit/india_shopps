<?php 
define('CLIENT_LONG_PASSWORD', 1);
if($_SERVER['HTTP_HOST']=='localhost')
{
	$server = 'localhost';
	$login = 'root'; 
	$password = ''; 
	$db = 'indiashopps'; 
}else{
	// you can change the following details as per your database configuration
	$server = '199.79.62.13';
	$login = 'onestj4t_shopp'; 
	//$password = 'Radio1234$'; 
	$password = 'indiashopp@1'; 
	$db = 'onestj4t_shopp';  
}

// establish database connection

$conn = mysql_connect($server, $login, $password, false, CLIENT_LONG_PASSWORD) or die(mysql_error());

mysql_select_db($db, $conn) or die(mysql_error($conn));
date_default_timezone_set("Asia/Kolkata");
?>