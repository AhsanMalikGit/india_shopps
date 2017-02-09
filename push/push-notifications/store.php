<?php 
$server = 'localhost';	
$login = 'wwwindia_main'; 
$password = 'I_ndia@1234'; 
$db = 'wwwindia_indiasho'; 
// establish database connection

$conn = mysql_connect($server, $login, $password) or die(mysql_error());

mysql_select_db($db, $conn) or die(mysql_error($conn));
date_default_timezone_set("Asia/Kolkata");

$push_id = $_REQUEST['push_id'];
$push_id = explode("/",$push_id);
$save['push_id'] = $push_id[(count($push_id)-1)];

if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
  $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
}
$save['ip_address'] 		= $_SERVER['REMOTE_ADDR'];
$save['date']				= date_create();
$save['date']				= date_format($save['date'],'Y-m-d H:i:s');


$sql = "insert into web_notification values (null,'".$save['push_id']."','".$save['ip_address']."','".$save['date']."')";
mysql_query($sql) or die(mysql_error());


