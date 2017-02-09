<?php 
header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

require_once('vendor/autoload.php');
$params = array();
$params['hosts'] = array (    
    'localhost:9200'	
);

$client = new Elasticsearch\Client($params);
if(isset($_REQUEST['ids']))
{
	
	$ids = json_decode($_REQUEST['ids']);
	//print_r($ids);exit;
	//$res = file_get_contents( '\'localhost:9200/shopping/_mget\' -d \'{	"ids" : ["5299320-44", "5297007-44", "4821743-36"]	}\' ');
	$res = file_get_contents( 'localhost:9200/shopping/_mget' -d '{	"ids" : ["5299320-44", "5297007-44", "4821743-36"]	}');
	print_r($res);exit;
	/*$search = array();
	$search['index'] = "shopping";
	//$search['body']['size']=24;
	//$search['body']['query']['bool']['should'][] =  array('match' => array('_id' => 1));
	//$search['body']['query']['bool']['should'][] =  array('match' => array('_id' => 2));
	//$search['body']['query']['bool']['should'][] =  array('match' => array('_id' => 3));
	//$search['body']['query']['ids']['type'] = "product";
	//$search['body']['query']['ids']['values'] = $ids;
	$search['_mget'] = ["5299320-44", "5297007-44", "4821743-36"];

	echo "<pre>";print_r(json_encode($search));echo "<br>";
	$result = $client->search($search);
	//$arr = array('status'=>true,'keycode'=>100,'products' => $result);

	if(isset($get['pretty']))
	{
		header("Content-type:application/json"); 
		echo json_encode($result, JSON_PRETTY_PRINT);
	}else{
		echo json_encode($result);
	}*/
}



?>

	