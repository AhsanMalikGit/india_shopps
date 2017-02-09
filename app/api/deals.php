<?php 
include 'conn.php';
$keycode = "";
$message = "";
$res = false;
$sql = "select * from `gc_deals` where 1";
if(isset($_REQUEST['promo']))
{
	$sql .= " and promo like '".$_REQUEST['promo']."'";
}
$from = 0;
if(isset($_REQUEST['from']))
{
	$from = $_REQUEST['from'];
}
$size = 10;
if(isset($_REQUEST['size']))
{
	$size = $_REQUEST['size'];
}
$sql = $sql." limit ".$from.",".$size;
$res = mysql_query($sql);
if($res)
{	
	$keycode = "100";
	$message = "Fetched Successfully";
	while($row = mysql_fetch_object($res))
	{		
		$rows['status'] = true;
		$rows['keycode'] = 100;
		$rows['deals'][] = $row;
		
	}
	
	
	header("Content-type:application/json"); 
	if(isset($_REQUEST['pretty']))
	{
		echo json_encode($rows, JSON_PRETTY_PRINT);
	}else{
		echo json_encode($rows);
	}
}else{
	$keycode = "200";
	$message = mysql_error();
	$res = array('keycode'=>$keycode,'status'=>false,'message'=>$message);
	echo json_encode($res);
}
