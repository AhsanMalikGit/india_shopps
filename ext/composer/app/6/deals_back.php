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
$cat_id   = isset($get['cat_id'])?$get['cat_id']:"";
$promo      = isset($get['promo'])?$get['promo']:"";
$size		= isset($get['size'])?$get['size']:"30";
$from		= isset($get['from'])?$get['from']:"0";
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


//print_r($must);
//exit;


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

$search['body']['query']['function_score']['random_score']['seed'] = time();

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