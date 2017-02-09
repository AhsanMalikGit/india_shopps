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
$get = json_decode($_REQUEST['query']);
//print_r($get);exit;
$cat 		= "";
$group 		= "";
$group_alt 	= "";
$sort 		= "";
$couponInfo = isset($get->query)?strtolower($get->query):"";
$type		= isset($get->type)?strtolower($get->type):"";
$vendor_name= isset($get->vendor_name)?strtolower($get->vendor_name):"";
$category   = isset($get->category)?strtolower($get->category):"";
$promo      = isset($get->promo)?$get->promo:"";
$size		= isset($get->size)?$get->size:"30";
$from		= isset($get->from)?$get->from:"0";
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
				'field' => 'category'
			)			
		),
		'cat_id' => array(
			'terms' => array(
				'field' => 'cat_id'
			)			
		),
		'vendor_name' => array(
			'terms' => array(
				'field' => 'vendor_name'
			)			
		)
		
	)
);
$must   =array();
$should =array();
/*&&&&&&&&&&&&&&&&&&&&&&&*type*&&&&&&&&&&&&&&&&&&&&&&&&&*/
if(!empty($type))
{				
	$must[] = array('match' => array('type' => $type));		
}

if(!empty($vendor_name))
{				
	$must[] = array('match' => array('vendor_name' => $vendor_name));		
}
if(!empty($promo))
{				
	$must[] = array('match' => array('promo' => $promo));		
}
/*if(!empty($category))
{				
	$must[] = array('match' => array('category' => $category));		
}*/
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
//print_r($must);
//exit;


$queryshould="";
if(!empty($couponInfo))
{				
	$queryshould[] = array('match' => array('category' => $couponInfo),);
	$queryshould[] =array('match' => array('vendor_name' => $couponInfo));		
	$queryshould[] =array('match' => array('offer_name' => $couponInfo));	
	$queryshould[] =array('match' => array('title' => $couponInfo));	
	$queryshould[] =array('match' => array('description' => $couponInfo));
}
//print_r($must);
$search['body']['query']['function_score']['query']['bool']['must'] = $must;
if(!empty($queryshould))
	$search['body']['query']['function_score']['query']['bool']['must'][]['bool']['should'] = $queryshould;
if(!empty($categoryShould))
	$search['body']['query']['function_score']['query']['bool']['must'][]['bool']['should'] = $categoryShould;

$search['body']['query']['function_score']['random_score']['seed'] = time();
// echo "<pre>";print_r(json_encode($search));exit;
$result = $client->search($search);
//echo "<pre>";print_r($result);exit;
$arr = array('return_txt' => $result);
//print_r($arr);
//exit;
echo json_encode($arr);


?>

	