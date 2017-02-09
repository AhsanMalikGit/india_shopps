<?php 
include_once "conn.php";
$data = $_REQUEST;
//print_r($data);exit;
$save['distributer_id'] 		= $data['distributer_id'];
$save['ip_address'] 			= $_SERVER['REMOTE_ADDR'];
$save['proxy_ip_address'] 		= $data['proxy_ip_address'];
$save['mac'] 					= $data['mac'];
$save['date']					= time();

//print_r($save);exit;
		
$field='';$values='';

$sql = "insert into gc_registry_uninstall (";
foreach($save as $key=>$val){
	$field .= "`".mysql_real_escape_string($key)."`,";
	$values .= "'".mysql_real_escape_string($val)."',";
}
$sql = $sql.substr($field,0,-1).") values (".substr($values,0,-1).")";

//echo $sql;exit;
$res = mysql_query($sql) or die(mysql_error());