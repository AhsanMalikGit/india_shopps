<?php 
require_once("config.php");

if(isset($_REQUEST['id']) || isset($_REQUEST['_id']) || isset($_REQUEST['product_id']))
{	
	$search = array();
	$search['index'] = "grocery";	$search['type'] = "product";
	$track_stock = 1;
	if(isset($_REQUEST['track_stock']))
	{
		$track_stock = $_REQUEST['track_stock'];
	}
	
	 if(isset($_REQUEST['showSec']) && $_REQUEST['showSec'] == 1)
	{
		$search['type'] = "vendorlist";
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
								array('match' => array('id' => $id)),
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
	$search['type'] = "vendorlist";
	$result_vendor = $client->search($search);
	/* if(isset($_REQUEST['showSec']) && $_REQUEST['showSec'] == 1)
	{
		$res = $result;
	}else{
		$res = $result['hits']['hits'][0]['_source'];
	} */
	
	$arr = array('product' =>$result['hits']['hits'][0]['_source'],'vendorlist' => $result_vendor);
	echo json_encode($arr, JSON_UNESCAPED_UNICODE);
}
?>