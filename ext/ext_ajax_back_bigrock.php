<?php 


$productInfo = $_POST['info'];
$productInfo = str_replace("/","-",$productInfo);
$productInfo = str_replace("NEW ARRIVALS IN","",$productInfo);
$productInfo = str_replace("NEW%20ARRIVALS%20IN","",$productInfo);
$dist_id = $_POST['dist_id'];
$clickUrl = 'http://dreamz.loveslife.biz/ext/log.php';

//$searchAPI = 'http://203.124.107.220:9200/shopping/_search';
//$serializedResult = file_get_contents($searchAPI.'?q='.urlencode($productInfo)."&size=5");

//$searchAPI = 'http://www.onestopcabs.com/ext_ajax_local.php';
$searchAPI = 'http://103.240.167.5/ext/ext_ajax_local.php';
$serializedResult = file_get_contents($searchAPI.'?term='.urlencode($productInfo).'&dist_id='.$dist_id);
print_r($serializedResult);

?>

	