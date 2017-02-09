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
$get = $_REQUEST;
//print_r($get);exit;
$cat 		= "";
$group 		= "";
$group_alt 	= "";
$sort 		= "";
$couponInfo = isset($get['query'])?$get['query']:"";
$type		= isset($get['type'])?$get['type']:"";
$vendor_name= isset($get['vendor'])?$get['vendor']:"";
$category   = isset($get['category'])?$get['category']:"";
$cat_id  	= isset($get['cat_id'])?$get['cat_id']:"";
$promo      = isset($get['promo'])?$get['promo']:"";
$size		= isset($get['size'])?$get['size']:30;
$from		= isset($get['from'])?$get['from']:0;
$isAggre	= isset($get['isAggre'])?true:false;
$search = array();
$search['index'] = "deals";
//$search['from']  = $data['from'];
$search['body'] = array(
	'size' => $size,
	'from' => $from,
	'query' => array(
	'function_score' => array(
	'query' => array(
		'bool' => array(			
			'minimum_should_match'=>'75%'
		)
		)
		)
    ),
	'aggs' => array(
		'category' => array(
			'terms' => array(
				'field' => 'category',
				'size'	=>	0
			),			
			'aggs' => array(
				'cat_id' => array(
					'terms' => array(
						'field' => 'cat_id',
						'size'	=>	0
					)			
				)
			)
		),
		'vendor_name' => array(
			'terms' => array(
				'field' => 'vendor_name',
				'size'	=>	0
			)			
		),'type' => array(
			'terms' => array(
				'field' => 'type',
				'size'	=>	0
			)			
		)
		
	)
);
$must   =array();
$should =array();

/*************Aggregation Filter*******************/
if($isAggre)
{
	//	print_r($vendor_name);exit;
	if(!empty($vendor_name))
	{
		
		$vendorAggrShould="";
		if(strpos($vendor_name,','))
		{	
			$vendor_name = explode(",",$vendor_name);			
			for($i=0;$i< count($vendor_name);$i++)
			{
				$vendorAggrShould[] = array('term' => array('vendor_name' => $vendor_name[$i]));		
			}	
			$filter_agg['vendor_aggr'] = array('or' => $vendorAggrShould);	
		}else {
			$term = array(
				'vendor_name' => $vendor_name 
			);
			$filter_agg['vendor_aggr'] = array('term' => $term);		
		}
		
	}	
	
	if(!empty($cat_id))
	{
		
		$cat_idAggrShould="";
		if(strpos($cat_id,','))
		{	
			$cat_id = explode(",",$cat_id);			
			for($i=0;$i< count($cat_id);$i++)
			{
				$cat_idAggrShould[] = array('term' => array('cat_id' => $cat_id[$i]));		
			}	
			$filter_agg['cat_id_aggr'] = array('or' => $cat_idAggrShould);	
		}else {
			$term = array(
				'cat_id' => $cat_id 
			);
			$filter_agg['cat_id_aggr'] = array('term' => $term);		
		}
		if(!empty($type))
		{				
			$filter_agg['type_aggr'] = array('match' => array('type' => $type));		
		}
	}	
	
	
	
	
}else{

	/*&&&&&&&&&&&&&&&&&&&&&&&*type*&&&&&&&&&&&&&&&&&&&&&&&&&*/
	if(!empty($type))
	{				
		$must[] = array('match' => array('type' => $type));		
	}

	
	if(!empty($promo))
	{				
		$must[] = array('match' => array('promo' => $promo));		
	}

	$vendor_nameShould="";
	if(strpos($vendor_name,','))
	{	
		$vendor_name = explode(",",$vendor_name);	
		
		for($i=0;$i< count($vendor_name);$i++)
		{
			$vendor_nameShould[] = array('match' => array('vendor_name' => $vendor_name[$i]));		
		}	
		

	}else if(!empty($vendor_name)){
		$must[] = array('match' => array('vendor_name' => $vendor_name));		
	}
	$categoryShould="";
	if(strpos($category,','))
	{	
		$category = explode(",",$category);	
		
		for($i=0;$i< count($category);$i++)
		{
			$categoryShould[] = array('match' => array('category' => $category[$i]));		
		}	
		

	}else if(!empty($category)){
		$must[] = array('match' => array('category' => $category));		
	}

	$cat_idShould="";
	if(strpos($cat_id,','))
	{	
		$cat_id = explode(",",$cat_id);	
		
		for($i=0;$i< count($cat_id);$i++)
		{
			$cat_idShould[] = array('match' => array('cat_id' => $cat_id[$i]));		
		}	
		

	}else if(!empty($cat_id)){
		$must[] = array('match' => array('cat_id' => $cat_id));		
	}
}

$queryshould="";
if(!empty($couponInfo))
{				
$queryshould[] = array('match' => array('category' => $couponInfo),);
$queryshould[] =array('match' => array('vendor_name' => $couponInfo));		
//$queryshould[] =array('match' => array('offer_name' => $couponInfo));	
//$queryshould[] =array('match' => array('title' => $couponInfo));	
//$queryshould[] =array('match' => array('description' => $couponInfo));
				
	//$queryshould = array('match' => array('vendor_name' => $couponInfo));		
}

$search['body']['query']['function_score']['query']['bool']['must'] = $must;
if(!empty($queryshould))
	$search['body']['query']['function_score']['query']['bool']['must'][]['bool']['should'] = $queryshould;
if(!empty($categoryShould))
	$search['body']['query']['function_score']['query']['bool']['must'][]['bool']['should'] = $categoryShould;
if(!empty($cat_idShould))
	$search['body']['query']['function_score']['query']['bool']['must'][]['bool']['should'] = $cat_idShould;
if(!empty($vendor_nameShould))
	$search['body']['query']['function_score']['query']['bool']['must'][]['bool']['should'] = $vendor_nameShould;

$search['body']['query']['function_score']['random_score']['seed'] = time();



if(!empty($filter_agg))
{
	$search['body']['aggs']['filter_aggr'] = array( 'aggs' => array(
														'category' => array(
															'terms' => array(
																'field' => 'category',
																'size'	=>	0
															),			
															'aggs' => array(
																'cat_id' => array(
																	'terms' => array(
																		'field' => 'cat_id',
																		'size'	=>	0
																	)			
																)
															)
														),
														'vendor_name' => array(
															'terms' => array(
																'field' => 'vendor_name',
																'size'	=>	0
															)			
														)
														
													)
												);
	
	if(!empty($filter_agg['vendor_aggr']))
	{

		$search['body']['aggs']['filter_aggr']['filter'] = $filter_agg['vendor_aggr'];
	}
	if(!empty($filter_agg['cat_id_aggr']))
	{
	
		$search['body']['aggs']['filter_aggr']['filter'] = $filter_agg['cat_id_aggr'];
	}
	if(!empty($filter_agg['type_aggr']))
	{
	
	
		$search['body']['aggs']['filter_aggr']['filter'] = $filter_agg['type_aggr'];
	}
	
}


















//echo "<pre>";print_r(json_encode($search));
$result = $client->search($search);
//echo "<pre>";print_r($result);exit;
$arr = array('return_txt' => $result);
if(isset($_REQUEST['pretty']))
{
	header("Content-type:application/json"); 
	echo json_encode($arr, JSON_PRETTY_PRINT);
}else{
	echo json_encode($arr);
}
?>	