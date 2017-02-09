<?php 
include 'conn1.php';
$keycode = "";
$message = "";
$sql = "select * from `slider` where active=1";
if(isset($_REQUEST['home']))
{
	$sql .= " and level=1";
}
if(isset($_REQUEST['cat_id']))
{
	$sql .= " and cat_id = ".$_REQUEST['cat_id'];
}
if(isset($_REQUEST['id']))
{
	$sql .= " and id =".$_REQUEST['id'];
}
if(isset($_REQUEST['type']))
{
	$sql .= " and type =".$_REQUEST['type'];
}
if(isset($_REQUEST['size']))
{
	$sql .= " and size like '".$_REQUEST['size']."'";
}
//echo $sql;exit;
$res = mysql_query($sql);
if($res)
{	
	$keycode = "100";
	$message = "Fetched Successfully";
	while($row = mysql_fetch_object($res))
	{
		//$res = array('Category'=>$categories);		
		//echo json_encode($row);
		
		$rows['status'] = true;
		$rows['keycode'] = 100;
		$rows['slider'][] = $row;
		
	}
	//$res = array('Category'=>$categories,'keycode'=>$keycode,'message'=>$message);
	//echo json_encode($res);
	header("Content-type:application/json"); 
	echo json_encode($rows);
}else{
	$keycode = "200";
	$message = mysql_error();
	$res = array('keycode'=>$keycode,'status'=>false,'message'=>$message);
	echo json_encode($res);
}
