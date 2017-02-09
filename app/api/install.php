<?php 
include 'conn.php';
$data = $_POST;

$save['device_id'] 			= $data['device_id'];
//$source 					= $data['source'];
//$source = explode(";",$source);
//foreach($source as $key => $val)
{
	//$v = explode("=",$val);
	//print_r($v);exit;
}
$save['utm_source'] 		= $data['utm_source'];
$save['utm_medium'] 		= $data['utm_medium'];
$save['utm_campaign'] 		= $data['utm_campaign'];
$save['utm_content'] 		= $data['utm_content'];
$save['tracking_id'] 		= $data['tracking_id'];
$save['ip_address'] 		= $data['ip_address'];
$save['date_create'] 		= date_create();
$save['date_create'] 		= date_format($save['date_create'],'Y-m-d H:i:s');
//print_r($save);exit;
$field='';$values='';
$res = false;
if(!empty($save['device_id'] ))
{
	$sql = "insert into and_install (";
	foreach($save as $key=>$val){
		$field .= "`".mysql_real_escape_string($key)."`,";
		$values .= "'".mysql_real_escape_string($val)."',";
	}
	$sql = $sql.substr($field,0,-1).") values (".substr($values,0,-1).")";
	//echo $sql;exit;
	$res = mysql_query($sql);
}else{	
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