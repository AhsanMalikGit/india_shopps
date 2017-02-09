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
$get 		= $_REQUEST;
$sort 		= "";
$cat 		= "";
$group 		= "";
$group_alt 	= "";
$productInfo 	= $get['query'];
$cat	 		= isset($get['cat_id'])?$get['cat_id']:"";
$group			= isset($get['group'])?$get['group']:"";
$vendor			= isset($get['vendor'])?$get['vendor']:"";
$brand			= isset($get['brand'])?$get['brand']:"";
$saleprice_min	= isset($get['saleprice_min'])?$get['saleprice_min']:"";
$saleprice_max	= isset($get['saleprice_max'])?$get['saleprice_max']:"";
$size			= isset($get['size'])?$get['size']:"0";
$page			= isset($get['page'])?$get['page']:"1";
$order_by		= isset($get['sort_field'])?$get['sort_field']:"";
$sort_order		= isset($get['sort_type'])?$get['sort_type']:"asc";
$from 			= (($page-1)*$size);
$isAggre		= isset($get['isAggre'])?$get['isAggre']:false;

/*
$productInfo 	= isset($get->query)?$get->query:"";
$cat	 		= isset($get->cat)?$get->cat:"";
$group			= isset($get->group)?$get->group:"";
$vendor			= isset($get->vendor)?$get->vendor:"";
$brand			= isset($get->brand)?$get->brand:"";
$size			= isset($get->size)?$get->size:"30";
$from			= isset($get->from)?$get->from:"0";
$saleprice_min	= isset($get->saleprice_min)?$get->saleprice_min:"";
$saleprice_max	= isset($get->saleprice_max)?$get->saleprice_max:"";
$order_by		= isset($get->order_by)?$get->order_by:"";
$sort_order		= isset($get->sort_order)?$get->sort_order:"";
$isAggre		= isset($get->isAggre)?$get->isAggre:false;*/

if($order_by=='null')
	$order_by = '';
if($sort_order=='null')
	$sort_order = '';
if($group == 'all') {$group='';}
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
$search['index'] = "shopping";
//$search['from']  = $data['from'];
$search['body'] = array(
	'size' => $size,
	'from' => $from,
	'query' => array(
		'bool' => array(			
			'minimum_should_match'=>'75%'
		)
    ),
	'aggs' => array(
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
		),
		'brand' => array(
			'terms' => array(
				'field' => 'brand',				
				'size' => 0,
				/*'order' => array(
					'_count' => "desc"
				)*/
			)
		),
		'vendor' => array(
			'terms' => array(
				'field' => 'vendor'
			)			
		),'grp' => array(
			'terms' => array(
				'field' => 'grp'
			)			
		)
	)
); 
 $must =array();
 $should =array();
// $must[] = array('match' => array('track_stock' => 1));
 $srchShould="";
if(!empty($productInfo))
{				
	//$must[] = array('match' => array('name' => $productInfo));		
	//$must[] = array('match' => array('name' => array('query' => $productInfo,'operator' => 'and')));		
	$srchShould[] = array('match' => array('name' => array('query' => $productInfo,'operator' => 'or','boost' => '3')));
	$srchShould[] = array('match' => array('category' => array('query' => $productInfo,'operator' => 'or','boost' => '2')));
	$srchShould[] = array('match' => array('brand' => array('query' => $productInfo,'operator' => 'or')));
}

/*************Category*******************/
$catShould = "";
if(strpos($cat,','))
{	
	$cat = explode(",",$cat);	
	for($i=0;$i< count($cat);$i++)
	{
		$catShould[] = array('match' => array('category_id' => $cat[$i]));		
	}	
	
}else if(!empty($cat)){
	$must[] = array('match' => array('category_id' => $cat));	
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
		$filter_agg['vendor_aggr'] = array('range' => $range);		
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
			$filter_agg['vendor_aggr'] = array('or' => $brandAggrShould);	
		}else {
			$term = array(
				'brand' => $brand 
			);
			$filter_agg['price_aggr'] = array('term' => $term);		
			$filter_agg['vendor_aggr'] = array('term' => $term);		
		}
		
	}	
	if(!empty($vendor))
	{
		//print_r($vendor);exit;
		$vendorAggrShould="";
		if(strpos($vendor,','))
		{	
			$vendor = explode(",",$vendor);	
			
			for($i=0;$i< count($vendor);$i++)
			{
				$brandAggrShould[] = array('term' => array('vendor' => $vendor[$i]));		
			}	
			$filter_agg['price_aggr'] = array('or' => $brandAggrShould);	
			$filter_agg['brand_aggr'] = array('or' => $brandAggrShould);	
		}else {
			$term = array(
				'vendor' => $vendor 
			);
			$filter_agg['price_aggr'] = array('term' => $term);		
			$filter_agg['brand_aggr'] = array('term' => $term);		
		}
		
	}	
}

else
{
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
if(!empty($srchShould))
	$search['body']['query']['bool']['must'][]['bool']['should'] = $srchShould;
//print_r($filter_agg);exit;
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
if(!empty($filter_agg['vendor_aggr']))
	{
		$search['body']['aggs']['vendor_aggr'] = array( 'aggs' => array(			
											
												'vendor' => array(
													'terms' => array(
														'field' => 'vendor'
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
		$search['body']['aggs']['vendor_aggr']['filter'] = $filter_agg['vendor_aggr'];
	}

	
}


//echo "<pre>";print_r(json_encode($search));
$result = $client->search($search);
$arr = array('status'=>true,'keycode'=>100,'products' => $result);

if(isset($get['pretty']))
{
	header("Content-type:application/json"); 
	echo json_encode($arr, JSON_PRETTY_PRINT);
}else{
	echo json_encode($arr);
}


?>