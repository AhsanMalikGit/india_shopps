<?php 
require_once("config.php");
if(isset($_REQUEST['ids']))
{
	
	$ids = json_decode($_REQUEST['ids']);
	//print_r($ids);
	
	$search = array();
	$search['index'] = "shopping";
	$search['body']['size']=100;
	$search['body']['query']['ids']['type'] = "product";
	$search['body']['query']['ids']['values'] = $ids;

	//echo "<pre>";print_r(json_encode($search));echo "<br>";
	$result = $client->search($search);
	//$arr = array('status'=>true,'keycode'=>100,'products' => $result);

	if(isset($get['pretty']))
	{
		header("Content-type:application/json"); 
		echo json_encode($result, JSON_PRETTY_PRINT);
	}else{
		echo json_encode($result);
	}
}



?>

	