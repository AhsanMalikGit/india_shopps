<?php 
$server = 'localhost';
$login = 'wwwindia_main'; 
$password = 'I_ndia@1234'; 
$db = 'wwwindia_app_9';  

// establish database connection
$conn = mysql_connect($server, $login, $password);
mysql_select_db($db, $conn) or die(mysql_error($conn));
date_default_timezone_set("Asia/Kolkata");