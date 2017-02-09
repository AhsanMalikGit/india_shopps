<?php 

require_once("config.php");

$get = json_decode($_REQUEST['query']);

//print_r($get);exit;

$cat 		= "";

$group 		= "";

$group_alt 	= "";

$sort 		= "";

$productInfo 		= isset($get->query)?urldecode(strtolower($get->query)):"";

$cat_id	 			= isset($get->category_id)?$get->category_id:"";

$cat	 			= isset($get->cat)?strtolower($get->cat):"";

$group				= strtolower(isset($get->group)?$get->group:"");

$vendor				= isset($get->vendor)?$get->vendor:"";

$brand				= isset($get->brand)?strtolower($get->brand):"";

$brand_min_doc_count= isset($get->brand_min_doc_count)?$get->brand_min_doc_count:10;

$brand_size			= isset($get->brand_size)?$get->brand_size:0;

$size				= isset($get->size)?$get->size:30;

$from				= isset($get->from)?$get->from:0;

$saleprice_min		= isset($get->saleprice_min)?$get->saleprice_min:"";

$saleprice_max		= isset($get->saleprice_max)?$get->saleprice_max:"";

$order_by			= isset($get->order_by)?$get->order_by:"";

$sort_order			= isset($get->sort_order)?$get->sort_order:"";

$session_id			= isset($get->session_id)?$get->session_id:time();

//$isAggre			= isset($get->isAggre)?$get->isAggre:false;

$track_stock		= isset($get->track_stock)?$get->track_stock:1;





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



 $must =array();

 $should =array();


 $srchShould="";

if(!empty($productInfo))
{
	//$must[] = array('match' => array('name' => $productInfo));		

	//$srchShould[] = array('match' => array('name' => array('query' => $productInfo,'operator' => 'and')));		

	//$must[] = array('match' => array('name' => array('query' => $productInfo,'operator' => 'and')));	
	$srchShould[] = array('match' => array('name' => array('query' => $productInfo,'operator' => 'or','boost' => '2')));
	$srchShould[] = array('match' => array('tags' => array('query' => $productInfo,'operator' => 'and','boost' => '5')));
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

/********************************************************Using POST-Filter**********************************/	 
/*************Price Range*******************/

if(!empty($saleprice_min) && !empty($saleprice_max))
{
	$range = array(
		'saleprice' => 	array ('gte' => $saleprice_min,'lte' => $saleprice_max )
	);	
	//$range_agg = array("range" =>'saleprice' =>array ('gte' => $saleprice_min,'lte' => $saleprice_max ))
}else if(!empty($saleprice_min)){
	$range = array(
		'saleprice' => 	array ('gte' => $saleprice_min)
	);	
}else if(!empty($saleprice_max)){
	$range = array(
		'saleprice' => 	array ('lte' => $saleprice_max)
	);	
}

/*************Brand*******************/

$brandShould="";
if(strpos($brand,','))
{
	$brand = explode(",",$brand);
	for($i=0;$i< count($brand);$i++)
	{
		$brand_must[] = array('match' => array('brand' => $brand[$i]));
		$brand_agg[] = array("term" =>array( "brand" => $brand[$i]));
	}
}else if(!empty($brand)){
	//$must[] = array('match' => array('brand' => $brand));
	$brand_must = array('match' => array('brand' => $brand));
	//$brand_agg = array(array("term" =>array( "brand" => $brand ))) ;
	$brand_agg = (array("term" =>array( "brand" => $brand ))) ;
}

/*************Vendor*******************/

$vendShould = "";
if(strpos($vendor,','))
{
	$vendor = explode(",",$vendor);
	for($i=0;$i< count($vendor);$i++)
	{
		$vendor_must[] = array('match' => array('vendor' => $vendor[$i]));
		$vendor_agg[] = array("term" =>array( "vendor" => $vendor[$i]));
	}
}else if(!empty($vendor)){
	$vendor_must = array('match' => array('vendor' => $vendor));
	//$vendor_agg = array(array("term" =>array( "vendor" => $vendor)));
	$vendor_agg = (array("term" =>array( "vendor" => $vendor)));
}

/********************************************************Using POST-Filter**********************************/	 

/*************Sort*******************/







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
		)
		
	)
);




//print_r(count($brand_agg));exit;
if(!empty($brand_agg))
{
	if(count($brand_agg) > 1)
	{
		$search['body']['aggs']['filter_brand'] =	array(		
			/*"filters" => array(
				"filters" => $brand_agg,
			),*/
		   "filter" => array( "or" => $brand_agg),
		   "aggs" => array(
				"vendor" => array(
				  "terms" => array( "field" => "vendor" ) 
				),
				"brand" => array(
				  "terms" => array( "field" => "brand" ) 
				),
				"saleprice_min" => array(
				  "min" => array( "field" => "saleprice" ) 
				),
				"saleprice_max" => array(
				  "max" => array( "field" => "saleprice" ) 
				)
			)		
		);
	}else{
		$search['body']['aggs']['filter_brand'] =	array(		
			/*"filters" => array(
				"filters" => $brand_agg,
			),*/
		   "filter" => $brand_agg,
		   "aggs" => array(
				"vendor" => array(
				  "terms" => array( "field" => "vendor" ) 
				),
				"brand" => array(
				  "terms" => array( "field" => "brand" ) 
				),
				"saleprice_min" => array(
				  "min" => array( "field" => "saleprice" ) 
				),
				"saleprice_max" => array(
				  "max" => array( "field" => "saleprice" ) 
				)
			)		
		);
	}
}
if(!empty($vendor_agg))
{
	if(count($vendor_agg) > 1)
	{
		$search['body']['aggs']['filter_vendor'] =	array(
				"filter" => array( "or" => $vendor_agg),
			   "aggs" => array(
					"brand" => array(
					  "terms" => array( "field" => "brand" ) 
					),
					"vendor" => array(
					  "terms" => array( "field" => "vendor" ) 
					),
					"saleprice_min" => array(
					  "min" => array( "field" => "saleprice" ) 
					),
					"saleprice_max" => array(
					  "max" => array( "field" => "saleprice" ) 
					)
				)		
		);	
	}else{
				$search['body']['aggs']['filter_vendor'] =	array(
				"filter" => $vendor_agg,
			   "aggs" => array(
					"brand" => array(
					  "terms" => array( "field" => "brand" ) 
					),
					"vendor" => array(
					  "terms" => array( "field" => "vendor" ) 
					),
					"saleprice_min" => array(
					  "min" => array( "field" => "saleprice" ) 
					),
					"saleprice_max" => array(
					  "max" => array( "field" => "saleprice" ) 
					)
				)		
		);	

	}
}
if(!empty($range))
{
	
	$search['body']['aggs']['filter_saleprice'] =	array(
			"filter" => array( "range" => $range),
		   "aggs" => array(
				"brand" => array(
				  "terms" => array( "field" => "brand" ) 
				),
				"vendor" => array(
				  "terms" => array( "field" => "vendor" ) 
				),
				"saleprice_min" => array(
				  "min" => array( "field" => "saleprice" ) 
				),
				"saleprice_max" => array(
				  "max" => array( "field" => "saleprice" ) 
				)
			)		
	);	
	
}

$search['body']['aggs']['vendor'] =	array(
	'terms' => array(
		'field' => 'vendor',
		'size' => 0
	)
);

$search['body']['aggs']['brand'] =	array( 
	'terms' => array(
		'field' => 'brand',
		'min_doc_count' => $brand_min_doc_count,
		'size' => $brand_size,
		'order' => array(
			'_count' => "desc"
		)
	)		
);



$must[] = array('match' => array('track_stock' => $track_stock));
$must[] = array('range' => array('saleprice' => array('gte' => 10)));

$search['body']['query']['function_score']['query']['bool']['must'] = $must;

if(!empty($catShould))
	$search['body']['query']['function_score']['query']['bool']['must'][]['bool']['should'] = $catShould;

if(!empty($cat_idShould))
	$search['body']['query']['function_score']['query']['bool']['must'][]['bool']['should'] = $cat_idShould;

if(!empty($grpShould))
	$search['body']['query']['function_score']['query']['bool']['must'][]['bool']['should'] = $grpShould;

if(!empty($srchShould))	
	$search['body']['query']['function_score']['query']['bool']['must'][]['bool']['should'] = $srchShould;	

if(!empty($brand_must))		
	$search['body']['post_filter']['bool']['must'][]['bool']['should'] = $brand_must;
if(!empty($vendor_must))		
	$search['body']['post_filter']['bool']['must'][]['bool']['should'] = $vendor_must;
if(!empty($range))
	$search['body']['post_filter']['bool']['must'][]['bool']['should']['range'] = $range;

if(!empty($sort))
{
	$search['body']['sort'] = $sort;
}




/*if(!empty($vendShould))

	$search['body']['query']['function_score']['query']['bool']['must'][]['bool']['should'] = $vendShould;

if(!empty($brandShould))

	$search['body']['query']['function_score']['query']['bool']['must'][]['bool']['should'] = $brandShould;*/



if(isset($_REQUEST['pre']))
{
echo "<pre>";print_r(json_encode($search));
}

$result = $client->search($search);
if(isset($_REQUEST['pre']))
{
	print_r($result);exit;
}
$arr = array('return_txt' => $result);

echo json_encode($arr);





?>	