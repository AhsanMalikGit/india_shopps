<?php 

$vendor = $_GET['vendor'];

$clickUrl = 'http://www.yourshoppingwizard.com/ext/log.php';
//$clickUrl = 'http://192.169.198.126/log.php';
//echo $productInfo;exit;
$searchAPI = 'http://www.yourshoppingwizard.com:9200/shopping/_search';
//$searchAPI = 'http://150.107.224.2:9200/shopping/_search';
$serializedResult = file_get_contents($searchAPI.'?q=vendor:'.$vendor."&size=50");
print_r($serializedResult);exit;

