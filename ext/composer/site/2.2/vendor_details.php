<?php 
require_once("config.php");
if(isset($_REQUEST['id']))
{
	$search = array();
	$search['index'] = "test_sec";	

		$id 	= $_REQUEST['id'];
		$search['body'] = array(
			'query' => array(
				'bool' => array(
					'must' =>  array('match' => array('id' => $id))
				)
			)
		);	
	
	//$sort = array('saleprice' => array ('order' =>'asc' ));
	$sort = array(array('track_stock' => array ('order' =>'desc' )),'saleprice');
	$search['body']['sort'] = $sort;
	if(isset($_REQUEST['pre']))
	{
		echo "<pre>";print_r($search);
	}
	$result = $client->search($search);	
	if(isset($_REQUEST['pre']))
	{
		print_r($result);exit;
	}
	$arr = array('return_txt' => $result);
	echo json_encode($arr, JSON_UNESCAPED_UNICODE);
}

?>