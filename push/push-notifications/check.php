<?php 
header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

//$block = array("gurgaon","new delhi","delhi","mumbai");
$block = array("new delhi","delhi","mumbai");

if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
  $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
}
$url = "http://api.ipinfodb.com/v3/ip-city/?format=json&key=25519b41231e883c9e95f9f8f3b536912c933ea024d078c13e48a5a90c77b6aa&ip=".$_SERVER['REMOTE_ADDR'];
//$url = "http://api.ipinfodb.com/v3/ip-city/?format=json&key=25519b41231e883c9e95f9f8f3b536912c933ea024d078c13e48a5a90c77b6aa&ip=182.77.34.47";

$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, $url );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
$result = curl_exec($ch );
curl_close( $ch );

$result = json_decode($result);
//print_r($result);
$flag = 1;
if( in_array(strtolower($result->cityName),$block))
	$flag = 0;
echo $flag;