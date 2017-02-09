<?php 
header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

require_once('vendor/autoload.php');
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
$isAggre			= isset($get->isAggre)?$get->isAggre:false;


/************Small Fixes************/
if($group == 'all') {$group='';}
if($order_by=='null')
	$order_by = '';
if($sort_order=='null')
	$sort_order = '';

if($isAggre)
	$size=0;
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
$search['body'] = array(
	'size' => $size,
	'from' => $from,
	'query' => array(
		'bool' => array(			
			'minimum_should_match'=>'75%'
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
				'size'	=>	0,
				'min_doc_count' => 2				
			),
			'aggs' => array(
				'category_id' => array(
					'terms' => array(
						'field' => 'category_id',
						'size'	=>	0,
						'min_doc_count' => 2
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
	)
);
 $must =array();
 $should =array();
 $must[] = array('match' => array('track_stock' => 1));
if(!empty($productInfo))
{				
	//$must[] = array('match' => array('name' => $productInfo));		
	$must[] = array('match' => array('name' => array('query' => $productInfo,'operator' => 'and')));		
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

/*************Aggregation Filter*******************/
if($isAggre)
{
	if(!empty($saleprice_min) && !empty($saleprice_max))
	{
		$range = array(
			'saleprice' => 	array ('gte' => $saleprice_min,'lte' => $saleprice_max )			
		);		
		$filter_agg['brand_aggr'] = array('range' => $range);		
	}	
	if(!empty($brand))
	{
		//print_r($brand);exit;
		$brandAggrShould="";
		if(strpos($brand,','))
		{	
			$brand = explode(",",$brand);	
			
			for($i=0;$i< count($brand);$i++)
			{
				$brandAggrShould[] = array('term' => array('brand' => $brand[$i]));		
			}	
			$filter_agg['price_aggr'] = array('or' => $brandAggrShould);	
		}else {
			$term = array(
				'brand' => $brand 
			);
			$filter_agg['price_aggr'] = array('term' => $term);		
		}
		
	}	
}
else
{


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
}

$search['body']['query']['bool']['must'] = $must;
if(!empty($catShould))
	$search['body']['query']['bool']['must'][]['bool']['should'] = $catShould;
if(!empty($cat_idShould))
	$search['body']['query']['bool']['must'][]['bool']['should'] = $cat_idShould;
if(!empty($vendShould))
	$search['body']['query']['bool']['must'][]['bool']['should'] = $vendShould;
if(!empty($brandShould))
	$search['body']['query']['bool']['must'][]['bool']['should'] = $brandShould;
if(!empty($grpShould))
	$search['body']['query']['bool']['must'][]['bool']['should'] = $grpShould;




if(!empty($filter_agg))
{
	
	if(!empty($filter_agg['brand_aggr']))
	{
	$search['body']['aggs']['brand_aggr'] = array( 'aggs' => array(			
											'brand' => array(
													'terms' => array(
														'field' => 'brand',
														//'min_doc_count' => 10,
														'size' => 0,
														/*'order' => array(
															'_count' => "desc"
														)*/
													)				
												),
												
												'saleprice_min' => array(
													'min' => array(
														'field' => 'saleprice'
													)		
												),
												'saleprice_max' => array(
													'max' => array(
														'field' => 'saleprice'
													)			
												)
										)
									);
	
	
		$search['body']['aggs']['brand_aggr']['filter'] = $filter_agg['brand_aggr'];
	}
	if(!empty($filter_agg['price_aggr']))
	{
		$search['body']['aggs']['price_aggr'] = array( 'aggs' => array(			
											
												'price_ranges' => array(
													'range' => array(
														'field' => 'saleprice',
														'ranges' => array(
															array("to" => 10000),
															array("from" => 10000,"to" => 20000),
															array("from" => 20000,"to" => 30000),
															array("from" => 30000)
														)
													)		
												),
												'saleprice_min' => array(
													'min' => array(
														'field' => 'saleprice'
													)		
												),
												'saleprice_max' => array(
													'max' => array(
														'field' => 'saleprice'
													)			
												)
										)
									);
		$search['body']['aggs']['price_aggr']['filter'] = $filter_agg['price_aggr'];
	}

	
}


if(!empty($prod))
{				
	$search['body']['query']['bool']['must'][]['bool']['must_not'] = array(
		array('match' => array('product_id' => $prod))    
	);		
}

//echo "<pre>";print_r(json_encode($search));exit;
$result = $client->search($search);
//print_r($result);
$arr = array('return_txt' => $result);
echo json_encode($arr);


?>	