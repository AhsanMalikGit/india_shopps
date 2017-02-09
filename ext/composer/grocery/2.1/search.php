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
$brand				= isset($get->brand)?strtolower($get->brand):"";
$brand_size			= isset($get->brand_size)?$get->brand_size:0;
$size				= isset($get->size)?$get->size:30;
$from				= isset($get->from)?$get->from:0;
$saleprice_min		= isset($get->saleprice_min)?$get->saleprice_min:"";
$saleprice_max		= isset($get->saleprice_max)?$get->saleprice_max:"";
$order_by			= isset($get->order_by)?strtolower($get->order_by):"";
$sort_order			= isset($get->sort_order)?strtolower($get->sort_order):"";
$session_id			= isset($get->session_id)?$get->session_id:time();
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
$filter_applied = array();
$should =array();

/*************Search Query*******************/
$srchShould="";
if(!empty($productInfo))
{
	//$must[] = array('match' => array('name' => $productInfo));		

	//$srchShould[] = array('match' => array('name' => array('query' => $productInfo,'operator' => 'and')));		

	//$must[] = array('match' => array('name' => array('query' => $productInfo,'operator' => 'and')));	
	$srchShould[] = array('match' => array('name' => array('query' => $productInfo,'operator' => 'or','boost' => '2')));
	$srchShould[] = array('match' => array('category' => array('query' => $productInfo,'operator' => 'and','boost' => '2')));
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


/********************************************************Using POST-Filter**********************************/	 
/*************Price Range*******************/

if(!empty($saleprice_min) && !empty($saleprice_max))
{
	$filter_applied[] = "saleprice_min";
	$filter_applied[] = "saleprice_max";
	$range = array(
		'saleprice' => 	array ('gte' => $saleprice_min,'lte' => $saleprice_max )
	);	
	//$range_agg = array("range" =>'saleprice' =>array ('gte' => $saleprice_min,'lte' => $saleprice_max ))
}else if(!empty($saleprice_min)){
	$filter_applied[] = "saleprice_min";
	$range = array(
		'saleprice' => 	array ('gte' => $saleprice_min)
	);	
}else if(!empty($saleprice_max)){
	$filter_applied[] = "saleprice_max";
	$range = array(
		'saleprice' => 	array ('lte' => $saleprice_max)
	);	
}

/*************Brand*******************/


if(strpos($brand,','))
{
	$brand = explode(",",$brand);
	$filter_applied[] = "brand";
	for($i=0;$i< count($brand);$i++)
	{
		$brand_must[] = array('match' => array('brand' => $brand[$i]));
		$agg_filter['brand_agg'][] = array("term" =>array( "brand" => $brand[$i]));
	}
}else if(!empty($brand)){	
	$filter_applied[] = "brand";
	$brand_must = array('match' => array('brand' => $brand));	
	$agg_filter['brand_agg'] = (array("term" =>array( "brand" => $brand ))) ;
}












/********************************************************Using POST-Filter**********************************/	 

/*************Sort*******************/

$search = array();
$search['index'] = "grocery";
$search['type'] = "product";
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
);






$search['body']['aggs']['brand'] =	array( 
	'terms' => array(
		'field' => 'brand',
		'size' => $brand_size,		
		'order' => array(
			'_count' => "desc"
		)
	)		
);

if(!empty($agg_filter))			//Adding filter for aggregation, as we're using Post-Filter
{
	if(count($agg_filter) > 1)	//If more than one filter is there
	{
		$fill = array();
		foreach($agg_filter as $key=>$value)
		{			
			if(count($value)>1)
			{
				$fill[] = array( "or" => $value);
			}else{
				$fill[] = $value;
			}
		}
		$filters['filter'] =	array(
			//"filters" => array("filters" => $fill)			
			"filter" => array("and" => $fill)			
		);
	
	}else{		//If single filter is applied
		foreach($agg_filter as $key=>$value)
		{			
			if(count($value) > 1)
			{
				$filters['filter'] =	array(
					"filter" => array( "or" => $value)
				);
			}else{
				$filters['filter'] = array(
					"filter" => $value
				);
			}
		}
	
	}
}
if(!empty($range))
{	
	$filters['filter'] =	array(
		   "filter" => array( "range" => $range)
	);	
}

$post_filter_aggs = array(		//Merge it with filter aggregation
	"aggs" => array(
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


$must[] = array('match' => array('track_stock' => $track_stock));
$must[] = array('range' => array('saleprice' => array('gte' => 10)));

$search['body']['query']['function_score']['query']['bool']['must'] = $must;

if(!empty($catShould))
	$search['body']['query']['function_score']['query']['bool']['must'][]['bool']['should'] = $catShould;

if(!empty($cat_idShould))
	$search['body']['query']['function_score']['query']['bool']['must'][]['bool']['should'] = $cat_idShould;



if(!empty($srchShould))	
	$search['body']['query']['function_score']['query']['bool']['must'][]['bool']['should'] = $srchShould;	

if(!empty($brand_must))		
	$search['body']['post_filter']['bool']['must'][]['bool']['should'] = $brand_must;


if(!empty($range))
	$search['body']['post_filter']['bool']['must'][]['bool']['should']['range'] = $range;



if(!empty($sort))
{
	$search['body']['sort'] = $sort;
}

$search['body']['query']['function_score']['random_score']['seed'] = $session_id;


if(isset($_REQUEST['pre']))
{
echo "<pre>";print_r(json_encode($search));
}

$result = $client->search($search);
$arr = array('return_txt' => $result,'filter_applied'=>$filter_applied);
if(isset($_REQUEST['pre']))
{
	print_r($arr);exit;
}

echo json_encode($arr);

?>