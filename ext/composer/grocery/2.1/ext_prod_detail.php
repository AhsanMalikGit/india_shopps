<?php 
require_once("config.php");

if(isset($_REQUEST['id']) || isset($_REQUEST['_id']))
{	
	$search = array();
	$search['index'] = "shopping";
	if(isset($_REQUEST['isBook']) && $_REQUEST['isBook'] !== false )
	{
		$search['index'] = "books";
	}
	if(isset($_REQUEST['id']))
	{
		$id 	= $_REQUEST['id'];
		$search['body'] = array(
			'size' => 1,
			'query' => array(
				'bool' => array(
					'must' =>  array(
								array('match' => array('id' => $id))    
							)			
				)
			)
		);
	}else if(isset($_REQUEST['_id'])){ 	
		$id 	= $_REQUEST['_id'];		
		$search['body'] = array(
			'size' => 1,
			'query' => array(
				'bool' => array(
					'must' =>  array(
								array('match' => array('_id' => $id))
							)			
				)
			)
		);
	}

	
	//$search['from']  = $data['from'];
	
//print_r($search);exit;
	$result = $client->search($search);//print_r($result);exit;
	if(count($result['hits']['hits'])>0)
	{
		$res = $result['hits']['hits'][0]['_source'];
		$arr = array('return_txt' => $res);
		echo json_encode($arr, JSON_UNESCAPED_UNICODE);
	}
}
?>

	