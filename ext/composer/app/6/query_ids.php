<?php 
header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

require_once('../../vendor/autoload.php');
$params = array();
$params['hosts'] = array (    
    'localhost:9200'	
);

$client = new Elasticsearch\Client($params);
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

	