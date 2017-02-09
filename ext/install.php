<?php 
include_once "conn.php";
$data = $_POST;
//print_r($data);exit;

$save['installation_id'] 	= ($data['seq']==0)?false:$data['seq'];
$save['distributer_id'] 	= $data['dist_id'];
$save['ip_address'] 		= $_SERVER['REMOTE_ADDR'];
$save['redistributer_id'] 	= $data['redist_id'];
if(isset($data['origin']))
	$save['origin'] 			= $data['origin'];	//FF
else
	$save['origin'] 			= 1;				//Chrome

$save['date']				= time();
//$save['cookie_id'] 			= $data['seq'];
$save['cookie_id'] 			= 0;
$save['active'] 			= 1;

//print_r($save);echo "<br/>";
		
$field='';$values='';
if(!$save['installation_id'])
{
	$sql = "insert into gc_extension_installation (";
	foreach($save as $key=>$val){
		$field .= "`".mysql_real_escape_string($key)."`,";
		$values .= "'".mysql_real_escape_string($val)."',";
	}
	$sql = $sql.substr($field,0,-1).") values (".substr($values,0,-1).")";
}else{
	$sql = "update gc_extension_installation set ";
	foreach($save as $key=>$val){
		if($key !='installation_id')
		{
			$field .= "`".mysql_real_escape_string($key)."`='".mysql_real_escape_string($val)."',";
		}
		
	}
	$sql = $sql.substr($field,0,-1)." where installation_id=".$save['installation_id'];
}
//echo $sql;exit;
$res = mysql_query($sql) or die(mysql_error());
if(!$save['installation_id'])
{
	$save['installation_id'] = mysql_insert_id();
}
$ret['seq']			= $save['installation_id'];
$ret['dist_id']		= $save['distributer_id'] ;


print_r(json_encode($ret));
