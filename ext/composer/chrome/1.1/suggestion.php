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

$vendor_logo = array(
	"0" => "http://www.indiashopps.com/images/logo1.jpg",
	"1" => "http://www.indiashopps.com/vendor_logo/flipkart_logo.png",
	"2" => "http://www.indiashopps.com/vendor_logo/jabong_logo.png",
	"3" => "http://www.indiashopps.com/vendor_logo/amazon_logo.png",
	"4" => "http://www.indiashopps.com/vendor_logo/myntra_logo.png",
	"5" => "http://www.indiashopps.com/vendor_logo/homeshop18_logo.png",
	"6" => "http://www.indiashopps.com/vendor_logo/naaptol_logo.png",
	"7" => "http://www.indiashopps.com/vendor_logo/shopclues_logo.png",
	"8" => "http://www.indiashopps.com/vendor_logo/indiatime_logo.png",
	"9" => "http://www.indiashopps.com/vendor_logo/Maniacstore.png",
	"10" => "http://www.indiashopps.com/vendor_logo/Play-Rummy_logo.png",
	"11" => "http://www.indiashopps.com/vendor_logo/dominos_logo.png",
	"12" => "http://www.indiashopps.com/vendor_logo/expedia_logo.png",
	"13" => "http://www.indiashopps.com/vendor_logo/makemytrip_logo.png",
	"14" => "http://www.indiashopps.com/vendor_logo/rediff_logo.png",
	"15" => "http://www.indiashopps.com/vendor_logo/yebhi_logo.png",
	"16" => "http://www.indiashopps.com/vendor_logo/snapdeal_logo.png",
	"17" => "http://www.indiashopps.com/vendor_logo/pepperfry_logo.png",
	"18" => "http://www.indiashopps.com/vendor_logo/Infibeam_logo.png",
	"19" => "http://www.indiashopps.com/vendor_logo/saholic_logo.png",
	"20" => "http://www.indiashopps.com/vendor_logo/croma_logo.png",
	"21" => "http://www.indiashopps.com/vendor_logo/trendin_logo.png",
	"22" => "http://www.indiashopps.com/vendor_logo/zovi_logo.png",
	"23" => "http://www.indiashopps.com/vendor_logo/firstcry_logo.png",
	"24" => "http://www.indiashopps.com/vendor_logo/lenskart_logo.png",
	"25" => "http://www.indiashopps.com/vendor_logo/fashionara_logo.png",
	"26" => "http://www.indiashopps.com/vendor_logo/fashionandyou_logo.png",
	"27" => "http://www.indiashopps.com/vendor_logo/americanswan_logo.png",
	"28" => "http://www.indiashopps.com/vendor_logo/babyoye_logo.png",
	"29" => "http://www.indiashopps.com/vendor_logo/shopperzville_logo.png",
	"30" => "http://www.indiashopps.com/vendor_logo/fabfurnish_logo.png",
	"31" => "http://www.indiashopps.com/vendor_logo/urbandazzle_logo.png",
	"32" => "http://www.indiashopps.com/vendor_logo/healthkart_logo.png",
	"33" => "http://www.indiashopps.com/vendor_logo/urban_ladder_logo.png",
	"34" => "http://www.indiashopps.com/vendor_logo/koovs_logo.png",
	"35" => "http://www.indiashopps.com/vendor_logo/zivame_logo.png",
	"36" => "http://www.indiashopps.com/vendor_logo/prettysecrets_logo.png",
	"37" => "http://www.indiashopps.com/vendor_logo/100bestbuy_logo.png",
	"38" => "http://www.indiashopps.com/vendor_logo/freecultr_logo.png",
	"39" => "http://www.indiashopps.com/vendor_logo/foodpanda_logo.png",
	"40" => "http://www.indiashopps.com/vendor_logo/ebayi_logo.png",
	"41" => "http://www.indiashopps.com/vendor_logo/limeroad_logo.png",
	"42" => "http://www.indiashopps.com/vendor_logo/StalkBuyLove_logo.png",
	"43" => "http://www.indiashopps.com/vendor_logo/yepme_logo.png",
	"44" => "http://www.indiashopps.com/vendor_logo/paytm_logo.png",
	"45" => "http://www.indiashopps.com/vendor_logo/fashionandyou_logo.png",
	"46" => "http://www.indiashopps.com/vendor_logo/askmebazaar_logo.png",
	"47" => "http://www.indiashopps.com/vendor_logo/bagittoday_logo.png",
	"48" => "http://www.indiashopps.com/vendor_logo/theelectronicstore_logo.png",
	"49" => "http://www.indiashopps.com/vendor_logo/theitdepot_logo.png",
	"50" => "http://www.indiashopps.com/vendor_logo/syberplace.png",
	"51" => "http://www.indiashopps.com/vendor_logo/shopmonk.png",
	"52" => "http://www.indiashopps.com/vendor_logo/next.png",
	"53" => "http://www.indiashopps.com/vendor_logo/gadgets360_logo.png"
);

$cat 	= "";
$group 	= "";
$group_alt = "";
$productInfo 	= $_REQUEST['info'];
$prod 			= isset($_REQUEST['prod'])?$_REQUEST['prod']:"";
$cat_post 		= isset($_REQUEST['cat'])?$_REQUEST['cat']:"";
$group_post		= isset($_REQUEST['group'])?$_REQUEST['group']:"";
$vendor		= isset($_REQUEST['vendor_post'])?$_REQUEST['vendor_post']:"";
$size		= isset($_REQUEST['size'])?$_REQUEST['size']:10;


if(isset($cat_post) && !empty($cat_post) && (trim($cat_post) == 'Smartphones' || trim($cat_post) == 'Basic Mobiles'|| trim($cat_post) == 'Feature Phones'|| trim($cat_post) == 'Mobile Phones' || trim($cat_post) == 'Mobiles'))
{
	$cat = "mobiles";	
}else if(isset($cat_post) && !empty($cat_post) && (trim($cat_post) == 'Digital Cameras' || trim($cat_post) == 'Cameras' || trim($cat_post) == 'Point & Shoot Digital Cameras' || trim($cat_post) == 'Digital SLRs'))
{
	$cat = "digital cameras";	
}else if(isset($cat_post) && !empty($cat_post) && (trim(strtolower($cat_post)) == 'laptops'))
{
	$cat = "laptops";	
}
if (strpos(strtolower($cat_post), 'women') !== false) {
   $group = "women";
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
			$group = "women";
			$group_alt = "unisex";
		break;
		case "men's":
		case 'men':
			$group = "men";
			$group_alt = "unisex";
		break;
		case 'boys':
		case 'girls':
		case 'kids':
		case "kids'":
			$group = "kids";
			$group_alt = "unisex";
		break;
	/*	case 'hardware':
		case 'home':		
			$group = "home";
		break;	
		case 'kitchen':
		case 'kitchenware':
			$group = "appliances";
		break;	*/
		case 'books':
			$group = "books";
		break;
		case 'mobiles':
			$group = "mobile";
		break;
		case 'electronic':
			$group = "electronic";
		break;
		case 'automobiles':
			$group = "automobiles";
		break;
		case 'sports':
			$group = "sports";
		break;
		case 'travel':
			$group = "travel";
		break;
		case 'accessories':
			$group = "accessories";
		break;
		
	}	
}
if(strtolower($cat_post) == 'kitchen appliances')
	$group = "appliances";

if(!empty($prod))
{
	$code = substr( $prod, 0, 3 );
	switch($code)
	{
		case 'MOB':
			$cat = "mobiles";
		break;		
	}	
}

$productInfo = str_replace("/"," ",$productInfo);
$productInfo = str_replace(" AND "," ",$productInfo);
$productInfo = str_replace("AND ","",$productInfo);
$productInfo = str_replace(" and "," ",$productInfo);
$productInfo = str_replace("and ","",$productInfo);
$productInfo = str_replace(" OR "," ",$productInfo);
$productInfo = str_replace(" or "," ",$productInfo);
$productInfo = str_replace(" pack of "," ",strtolower($productInfo));
$productInfo = str_replace("pack of ","",strtolower($productInfo));
$productInfo = str_replace("pack of"," ",strtolower($productInfo));
$productInfo = str_replace(" pack of","",strtolower($productInfo));
$productInfo = str_replace(" pairs of "," ",strtolower($productInfo));
$productInfo = str_replace("pairs of ","",strtolower($productInfo));
$productInfo = str_replace("pairs of"," ",strtolower($productInfo));
$productInfo = str_replace(" pairs of","",strtolower($productInfo));

$clickUrl = 'http://www.indiashopps.com/ext/log.php';
$search = array();

$search['index'] = "shopping";
if($group == 'books')
	$search['index'] = "books";
//$search['from']  = $data['from'];
$search['body'] = array(
	'size' => $size,
	'query' => array(
		'function_score' => array(
		'query' => array(
		'bool' => array(			
			'minimum_should_match'=>'75%'
		)
		)
		)
	)
);



$srchShould="";
$must[] = array('match' => array('track_stock' => 1));
if(!empty($productInfo))
{
	$srchShould[] = array('match' => array('name' => array('query' => $productInfo,'operator' => 'or','boost' => '2')));
	$srchShould[] = array('match' => array('tags' => array('query' => $productInfo,'operator' => 'and','boost' => '5')));
}
if(!empty($prod))
{				
	$search['body']['query']['function_score']['query']['bool']['must_not'] = array(
		array('match' => array('product_id' => $prod))    
	);		
}
if(!empty($vendor))
{				
	$search['body']['query']['function_score']['query']['bool']['must_not'] = array(
		array('match' => array('vendor' => $vendor))    
	);		
}
$shouldcat="";
$shouldgrp="";
if(!empty($cat))
{				
	$shouldcat[] = array('match' => array('category' => strtolower($cat)));
}
if(!empty($group))
{				
	$shouldgrp[] = array('match' => array('grp' => strtolower($group)));
}



$search['body']['query']['function_score']['query']['bool']['must'] = $must;
if(!empty($srchShould))
	$search['body']['query']['function_score']['query']['bool']['must'][]['bool']['should'] = $srchShould;
if(!empty($shouldcat))
	$search['body']['query']['function_score']['query']['bool']['must'][]['bool']['should'] = $shouldcat;
if(!empty($shouldgrp))
	$search['body']['query']['function_score']['query']['bool']['must'][]['bool']['should'] = $shouldgrp;



$functions = array(array('filter'=> array('match' => array('category_id' => 351)),'weight' => 4));
$search['body']['query']['function_score']['functions'] = $functions;
$search['body']['query']['function_score']['max_boost'] = 8;
$search['body']['query']['function_score']['score_mode'] = 'max';
$search['body']['query']['function_score']['boost_mode'] = 'multiply';


//print_r(json_encode($search));exit;
$result = $client->search($search);

	
if(!empty($result))
{
	//print_r($result['hits']);exit;
	$return_txt ="";
	//if($vendor != 1 && $vendor !=2 && $vendor !=3  && $vendor !=5 )
	{
		$return_txt = '<a target="_parent" class="buttons prev disable" href="javascript:void(0)">left</a><div class="viewport"><ul class="overview">';		
		$i=1;
		foreach($result['hits']['hits'] as $val){ 
			if($i <= 10)
			{
				$targetUrl = "";	
				$val = $val['_source'];
				//print_r($val);
				if($val['vendor']==1)
					$img = get_img($val['image_url']);
				else
					$img = $val['image_url'];
				
				if($val['vendor']==22)
				{
					if(!is_file_exists($img))
					{
						$img = str_replace("1_c","2_c",$img);
					}
				}
								if(json_decode($img) != NULL)				{					$img = json_decode($img);					$img = $img[0];				}
				if($val['vendor']==0)
				{
					$targetUrl = "http://www.indiashopps.com/product/".create_slug($val['name'])."/".$val['id'];					
				}else{
					$targetUrl = $val['product_url'];
				}
				 $return_txt .= '<li id="'.$val['id'].'" vendor="'.$val['vendor'].'">' .  
								'<div class="ind-product"> ' .
								'<a href="' . $targetUrl . '" target="_blank" title="' . $val['name'] . '"> ' .
								'<div class="ind-product_img"> ' .
									'<img src="' . $img . '" style="max-height:100px;max-width:100px;"/>' .
								'</div>' .
								'<h5 class="ind-product-heading">'.truncate($val['name'],45).'</h5>' .
								'<div class="ind-product_contant">' .
								'<h5 class="ind-product-price">Rs.'. number_format($val['saleprice']) . '</h5>' .
								'<h5 class="ind-product-logo"><img class="ind-vendor-logo" src="' . $vendor_logo[$val['vendor']] .'"></h5>' .									
								'</div>' .
								'</a></div>' .
						'</li>' ;  
				$i++;
			}
		}
		$return_txt .= ' </ul>	</div>	<a target="_parent" class="buttons next" href="javascript:void(0)">right</a>';
		
	}
	
	
	
	
	//$arr = array('return_txt' => $return_txt);	
	//echo json_encode($arr);
	echo $return_txt;
}
function create_slug($string){
   $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
   $slug = strtolower($slug);
   return $slug;
}

function get_img( $img ) {
if(json_decode($img) != NULL)
{
	$img = json_decode($img);
	return $img[0];		
}
if(strpos($img,',') || strpos($img,';'))
{
	if(strpos($img,','))
	{
		$img = explode(",",$img);
	}else if(strpos($img,';')){
		$img = explode(";",$img);
	}
	$img = (!empty($img[5])?$img[5]:(!empty($img[0])?$img[0]:""));
	//echo $img;exit;
	if(!strpos($img,'100x100') && strpos($img,'40x40'))
	{
		$img = str_replace("40x40","100x100",$img);
		
	}
	if(!strpos($img,'100x100') && strpos($img,'400x400'))
	{
		$img = str_replace("400x400","100x100",$img);
		
	}
	if(!strpos($img,'100x100') && strpos($img,'125x125'))
	{
		$img = str_replace("125x125","100x100",$img);
		
	}if(!strpos($img,'100x100') && strpos($img,'275x275'))
	{
		$img = str_replace("275x275","100x100",$img);
		
	}if(!strpos($img,'100x100') && strpos($img,'200x200'))
	{
		$img = str_replace("200x200","100x100",$img);
		
	}
}
	return $img;
}
function is_file_exists($filePath)
{
      return is_file($filePath) && file_exists($filePath);
}
function truncate ($str, $length=10, $trailing='...')
{

      // take off chars for the trailing
      $length-=mb_strlen($trailing);
      if (mb_strlen($str)> $length)
      {
         // string exceeded length, truncate and add trailing dots
         return mb_substr($str,0,$length).$trailing;
      }
      else
      {
         // string was already short enough, return the string
         $res = $str;
      }
 
      return $res;
 
}
?>