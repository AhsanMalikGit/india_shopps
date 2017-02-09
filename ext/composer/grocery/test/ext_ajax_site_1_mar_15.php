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
$productInfo 		= isset($get->query)?$get->query:"";
$cat_id	 			= isset($get->category_id)?$get->category_id:"";
$cat	 			= isset($get->cat)?$get->cat:"";
$group				= isset($get->group)?$get->group:"";
$vendor				= isset($get->vendor)?$get->vendor:"";
$brand				= isset($get->brand)?$get->brand:"";
$size				= isset($get->size)?$get->size:"30";
$from				= isset($get->from)?$get->from:"0";
$saleprice_min		= isset($get->saleprice_min)?$get->saleprice_min:"";
$saleprice_max		= isset($get->saleprice_max)?$get->saleprice_max:"";
$order_by			= isset($get->order_by)?$get->order_by:"";
$sort_order			= isset($get->sort_order)?$get->sort_order:"";
$session_id			= isset($get->session_id)?$get->session_id:"";



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
	'from' => $from/*,
	'query' => array(
		'function_score' => array(
			'query' => array(
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
				'min_doc_count' => 10,
				'size' => 0,
				'order' => array(
					'_count' => "desc"
				)
			)			
		)
	)*/
);

if(!empty($productInfo))
{				

//$search['body']['query']['common']= array('name' => array('query' => $productInfo,'cutoff_frequency'=>0.001));


	$search['body']['query']['function_score']['query']['dis_max']['tie_breaker'] = 0.7;
	$search['body']['query']['function_score']['query']['dis_max']['boost'] = 1.2;	
	$search['body']['query']['function_score']['query']['dis_max']['queries'][]['common']= array('name' => array('query' => $productInfo,'boost'=>5,'cutoff_frequency'=>0.001));
	$search['body']['query']['function_score']['query']['dis_max']['queries'][]['common']= array('tags' => array('query' => $productInfo,'boost'=>10,'cutoff_frequency'=>0.001));
	//$search['body']['query']['function_score']['query']['dis_max']['queries'][]['common']= array('description' => array('query' => $productInfo,'boost'=>5,'cutoff_frequency'=>0.001));
//	$search['body']['query']['function_score']['fliter']['dis_max']['queries'][]['common']= array('category_id' => array('query' => 351,'boost'=>10,'cutoff_frequency'=>0.001));
	
/*$functions = array(array('filter'=> array('match' => array('vendor' => 0)),'weight' => 2));
$search['body']['query']['function_score']['functions'] = $functions;
$search['body']['query']['function_score']['max_boost'] = 6;
$search['body']['query']['function_score']['score_mode'] = 'max';
$search['body']['query']['function_score']['boost_mode'] = 'multiply';	*/


	//$search['body']['query']['bool']['should'][]= array('match' => array('name' => array('query' => $productInfo,'operator' => 'or','boost' => '3')));
//	$search['body']['query']['function_score']['query']['filtered']['query']['bool']['should'][]= array('match' => array('description' => array('query' => $productInfo,'operator' => 'or','boost' => '3')));
	//$search['body']['query']['function_score']['query']['filtered']['filter']['category_id']= array('match' => '351');
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
//	$search['body']['query']['function_score']['functions'][]['field_value_factor']= array('field' => 'category','factor'=>1.2,'modifier'=>'log1p','missing'=>1); 
	//$search['body']['query']['function_score']['filter']['dis_max']['queries'][]['common']= array('category' => array('query' => 'Mobiles','boost'=>10,'cutoff_frequency'=>0.001));
	
		//$search['body']['query']['function_score']['score_mode'] = "multiply";
	
	
	//$search['body']['query']['dis_max']['queries'][]['common']= array('brand' => array('query' => $productInfo,'cutoff_frequency'=>0.001));
	//$search['body']['query']['dis_max']['queries'][]['term']= array('name' => $productInfo);
	//$search['body']['query']['dis_max']['queries'][]['term']= array('description' => $productInfo);
	//$search['body']['query']['dis_max']['queries'][]['term']= array('brand' => $productInfo);  
	
	
//	$search['body']['query']['function_score']['random_score']['seed'] = time();
//	$search['body']['query']['function_score']['boost'] = 1.2;
	//$search['body']['query']['function_score']['functions'][]['filter'] = array('match'=>array('vendor' =>0 ));
	//$search['body']['query']['function_score']['functions'][]['weight'] = 2;

	
	
	
	
	//$search['body']['query']['dis_max']['queries'][]['common'][]['name']['boost'] = 10;
	//$search['body']['query']['dis_max']['queries'][]['common'][]['name']['cutoff_frequency'] = 0.001;
	/*$search['body']['query']['dis_max']['queries'][]['common'][]['ncategory']['query'] = $productInfo;
	$search['body']['query']['dis_max']['queries'][]['common'][]['ncategory']['boost'] = 5;
	$search['body']['query']['dis_max']['queries'][]['common'][]['ncategory']['cutoff_frequency'] = 0.001;
	$search['body']['query']['dis_max']['queries'][]['common'][]['brand']['query'] = $productInfo;
	$search['body']['query']['dis_max']['queries'][]['common'][]['brand']['boost'] = 3;
	$search['body']['query']['dis_max']['queries'][]['common'][]['brand']['cutoff_frequency'] = 0.001; */
	
}


//$search['body']['query']['function_score']['query']['bool']['must'] = $must;
//if(!empty($srchShould))
//$search['body']['query']['function_score']['query']['bool']['must'][]['bool']['should'] = $srchShould;
$sort = array(
		'_score' => array ('order' => 'desc' )
	);
$search['body']['sort'] = $sort;
 echo "<pre>";print_r(json_encode($search));
$result = $client->search($search);
print_r($result);exit;
$arr = array('return_txt' => $result);
echo json_encode($arr);


?>	
