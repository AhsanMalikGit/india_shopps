<?php 
require_once("config.php");
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

	