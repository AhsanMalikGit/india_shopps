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
$client = new Elasticsearch\Client($params);

$cat 	= "";
$group 	= "";
$group_alt = "";
$productInfo 	= $_REQUEST['query'];
$prod 			= isset($_REQUEST['prod'])?$_REQUEST['prod']:"";
$cat_post 		= isset($_REQUEST['cat'])?$_REQUEST['cat']:"";
$group_post		= isset($_REQUEST['group'])?$_REQUEST['group']:"";
$vendor		= isset($_REQUEST['vendor'])?$_REQUEST['vendor']:"";
$size		= isset($_REQUEST['size'])?$_REQUEST['size']:"";

if(isset($cat_post) && !empty($cat_post) && (trim($cat_post) == 'Smartphones' || trim($cat_post) == 'Basic Mobiles'|| trim($cat_post) == 'Feature Phones'|| trim($cat_post) == 'Mobile Phones' || trim($cat_post) == 'Mobiles'))
{
	$cat = "Mobiles";	
}else if(isset($cat_post) && !empty($cat_post) && (trim($cat_post) == 'Digital Cameras' || trim($cat_post) == 'Cameras' || trim($cat_post) == 'Point & Shoot Digital Cameras' || trim($cat_post) == 'Digital SLRs'))
{
	$cat = "Cameras";	
}


if(isset($group_post) && !empty($group_post))
{
	if(strpos($group_post,' ') !== false)
	{
		$group_post = explode(" ",$group_post);
		$group_post = $group_post[0];
	}
	switch(strtolower($group_post)){
		case "women's":
		case 'women':
		case 'ladies':
			$group = "Women";
			$group_alt = "unisex";
		break;
		case "men's":
		case 'men':
			$group = "Men";
			$group_alt = "unisex";
		break;
		case 'boys':
		case 'girls':
		case 'kids':
		case "kids'":
			$group = "Kids";
			$group_alt = "unisex";
		break;
		case 'hardware & sanitary fittings':
		case 'home furnishing':
		case 'home decoratives':
		case 'home & kitchen':
		case 'home':
			$group = "Home";
		break;
		case 'kitchen appliances':
		case 'kitchenware':
			$group = "kitchen";
		break;
		case 'books':
			$group = "Books";
		break;
		case 'mobiles & accessories':
		case 'electronic':
			$group = "Electronic";
		break;
		case 'automobiles':
			$group = "Automobiles";
		break;
		case 'sports':
			$group = "Sports";
		break;
		case 'travel':
			$group = "Travel";
		break;
		case 'accessories':
			$group = "Accessories";
		break;
		
	}
	if(isset($cat_post) && !empty($cat_post))
	{
		if($cat_post=='Clothing' || $cat_post=='Clothing & Accessories' || $cat_post=='Apparel'|| strpos($cat_post,'Shirt') !== false || $cat_post=='Ethnic Wear')
		{
			switch(strtolower($group_post)){
				case "men's":
				case 'men':
					$cat = "Men's Clothing";
				break;
				case "women's":
				case 'women':
				case 'ladies':
					$cat = "Women's Clothing";
				break;
				case 'boys':
				case 'girls':
				case 'kids':
				case "kids'":
					$cat = "Kids' Clothing";
				break;
			}
		}else if($cat_post=='Footwear' || $cat_post=='Shoe' || $cat_post=='Shoes')
		{
			switch(strtolower($group_post)){
				case "men's":
				case 'men':
					$cat = "Men's Footwear";
				break;
				case "women's":
				case 'women':
				case 'ladies':
					$cat = "Women's Footwear";
				break;
				case 'boys':
				case 'girls':
				case 'kids':
				case "kids'":
					$cat = "Kids' Footwear";
				break;
			}
		}
	}
	
}


if(!empty($prod))
{
	$code = substr( $prod, 0, 3 );
	switch($code)
	{
		case 'MOB':
			$cat = "Mobiles";
		break;
		case 'CAM':
			$cat = "Cameras";
		break;
		case 'WCW':
			$cat = "Bags, Wallets & Belts";
		break;
		
	}	
}

$productInfo = str_replace("/","-",$productInfo);
$productInfo = str_replace(" AND ","",$productInfo);
$productInfo = str_replace("AND ","",$productInfo);
$productInfo = str_replace(" and ","",$productInfo);
$productInfo = str_replace("and ","",$productInfo);
$productInfo = str_replace(" OR ","",$productInfo);
$productInfo = str_replace(" or ","",$productInfo);

$clickUrl = 'http://www.indiashopps.com/ext/log.php';
$search = array();
$search['index'] = "shopping";
//$search['from']  = $data['from'];
$search['body'] = array(
	'size' => 20,
	'query' => array(
		'bool' => array(
			'must' =>  array(
						array('match' => array('name' => array('query' => $productInfo,'operator' => 'or'))),
						array('match' => array('track_stock' => 1))    
					)			
		)
	)
);

//$search['body']['query']['bool'] = array( 'should' => new \stdClass());

if(!empty($cat) && !empty($group))
{
	if(!empty($group_alt))
	{
		$search['body']['query']['bool']['should'] = array(
			array('match' => array('category' => $cat)),
			array('match' => array('grp' => $group)),
			array('match' => array('grp' => $group_alt))
		);	

	}else{
		$search['body']['query']['bool']['should'] = array(
			array('match' => array('category' => $cat)),
			array('match' => array('grp' => $group))
		);	
	}
}else if(!empty($cat))
{ 	
	$search['body']['query']['bool']['should'] = array(
		array('match' => array('category' => $cat))		
	);	
}else if(!empty($group))
{	
	if(!empty($group_alt))
	{
		$search['body']['query']['bool']['should'] = array(
			array('match' => array('grp' => $group)),
			array('match' => array('grp' => $group_alt))
		);	

	}else{
		$search['body']['query']['bool']['should'] = array(
			array('match' => array('grp' => $group))
		);
	}
}

if(!empty($prod))
{				
	$search['body']['query']['bool']['must_not'] = array(
		array('match' => array('product_id' => $prod))    
	);		
}
if(!empty($vendor))
{				
	$search['body']['query']['bool']['must_not'] = array(
		array('match' => array('vendor' => $vendor))    
	);		
}


//print_r(json_encode($search));
$result = $client->search($search);
//echo "<pre>";print_r(($result));exit;
$arr = array('status'=>true,'keycode'=>100,'products' => $result);

if(isset($get['pretty']))
{
	header("Content-type:application/json"); 
	echo json_encode($arr, JSON_PRETTY_PRINT);
}else{
	echo json_encode($arr);
}
?>