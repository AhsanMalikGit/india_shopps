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
$productInfo 		= isset($get->query)?urldecode($get->query):"";
$cat_id	 			= isset($get->category_id)?$get->category_id:"";
$cat	 			= isset($get->cat)?$get->cat:"";
$group				= strtolower(isset($get->group)?$get->group:"");
$vendor				= isset($get->vendor)?$get->vendor:"";
$brand				= isset($get->brand)?$get->brand:"";
$brand_min_doc_count= isset($get->brand_min_doc_count)?$get->brand_min_doc_count:10;
$brand_size			= isset($get->brand_size)?$get->brand_size:0;
$size				= isset($get->size)?$get->size:30;
$size				= isset($get->size)?$get->size:30;
$from				= isset($get->from)?$get->from:0;
$saleprice_min		= isset($get->saleprice_min)?$get->saleprice_min:"";
$saleprice_max		= isset($get->saleprice_max)?$get->saleprice_max:"";
$order_by			= isset($get->order_by)?$get->order_by:"";
$sort_order			= isset($get->sort_order)?$get->sort_order:"";
$session_id			= isset($get->session_id)?$get->session_id:time();
$isAggre			= isset($get->isAggre)?$get->isAggre:false;


/************Small Fixes************/
if($group == 'all') {$group='';}
if($order_by=='null')
	$order_by = '';
if($sort_order=='null')
	$sort_order = '';

if(!empty($productInfo ))
{
	$productInfo = str_replace("/","-",$productInfo);
	$productInfo = str_replace(" AND ","",$productInfo);
	$productInfo = str_replace("AND ","",$productInfo);
	$productInfo = str_replace(" and ","",$productInfo);
	$productInfo = str_replace("and ","",$productInfo);
	$productInfo = str_replace(" OR ","",$productInfo);
	$productInfo = str_replace(" or ","",$productInfo);
}
/************Small Fixes************/


if(isset($order_by) && !empty($order_by))
{
	$sort = array(
		$order_by => array ('order' => $sort_order )
	);
}

$search = array();
$search['index'] = "shopping";
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
		'saleprice_min' => array(
			'min' => array(
				'field' => 'saleprice'
			)			
		),
		'saleprice_max' => array(
			'max' => array(
				'field' => 'saleprice'
			)			
		),
		'grp' => array(
			'terms' => array(
				'field' => 'grp',
				'size'	=>	0
				//'min_doc_count' => 2				
			),
			'aggs' => array(
				'category_id' => array(
					'terms' => array(
						'field' => 'category_id',
						'size'	=>	0
						//'min_doc_count' => 2
					),
					'aggs' => array(
						'category' => array(
							'terms' => array(
								'field' => 'category',
								'size'	=>	0
							)			
						)
					)
				)
			)
		),
		'vendor' => array(
			'terms' => array(
				'field' => 'vendor',
				'size' => 0			
			)			
		),
		'brand' => array(
			'terms' => array(
				'field' => 'brand',
				'min_doc_count' => $brand_min_doc_count,
				'size' => $brand_size,
				'order' => array(
					'_count' => "desc"
				)
			)			
		)
	)
);
 $must =array();
 $should =array();
 $must[] = array('match' => array('track_stock' => 1));
 $srchShould="";
if(!empty($productInfo))
{				
	//$must[] = array('match' => array('name' => $productInfo));		
	//$srchShould[] = array('match' => array('name' => array('query' => $productInfo,'operator' => 'and')));		
	//$must[] = array('match' => array('name' => array('query' => $productInfo,'operator' => 'and')));	
	
	
	$srchShould[] = array('match' => array('name' => array('query' => $productInfo,'operator' => 'or','boost' => '2')));
	$srchShould[] = array('match' => array('tags' => array('query' => $productInfo,'operator' => 'and','boost' => '5')));
//	$srchShould[] = array('match' => array('description' => array('query' => $productInfo,'operator' => 'or','boost' => '3')));
	//$srchShould[] = array('match' => array('category' => array('query' => $productInfo,'operator' => 'or','boost' => '2')));
//	$srchShould[] = array('match' => array('brand' => array('query' => $productInfo,'operator' => 'or')));
	
}

/*************Category*******************/
$catShould = "";
if(strpos($cat,','))
{	
	$cat = explode(",",$cat);	
	for($i=0;$i< count($cat);$i++)
	{
		$catShould[] = array('match' => array('category' => $cat[$i]));		
	}	
	
}else if(!empty($cat)){
	$must[] = array('match' => array('category' => $cat));	
}
$cat_idShould = "";
if(strpos($cat_id,','))
{	
	$cat_id = explode(",",$cat_id);	
	for($i=0;$i< count($cat_id);$i++)
	{
		$cat_idShould[] = array('match' => array('category_id' => $cat_id[$i]));		
	}	
	
}else if(!empty($cat_id)){
	$must[] = array('match' => array('category_id' => $cat_id));	
}
/*************Vendor*******************/
$vendShould = "";
if(strpos($vendor,','))
{	
	$vendor = explode(",",$vendor);	
	
	for($i=0;$i< count($vendor);$i++)
	{
		$vendShould[] = array('match' => array('vendor' => $vendor[$i]));		
	}	
}else if(!empty($vendor)){
	$must[] = array('match' => array('vendor' => $vendor));		
}
/*************Brand*******************/
$brandShould="";
if(strpos($brand,','))
{	
	$brand = explode(",",$brand);	
	
	for($i=0;$i< count($brand);$i++)
	{
		$brandShould[] = array('match' => array('brand' => $brand[$i]));		
	}	
}else if(!empty($brand)){
	$must[] = array('match' => array('brand' => $brand));		
}
/*************Group*******************/
$grpShould="";
if(strpos($group,','))
{	
	$group = explode(",",$group);	
	
	for($i=0;$i< count($group);$i++)
	{
		$grpShould[] = array('match' => array('grp' => $group[$i]));		
	}	
}else if(!empty($group)){
	$must[] = array('match' => array('grp' => $group));		
}
/*************Price Range*******************/
if(!empty($saleprice_min) && !empty($saleprice_max))
{
	$range = array(
		'saleprice' => 	array ('gte' => $saleprice_min,'lte' => $saleprice_max )			
	);	
	$search['body']['filter']['range'] = $range;
}
/*************Sort*******************/
if(!empty($sort))
{
		$search['body']['sort'] = $sort;
}


$search['body']['query']['function_score']['query']['bool']['must'] = $must;
if(!empty($catShould))
	$search['body']['query']['function_score']['query']['bool']['must'][]['bool']['should'] = $catShould;
if(!empty($cat_idShould))
	$search['body']['query']['function_score']['query']['bool']['must'][]['bool']['should'] = $cat_idShould;
if(!empty($vendShould))
	$search['body']['query']['function_score']['query']['bool']['must'][]['bool']['should'] = $vendShould;
if(!empty($brandShould))
	$search['body']['query']['function_score']['query']['bool']['must'][]['bool']['should'] = $brandShould;
if(!empty($grpShould))
	$search['body']['query']['function_score']['query']['bool']['must'][]['bool']['should'] = $grpShould;
if(!empty($srchShould))
	$search['body']['query']['function_score']['query']['bool']['must'][]['bool']['should'] = $srchShould;


//$search['body']['query']['function_score']['random_score']['seed'] = time();
//$search['body']['query']['function_score']['field_value_factor']['field'] = '';

//$search['body']['query']['function_score']['boost'] = 4;

//$functions = array( array('rnd'=> array('random_score' => array('seed' => time()))));
//$functions = array('FUNCTION'=> array('script_score' => array('script' => "_score - doc['vendor'].value" )));
//$functions = array(array('filter'=> array('match' => array('category_id' => 351)),'weight' => 8));
//$search['body']['query']['function_score']['script_score']['script'] = "doc['vendor'].value";


if(!empty($productInfo))
{

$functions = array(array('filter'=> array('match' => array('category_id' => 351)),'weight' => 2));

//$functions = array(array('filter'=> array('match' => array('vendor' => 0)),'weight' => 2));
$search['body']['query']['function_score']['functions'] = $functions;
$search['body']['query']['function_score']['max_boost'] = 8;
$search['body']['query']['function_score']['score_mode'] = 'max';
$search['body']['query']['function_score']['boost_mode'] = 'multiply';
$search['body']['query']['function_score']['min_score'] = 0.4;

}else{
	$search['body']['query']['function_score']['random_score']['seed'] = $session_id;
}



//$search['body']['query']['filtered']['filter']['bool']['must'][] = $catMust;
//$search['body']['query']['filtered']['filter']['bool']['must'][]['bool']['should'] = $vendShould;
//$search['body']['query']['bool']['should'] = $should;


if(!empty($prod))
{				
	$search['body']['query']['bool']['must'][]['bool']['must_not'] = array(
		array('match' => array('product_id' => $prod))    
	);		
}

//echo "<pre>";print_r(json_encode($search));
$result = $client->search($search);
//print_r($result);exit;
$arr = array('return_txt' => $result);
echo json_encode($arr);


?>	