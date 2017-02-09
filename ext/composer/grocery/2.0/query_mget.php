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
//	print_r($_REQUEST['ids']);
	$url="localhost:9200/shopping/_mget";	
	//$data = array("ids" = array( "5299320-44"));
	//$data = array("ids" => array( "5299320-44","4821743-36"));
	$data = array("ids" => $ids );
	                                                                 
	$data_string = json_encode($data);      
	
	//$data_string = '"ids" : ["5299320-44", "5297007-44", "4821743-36"]';
	
	//print_r($data_string);
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_VERBOSE, true);
	curl_setopt ($ch, CURLOPT_HTTPHEADER, Array("Content-Type: application/json"));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);         
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	//curl_setopt($ch, CURLOPT_USERAGENT, $agent);
	curl_setopt($ch, CURLOPT_URL,$url);
	$result=curl_exec($ch);
	echo $result;	
}



?>

	