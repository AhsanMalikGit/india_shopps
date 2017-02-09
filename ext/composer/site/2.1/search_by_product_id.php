<?php 

require_once("config.php");
if(isset($_REQUEST['product_id']))
{
	$product_id = $_REQUEST['product_id'];
	if(isset($_REQUEST['vendor']))
	{
		$vendor = $_REQUEST['vendor'];
	}


	$search['body'] = array(
			'size' => $size,
			'from' => $from,	
			'query' => array(				
				'bool' => array(
					'minimum_should_match'=>'75%'
				)					
			)
		);
	if(isset($vendor))
	{
		$must[] = array('match' => array('vendor' => $vendor));
	}

	$must[] = array('match' => array('product_id' => $product_id));
	$search['body']['query']['bool']['must'] = $must;
	if(isset($_REQUEST['pre']))
	{
	echo "<pre>";print_r(json_encode($search));
	}

	$result = $client->search($search);	
	print_r(json_encode($result));
}