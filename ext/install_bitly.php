<?php 
if($_SERVER['HTTP_HOST']=='localhost')
{
	$server = 'localhost';
	$login = 'root'; 
	$password = ''; 
	$db = 'indiashopps'; 
}else{
	// you can change the following details as per your database configuration
	$server = 'localhost';
	$login = 'wwwindia_admin'; 
	$password = 'yTxAQ}x^_RS)'; 
	$db = 'wwwindia_extension';	
}

// establish database connection

$conn = mysql_connect($server, $login, $password);
mysql_select_db($db, $conn) or die(mysql_error($conn));
if(isset($_REQUEST['distributer_id']))
{
$data = $_REQUEST;
//print_r($data);exit;
$save['distributer_id'] 		= $data['distributer_id'];
$save['ip_address'] 			= $_SERVER['REMOTE_ADDR'];
$save['proxy_ip_address'] 		= $data['proxy_ip_address'];
$save['mac'] 					= $data['mac'];
$save['valid'] 					= $data['valid'];
$date 							= date_create();
$save['date']					= date_format($date,"Y-m-d H:i:s");

//print_r($save);exit;
		
$field='';$values='';

$sql = "insert into bitly_install (";
foreach($save as $key=>$val){
	$field .= "`".mysql_real_escape_string($key)."`,";
	$values .= "'".mysql_real_escape_string($val)."',";
}
$sql = $sql.substr($field,0,-1).") values (".substr($values,0,-1).")";

//echo $sql;exit;
$res = mysql_query($sql) or die(mysql_error());

}