<?php 
require_once("config.php");

if(isset($_REQUEST['id']) || isset($_REQUEST['_id']) || isset($_REQUEST['product_id']))
{	
	$search = array();
	$search['index'] = "shopping";
	$track_stock = 1;
	if(isset($_REQUEST['track_stock']))
	{
		$track_stock = $_REQUEST['track_stock'];
	}
	if(isset($_REQUEST['isBook']) && $_REQUEST['isBook'] !== false )
	{
		$search['index'] = "books";
	}
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
								array('match' => array('track_stock' => $track_stock))    
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
								//array('match' => array('track_stock' => $track_stock))    
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
								array('match' => array('track_stock' => $track_stock))
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
	echo json_encode($arr, JSON_UNESCAPED_UNICODE);
}
?>