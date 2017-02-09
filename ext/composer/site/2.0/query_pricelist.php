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
// print_r($_REQUEST);exit;
$group ="";
$sort 			= "";
$productInfo 	= isset($get->query)?$get->query:"";
$cat	 		= isset($get->cat)?$get->cat:"";
$cat_id	 		= isset($get->cat_id)?$get->cat_id:"";
/*$group			= isset($get->grp)?$get->grp:"";
if(empty($group))
	$group			= isset($get->group)?$get->group:"";*/
$vendor			= isset($get->vendor)?$get->vendor:"";
$brand			= isset($get->brand)?$get->brand:"";
$size			= isset($get->size)?$get->size:"24";
$from			= isset($get->from)?$get->from:"0";
$saleprice_min	= isset($get->saleprice_min)?$get->saleprice_min:"";
$saleprice_max	= isset($get->saleprice_max)?$get->saleprice_max:"";
$order_by		= isset($get->order_by)?$get->order_by:"";
$sort_order		= isset($get->sort_order)?$get->sort_order:"";
$isAggre		= isset($get->isAggre)?$get->isAggre:false;
$smax			= isset($get->smax)?$get->smax:60000;
$smin			= isset($get->smin)?$get->smin:10000;


/**************Some Fixes*************/

if($order_by=='null')
	$order_by = '';
if($sort_order=='null')
	$sort_order = '';
if($group == 'all') {$group='';}
if($isAggre)
	$size=0;
if(!empty($cat))
{
	//$cat = str_replace("-"," ",$cat);
	$cat = preg_replace("/[-]/", " ", $cat);	
}

$prange = intval(floor(($smax - $smin)/4));
if($prange > 10000)
{
	$prange = intval(floor($prange / 10000))*10000;
}elseif($prange > 1000){
	$prange = intval(floor($prange / 1000))*1000;
}else{
	$prange = intval(floor($prange / 100))*100;
}
//$prange = array(10000,20000,30000);
$price_range = array();
$price_range[] = array("to" => ($prange-1));
$price_range[] = array("from" => $prange,"to" => ($prange*2-1));
$price_range[] = array("from" => ($prange*2),"to" => ($prange*3-1));
$price_range[] = array("from" => ($prange*3));
//print_r($price_range);exit;
/*
$price_range[] = array("to" => $prange[0]);
for($i=1;$i<(count($prange));$i++)
{
	$price_range[] = array("from" => $prange[$i-1],"to" => $prange[$i]);
}
$price_range[] = array("from" => $prange[count($prange)-1]);*/




//echo $cat;
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
/**************Some Fixes*************/
if(isset($order_by) && !empty($order_by))
{
	$sort = array(
		$order_by => array ('order' => $sort_order )
	);
}
$br = $brand;

if(is_array($br))
{	
	$brand = "";
	foreach($br as $b)
	{
		$brand .= $b.",";
	}
	$brand = substr($brand,0,-1);
}

//echo $brand;exit;


$search = array();
//$search['index'] = "test_prime";
$search['index'] = "shopping";
//$search['from']  = $data['from'];
$search['body'] = array(
	'size' => $size,
	'from' => $from,
	'query' => array(
		'bool' => array(			
			'minimum_should_match'=>'100%'
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
		'price_ranges' => array(
			'range' => array(
				'field' => 'saleprice',
				'ranges' => $price_range
			)		
		),
		
		'brand' => array(
			'terms' => array(
				'field' => 'brand',				
				'size' => 0,
				'min_doc_count' => 2
				/*'order' => array(
					'_count' => "desc"
				)*/
			)
		)/*,
		'all' => array(
			 'global' => new stdClass(),
			'aggs' => array(
				'totalBrand' => array(
					'terms' => array(
						'field' => 'brand'
					)			
				)
			)			
		),*/
	)
); 
 $must =array();
 $should =array();
// $must[] = array('match' => array('track_stock' => 1));
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
	//$must[] = array('term' => array('category' => $cat));	
}
/*if(strpos($cat_id,','))
{	
	$cat_id = explode(",",$cat_id);	
	for($i=0;$i< count($cat_id);$i++)
	{
		$catShould[] = array('match' => array('category_id' => $cat_id[$i]));		
	}	
	
}else if(!empty($cat_id)){
	$must[] = array('match' => array('category_id' => $cat_id));	
}*/
/*************Vendor****************/
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
}else if($vendor==0){
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
	$range ="";
	if(!empty($saleprice_min) && !empty($saleprice_max))
	{
		$range = array(
			'saleprice' => 	array ('gte' => $saleprice_min,'lte' => $saleprice_max )			
		);	
		//$must['range'] = $range;
		$must[] = array('range' => $range);		
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
if(!empty($vendShould))
	$search['body']['query']['bool']['must'][]['bool']['should'] = $vendShould;
if(!empty($brandShould))
	$search['body']['query']['bool']['must'][]['bool']['should'] = $brandShould;
if(!empty($grpShould))
	$search['body']['query']['bool']['must'][]['bool']['should'] = $grpShould;
//print_r($filter_agg);exit;
if(!empty($filter_agg))
{
	
	if(!empty($filter_agg['brand_aggr']))
	{
	$search['body']['aggs']['brand_aggr'] = array( 'aggs' => array(			
											'brand' => array(
													'terms' => array(
														'field' => 'brand',
														'min_doc_count' => 2,
														'size' => 0
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
														'ranges' => $price_range
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


//echo "<pre>";print_r(json_encode($search));
//echo "<br>";
$result = $client->search($search);
//echo "<pre>";print_r($result);exit;
$arr = array('return_txt' => $result);
echo json_encode($arr);


?>	