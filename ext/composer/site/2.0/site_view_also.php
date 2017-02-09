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

$vendor_logo = array(
"1" => "http://www.indiashopps.com/ext/img/flipkart.png",
"2" => "http://www.indiashopps.com/ext/img/jabong.png",
"3" => "http://www.indiashopps.com/ext/img/amazon_logo.jpg",
"4" => "http://myntra.myntassets.com/skin2/images/MyntraLogo.png",
"5" => "http://www.indiashopps.com/ext/img/homeshop18.png",
"6" => "http://images5.naptol.com/usr/local/csp/staticContent/images_layout-html5/naaptol.png",
"7" => "http://cdn.shopclues.com/images/skin/shopclues_logo.gif",			
"8" => "http://www.indiashopps.com/ext/img/indiatimes_logo.jpg",
"9" => "http://www.maniacstore.com/images/FW/logo.png",
"11" => "http://sasstag.com/wp-content/uploads/2013/05/dominos-pizza-inc-logo.jpg",
"12" => "http://www.indiashopps.com/images/expedia_co_in.png",
"13" => "http://www.indiashopps.com/images/mmt_logo.png",
"14" => "http://www.indiashopps.com/ext/img/rediff-logo.jpg",
"15" => "http://www.indiashopps.com/ext/img/Yebhi-Logo.png",
"16" => "http://i3.sdlcdn.com/img/snapdeal/sprite/snapdeal_logo.png",
"17" => "http://i1.pepperfry.com/img/pf_header_logo.jpg?v=3",
"18" => "http://www.infibeam.com/assets/skins/common/images/infibeam_logo.png",
"19" => "http://www.saholic.com/images/saholic-logo-5648.jpg",
"20" => "http://www.cromaretail.com/images/croma-retail-logo.png",
"21" => "http://assets.trendin.com/img/app/others/logo_v3.jpg",
"22" => "http://d32vlg867bsa1v.cloudfront.net/z/prod/w/2/i/zovi-logo2.png",
"23" => "http://www.indiashopps.com/ext/img/first-cry-logo.jpg",
"24" => "http://dxq0awx9u4n5p.cloudfront.net/skin/frontend/default/blanco_sun/images/logo_lens.png",
"25" => "http://static.fashionara.com/media/homepage/Logo05.png",
"26" => "http://www.fashionandyou.com/assets/4229/app/components/fny_logo_new.png",
"27" => "http://www.americanswan.com/assets/images/logo.png",
"28" => "http://media.babyoye.com/images/babyoye-logo.png",
"29" => "http://fostelo.com/image/data/banners/fostelologo.png",
"30" => "http://www.indiashopps.com/ext/img/fab.jpg",
"31" => "http://www.urbandazzle.com/skin/frontend/default/default/images/logo1.png",
"32" => "http://static.healthkart.com/assets/images/HK-Logo.png",
"33" => "http://s.urbanladder.com/skin/frontend/default/urbanladder/images/logo.png",
"34" => "http://images.kooves.com/images/kv/KOOVS-Fashion-logo-new.jpg",
"35" => "http://cdn.zivame.mobi/skin/frontend/base/theme049/images/zivame_logo.png",
"36" => "http://www.indiashopps.com/ext/img/preetysecrets.png",
"37" => "http://images.100bestbuy.com/menu/new/bestbuy.jpg",
"38" => "http://grabbestoffers.com/wp-content/themes/couponpress/thumbs/freecultr_logo.png",
"39" => "http://www.indiashopps.com/images/fp_logo.png",
"40" => "http://www.indiashopps.com/ext/img/ebay.png",
"41" => "http://www.indiashopps.com/ext/img/limeroad.jpg",
"42" => "http://www.stalkbuylove.com/skin/frontend/SBL/default/images/logo.png",
"43" => "http://staticaky.yepme.com/images/yepme-logo.gif",
"44" => "http://www.indiashopps.com/images/paytm_logo.png",
"45" => "http://static.fashionandyou.com/app-images/logo.png"
);

$cat 	= "";
$group 	= "";
$group_alt = "";
$productInfo 	= $_REQUEST['info'];
$prod 			= isset($_REQUEST['pid'])?$_REQUEST['pid']:"";
$cat 		= isset($_REQUEST['cat'])?$_REQUEST['cat']:"";
$cat_id 		= isset($_REQUEST['cat_id'])?$_REQUEST['cat_id']:"";
$group_post		= isset($_REQUEST['group'])?$_REQUEST['group']:"";
$vendor		= isset($_REQUEST['vendor_post'])?$_REQUEST['vendor_post']:"";
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

$search['index'] = "shopping";

	
//$search['from']  = $data['from'];
$search['body'] = array(
	'size' => 20,
	'query' => array(
		'bool' => array(
			'must' =>  array(
						array('match' => array('name' => $productInfo)),
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
		array('match' => array('_id' => $prod))    
	);		
}
// echo "<PRE>";
// print_r( $search );exit;

//print_r(json_encode($search));
$result = $client->search($search);

//print_r($result['hits']['hits']);exit;
$arr = array('return_txt' => $result['hits']['hits']);
echo json_encode($arr);
	//echo $return_txt;



function get_img( $img ) {
//print_r($img);exit;
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
function get_img1( $img ) {
//print_r($img);exit;
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
		
	}if(!strpos($img,'200x200') && strpos($img,'700x700'))
	{
		
		$img = str_replace("700x700","200x200",$img);
		
	}
}
	return $img;
}
function get_img2( $img ) {
//print_r($img);exit;
if(strpos($img,',') || strpos($img,';'))
{
	if(strpos($img,','))
	{
		$img = explode(",",$img);
	}else if(strpos($img,';')){
		$img = explode(";",$img);
	}
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