<?php 
require_once("config.php");
$cat 	= "";
$group 	= "";
$group_alt = "";
$productInfo 	= $_REQUEST['info'];
$prod 			= isset($_REQUEST['pid'])?$_REQUEST['pid']:"";
$cat 		= isset($_REQUEST['cat'])?$_REQUEST['cat']:"";
$cat_id 		= isset($_REQUEST['cat_id'])?$_REQUEST['cat_id']:"";

$size		= isset($_REQUEST['size'])?$_REQUEST['size']:"";
$len		= isset($_REQUEST['len'])?$_REQUEST['len']:"";


$productInfo = str_replace("/","-",$productInfo);
$productInfo = str_replace(" AND ","",$productInfo);
$productInfo = str_replace("AND ","",$productInfo);
$productInfo = str_replace(" and ","",$productInfo);
$productInfo = str_replace("and ","",$productInfo);
$productInfo = str_replace(" OR ","",$productInfo);
$productInfo = str_replace(" or ","",$productInfo);

$clickUrl = 'http://www.indiashopps.com/ext/log.php';
$search = array();

$search['index'] = "grocery";
	
//$search['from']  = $data['from'];
$search['body'] = array(
	'size' => 20,
	'query' => array(
		'bool' => array(
			'must' =>  array(
						array('match' => array('name' => $productInfo)),
						array('match' => array('track_stock' => 1)),
						array('range' => array('saleprice' => array('gte' => 10)))
					)			
		)
	)
);

//$search['body']['query']['bool'] = array( 'should' => new \stdClass());

 if(!empty($cat)){	$search['body']['query']['bool']['should'] = array(		array('match' => array('category' => $cat))	);}

if(!empty($prod))
{				
	$search['body']['query']['bool']['must_not'] = array(
		array('match' => array('_id' => $prod))    
	);		
}
// echo "<PRE>";
// print_r( $search );exit;

//print_r(json_encode($search));
$result = $client->search($search);

//print_r($result['hits']['hits']);exit;
$arr = array('return_txt' => $result['hits']['hits']);
echo json_encode($arr, JSON_UNESCAPED_UNICODE);
	//echo $return_txt;


?>