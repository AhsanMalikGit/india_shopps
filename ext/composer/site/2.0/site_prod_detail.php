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
//$params['serializerClass'] = 'Elasticsearch\Serializers\ArrayToJSONSerializer';
$client = new Elasticsearch\Client($params);

if(isset($_REQUEST['id']) || isset($_REQUEST['_id']) || isset($_REQUEST['product_id']))
{	
	$search = array();
	$search['index'] = "shopping";
	if(isset($_REQUEST['showSec']) && $_REQUEST['showSec'] == 1)
	{
		$search['index'] = "test_sec";
	}
	if(isset($_REQUEST['id']))
	{
		$id 	= $_REQUEST['id'];
		$search['body'] = array(			
			'query' => array(
				'bool' => array(
					'must' =>  array(
								array('match' => array('id' => $id)),
								array('match' => array('track_stock' => 1))    
							)			
				)
			)
		);
	}else if(isset($_REQUEST['_id'])){ 	
		$id 	= $_REQUEST['_id'];		
		$search['body'] = array(			
			'query' => array(
				'bool' => array(
					'must' =>  array(
								array('match' => array('_id' => $id)),
								array('match' => array('track_stock' => 1))    
							)			
				)
			)
		);
	}
	else if(isset($_REQUEST['product_id'])){ 	
		$product_id 	= $_REQUEST['product_id'];		
		$search['body'] = array(			
			'query' => array(
				'bool' => array(
					'must' =>  array(
								array('match' => array('product_id' => $product_id)),
								array('match' => array('track_stock' => 1))
							)			
				)
			)
		);
	}
	
	if(isset($_REQUEST['showSec']) && $_REQUEST['showSec'] == 1)
	{
		$sort = array(
			'saleprice' => array ('order' =>'asc' )
		);
		$search['body']['sort'] = $sort;
	}
	
//echo "<pre>";print_r($search);exit;
	$result = $client->search($search);
	if(isset($_REQUEST['showSec']) && $_REQUEST['showSec'] == 1)
	{
		$res = $result;
	}else{
		$res = $result['hits']['hits'][0]['_source'];
	}
	
	$arr = array('return_txt' => $res);
	echo json_encode($arr);
}
?>
