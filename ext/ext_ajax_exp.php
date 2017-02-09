<?php 
header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

$vendor_logo = array(
"1" => "http://www.yourshoppingwizard.com/ext/img/flipkart.png",
"2" => "http://www.yourshoppingwizard.com/ext/img/jabong.png",
"3" => "http://www.yourshoppingwizard.com/ext/img/amazon_logo.jpg",
"4" => "http://myntra.myntassets.com/skin2/images/MyntraLogo.png",
"5" => "http://www.yourshoppingwizard.com/ext/img/homeshop18.png",
"6" => "http://images5.naptol.com/usr/local/csp/staticContent/images_layout-html5/naaptol.png",
"7" => "http://cdn.shopclues.com/images/skin/shopclues_logo.gif",			
"8" => "http://www.yourshoppingwizard.com/ext/img/indiatimes_logo.jpg",
"9" => "http://www.maniacstore.com/images/FW/logo.png",

"11" => "http://sasstag.com/wp-content/uploads/2013/05/dominos-pizza-inc-logo.jpg",
"12" => "http://www.yourshoppingwizard.com/images/expedia_co_in.png",
"13" => "http://www.yourshoppingwizard.com/images/mmt_logo.png",

"14" => "http://www.yourshoppingwizard.com/ext/img/rediff-logo.jpg",
"15" => "http://www.yourshoppingwizard.com/ext/img/Yebhi-Logo.png",
"16" => "http://i3.sdlcdn.com/img/snapdeal/sprite/snapdeal_logo.png",
"17" => "http://i1.pepperfry.com/img/pf_header_logo.jpg?v=3",
"18" => "http://www.infibeam.com/assets/skins/common/images/infibeam_logo.png",
"19" => "http://www.saholic.com/images/saholic-logo-5648.jpg",
"20" => "http://www.cromaretail.com/images/croma-retail-logo.png",
"21" => "http://static4.cdntrendin.com/img/logo_v2.png",
"22" => "http://d32vlg867bsa1v.cloudfront.net/z/prod/w/2/i/zovi-logo2.png",
"23" => "http://www.yourshoppingwizard.com/ext/img/first-cry-logo.jpg",
"24" => "http://dxq0awx9u4n5p.cloudfront.net/skin/frontend/default/blanco_sun/images/logo_lens.png",
"25" => "http://static.fashionara.com/media/homepage/Logo05.png",
"26" => "http://www.fashionandyou.com/assets/4229/app/components/fny_logo_new.png",
"27" => "http://img.americanswan.com/skin/frontend/enterprise/lecom/images/logo.gif",
"28" => "http://media.babyoye.com/images/babyoye-logo.png",
"29" => "http://fostelo.com/image/data/banners/fostelologo.png",
"30" => "http://www.yourshoppingwizard.com/ext/img/fab.jpg",
"31" => "http://www.urbandazzle.com/skin/frontend/default/default/images/logo1.png",
"32" => "http://static.healthkart.com/assets/images/HK-Logo.png",
"33" => "http://s.urbanladder.com/skin/frontend/default/urbanladder/images/logo.png",
"34" => "http://images.kooves.com/images/kv/KOOVS-Fashion-logo-new.jpg",
"35" => "http://cdn.zivame.mobi/skin/frontend/base/theme049/images/zivame_logo.png",
"36" => "http://www.yourshoppingwizard.com/ext/img/preetysecrets.png",
"37" => "http://images.100bestbuy.com/menu/new/bestbuy.jpg",
"38" => "http://grabbestoffers.com/wp-content/themes/couponpress/thumbs/freecultr_logo.png",
"39" => "http://www.yourshoppingwizard.com/images/fp_logo.png.png"
);

$productInfo = $_REQUEST['info'];
//$productInfo = "PrettySecrets Solid Women's";
$productInfo = str_replace("/","-",$productInfo);

//$dist_id = $_POST['dist_id'];
$from=1;
$file = fopen("flag.txt", "r") or die("Unable to open file!");
$flag = fgets($file);
fclose($file);
$file = fopen("flag.txt", "w+") or die("Unable to open file!");
if($flag == 1)
{
	fwrite($file,"0");
	
}else{
	$from=5;
	fwrite($file,"1");
}
fclose($file);


$clickUrl = 'http://www.yourshoppingwizard.com/ext/log.php';

$searchAPI = 'http://103.252.96.182:9200/shopping/_search';
$serializedResult = file_get_contents($searchAPI.'?q='.urlencode($productInfo)."&size=4&from=$from");

//$search['query']['filtered']['query']['match']['name'] = $productInfo;	
//$search['query']['match']['name'] = $productInfo;	

#$search['from']  = $data['from'];
//$search['size']  = 4;
//echo json_encode($search);
//$serializedResult = httpPost($searchAPI,json_encode($search));
//echo $serializedResult;exit;




$result = json_decode($serializedResult);
//print_r($result->hits);
foreach($result->hits->hits as $val){ 
$targetUrl = "";
$return_txt = "";
	$val = $val->_source;
	//print_r($val);
	if($val->vendor==1)
		$img = get_img($val->image_url);
	else
		$img = $val->image_url;
	 //$targetUrl = $clickUrl."?vendor=".$val->vendor . '&url=' . urlencode($val->product_url) . '&distributer_id='.$dist_id;
	 $targetUrl = $clickUrl."?vendor=".$val->vendor . '&url=' . urlencode($val->product_url);
	// if($val->vendor ==2 || $val->vendor==4|| $val->vendor==5)
	 {
		//$targetUrl = $clickUrl."?vendor=".$val->vendor . '&url=' . $val->product_url;
		//$targetUrl = $val->product_url;
	 }
	
	 $return_txt = '<a href="' . $targetUrl . '" target="_blank" title="' . $val->name . '">' .  
				'<div class="dz-grid">'.
					'<div class="dz-thumb" style="min-width:80px;text-align:center"> ' .
						'<img src="' . $img . '" style="max-height:121px;max-width:115px;"/>' .
					'</div>' .
					'<div class="dz-info">' .
						'<div class="dz-price">Rs. ' . $val->saleprice . '</div>' .
						'<div class="dz-title">' . 
							$val->name . 
						'...</div>'.
						'<div class="dz-logo"><img src="' . $vendor_logo[$val->vendor] .'" width="100px" height="20px"> </div>'.
					'</div>' .
				'</div>' .
			'</a>' ;  
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
function httpPost($url,$params)
{
  $postData = '';
   //create name value pairs seperated by &
   foreach($params as $k => $v) 
   { 
      $postData .= $k . '='.$v.'&'; 
   }
   rtrim($postData, '&');
 
    $ch = curl_init();  
 
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_HEADER, false); 
    curl_setopt($ch, CURLOPT_POST, count($postData));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);    
 
    $output=curl_exec($ch);
 
    curl_close($ch);
    return $output;
 
}

?>

	