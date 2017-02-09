<?php 

$productInfo = urldecode($_GET['q']);
$productInfo = str_replace("/","-",$productInfo);
$productInfo = str_replace("NEW ARRIVALS IN","",$productInfo);
$productInfo = str_replace("NEW%20ARRIVALS%20IN","",$productInfo);

$searchAPI = 'http://www.yourshoppingwizard.com:9200/shopping/_search';
$serializedResult = file_get_contents($searchAPI.'?q='.urlencode($productInfo)."&size=4");
echo $serializedResult;
?>