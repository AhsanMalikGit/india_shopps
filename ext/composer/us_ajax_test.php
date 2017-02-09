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

$productInfo 	= $_REQUEST['info'];

$productInfo = str_replace("/","-",$productInfo);
$productInfo = str_replace(" AND ","",$productInfo);
$productInfo = str_replace("AND ","",$productInfo);
$productInfo = str_replace(" and ","",$productInfo);
$productInfo = str_replace("and ","",$productInfo);
$productInfo = str_replace(" OR ","",$productInfo);
$productInfo = str_replace(" or ","",$productInfo);

$clickUrl = 'http://www.yourshoppingwizard.com/ext/log.php';
$searchAPI = 'http://www.yourshoppingwizard.com:9200/shopping/_search';
$search = array();
$search['index'] = "shopping";
//$search['from']  = $data['from'];
$search['body'] = array(
	'size' => 20,
	'query' => array(
		'bool' => array(
			'must' =>  array(
						array('match' => array('name' => $productInfo))    
					)			
		)
	)
);



//print_r(json_encode($search));
$result = $client->search($search);

	
if(!empty($result))
{
	//print_r($result['hits']);exit;
	$return_txt ="";
	//if($vendor != 1 && $vendor !=2 && $vendor !=3  && $vendor !=5 )
	{
		$return_txt = '<a target="_parent" class="buttons prev disable" href="javascript:void(0)">left</a><div class="viewport"><ul class="overview" style="width: 4940px; left: 0px;">';
		$i=1;
		foreach($result['hits']['hits'] as $val){ 
			if($i <= 8)
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
			
				 $targetUrl = $clickUrl."?vendor=".$val['vendor'] . '&url=' . urlencode($val['product_url']);
				 $return_txt .= '<li id="'.$val['product_id'].'" vendor="'.$val['vendor'].'"><a href="' . $targetUrl . '" target="_blank" title="' . $val['name'] . '">' .  
								'<div class="dz-grid"> ' .
								'<div class="dz-thumb"> ' .
									'<img src="' . $img . '" style="max-height:121px;max-width:100px;"/>' .
								'</div>' .
								'<div class="dz-info">' .
									'<div class="dz-price">Rs. ' . $val['saleprice'] . '</div>' .
									'<div class="dz-title">' . 
										$val['name'] . 
									'...</div>'.
									'<div class="dz-logo"><img src="' . $vendor_logo[$val['vendor']] .'" width="100px" height="20px"> </div>'.
								'</div>' .
								'</div>' .
						'</a></li>' ;  
				$i++;
			}
		}
		$return_txt .= ' </ul>	</div>	<a target="_parent" class="buttons next" href="javascript:void(0)">right</a>';
	}
	
	
	
	//echo "fk_return_txt:".$fk_return_txt.",return_txt".$return_txt;
	//$arr = array('rd_return_txt' => $rd_return_txt, 'return_txt' => $return_txt);
	//echo json_encode($arr);
	echo $return_txt;
}


function get_img( $img ) {
//print_r($img);exit;
if(strpos($img,','))
{
	$img = explode(",",$img);
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
function get_img1( $img ) {
//print_r($img);exit;
if(strpos($img,','))
{
	$img = explode(",",$img);
	$img = (!empty($img[5])?$img[5]:(!empty($img[0])?$img[0]:""));
	//echo $img;exit;
	if(!strpos($img,'200x200') && strpos($img,'40x40'))
	{
		$img = str_replace("40x40","200x200",$img);
		
	}
	if(!strpos($img,'200x200') && strpos($img,'400x400'))
	{
		$img = str_replace("400x400","200x200",$img);
		
	}
	if(!strpos($img,'200x200') && strpos($img,'125x125'))
	{
		$img = str_replace("125x125","200x200",$img);
		
	}if(!strpos($img,'200x200') && strpos($img,'275x275'))
	{
		$img = str_replace("275x275","200x200",$img);
		
	}if(!strpos($img,'200x200') && strpos($img,'100x100'))
	{
		
		$img = str_replace("100x100","200x200",$img);
		
	}
}
	return $img;
}
function get_img2( $img ) {
//print_r($img);exit;
if(strpos($img,','))
{
	$img = explode(",",$img);
	$img = (!empty($img[0])?$img[0]:(!empty($img[5])?$img[5]:""));
	//echo $img;exit;
	if(!strpos($img,'400x400') && strpos($img,'40x40'))
	{
		$img = str_replace("40x40","400x400",$img);
		
	}if(!strpos($img,'400x400') && strpos($img,'75x75'))
	{
		$img = str_replace("75x75","400x400",$img);
		
	}
	if(!strpos($img,'400x400') && strpos($img,'275x275'))
	{
		$img = str_replace("275x275","400x400",$img);
		
	}
	if(!strpos($img,'400x400') && strpos($img,'125x125'))
	{
		$img = str_replace("125x125","400x400",$img);
		
	}if(!strpos($img,'400x400') && strpos($img,'100x100'))
	{		
		$img = str_replace("100x100","400x400",$img);
		
	}if(!strpos($img,'400x400') && strpos($img,'125x167'))
	{		
		$img = str_replace("125x167","400x400",$img);
		
	}
}
	return $img;
}
function is_file_exists($filePath)
{
      return is_file($filePath) && file_exists($filePath);
}

?>

	