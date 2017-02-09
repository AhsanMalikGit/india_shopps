<?php 

require_once("config.php");

$get = json_decode($_REQUEST['query']);

//print_r($get);exit;

$cat 		= "";

$group 		= "";

$group_alt 	= "";

$sort 		= "";

$productInfo 		= isset($get->query)?urldecode(strtolower($get->query)):"";

$category	 		= isset($get->category)?strtolower($get->category):"";

$deal_type				= strtolower(isset($get->deal_type)?$get->deal_type:"");

$type				= isset($get->type)?$get->type:"";

$size				= isset($get->size)?$get->size:31;

$from				= isset($get->from)?$get->from:0;

//$order_by			= isset($get->order_by)?$get->order_by:"";
$order_by			= "end_datetime";

$sort_order			= isset($get->sort_order)?$get->sort_order:"asc";

$session_id			= isset($get->session_id)?$get->session_id:time();







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
$filter_applied = array();

 $srchShould="";

if(!empty($productInfo))
{
	
	$srchShould[] = array('match' => array('name' => array('query' => $productInfo,'operator' => 'or','boost' => '2')));
	//$srchShould[] = array('match' => array('tags' => array('query' => $productInfo,'operator' => 'and','boost' => '5')));
}

/*************Category*******************/

$catShould = "";

if(strpos($category,','))
{	

	$category = explode(",",$category);	
	$filter_applied[] = "category";
	for($i=0;$i< count($category);$i++)

	{

		$catShould[] = array('match' => array('category' => $category[$i]));		
		$agg_filter['category_agg'] = (array("term" =>array( "category" => $category[$i]))) ;
	}	

	

}else if(!empty($category)){
	$filter_applied[] = "category";
	$catShould = array('match' => array('category' => $category));	
	$agg_filter['category_agg'] = (array("term" =>array( "category" => $category ))) ;
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








$search = array();
$search['index'] = "amzsale";
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
		'category' => array(
			'terms' => array(
				'field' => 'category',
				'size'	=>	0
				//'min_doc_count' => 2
			)			
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
$post_filter_aggs = array(		//Merge it with filter aggregation
	"aggs" => array(
		"category" => array(
		  "terms" => array( "field" => "category" ) 
		)
	)	
);

if(!empty($filters['filter']))
{	
	$search['body']['aggs']['filters_all'] = array_merge($filters['filter'],$post_filter_aggs);
}
$must[] = array('range' => array('end_datetime' => array('gte' => "now+330m")));
$must[] = array('range' => array('start_datetime' => array('lte' => "now+330m")));


if(!empty($must))
	$search['body']['query']['function_score']['query']['bool']['must'] = $must;

if(!empty($catShould))
	$search['body']['post_filter']['bool']['must'][]['bool']['should'] = $catShould;



if(!empty($srchShould))	
	$search['body']['query']['function_score']['query']['bool']['must'][]['bool']['should'] = $srchShould;	



if(!empty($sort))
{
	$search['body']['sort'] = $sort;
}





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