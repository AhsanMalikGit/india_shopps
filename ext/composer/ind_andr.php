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

$get 		= $_REQUEST;

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
$size			= isset($get['size'])?$get['size']:"30";
$page			= isset($get['page'])?$get['page']:"1";
$sort_field		= isset($get['sort_field'])?$get['sort_field']:"";
$sort_type		= isset($get['sort_type'])?$get['sort_type']:"asc";
$from 			= (($page-1)*$size);
$id				= isset($get['_id'])?$get['_id']:"0";



$productInfo = str_replace("/","-",$productInfo);
$productInfo = str_replace(" AND ","",$productInfo);
$productInfo = str_replace("AND ","",$productInfo);
$productInfo = str_replace(" and ","",$productInfo);
$productInfo = str_replace("and ","",$productInfo);
$productInfo = str_replace(" OR ","",$productInfo);
$productInfo = str_replace(" or ","",$productInfo);

$sort = "";
if(!empty($sort_field))
{
	$sort = array(array(
		$sort_field => array ('order' => $sort_type )
	));
}
//print_r($sort);exit;
$clickUrl = 'http://www.yourshoppingwizard.com/ext/log.php';
//$searchAPI = 'http://www.yourshoppingwizard.com:9200/shopping/_search';
$search = array();
$search['index'] = "shopping";

$search['body'] = array(
	'size' => $size,	
	'from' => $from,
	'query' => array(		
		'bool' => array(			
			'minimum_should_match'=>1				
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
				'field' => 'category'				
			)			
		),'category_id' => array(
			'terms' => array(
				'field' => 'category_id'
			)			
		),
		'vendor' => array(
			'terms' => array(
				'field' => 'vendor'
			)			
		),
		'brand' => array(
			'terms' => array(
				'field' => 'brand'
			)			
		),
		'grp' => array(
			'terms' => array(
				'field' => 'grp'
			)			
		)
	)
);
 if(!empty($id))
{
	$search['body'] = array(
		'size' => $size,	
		'from' => $from,
		'query' => array(
			'bool' => array(			
				'minimum_should_match'=>1				
			)
		)
	);
}
//$search['body']['query']['bool'] = array( 'should' => new \stdClass());

$must =array();
if(!empty($id))
{
	$must[] = array('match' => array('_id' => $id));
}
if(!empty($productInfo))
{
	$must[] = array('match' => array('name' => $productInfo));	
}


$should =array();

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

//$search['body']['query']['bool']['should'] = $should;


$search['body']['query']['bool']['must'] = $must;
if(!empty($catShould))
	$search['body']['query']['bool']['must'][]['bool']['should'] = $catShould;
if(!empty($vendShould))
	$search['body']['query']['bool']['must'][]['bool']['should'] = $vendShould;
if(!empty($brandShould))
	$search['body']['query']['bool']['must'][]['bool']['should'] = $brandShould;
if(!empty($grpShould))
	$search['body']['query']['bool']['must'][]['bool']['should'] = $grpShould;


//echo "<pre>";print_r(json_encode($search));exit;
$result = $client->search($search);
if(isset($get['_id']) && isset($get['raw']) && ($get['raw']))
{	
	$res = $result['hits']['hits'][0];	
	echo json_encode($res);	exit;
}
$arr = array('status'=>true,'keycode'=>100,'products' => $result);

if(isset($get['pretty']))
{
	header("Content-type:application/json"); 
	echo json_encode($arr, JSON_PRETTY_PRINT);
}else{
	echo json_encode($arr);
}




?>

	