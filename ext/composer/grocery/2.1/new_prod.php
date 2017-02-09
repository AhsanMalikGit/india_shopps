<?php 

require_once("config.php");

$search = array();
$search['index'] = "shopping";

$get = json_decode($_REQUEST['query']);
$size				= isset($get->size)?$get->size:8;

$search['body'] = array(
	'size' => $size,
	'from' => 0,	
	'query' => array(			
		'bool' => array(
			'minimum_should_match'=>'75%'
		)		
	)
);

$must[] = array('match' => array('track_stock' => 1));
$must[] = array('match' => array('vendor' => 0));
$must[] = array('range' => array('saleprice' => array('gte' => 10000)));

$search['body']['query']['bool']['must'] = $must;

if(isset($_REQUEST['pre']))
{
echo "<pre>";print_r(json_encode($search));
}

$result = $client->search($search);
if(isset($_REQUEST['pre']))
{
	print_r($result);exit;
}
$arr = array('return_txt' => $result);

echo json_encode($arr);
