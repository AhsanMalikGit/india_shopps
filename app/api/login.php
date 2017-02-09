<?php 
include 'conn.php';
$data = $_POST;

$save['device_id'] 		= $data['device_id'];
$save['name'] 			= urldecode($data['name']);
$save['email'] 			= urldecode($data['email']);
$save['gender'] 		= $data['gender'];
$save['active'] 		= 1;
$save['join_date'] 		= date_create();
$save['join_date'] 		= date_format($save['join_date'],'Y-m-d H:i:s');
//print_r($save);exit;
$field='';$values='';
if(!empty($save['name'] ) && !empty($save['device_id'] ) && !empty($save['email'] ))
{
	$sql = "insert into and_user (";
	foreach($save as $key=>$val){
		$field .= "`".mysql_real_escape_string($key)."`,";
		$values .= "'".mysql_real_escape_string($val)."',";
	}
	$sql = $sql.substr($field,0,-1).") values (".substr($values,0,-1).")";
	//echo $sql;exit;
	$res = mysql_query($sql);
}else{
	$res = false;
	$message = "Field Missing";
}

header("Content-type:application/json"); 
if($res)
{	
	$keycode = "100";
	$message = "Data Inserted Successfully.";
	$res = array('keycode'=>$keycode,'status'=>true,'message'=>$message);
	echo json_encode($res);
}else{
	$keycode = "200";
	if(empty($message) && !isset($message))
	{
		$message = mysql_error();
	}
	$res = array('keycode'=>$keycode,'status'=>false,'message'=>$message);
	echo json_encode($res);
}